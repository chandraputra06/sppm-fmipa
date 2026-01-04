<?php

namespace App\Imports;

use App\Models\Achievement;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class AchievementImport implements
    ToModel,
    WithHeadingRow,
    WithValidation,
    SkipsOnFailure,
    SkipsEmptyRows,
    WithBatchInserts,
    WithChunkReading
{
    use SkipsFailures;

    /**
     * Mapping setiap baris Excel → DB
     */
    public function model(array $row)
    {
        // cari mahasiswa berdasarkan nim yang terdaftar karena nim itu unik
        $nim = trim((string) $row['nim']);

        $student = Student::where('nim', $nim)->first();

        // set up jenis prestasi untuk pilihan enum
        $category = match (strtolower($row['jenis_prestasi'])) {
            'akademik' => 1,
            'non akademik', 'non-akademik' => 2,
            default => null,
        };

        if (!$category) {
            throw ValidationException::withMessages([
                'jenis_prestasi' => "Jenis Prestasi tidak valid: {$row['jenis_prestasi']}",
            ]);
        }

        // set up tingkat prestasi yang di pilih
        $grade = ucfirst(strtolower($row['tingkat']));

        if (!in_array($grade, ['Lokal', 'Nasional', 'Internasional'])) {
            throw ValidationException::withMessages([
                'tingkat' => "Tingkat tidak valid: {$row['tingkat']}",
            ]);
        }

        // parsing tanggal dari format DD/MM/YYYY atau serial Excel ke Y-m-d
        try {
            $rawDate = $row['tanggal_perolehan'];

            if (is_numeric($rawDate)) {
                // Excel menyimpan tanggal sebagai serial number
                $date = ExcelDate::excelToDateTimeObject($rawDate)->format('Y-m-d');
            } else {
                $date = Carbon::createFromFormat('d/m/Y', $rawDate)->format('Y-m-d');
            }
        } catch (\Throwable $e) {
            throw ValidationException::withMessages([
                'tanggal_perolehan' => "Format tanggal salah (DD/MM/YYYY)",
            ]);
        }

        return new Achievement([
            'student_id' => $student->id,
            'title'      => $row['nama_kegiatan'],
            'category'   => $category,
            'grade'      => $grade,
            'date'       => $date,
            'status'     => 'Draft', // default
        ]);
    }


    public function rules(): array
    {
        return [
            '*.nim' => ['required', 'exists:students,nim'],
            '*.jenis_prestasi' => ['required', function ($attribute, $value, $fail) {
                $normalized = strtolower(trim((string) $value));
                if (!in_array($normalized, ['akademik', 'non akademik', 'non-akademik'])) {
                    $fail('Jenis Prestasi harus Akademik atau Non Akademik');
                }
            }],
            '*.nama_kegiatan' => ['required'],
            '*.tingkat' => ['required', function ($attribute, $value, $fail) {
                $allowed = ['lokal', 'nasional', 'internasional'];
                if (!in_array(strtolower(trim((string) $value)), $allowed)) {
                    $fail('Tingkat harus Lokal / Nasional / Internasional');
                }
            }],
            '*.tanggal_perolehan' => ['required', function ($attribute, $value, $fail) {
                if (is_numeric($value)) {
                    return;
                }

                try {
                    Carbon::createFromFormat('d/m/Y', (string) $value);
                } catch (\Throwable $e) {
                    $fail('Format tanggal salah (DD/MM/YYYY)');
                }
            }],
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nim.required' => 'NIM wajib diisi',
            'nim.exists' => 'NIM tidak ditemukan di data mahasiswa',
            'nama_kegiatan.required' => 'Nama kegiatan wajib diisi',
        ];
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }
}

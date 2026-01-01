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

class AchievementImport implements
    ToModel,
    WithHeadingRow,
    WithValidation,
    SkipsOnFailure
{
    use SkipsFailures;

    /**
     * Mapping setiap baris Excel → DB
     */
    public function model(array $row)
    {
        // cari mahasiswa berdasarkan nim yang terdaftar karena nim itu unik
        $student = Student::where('nim', trim($row['nim']))->first();

        if (!$student) {
            throw ValidationException::withMessages([
                'nim' => "NIM {$row['nim']} tidak ditemukan",
            ]);
        }

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

        if (!in_array($grade, ['Fakultas', 'Universitas', 'Nasional', 'Internasional'])) {
            throw ValidationException::withMessages([
                'tingkat' => "Tingkat tidak valid: {$row['tingkat']}",
            ]);
        }

        // parsing tanggal dari format DD/MM/YYYY ke Y-m-d
        try {
            $date = Carbon::createFromFormat('d/m/Y', $row['tanggal_perolehan'])
                ->format('Y-m-d');
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
            '*.nim' => ['required'],
            '*.jenis_prestasi' => ['required'],
            '*.nama_kegiatan' => ['required'],
            '*.tingkat' => ['required'],
            '*.tanggal_perolehan' => ['required'],
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nim.required' => 'NIM wajib diisi',
            'nama_kegiatan.required' => 'Nama kegiatan wajib diisi',
        ];
    }
}

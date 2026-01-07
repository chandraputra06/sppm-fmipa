<?php

namespace App\Exports;

use App\Models\Achievement;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportAchievementExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    ShouldAutoSize
{
    private int $rowNumber = 0;

    public function headings(): array
    {
        return [
            'No',
            'Judul Prestasi',
            'Nama Mahasiswa',
            'NIM',
            'Program Studi',
            'Jenis Prestasi',
            'Tingkat',
            'Tanggal',
            'Status',
        ];
    }

    public function map($achievement): array
    {
        return [
            ++$this->rowNumber,
            $achievement->title,
            $achievement->students->name ?? '-',
            $achievement->students->nim ?? '-',
            $achievement->students?->studyProgram->name ?? '-',
            $achievement->jenis_prestasi,
            $achievement->grade,
            optional($achievement->date)->format('d-m-Y'),
            $achievement->status,
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $endDate = Carbon::now();               // hari ini
        $startDate = Carbon::now()->subMonths(3); // 3 bulan ke belakang

        return Achievement::with(['students.studyProgram'])
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date')
            ->get();
    }
}

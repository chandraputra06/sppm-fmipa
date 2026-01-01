<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AchievementTemplateExport implements
    FromArray,
    WithHeadings,
    WithColumnWidths,
    WithStyles
{
    public function headings(): array
    {
        return [
            'NIM',
            'Nama Mahasiswa',
            'Program Studi',
            'Jenis Prestasi',
            'Nama Kegiatan',
            'Tingkat',
            'Tanggal Perolehan',
        ];
    }

    public function array(): array
    {
        return [
            [
                '2201234567',
                'Made Suteja',
                'Teknik Informatika',
                'Akademik',
                'Juara 1 Lomba Karya Tulis',
                'Nasional',
                '31/12/2025',
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 18,
            'B' => 25,
            'C' => 25,
            'D' => 35,
            'E' => 35,
            'F' => 45,
            'G' => 30,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);

        return [];
    }
}

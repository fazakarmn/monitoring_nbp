<?php

namespace App\Exports\Sheets;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class BomSheet implements FromArray, WithHeadings, WithTitle, WithStyles
{
    public function __construct(protected Project $project) {}

    public function title(): string { return 'Bill of Material'; }

    public function headings(): array
    {
        return ['Section', 'No', 'Part No', 'Rev', 'Description', 'Grade', 'Qty', 'Length', 'Unit Sq Area', 'Unit Weight', 'Total Weight', 'Remarks'];
    }

    public function array(): array
    {
        $rows = [];
        $sections = ['structure' => 'STRUCTURE', 'bolt_nut_washer' => 'BOLT, NUT & WASHER'];
        foreach ($sections as $key => $label) {
            foreach ($this->project->bom_data[$key] ?? [] as $item) {
                $rows[] = [
                    $label,
                    $item['no'] ?? '-',
                    $item['part_no'] ?? '-',
                    $item['rev'] ?? '-',
                    $item['description'] ?? '-',
                    $item['grade'] ?? '-',
                    $item['qty'] ?? 0,
                    $item['length'] ?? 0,
                    $item['unit_sq_area'] ?? '-',
                    $item['unit_weight'] ?? 0,
                    $item['total_weight'] ?? 0,
                    $item['remarks'] ?? '-',
                ];
            }
        }
        return $rows;
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']], 'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '55ACEE']]],
        ];
    }
}

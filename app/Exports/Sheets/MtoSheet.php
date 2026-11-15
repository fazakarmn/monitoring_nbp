<?php

namespace App\Exports\Sheets;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class MtoSheet implements FromArray, WithHeadings, WithTitle, WithStyles
{
    public function __construct(protected Project $project) {}

    public function title(): string { return 'Material Take Off'; }

    public function headings(): array
    {
        return ['Section', 'Description', 'Grade', 'Qty', 'Length', 'Unit Weight', 'Total Weight', 'Stock', 'Purchase Order', 'Remarks'];
    }

    public function array(): array
    {
        $rows = [];
        $sections = ['profile' => 'PROFILE', 'plate' => 'PLATE', 'bolt_nut_washer' => 'BOLT, NUT & WASHER'];
        foreach ($sections as $key => $label) {
            foreach ($this->project->mto_data[$key] ?? [] as $item) {
                $rows[] = [
                    $label,
                    $item['description'] ?? '-',
                    $item['grade'] ?? '-',
                    $item['qty'] ?? 0,
                    $item['length'] ?? 0,
                    $item['unit_weight'] ?? 0,
                    $item['total_weight'] ?? 0,
                    $item['stock'] ?? '-',
                    $item['purchase_order'] ?? '-',
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

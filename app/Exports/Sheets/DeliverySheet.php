<?php

namespace App\Exports\Sheets;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class DeliverySheet implements FromArray, WithHeadings, WithTitle, WithStyles
{
    public function __construct(protected Project $project) {}

    public function title(): string { return 'Delivery'; }

    public function headings(): array
    {
        return ['Section', 'Assembly No', 'Rev', 'Description', 'Class', 'Qty (pcs)', 'Length (mm)', 'Unit Weight (kg)', 'Total Weight (kg)', 'Remarks'];
    }

    public function array(): array
    {
        return $this->project->deliveries->map(fn($d) => [
            $d->section,
            $d->assembly_no,
            $d->rev ?? '-',
            $d->description,
            $d->class ?? '-',
            $d->quantity,
            $d->length_mm ?? 0,
            $d->unit_weight_kg ?? 0,
            $d->total_weight_kg ?? 0,
            $d->remarks ?? '-',
        ])->toArray();
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']], 'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '55ACEE']]],
        ];
    }
}

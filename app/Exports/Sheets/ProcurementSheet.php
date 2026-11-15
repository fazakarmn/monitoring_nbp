<?php

namespace App\Exports\Sheets;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ProcurementSheet implements FromArray, WithHeadings, WithTitle, WithStyles
{
    public function __construct(protected Project $project) {}

    public function title(): string { return 'Material Procurement'; }

    public function headings(): array
    {
        return ['No. PO', 'Deskripsi', 'Supplier', 'Qty', 'Grade', 'Tanggal PO', 'Estimasi (ETA)', 'Status', 'MTC'];
    }

    public function array(): array
    {
        return $this->project->materialProcurements->map(fn($m) => [
            $m->no_po,
            $m->deskripsi ?? $m->part_no,
            $m->supplier,
            $m->qty ?? $m->qty_ordered,
            $m->grade,
            $m->tanggal_po ? $m->tanggal_po->format('d M Y') : '-',
            $m->eta ? $m->eta->format('d M Y') : '-',
            $m->status ?? 'On Track',
            $m->mtc,
        ])->toArray();
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']], 'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '55ACEE']]],
        ];
    }
}

<?php

namespace App\Exports\Sheets;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class BoqSheet implements FromArray, WithHeadings, WithTitle, WithStyles
{
    public function __construct(protected Project $project) {}

    public function title(): string { return 'Bill of Quantity'; }

    public function headings(): array
    {
        return ['No', 'Description of Work', 'Unit', 'Qty', 'Unit Price (Rp)', 'Total Price (Rp)', 'Progress (%)', 'Nilai Tertagih (Rp)'];
    }

    public function array(): array
    {
        $rows = [];
        $grandTotal = 0; $grandTertagih = 0;
        foreach ($this->project->boq_data['items'] ?? [] as $item) {
            $tp = ($item['qty'] ?? 0) * ($item['unit_price'] ?? 0);
            $nt = $tp * (($item['progress'] ?? 0) / 100);
            $grandTotal += $tp; $grandTertagih += $nt;
            $rows[] = [
                $item['no'] ?? '-',
                $item['description'] ?? '-',
                $item['unit'] ?? '-',
                $item['qty'] ?? 0,
                $item['unit_price'] ?? 0,
                $tp,
                $item['progress'] ?? 0,
                $nt,
            ];
        }
        $rows[] = ['', 'TOTAL', '', '', '', $grandTotal, '', $grandTertagih];
        return $rows;
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']], 'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '55ACEE']]],
        ];
    }
}

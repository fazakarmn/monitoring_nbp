<?php

namespace App\Exports\Sheets;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class BopSheet implements FromArray, WithHeadings, WithTitle, WithStyles
{
    public function __construct(protected Project $project) {}

    public function title(): string { return 'Bill of Payment'; }

    public function headings(): array
    {
        return ['Nama Pembayaran', 'No. Invoice', 'Jatuh Tempo', 'Total (Rp)', 'Persentase (%)', 'Status', 'Keterangan'];
    }

    public function array(): array
    {
        return $this->project->billOfPayments->map(fn($p) => [
            $p->payment_name,
            $p->invoice_no ?? '-',
            $p->due_payment?->format('d M Y') ?? '-',
            $p->total,
            (float) $p->percentage,
            $p->status,
            $p->description ?? '-',
        ])->toArray();
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']], 'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '55ACEE']]],
        ];
    }
}

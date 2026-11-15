<?php

namespace App\Exports\Sheets;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ProjectInfoSheet implements FromArray, WithHeadings, WithTitle, WithStyles
{
    public function __construct(protected Project $project) {}

    public function title(): string { return 'Info & Progress'; }

    public function headings(): array
    {
        return ['Field', 'Value'];
    }

    public function array(): array
    {
        $p = $this->project;
        return [
            ['Work Order', $p->work_order],
            ['Customer', $p->customer],
            ['Tipe Jembatan', $p->bridge_type],
            ['Nilai Kontrak', 'Rp ' . number_format($p->contract_value ?? 0, 0, ',', '.')],
            ['Timeline Mulai', $p->timeline_start->format('d M Y')],
            ['Timeline Selesai', $p->timeline_end->format('d M Y')],
            ['Tanggal Desain', $p->design_date ? $p->design_date->format('d M Y') : '-'],
            ['Status', strtoupper($p->status)],
            ['', ''],
            ['=== PROGRESS ===', ''],
            ['Bill of Payment', ($p->prog_bill_of_payment ?? 0) . '%'],
            ['Design Engineering', ($p->prog_design_engineering ?? 0) . '%'],
            ['Bill of Material', ($p->prog_bill_of_material ?? 0) . '%'],
            ['Material Take Off', ($p->prog_material_take_off ?? 0) . '%'],
            ['Material Procurement', ($p->prog_material_procurement ?? 0) . '%'],
            ['Fabrication', ($p->prog_fabrication ?? 0) . '%'],
            ['Galvanized', ($p->prog_galvanized ?? 0) . '%'],
            ['Delivery', ($p->prog_delivery ?? 0) . '%'],
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true], 'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '55ACEE']], 'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']]],
            11 => ['font' => ['bold' => true], 'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1e2530']], 'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']]],
        ];
    }
}

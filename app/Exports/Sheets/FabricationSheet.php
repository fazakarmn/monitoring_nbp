<?php

namespace App\Exports\Sheets;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class FabricationSheet implements FromArray, WithHeadings, WithTitle, WithStyles
{
    public function __construct(protected Project $project) {}

    public function title(): string { return 'Fabrication'; }

    public function headings(): array
    {
        return ['Part No', 'Description', 'Qty Target', 'Cek Material', 'Pencocokan', 'Dinasting', 'Potong', 'Grinda', 'Assembling', 'Welding', 'Cek Finishing', 'Progress (%)', 'Welder', 'PIC', 'Tgl Update'];
    }

    public function array(): array
    {
        $rows = [];

        foreach ($this->project->fabrication_data['items'] ?? [] as $item) {
            $qty = (float)($item['qty_target'] ?? 0);
            $s = array_sum([
                (float)($item['cek_material'] ?? 0),
                (float)($item['pencocokan'] ?? 0),
                (float)($item['dinasting'] ?? 0),
                (float)($item['potong'] ?? 0),
                (float)($item['grinda'] ?? 0),
                (float)($item['assembling'] ?? 0),
                (float)($item['welding'] ?? 0),
                (float)($item['cek_finishing'] ?? 0),
            ]);
            $pct = $qty > 0 ? min(100, round(($s / ($qty * 8)) * 100)) : 0;

            $rows[] = [
                $item['part_no'] ?? '-',
                $item['description'] ?? '-',
                $item['qty_target'] ?? 0,
                $item['cek_material'] ?? 0,
                $item['pencocokan'] ?? 0,
                $item['dinasting'] ?? 0,
                $item['potong'] ?? 0,
                $item['grinda'] ?? 0,
                $item['assembling'] ?? 0,
                $item['welding'] ?? 0,
                $item['cek_finishing'] ?? 0,
                $pct,
                $item['welder_id'] ?? '-',
                $item['pic'] ?? '-',
                $item['tgl_update'] ?? '-',
            ];
        }

        // NCR rows (spacer + header)
        if (!empty($this->project->fabrication_data['ncr'])) {
            $rows[] = array_fill(0, 15, '');
            $rows[] = ['=== NCR ===', 'Part No', 'Deskripsi', 'Status', 'Tanggal', '', '', '', '', '', '', '', '', '', ''];
            foreach ($this->project->fabrication_data['ncr'] as $ncr) {
                $rows[] = ['', $ncr['part_no'] ?? '-', $ncr['deskripsi'] ?? '-', $ncr['status'] ?? '-', $ncr['tanggal'] ?? '-', '', '', '', '', '', '', '', '', '', ''];
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

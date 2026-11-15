<?php

namespace App\Http\Controllers;

use App\Exports\ProjectExport;
use App\Models\Project;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ProjectExportController extends Controller
{
    /**
     * Export project data as PDF.
     */
    public function pdf(Project $monitoring)
    {
        $project = $monitoring->load([
            'billOfPayments',
            'materialProcurements',
            'galvanizeds',
            'deliveries',
        ]);

        $pdf = Pdf::loadView('exports.project_pdf', compact('project'))
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'defaultFont' => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => false,
                'dpi' => 120,
            ]);

        $filename = 'project-' . str_replace('/', '-', $project->work_order) . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Export project data as Excel (multi-sheet).
     */
    public function excel(Project $monitoring)
    {
        $project = $monitoring->load([
            'billOfPayments',
            'materialProcurements',
            'galvanizeds',
            'deliveries',
        ]);

        $filename = 'project-' . str_replace('/', '-', $project->work_order) . '.xlsx';

        return Excel::download(new ProjectExport($project), $filename);
    }
}

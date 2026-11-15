<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use app\models\documentcomment;

class DocumentsController extends Controller
{
    public function index(Request $request)
    {
        $projects = \App\Models\Project::orderBy('work_order', 'asc')->get();
        $selectedProject = null;

        if ($request->has('work_order') && $request->work_order != '') {
            $selectedProject = \App\Models\Project::with([
                'billOfQuantities',
                'billOfPayments',
                'designEngineerings',
                'billOfMaterials',
                'materialTakeOffs',
                'materialProcurements',
                'fabrications',
                'galvanizeds',
                'deliveries',
            ])->where('work_order', $request->work_order)->first();
        }

        return view('documents.index', compact('projects', 'selectedProject'));
    }

    public function show(Request $request)
{
    $workOrder = $request->query('work_order', 'O0009');

    // Ambil semua komentar untuk dokumen ini, di-load bersama data user-nya
    $comments = DocumentComment::with('user')
        ->where('work_order', $workOrder)
        ->latest()
        ->get()
        ->groupBy('section'); // Dikelompokkan per section: 'boq', 'bop', 'design', 'bom'

    return view('monitoring._show_content', compact('project', 'comments'));
}
}
<?php

namespace App\Http\Controllers;

use App\Models\FabricationComponent;
use App\Models\NcrReport;
use Illuminate\Http\Request;

class FabricationController extends Controller
{
    public function index()
    {
        $components = FabricationComponent::all();
        $ncrs = NcrReport::latest()->get();

        return view('fabrication.index', compact('components', 'ncrs'));
    }

    public function storeComponent(Request $request)
    {
        $validated = $request->validate([
            'part_no' => 'required|string',
            'description' => 'required|string',
            'qty_target' => 'required|integer|min:1',
            'qty_cutting' => 'nullable|integer|min:0',
            'qty_fitup' => 'nullable|integer|min:0',
            'qty_welding' => 'nullable|integer|min:0',
            'qty_finishing' => 'nullable|integer|min:0',
            'welder_id' => 'nullable|string',
            'wps_ref' => 'nullable|string',
            'pic' => 'nullable|string',
            'start_date' => 'nullable|date',
        ]);

        FabricationComponent::updateOrCreate(
            ['part_no' => $request->part_no],
            $validated
        );

        return redirect()->back()->with('success', 'Komponen berhasil diperbarui.');
    }

    public function storeNcr(Request $request)
    {
        $validated = $request->validate([
            'part_no' => 'required|string',
            'defect_description' => 'required|string',
            'status' => 'required|in:Terbuka,Dalam Proses,Selesai',
        ]);

        NcrReport::create($validated);

        return redirect()->back()->with('success', 'Laporan NCR berhasil ditambahkan.');
    }
}
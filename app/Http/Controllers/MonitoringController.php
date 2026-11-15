<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MonitoringController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('bridge_type', 'like', '%' . $request->search . '%')
                  ->orWhere('work_order', 'like', '%' . $request->search . '%');
            });
        }

        $projects = $query->with('billOfPayments')->latest()->paginate(15);

        return view('monitoring.index', compact('projects'));
    }

    public function create()
    {
        return view('monitoring.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer'                 => 'required|string|max:100',
            'bridge_type'              => 'required|string|max:100',
            'work_order'               => 'required|string|max:50|unique:projects',
            'contract_value'           => 'nullable|numeric|min:0',
            'timeline_start'           => 'required|date',
            'timeline_end'             => 'required|date|after_or_equal:timeline_start',
            'bill_of_quantity_ton'     => 'nullable|numeric|min:0',
            'status'                   => 'nullable|in:done,on-going,pending',
            'prog_bill_of_payment'     => 'nullable|integer|min:0|max:100',
            'prog_design_engineering'  => 'nullable|integer|min:0|max:100',
            'prog_bill_of_material'    => 'nullable|integer|min:0|max:100',
            'prog_material_take_off'   => 'nullable|integer|min:0|max:100',
            'prog_material_procurement' => 'nullable|integer|min:0|max:100',
            'prog_fabrication'         => 'nullable|integer|min:0|max:100',
            'prog_galvanized'          => 'nullable|integer|min:0|max:100',
            'prog_delivery'            => 'nullable|integer|min:0|max:100',
        ]);

        DB::transaction(function () use ($data, &$project) {
            $project = Project::create($data);

            ActivityLog::create([
                'user_id'  => auth()->id(),
                'activity' => 'Created Project',
                'target'   => $project->bridge_type . ' - ' . $project->work_order,
            ]);
        });

        return redirect()->route('monitoring.index')
            ->with('success', 'Project berhasil ditambahkan.');
    }

    public function show(Project $monitoring)
    {
        $monitoring->load([
            'billOfQuantities',
            'billOfPayments',
            'designEngineerings',
            'billOfMaterials',
            'materialTakeOffs',
            'materialProcurements',
            'fabrications',
            'galvanizeds',
            'deliveries',
        ]);

        return view('monitoring.show', ['project' => $monitoring]);
    }

    public function edit(Project $monitoring)
    {
        $monitoring->load('billOfPayments');
        return view('monitoring.edit', ['project' => $monitoring]);
    }

    public function update(Request $request, Project $monitoring)
    {
        $data = $request->validate([
            'customer'                 => 'required|string|max:100',
            'bridge_type'              => 'required|string|max:100',
            'work_order'               => 'required|string|max:50|unique:projects,work_order,' . $monitoring->id,
            'contract_value'           => 'nullable|numeric|min:0',
            'timeline_start'           => 'required|date',
            'timeline_end'             => 'required|date|after_or_equal:timeline_start',
            'bill_of_quantity_ton'     => 'nullable|numeric|min:0',
            'status'                   => 'nullable|in:done,on-going,pending',
            'prog_bill_of_payment'     => 'nullable|integer|min:0|max:100',
            'prog_design_engineering'  => 'nullable|integer|min:0|max:100',
            'prog_bill_of_material'    => 'nullable|integer|min:0|max:100',
            'prog_material_take_off'   => 'nullable|integer|min:0|max:100',
            'prog_material_procurement' => 'nullable|integer|min:0|max:100',
            'prog_fabrication'         => 'nullable|integer|min:0|max:100',
            'prog_galvanized'          => 'nullable|integer|min:0|max:100',
            'prog_delivery'            => 'nullable|integer|min:0|max:100',
            'bop'                      => 'nullable|array',
            'delivery'                 => 'nullable|array',
            'procurement'              => 'nullable|array',
            'galvanized'               => 'nullable|array',
            'documents'                => 'nullable|array',
            'documents.*'              => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,zip,jpg,png|max:51200',
            'delete_documents'         => 'nullable|array',
            'design_date'              => 'nullable|date',
        ]);

        // Sanitasi Data MTO
        if ($request->has('mto_data')) {
            $mtoRaw = $request->input('mto_data');
            if (is_array($mtoRaw)) {
                foreach ($mtoRaw as $section => $rows) {
                    if ($section === 'header') continue;
                    if (is_array($rows)) {
                        $mtoRaw[$section] = array_values(array_filter($rows, function ($row) {
                            if (!is_array($row)) return false;
                            return collect($row)->contains(fn($v) => $v !== null && $v !== '');
                        }));
                    }
                }
            }
            $data['mto_data'] = $mtoRaw;
        }

        // Sanitasi Data BOM
        if ($request->has('bom_data')) {
            $bomRaw = $request->input('bom_data');
            if (is_array($bomRaw)) {
                foreach ($bomRaw as $section => $rows) {
                    if ($section === 'header') continue;
                    if (is_array($rows)) {
                        $bomRaw[$section] = array_values(array_filter($rows, function ($row) {
                            if (!is_array($row)) return false;
                            return collect($row)->contains(fn($v) => $v !== null && $v !== '');
                        }));
                    }
                }
            }
            $data['bom_data'] = $bomRaw;
        }

        // Sanitasi Data BOQ
        if ($request->has('boq_data')) {
            $boqData = $request->input('boq_data');
            $data['boq_data'] = $boqData;
            
            // Hitung total quantity
            if (isset($boqData['items']) && is_array($boqData['items'])) {
                $totalQty = 0;
                foreach ($boqData['items'] as $item) {
                    $totalQty += floatval($item['qty'] ?? 0);
                }
                $data['bill_of_quantity_ton'] = $totalQty;
            }
        }
        
        // Sanitasi Data Fabrication
        if ($request->has('fabrication_data')) {
            $data['fabrication_data'] = $request->input('fabrication_data');
        }
        
        // Sanitasi Data Galvanized
        if ($request->has('galvanized_data')) {
            $data['galvanized_data'] = $request->input('galvanized_data');
        }

        $userRole = auth()->user()->role ?? 'Staff / Operator';
        $isAdmin = in_array($userRole, ['Management', 'Direksi']);

        $roleFieldAccess = [
            'Marketing'            => ['prog_bill_of_payment', 'bop'],
            'Design & Engineering' => ['prog_design_engineering', 'design_date', 'documents'],
            'Fabrikasi'            => ['prog_fabrication', 'prog_galvanized', 'fabrication_data', 'galvanized_data', 'galvanized'],
            'PPIC'                 => ['delivery', 'prog_material_take_off', 'prog_bill_of_material', 'mto_data', 'bom_data', 'boq_data'],
            'Purchasing'           => ['prog_material_procurement', 'procurement', 'boq_data', 'bom_data'],
            'Finance & Admin'      => ['prog_material_procurement', 'procurement'],
            'Staff / Operator'     => ['prog_delivery'],
            'project controller'   => ['prog_fabrication', 'prog_galvanized', 'prog_delivery', 'fabrication_data', 'galvanized_data', 'galvanized'],
            'staff'                => []
        ];

        $allowedFields = $isAdmin ? array_keys($data) : ($roleFieldAccess[$userRole] ?? []);
        $allowedFields = array_merge($allowedFields, ['customer', 'bridge_type', 'work_order', 'contract_value', 'timeline_start', 'timeline_end', 'status', 'bill_of_quantity_ton']);

        if (!$isAdmin) {
            $data = array_intersect_key($data, array_flip($allowedFields));
        }

        DB::transaction(function () use ($request, $monitoring, $data, $isAdmin, $allowedFields) {
            // Upload Dokumen
            if ($request->hasFile('documents')) {
                $existingDocs = $monitoring->design_documents ?? [];
                foreach ($request->file('documents') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $existingDocs[] = $file->storeAs('documents', $filename, 'public');
                }
                $monitoring->design_documents = $existingDocs;
                $monitoring->save();
            }

            // Hapus Dokumen
            if ($request->has('delete_documents')) {
                $toDelete = $request->input('delete_documents', []);
                $existingDocs = $monitoring->design_documents ?? [];
                foreach ($toDelete as $delPath) {
                    if (Storage::disk('public')->exists($delPath)) {
                        Storage::disk('public')->delete($delPath);
                    }
                    $existingDocs = array_values(array_filter($existingDocs, fn($p) => $p !== $delPath));
                }
                $monitoring->design_documents = $existingDocs;
                $monitoring->save();
            }

            $monitoring->update($data);

            // Relasi BOP
            if ($request->has('bop') && ($isAdmin || in_array('bop', $allowedFields))) {
                $existingBopNames = [];
                foreach ($request->bop as $paymentName => $bopData) {
                    $actualName = str_replace('_', ' ', $paymentName);
                    $existingBopNames[] = $actualName;

                    $monitoring->billOfPayments()->updateOrCreate(
                        ['payment_name' => $actualName],
                        [
                            'work_name'      => $bopData['work_name'] ?? '',
                            'invoice_no'     => $bopData['invoice_no'] ?? null,
                            'contract_value' => $monitoring->contract_value ?? 0,
                            'total'          => $bopData['total'] ?? 0,
                            'percentage'     => $bopData['percentage'] ?? 0,
                            'status'         => $bopData['status'] ?? 'Unpaid',
                            'due_payment'    => $bopData['due_payment'] ?? null,
                            'description'    => $bopData['description'] ?? null,
                        ]
                    );
                }
                $monitoring->billOfPayments()->whereNotIn('payment_name', $existingBopNames)->delete();
            }

            // Relasi Delivery
            if ($request->has('delivery') && ($isAdmin || in_array('delivery', $allowedFields))) {
                $headerData = $request->input('delivery_header', []);
                $existingIds = [];
                foreach ($request->delivery as $delData) {
                    $delData = array_merge($delData, $headerData);

                    if (!empty($delData['id'])) {
                        $del = $monitoring->deliveries()->find($delData['id']);
                        if ($del) {
                            $del->update($delData);
                            $existingIds[] = $del->id;
                        }
                    } else {
                        $newDel = $monitoring->deliveries()->create($delData);
                        $existingIds[] = $newDel->id;
                    }
                }
                $monitoring->deliveries()->whereNotIn('id', $existingIds)->delete();
            }

            // Relasi Procurement
            if ($request->has('procurement') && ($isAdmin || in_array('procurement', $allowedFields))) {
                $existingIds = [];
                foreach ($request->procurement as $procData) {
                    // Set part_no manually since it's required by the database but not provided by the UI anymore
                    if (!isset($procData['part_no'])) {
                        $procData['part_no'] = $procData['deskripsi'] ?? '-';
                    }
                    
                    if (!empty($procData['id'])) {
                        $proc = $monitoring->materialProcurements()->find($procData['id']);
                        if ($proc) {
                            $proc->update($procData);
                            $existingIds[] = $proc->id;
                        }
                    } else {
                        $newProc = $monitoring->materialProcurements()->create($procData);
                        $existingIds[] = $newProc->id;
                    }
                }
                $monitoring->materialProcurements()->whereNotIn('id', $existingIds)->delete();
            }

            // Relasi Galvanized
            if ($request->has('galvanized') && ($isAdmin || in_array('galvanized', $allowedFields))) {
                $existingIds = [];
                foreach ($request->galvanized as $galData) {
                    if (!empty($galData['id'])) {
                        $gal = $monitoring->galvanizeds()->find($galData['id']);
                        if ($gal) {
                            $gal->update([
                                'process'     => $galData['process'] ?? '',
                                'date'        => $galData['date'] ?: null,
                                'status'      => $galData['status'] ?? 'Pending',
                                'description' => $galData['description'] ?? null,
                            ]);
                            $existingIds[] = $gal->id;
                        }
                    } else {
                        $newGal = $monitoring->galvanizeds()->create([
                            'process'     => $galData['process'] ?? '',
                            'date'        => $galData['date'] ?: null,
                            'status'      => $galData['status'] ?? 'Pending',
                            'description' => $galData['description'] ?? null,
                        ]);
                        $existingIds[] = $newGal->id;
                    }
                }
                $monitoring->galvanizeds()->whereNotIn('id', $existingIds)->delete();
            }

            ActivityLog::create([
                'user_id'  => auth()->id(),
                'activity' => 'Updated Project',
                'target'   => $monitoring->bridge_type . ' - ' . $monitoring->work_order,
            ]);
        });

        return redirect()->route('monitoring.show', $monitoring)
            ->with('success', 'Project berhasil diperbarui.');
    }

    public function downloadDocument(Request $request, Project $monitoring)
    {
        $filePath = $request->query('file');

        // Whitelist check — hanya boleh download file yang ada di design_documents project ini
        $allowedFiles = $monitoring->design_documents ?? [];

        if (empty($filePath) || !in_array($filePath, $allowedFiles)) {
            return redirect()->route('monitoring.show', $monitoring)
                ->with('error', 'File tidak ditemukan atau akses ditolak.');
        }

        // Cek apakah file benar-benar ada di disk
        if (!Storage::disk('public')->exists($filePath)) {
            return redirect()->route('monitoring.show', $monitoring)
                ->with('error', 'File tidak ada di server.');
        }

        // Kirim response download dengan nama file asli (tanpa prefix timestamp)
        return Storage::disk('public')->download($filePath, basename($filePath));
    }

    public function destroy(Project $monitoring)
    {
        DB::transaction(function () use ($monitoring) {
            $name = $monitoring->bridge_type . ' - ' . $monitoring->work_order;
            $monitoring->delete();

            ActivityLog::create([
                'user_id'  => auth()->id(),
                'activity' => 'Deleted Project',
                'target'   => $name,
            ]);
        });

        return redirect()->route('monitoring.index')
            ->with('success', 'Project berhasil dihapus.');
    }
}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Report — {{ $project->work_order }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: sans-serif; font-size: 10px; color: #1e293b; background: #fff; }

        /* Header */
        .report-header { background: #1e2530; color: #fff; padding: 14px 20px; margin-bottom: 16px; border-radius: 4px; }
        .report-header h1 { font-size: 16px; font-weight: 700; letter-spacing: 0.5px; }
        .report-header p { font-size: 10px; color: #94a3b8; margin-top: 3px; }
        .report-header .meta { display: flex; gap: 30px; margin-top: 10px; }
        .report-header .meta-item label { font-size: 8px; text-transform: uppercase; color: #64748b; display: block; }
        .report-header .meta-item span { font-size: 11px; font-weight: 600; color: #fff; }

        /* Section */
        .section { margin-bottom: 18px; page-break-inside: avoid; }
        .section-title { background: #55ACEE; color: #fff; padding: 6px 12px; font-size: 11px; font-weight: 700; border-radius: 4px 4px 0 0; }
        .section-body { border: 1px solid #e2e8f0; border-top: none; border-radius: 0 0 4px 4px; overflow: hidden; }

        /* Table */
        table { width: 100%; border-collapse: collapse; }
        th { background: #f8fafc; color: #475569; font-size: 9px; font-weight: 700; text-transform: uppercase; padding: 6px 10px; border-bottom: 1px solid #e2e8f0; text-align: left; }
        td { padding: 6px 10px; border-bottom: 1px solid #f1f5f9; font-size: 9px; vertical-align: top; }
        tr:last-child td { border-bottom: none; }
        tr:nth-child(even) td { background: #fafafa; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .fw-bold { font-weight: 700; }
        .text-blue { color: #55ACEE; }
        .text-muted { color: #94a3b8; }

        /* Progress summary grid */
        .progress-grid { display: table; width: 100%; border-collapse: collapse; }
        .progress-row { display: table-row; }
        .progress-cell { display: table-cell; padding: 6px 10px; border: 1px solid #e2e8f0; font-size: 9px; width: 25%; }
        .progress-cell label { display: block; color: #64748b; font-size: 8px; text-transform: uppercase; font-weight: 600; }
        .progress-value { font-size: 13px; font-weight: 700; color: #1e293b; }

        /* Progress bar */
        .prog-bar-wrap { background: #e2e8f0; height: 5px; border-radius: 3px; margin-top: 3px; }
        .prog-bar { background: #55ACEE; height: 5px; border-radius: 3px; }

        /* Info grid */
        .info-grid { display: table; width: 100%; border-collapse: collapse; }
        .info-row { display: table-row; }
        .info-cell { display: table-cell; padding: 7px 14px; border-bottom: 1px solid #f1f5f9; width: 50%; font-size: 9px; }
        .info-cell label { color: #64748b; font-size: 8px; display: block; text-transform: uppercase; font-weight: 600; }

        /* Badge */
        .badge { display: inline-block; padding: 2px 7px; border-radius: 10px; font-size: 8px; font-weight: 700; }
        .badge-done { background: #dcfce7; color: #16a34a; }
        .badge-ongoing { background: #E6F9FF; color: #55ACEE; }
        .badge-pending { background: #fef9c3; color: #ca8a04; }
        .badge-paid { background: #dcfce7; color: #16a34a; }
        .badge-unpaid { background: #fee2e2; color: #dc2626; }
        .badge-delay { background: #fee2e2; color: #ef4444; }

        /* Footer */
        .page-footer { position: fixed; bottom: 10px; left: 20px; right: 20px; font-size: 8px; color: #94a3b8; border-top: 1px solid #e2e8f0; padding-top: 5px; display: flex; justify-content: space-between; }

        /* Grand total row */
        .grand-total td { background: #1e2530 !important; color: #fff; font-weight: 700; font-size: 10px; }
        .subtotal td { background: #f1f5f9 !important; font-weight: 700; }

        /* Section label row */
        .section-row td { background: #e2e8f0 !important; font-weight: 700; font-size: 9px; color: #334155; }

        .no-data { text-align: center; color: #94a3b8; padding: 12px; font-style: italic; }
    </style>
</head>
<body>

{{-- ======= HEADER ======= --}}
<div class="report-header">
    <h1>PROJECT MONITORING REPORT</h1>
    <p>Dicetak pada: {{ now()->format('d M Y, H:i') }} WIB</p>
    <div class="meta">
        <div class="meta-item"><label>Work Order</label><span>{{ $project->work_order }}</span></div>
        <div class="meta-item"><label>Customer</label><span>{{ $project->customer }}</span></div>
        <div class="meta-item"><label>Tipe Jembatan</label><span>{{ $project->bridge_type }}</span></div>
        <div class="meta-item"><label>Status</label><span>{{ strtoupper($project->status) }}</span></div>
        <div class="meta-item"><label>Nilai Kontrak</label><span>Rp {{ number_format($project->contract_value ?? 0, 0, ',', '.') }}</span></div>
    </div>
</div>

{{-- ======= 1. INFO PROJECT ======= --}}
<div class="section">
    <div class="section-title">1. Informasi Project</div>
    <div class="section-body">
        <div class="info-grid">
            <div class="info-row">
                <div class="info-cell"><label>Customer</label>{{ $project->customer }}</div>
                <div class="info-cell"><label>Work Order / Contract No.</label>{{ $project->work_order }}</div>
            </div>
            <div class="info-row">
                <div class="info-cell"><label>Tipe Jembatan</label>{{ $project->bridge_type }}</div>
                <div class="info-cell"><label>Nilai Kontrak</label>Rp {{ number_format($project->contract_value ?? 0, 0, ',', '.') }}</div>
            </div>
            <div class="info-row">
                <div class="info-cell"><label>Timeline Mulai</label>{{ $project->timeline_start->format('d M Y') }}</div>
                <div class="info-cell"><label>Timeline Selesai</label>{{ $project->timeline_end->format('d M Y') }}</div>
            </div>
            <div class="info-row">
                <div class="info-cell"><label>Tanggal Desain</label>{{ $project->design_date ? $project->design_date->format('d M Y') : '-' }}</div>
                <div class="info-cell"><label>Status</label>
                    <span class="badge {{ $project->status === 'done' ? 'badge-done' : ($project->status === 'on-going' ? 'badge-ongoing' : 'badge-pending') }}">
                        {{ strtoupper($project->status) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ======= 2. PROGRESS SUMMARY ======= --}}
@php
$progressItems = [
    'Bill of Payment'        => $project->prog_bill_of_payment ?? 0,
    'Design Engineering'     => $project->prog_design_engineering ?? 0,
    'Bill of Material'       => $project->prog_bill_of_material ?? 0,
    'Material Take Off'      => $project->prog_material_take_off ?? 0,
    'Material Procurement'   => $project->prog_material_procurement ?? 0,
    'Fabrication'            => $project->prog_fabrication ?? 0,
    'Galvanized'             => $project->prog_galvanized ?? 0,
    'Delivery'               => $project->prog_delivery ?? 0,
];
@endphp
<div class="section">
    <div class="section-title">2. Ringkasan Progress</div>
    <div class="section-body">
        <table>
            <thead>
                <tr>
                    @foreach($progressItems as $label => $val)
                    <th class="text-center">{{ $label }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach($progressItems as $label => $val)
                    <td class="text-center">
                        <div class="progress-value">{{ $val }}%</div>
                        <div class="prog-bar-wrap"><div class="prog-bar" style="width:{{ $val }}%;"></div></div>
                    </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>

{{-- ======= 3. BILL OF QUANTITY ======= --}}
@php
$boqItems = $project->boq_data['items'] ?? [];
$grandTotalKontrak = 0; $grandTotalTertagih = 0;
@endphp
<div class="section">
    <div class="section-title">3. Bill of Quantity (BOQ)</div>
    <div class="section-body">
        @if(count($boqItems) > 0)
        <table>
            <thead><tr>
                <th>No</th><th>Deskripsi</th><th>Unit</th>
                <th class="text-right">Qty</th><th class="text-right">Unit Price (Rp)</th>
                <th class="text-right">Total (Rp)</th><th class="text-center">Progress</th>
                <th class="text-right">Nilai Tertagih (Rp)</th>
            </tr></thead>
            <tbody>
                @foreach($boqItems as $item)
                @php $tp = ($item['qty']??0)*($item['unit_price']??0); $nt = $tp*(($item['progress']??0)/100); $grandTotalKontrak+=$tp; $grandTotalTertagih+=$nt; @endphp
                <tr>
                    <td class="fw-bold">{{ $item['no']??'-' }}</td>
                    <td>{{ $item['description']??'-' }}</td>
                    <td>{{ $item['unit']??'-' }}</td>
                    <td class="text-right">{{ $item['qty']??0 }}</td>
                    <td class="text-right">{{ number_format($item['unit_price']??0,0,',','.') }}</td>
                    <td class="text-right fw-bold">{{ number_format($tp,0,',','.') }}</td>
                    <td class="text-center">{{ $item['progress']??0 }}%</td>
                    <td class="text-right fw-bold">{{ number_format($nt,0,',','.') }}</td>
                </tr>
                @endforeach
                <tr class="grand-total">
                    <td colspan="5" class="text-right">TOTAL</td>
                    <td class="text-right">{{ number_format($grandTotalKontrak,0,',','.') }}</td>
                    <td></td>
                    <td class="text-right">{{ number_format($grandTotalTertagih,0,',','.') }}</td>
                </tr>
            </tbody>
        </table>
        @else <p class="no-data">Tidak ada data</p> @endif
    </div>
</div>

{{-- ======= 4. BILL OF PAYMENT ======= --}}
<div class="section">
    <div class="section-title">4. Bill of Payment (BOP)</div>
    <div class="section-body">
        @if($project->billOfPayments->count() > 0)
        <table>
            <thead><tr>
                <th>Nama Pembayaran</th><th>No. Invoice</th><th>Jatuh Tempo</th>
                <th class="text-right">Total (Rp)</th><th class="text-center">%</th><th>Status</th><th>Keterangan</th>
            </tr></thead>
            <tbody>
                @foreach($project->billOfPayments as $pay)
                <tr>
                    <td class="fw-bold">{{ $pay->payment_name }}</td>
                    <td>{{ $pay->invoice_no ?? '-' }}</td>
                    <td>{{ $pay->due_payment?->format('d M Y') ?? '-' }}</td>
                    <td class="text-right">{{ number_format($pay->total,0,',','.') }}</td>
                    <td class="text-center">{{ (float)$pay->percentage }}%</td>
                    <td>
                        <span class="badge {{ $pay->status==='Paid' ? 'badge-paid' : 'badge-unpaid' }}">{{ $pay->status }}</span>
                    </td>
                    <td>{{ $pay->description ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else <p class="no-data">Tidak ada data</p> @endif
    </div>
</div>

{{-- ======= 5. BILL OF MATERIAL ======= --}}
@php
$grandTotalBOM = 0;
$bomSections = ['structure' => 'STRUCTURE', 'bolt_nut_washer' => 'BOLT, NUT & WASHER'];
@endphp
<div class="section">
    <div class="section-title">5. Bill of Material (BOM)</div>
    <div class="section-body">
        @php $hasBom = !empty($project->bom_data['structure']) || !empty($project->bom_data['bolt_nut_washer']); @endphp
        @if($hasBom)
        <table>
            <thead><tr>
                <th>No</th><th>Part No</th><th>Rev</th><th>Description</th><th>Grade</th>
                <th class="text-right">Qty</th><th class="text-right">Length</th>
                <th class="text-right">Unit Weight</th><th class="text-right">Total Weight</th><th>Remarks</th>
            </tr></thead>
            <tbody>
                @foreach($bomSections as $key => $label)
                @php $items = $project->bom_data[$key] ?? []; $subtotal=0; @endphp
                @if(count($items)>0)
                <tr class="section-row"><td colspan="10">{{ $label }}</td></tr>
                @foreach($items as $item)
                @php $subtotal+=(float)($item['total_weight']??0); $grandTotalBOM+=(float)($item['total_weight']??0); @endphp
                <tr>
                    <td>{{ $item['no']??'-' }}</td>
                    <td class="fw-bold text-blue">{{ $item['part_no']??'-' }}</td>
                    <td>{{ $item['rev']??'-' }}</td>
                    <td>{{ $item['description']??'-' }}</td>
                    <td>{{ $item['grade']??'-' }}</td>
                    <td class="text-right">{{ $item['qty']??0 }}</td>
                    <td class="text-right">{{ $item['length']??0 }}</td>
                    <td class="text-right">{{ number_format((float)($item['unit_weight']??0),2,',','.') }}</td>
                    <td class="text-right fw-bold">{{ number_format((float)($item['total_weight']??0),2,',','.') }}</td>
                    <td>{{ $item['remarks']??'-' }}</td>
                </tr>
                @endforeach
                <tr class="subtotal"><td colspan="8" class="text-right">Subtotal {{ $label }}</td><td class="text-right">{{ number_format($subtotal,2,',','.') }}</td><td></td></tr>
                @endif
                @endforeach
                <tr class="grand-total"><td colspan="8" class="text-right">GRAND TOTAL WEIGHT</td><td class="text-right">{{ number_format($grandTotalBOM,2,',','.') }}</td><td></td></tr>
            </tbody>
        </table>
        @else <p class="no-data">Tidak ada data</p> @endif
    </div>
</div>

{{-- ======= 6. MATERIAL TAKE OFF ======= --}}
@php
$mtoSections = ['profile','plate','bolt_nut_washer'];
$mtoLabels = ['profile'=>'PROFILE','plate'=>'PLATE','bolt_nut_washer'=>'BOLT, NUT & WASHER'];
$hasMto = false;
foreach($mtoSections as $s){ if(!empty($project->mto_data[$s])) $hasMto=true; }
@endphp
<div class="section">
    <div class="section-title">6. Material Take Off (MTO)</div>
    <div class="section-body">
        @if($hasMto)
        <table>
            <thead><tr>
                <th>Description</th><th>Grade</th>
                <th class="text-right">Qty</th><th class="text-right">Length</th>
                <th class="text-right">Unit Weight</th><th class="text-right">Total Weight</th>
                <th>Stock</th><th>Purchase Order</th>
            </tr></thead>
            <tbody>
                @foreach($mtoSections as $sec)
                @php $items = $project->mto_data[$sec] ?? []; @endphp
                @if(count($items)>0)
                <tr class="section-row"><td colspan="8">{{ $mtoLabels[$sec] ?? strtoupper($sec) }}</td></tr>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item['description']??'-' }}</td>
                    <td>{{ $item['grade']??'-' }}</td>
                    <td class="text-right">{{ $item['qty']??0 }}</td>
                    <td class="text-right">{{ $item['length']??0 }}</td>
                    <td class="text-right">{{ number_format((float)($item['unit_weight']??0),2,',','.') }}</td>
                    <td class="text-right fw-bold">{{ number_format((float)($item['total_weight']??0),2,',','.') }}</td>
                    <td>{{ $item['stock']??'-' }}</td>
                    <td>{{ $item['purchase_order']??'-' }}</td>
                </tr>
                @endforeach
                @endif
                @endforeach
            </tbody>
        </table>
        @else <p class="no-data">Tidak ada data</p> @endif
    </div>
</div>

{{-- ======= 7. MATERIAL PROCUREMENT ======= --}}
<div class="section">
    <div class="section-title">7. Material Procurement</div>
    <div class="section-body">
        @if($project->materialProcurements->count() > 0)
        <table>
            <thead><tr>
                <th>No. PO</th><th>Deskripsi</th><th>Supplier</th>
                <th>Qty</th><th>Grade</th><th>Tanggal PO</th>
                <th>Estimasi (ETA)</th><th>Status</th><th>MTC</th>
            </tr></thead>
            <tbody>
                @foreach($project->materialProcurements as $mp)
                <tr>
                    <td class="fw-bold text-blue">{{ $mp->no_po }}</td>
                    <td>{{ $mp->deskripsi ?? $mp->part_no }}</td>
                    <td>{{ $mp->supplier }}</td>
                    <td>{{ $mp->qty ?? $mp->qty_ordered }}</td>
                    <td>{{ $mp->grade }}</td>
                    <td>{{ $mp->tanggal_po ? $mp->tanggal_po->format('d M Y') : '-' }}</td>
                    <td>{{ $mp->eta ? $mp->eta->format('d M Y') : '-' }}</td>
                    <td>
                        <span class="badge {{ $mp->status=='Delay' ? 'badge-delay' : 'badge-ongoing' }}">
                            {{ $mp->status ?? 'On Track' }}
                        </span>
                    </td>
                    <td>{{ $mp->mtc }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else <p class="no-data">Tidak ada data</p> @endif
    </div>
</div>

{{-- ======= 8. FABRICATION ======= --}}
@php $fabItems = $project->fabrication_data['items'] ?? []; $ncrItems = $project->fabrication_data['ncr'] ?? []; @endphp
<div class="section">
    <div class="section-title">8. Fabrication</div>
    <div class="section-body">
        @if(count($fabItems) > 0)
        <table>
            <thead><tr>
                <th>Part No</th><th>Description</th><th class="text-center">Qty</th>
                <th class="text-center">Cek Matl</th><th class="text-center">Cocok</th>
                <th class="text-center">Dinasting</th><th class="text-center">Potong</th>
                <th class="text-center">Grinda</th><th class="text-center">Assembly</th>
                <th class="text-center">Welding</th><th class="text-center">Finishing</th>
                <th class="text-center">Progress</th><th>Welder</th><th>PIC</th>
            </tr></thead>
            <tbody>
                @foreach($fabItems as $item)
                @php
                $qty=(float)($item['qty_target']??0);
                $s1=(float)($item['cek_material']??0); $s2=(float)($item['pencocokan']??0);
                $s3=(float)($item['dinasting']??0);     $s4=(float)($item['potong']??0);
                $s5=(float)($item['grinda']??0);        $s6=(float)($item['assembling']??0);
                $s7=(float)($item['welding']??0);       $s8=(float)($item['cek_finishing']??0);
                $pct=$qty>0?min(100,round((($s1+$s2+$s3+$s4+$s5+$s6+$s7+$s8)/($qty*8))*100)):0;
                @endphp
                <tr>
                    <td class="fw-bold">{{ $item['part_no']??'-' }}</td>
                    <td>{{ $item['description']??'-' }}</td>
                    <td class="text-center">{{ $item['qty_target']??0 }}</td>
                    <td class="text-center">{{ $s1 }}</td><td class="text-center">{{ $s2 }}</td>
                    <td class="text-center">{{ $s3 }}</td><td class="text-center">{{ $s4 }}</td>
                    <td class="text-center">{{ $s5 }}</td><td class="text-center">{{ $s6 }}</td>
                    <td class="text-center">{{ $s7 }}</td><td class="text-center">{{ $s8 }}</td>
                    <td class="text-center fw-bold">{{ $pct }}%</td>
                    <td>{{ $item['welder_id']??'-' }}</td>
                    <td>{{ $item['pic']??'-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else <p class="no-data">Tidak ada data fabrication</p> @endif

        @if(count($ncrItems) > 0)
        <div style="margin-top:10px; border-top:2px solid #fee2e2; padding-top:6px;">
            <p style="color:#dc2626; font-weight:700; font-size:10px; margin-bottom:4px;">Non-Conformance Report (NCR)</p>
            <table>
                <thead style="background:#fee2e2;">
                    <tr><th>Part No</th><th>Deskripsi Masalah</th><th>Status NCR</th><th>Tanggal</th></tr>
                </thead>
                <tbody>
                    @foreach($ncrItems as $ncr)
                    <tr>
                        <td class="fw-bold" style="color:#b91c1c;">{{ $ncr['part_no']??'-' }}</td>
                        <td>{{ $ncr['deskripsi']??'-' }}</td>
                        <td><span class="badge badge-delay">{{ $ncr['status']??'Open' }}</span></td>
                        <td>{{ $ncr['tanggal']??'-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

{{-- ======= 9. GALVANIZED ======= --}}
<div class="section">
    <div class="section-title">9. Galvanized</div>
    <div class="section-body">
        @if($project->galvanizeds->count() > 0)
        <table>
            <thead><tr><th>Proses</th><th>Tanggal</th><th>Status</th><th>Deskripsi</th></tr></thead>
            <tbody>
                @foreach($project->galvanizeds as $gal)
                <tr>
                    <td class="fw-bold">{{ $gal->process }}</td>
                    <td>{{ $gal->date ? $gal->date->format('d M Y') : '-' }}</td>
                    <td>
                        <span class="badge {{ $gal->status==='Done' ? 'badge-done' : ($gal->status==='On-Go' ? 'badge-ongoing' : 'badge-pending') }}">
                            {{ $gal->status ?? 'Pending' }}
                        </span>
                    </td>
                    <td>{{ $gal->description ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else <p class="no-data">Tidak ada data</p> @endif
    </div>
</div>

{{-- ======= 10. DELIVERY ======= --}}
<div class="section">
    <div class="section-title">10. Delivery</div>
    <div class="section-body">
        @if($project->deliveries->count() > 0)
        <table>
            <thead><tr>
                <th>Assembly No</th><th>Section</th><th>Description</th>
                <th class="text-right">Qty</th><th>Class</th>
                <th class="text-right">Length (mm)</th>
                <th class="text-right">Unit Weight (kg)</th>
                <th class="text-right">Total Weight (kg)</th>
                <th>Remarks</th>
            </tr></thead>
            <tbody>
                @php $grandWeightTotal = 0; @endphp
                @foreach($project->deliveries->groupBy('section') as $section => $items)
                <tr class="section-row"><td colspan="9">{{ $section }}</td></tr>
                @php $sectionTotal = 0; @endphp
                @foreach($items as $item)
                @php $sectionTotal += $item->total_weight_kg; $grandWeightTotal += $item->total_weight_kg; @endphp
                <tr>
                    <td class="fw-bold">{{ $item->assembly_no }}</td>
                    <td>{{ $item->section }}</td>
                    <td>{{ $item->description }}</td>
                    <td class="text-right">{{ $item->quantity }}</td>
                    <td>{{ $item->class }}</td>
                    <td class="text-right">{{ $item->length_mm }}</td>
                    <td class="text-right">{{ number_format($item->unit_weight_kg,3,',','.') }}</td>
                    <td class="text-right fw-bold">{{ number_format($item->total_weight_kg,3,',','.') }}</td>
                    <td>{{ $item->remarks ?? '-' }}</td>
                </tr>
                @endforeach
                <tr class="subtotal">
                    <td colspan="7" class="text-right">Subtotal {{ $section }}</td>
                    <td class="text-right">{{ number_format($sectionTotal,3,',','.') }}</td><td></td>
                </tr>
                @endforeach
                <tr class="grand-total">
                    <td colspan="7" class="text-right">GRAND TOTAL WEIGHT</td>
                    <td class="text-right">{{ number_format($grandWeightTotal,3,',','.') }}</td><td></td>
                </tr>
            </tbody>
        </table>
        @else <p class="no-data">Tidak ada data</p> @endif
    </div>
</div>

</body>
</html>

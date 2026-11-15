{{-- Header action --}}
<div style="display:flex; justify-content:flex-end; gap:8px; margin-bottom:20px;">
    <span class="badge badge-primary" style="padding:8px 16px; font-size:13px;">
        Work Order: {{ $project->work_order }}
    </span>
</div>

{{-- Project Info Card --}}
<div class="card" style="padding:20px; margin-bottom:16px;">
    <div style="display:grid; grid-template-columns: repeat(6, 1fr); gap:20px;">
        <div>
            <div class="text-muted text-sm">Customer</div>
            <div class="fw-700" style="margin-top:4px; font-size:15px;">{{ $project->customer }}</div>
        </div>
        <div>
            <div class="text-muted text-sm">{{ __('messages.contract_value') }}</div>
            <div class="fw-700" style="margin-top:4px; font-size:15px;">Rp {{ number_format($project->contract_value ?? 0, 0, ',', '.') }}</div>
        </div>
        <div>
            <div class="text-muted text-sm">{{ __('messages.work_order') }}</div>
            <div class="fw-700" style="margin-top:4px; font-size:15px;">{{ $project->work_order }}</div>
        </div>
        <div>
            <div class="text-muted text-sm">{{ __('messages.bridge_type') }}</div>
            <div class="fw-700" style="margin-top:4px; font-size:15px;">{{ $project->bridge_type }}</div>
        </div>
        <div>
            <div class="text-muted text-sm">{{ __('messages.timeline') }}</div>
            <div class="fw-600" style="margin-top:4px; font-size:13px;">
                {{ $project->timeline_start->format('d-m-Y') }}<br>
                {{ $project->timeline_end->format('d-m-Y') }}
            </div>
        </div>
        <div>
            <div class="text-muted text-sm">{{ __('messages.status') }}</div>
            <div style="margin-top:6px;">
                @if($project->status === 'done')
                    <span class="badge badge-done">Done</span>
                @elseif($project->status === 'on-going')
                    <span class="badge badge-ongoing">On-Going</span>
                @else
                    <span class="badge badge-pending">Pending</span>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Global Comments Data --}}
@php
    $commentsData = $comments ?? \App\Models\DocumentComment::with('user')
        ->where('work_order', $project->work_order)
        ->latest()
        ->get();

    $totalCommentsCount = $commentsData->count();
@endphp

{{-- TABS NAVIGATION --}}
<style>
.custom-tabs { display: flex; flex-wrap: wrap; align-items: center; gap: 8px; margin-bottom: 20px; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; }
.custom-tab-btn { background: #f8fafc; border: 1px solid #cbd5e1; color: #475569; padding: 8px 16px; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s; }
.custom-tab-btn:hover { background: #e2e8f0; color: #1e293b; }
.custom-tab-btn.active { background: #55ACEE; color: #ffffff; border-color: #55ACEE; }
.custom-tab-content { display: none; animation: fadeIn 0.3s; }
.custom-tab-content.active { display: block; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
</style>

<div class="custom-tabs">
    <button class="custom-tab-btn active" onclick="openTab('tab-boq', this)">{{ __('messages.bill_of_quantity') }}</button>
    <button class="custom-tab-btn" onclick="openTab('tab-bop', this)">{{ __('messages.bill_of_payment') }}</button>
    <button class="custom-tab-btn" onclick="openTab('tab-de', this)">{{ __('messages.design_engineering') }}</button>
    <button class="custom-tab-btn" onclick="openTab('tab-bom', this)">{{ __('messages.bill_of_material') }}</button>
    <button class="custom-tab-btn" onclick="openTab('tab-mto', this)">{{ __('messages.material_take_off') }}</button>
    <button class="custom-tab-btn" onclick="openTab('tab-mp', this)">{{ __('messages.material_procurement') }}</button>
    <button class="custom-tab-btn" onclick="openTab('tab-fab', this)">{{ __('messages.fabrication') }}</button>
    <button class="custom-tab-btn" onclick="openTab('tab-gal', this)">{{ __('messages.galvanized') }}</button>
    <button class="custom-tab-btn" onclick="openTab('tab-del', this)">{{ __('messages.delivery') }}</button>
    
    <div style="display:flex; align-items:center; gap:8px; margin-left:auto;">
        {{-- Export PDF --}}
        <a href="{{ route('monitoring.export.pdf', $project) }}"
            style="background:#ef4444; color:white; padding:8px 14px; border-radius:6px; text-decoration:none; font-size:13px; font-weight:600; display:inline-flex; align-items:center; gap:5px;">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
            </svg>
            Export PDF
        </a>
        {{-- Export Excel --}}
        <a href="{{ route('monitoring.export.excel', $project) }}"
            style="background:#16a34a; color:white; padding:8px 14px; border-radius:6px; text-decoration:none; font-size:13px; font-weight:600; display:inline-flex; align-items:center; gap:5px;">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18M10 3v18M14 3v18M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/>
            </svg>
            Export Excel
        </a>
        {{-- Edit Project --}}
        <a href="{{ route('monitoring.edit', $project) }}" class="btn btn-primary btn-sm" style="padding: 8px 16px; font-weight: 600; font-size: 13px; display: inline-flex; align-items: center; gap: 6px;">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            {{ __('messages.edit_project') }}
        </a>
    </div>
</div>

{{-- 1. Bill of Quantity --}}
<div id="tab-boq" class="detail-section mb-4 custom-tab-content active">
    <div class="detail-section-header bg-primary text-white p-3 rounded-top">
        <span class="fw-bold">{{ __('messages.bill_of_quantity') }}</span>
    </div>

    <div class="detail-section-body border border-top-0 rounded-bottom">
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Description of work</th>
                        <th>Unit</th>
                        <th style="text-align: right;">Qty</th>
                        <th style="text-align: right;">Unit price</th>
                        <th style="text-align: right;">Total price</th>
                        <th style="text-align: center;">Progress</th>
                        <th style="text-align: right;">{{ __('messages.nilai_tertagih') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $boqItems = $project->boq_data['items'] ?? [];
                        $grandTotalKontrak = 0;
                        $grandTotalTertagih = 0;
                    @endphp
                    @forelse($boqItems as $item)
                    @php
                        $totalPrice = ($item['qty'] ?? 0) * ($item['unit_price'] ?? 0);
                        $nilaiTertagih = $totalPrice * (($item['progress'] ?? 0) / 100);
                        $grandTotalKontrak += $totalPrice;
                        $grandTotalTertagih += $nilaiTertagih;
                    @endphp
                    <tr>
                        <td class="fw-600">{{ $item['no'] ?? '-' }}</td>
                        <td>{{ $item['description'] ?? '-' }}</td>
                        <td>{{ $item['unit'] ?? '-' }}</td>
                        <td style="text-align: right;">{{ $item['qty'] ?? 0 }}</td>
                        <td style="text-align: right;">Rp {{ number_format($item['unit_price'] ?? 0, 0, ',', '.') }}</td>
                        <td style="text-align: right; font-weight: 600;">Rp {{ number_format($totalPrice, 0, ',', '.') }}</td>
                        <td style="text-align: center;">@include('monitoring._prog_badge', ['v' => $item['progress'] ?? 0])</td>
                        <td style="text-align: right; font-weight: 600;">Rp {{ number_format($nilaiTertagih, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="8" style="text-align:center; color:var(--text-light); padding:20px;">{{ __('messages.no_data') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(count($boqItems) > 0)
        <div style="background-color: #1e2530; color: #ffffff; display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; padding: 16px 20px; border-radius: 8px; margin: 20px;">
            <div>
                <div style="font-size: 11px; color: #94a3b8; font-weight: 600; text-transform: uppercase;">Total Nilai Kontrak</div>
                <div style="font-size: 16px; font-weight: 700; margin-top: 2px;">Rp {{ number_format($grandTotalKontrak, 0, ',', '.') }}</div>
            </div>
            <div>
                <div style="font-size: 11px; color: #94a3b8; font-weight: 600; text-transform: uppercase;">Total {{ __('messages.nilai_tertagih') }}</div>
                <div style="font-size: 16px; font-weight: 700; margin-top: 2px;">Rp {{ number_format($grandTotalTertagih, 0, ',', '.') }}</div>
            </div>
            <div>
                <div style="font-size: 11px; color: #94a3b8; font-weight: 600; text-transform: uppercase;">Sisa Nilai Belum Tertagih</div>
                <div style="font-size: 16px; font-weight: 700; margin-top: 2px;">Rp {{ number_format($grandTotalKontrak - $grandTotalTertagih, 0, ',', '.') }}</div>
            </div>
        </div>
        @endif
        <div style="margin: 20px; padding: 15px; border: 1px solid #e2e8f0; border-radius: 8px; background: #f8fafc;">
            <div style="display: flex; justify-content: space-between; font-size: 12px; font-weight: 600; margin-bottom: 5px; color: #475569;">
                <span>{{ __('messages.total_progress') }}</span>
                <span>{{ $project->prog_bill_of_quantity ?? ($project->prog_bill_of_material ?? 0) }}%</span>
            </div>
            <div style="background: #e2e8f0; height: 5px; border-radius: 4px; width: 100%; overflow: hidden;">
                <div style="background: #55ACEE; margin: 0; height: 100%; width: {{ $project->prog_bill_of_quantity ?? ($project->prog_bill_of_material ?? 0) }}%;"></div>
            </div>
        </div>
    </div>
</div>

{{-- 2. Bill of Payment --}}
<div id="tab-bop" class="detail-section mb-4 custom-tab-content">
    <div class="detail-section-header bg-primary text-white p-3 rounded-top">
        <span class="fw-bold">{{ __('messages.bill_of_payment') }}</span>
        @if($project->contract_value)
            <span style="font-weight:400; font-size:12px; color:rgba(255,255,255,0.8); margin-left:12px;">
                {{ __('messages.contract_value') }}: Rp {{ number_format($project->contract_value, 0, ',', '.') }}
            </span>
        @endif
    </div>
    <div class="detail-section-body border border-top-0 rounded-bottom">
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>{{ __('messages.payment_name') }}</th>
                        <th>No. Invoice</th>
                        <th>{{ __('messages.due_payment') }}</th>
                        <th>{{ __('messages.total') }}</th>
                        <th>{{ __('messages.percentage') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.description') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($project->billOfPayments as $pay)
                    <tr>
                        <td class="fw-600">{{ $pay->payment_name }}</td>
                        <td>{{ $pay->invoice_no ?? '-' }}</td>
                        <td>{{ $pay->due_payment?->format('d-m-Y') ?? '-' }}</td>
                        <td>Rp {{ number_format($pay->total, 0, ',', '.') }}</td>
                        <td>{{ (float)$pay->percentage }}%</td>
                        <td>
                            @if($pay->status === 'Paid')
                                <span class="badge badge-paid">Paid</span>
                            @elseif($pay->status === 'Partial')
                                <span class="badge badge-partial">Partial</span>
                            @else
                                <span class="badge badge-unpaid">Unpaid</span>
                            @endif
                        </td>
                        <td style="color:var(--text-mid);">{{ $pay->description }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="7" style="text-align:center; color:var(--text-light); padding:20px;">{{ __('messages.no_data') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin: 20px; padding: 15px; border: 1px solid #e2e8f0; border-radius: 8px; background: #f8fafc;">
            <div style="display: flex; justify-content: space-between; font-size: 12px; font-weight: 600; margin-bottom: 5px; color: #475569;">
                <span>{{ __('messages.total_progress') }} (Bill of Payment)</span>
                <span>{{ $project->prog_bill_of_payment ?? 0 }}%</span>
            </div>
            <div style="background: #e2e8f0; height: 5px; border-radius: 4px; width: 100%; overflow: hidden;">
                <div style="background: #55ACEE; margin: 0; height: 100%; width: {{ $project->prog_bill_of_payment ?? 0 }}%;"></div>
            </div>
        </div>
    </div>
</div>

{{-- 3. Design Engineering --}}
<div id="tab-de" class="detail-section mb-4 custom-tab-content">
    <div class="detail-section-header bg-primary text-white p-3 rounded-top">
        <span class="fw-bold">{{ __('messages.design_engineering') }}</span>
    </div>
    <div class="detail-section-body border border-top-0 rounded-bottom">
        @if($project->design_date)
        <div style="margin: 10px 20px 10px 20px; display: inline-flex; align-items: center; background: #E6F9FF; border: 1px solid #E6F9FF; padding: 6px 12px; border-radius: 6px;">
            <svg style="width: 16px; height: 16px; color: #55ACEE; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span style="font-size: 13px; font-weight: 600; color: #0099CC;">
                Tanggal Desain: {{ $project->design_date->format('d M Y') }}
            </span>
        </div>
        @endif

        <div class="table-wrapper">
            <table>
                <tbody>
                    @forelse($project->designEngineerings as $de)
                    <tr>
                        <td class="fw-600">{{ $de->activity }}</td>
                        <td>{{ $de->drawing_no }}</td>
                        <td>{{ $de->presentation }}</td>
                        <td>@include('monitoring._prog_badge', ['v' => $de->percent])</td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @php $docs = $project->design_documents ?? []; @endphp
        @if(count($docs) > 0)
        <div style="margin-left: 20px; margin-right: 20px; margin-top: 10px;">
            @foreach($docs as $doc)
            <div style="display:flex; align-items:center; justify-content:space-between; padding:10px 14px; background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; margin-bottom:2px;">
                <div style="display:flex; align-items:center; gap:10px; overflow:hidden;">
                    <svg style="width:20px;height:20px;flex-shrink:0;color:#55ACEE;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span style="color:#1e293b; font-size:13px; font-weight:500; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:320px; display:block;" title="{{ basename($doc) }}">
                        {{ basename($doc) }}
                    </span>
                </div>
                <div style="display:flex; gap:8px; flex-shrink:0;">
                    <a href="{{ asset('storage/' . $doc) }}" target="_blank"
                        style="background:#55ACEE; color:white; padding:6px 14px; border-radius:6px; text-decoration:none; font-size:12px; font-weight:600; white-space:nowrap; display:inline-flex; align-items:center; gap:4px;">
                        <svg style="width:13px;height:13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        Buka File
                    </a>
                    <a href="{{ route('monitoring.document.download', ['monitoring' => $project->id, 'file' => $doc]) }}"
                        style="background:#10b981; color:white; padding:6px 14px; border-radius:6px; text-decoration:none; font-size:12px; font-weight:600; white-space:nowrap; display:inline-flex; align-items:center; gap:4px;">
                        <svg style="width:13px;height:13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Download
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div style="margin-top: 20px; padding: 14px; background: #f8fafc; border: 1px dashed #e2e8f0; border-radius: 8px; text-align:center; color:#94a3b8; font-size:13px;">
            {{ __('messages.no_data') }}
        </div>
        @endif
        
        <div style="margin: 20px; margin-top: 10px;">
            <div style="display: flex; justify-content: space-between; font-size: 12px; font-weight: 600; margin-bottom: 5px; color: #475569;">
                <span>{{ __('messages.total_progress') }}</span>
                <span>{{ $project->prog_design_engineering ?? 0 }}%</span>
            </div>
            <div style="background: #e2e8f0; height: 5px; border-radius: 4px; width: 100%; overflow: hidden;">
                <div style="background: #55ACEE;margin: 0; height: 100%; width: {{ $project->prog_design_engineering ?? 0 }}%;"></div>
            </div>
        </div>
    </div>
</div>

{{-- 4. Bill of Material --}}
<div id="tab-bom" class="detail-section mb-4 custom-tab-content">
    <div class="detail-section-header bg-primary text-white p-3 rounded-top">
        <span class="fw-bold">{{ __('messages.bill_of_material') }}</span>
    </div>
    <div class="detail-section-body border border-top-0 rounded-bottom">
        <div class="table-wrapper">
            <table style="width: 100%; border-collapse: collapse; min-width: 1000px; text-align: left; font-size: 12px;">
                <thead style="background-color: #f8fafc; color: #64748b;">
                    <tr>
                        <th style="padding: 12px 16px;">No</th>
                        <th style="padding: 12px 16px;">Part no</th>
                        <th style="padding: 12px 16px;">Rev</th>
                        <th style="padding: 12px 16px;">Description</th>
                        <th style="padding: 12px 16px;">Grade</th>
                        <th style="padding: 12px 16px; text-align: right;">Qty</th>
                        <th style="padding: 12px 16px; text-align: right;">Length</th>
                        <th style="padding: 12px 16px; text-align: right;">Sq Area</th>
                        <th style="padding: 12px 16px; text-align: right;">Unit Weight</th>
                        <th style="padding: 12px 16px; text-align: right;">Total Weight</th>
                        <th style="padding: 12px 16px;">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $grandTotalBOM = 0;
                    @endphp
                    @foreach(['structure' => 'STRUCTURE', 'bolt_nut_washer' => 'BOLT, NUT & WASHER'] as $key => $label)
                        @php
                            $items = $project->bom_data[$key] ?? [];
                            $subtotal = 0;
                        @endphp
                        @if(count($items) > 0)
                            <tr style="background: #f1f5f9;">
                                <td colspan="11" style="padding: 8px 16px; font-weight: 700; color: #334155;">{{ $label }}</td>
                            </tr>
                            @foreach($items as $item)
                                @php
                                    $subtotal += (float)($item['total_weight'] ?? 0);
                                    $grandTotalBOM += (float)($item['total_weight'] ?? 0);
                                @endphp
                                <tr>
                                    <td style="padding: 8px 16px;">{{ $item['no'] ?? '-' }}</td>
                                    <td style="padding: 8px 16px; font-weight: 600;">{{ $item['part_no'] ?? '-' }}</td>
                                    <td style="padding: 8px 16px;">{{ $item['rev'] ?? '-' }}</td>
                                    <td style="padding: 8px 16px;">{{ $item['description'] ?? '-' }}</td>
                                    <td style="padding: 8px 16px;">{{ $item['grade'] ?? '-' }}</td>
                                    <td style="padding: 8px 16px; text-align: right;">{{ $item['qty'] ?? 0 }}</td>
                                    <td style="padding: 8px 16px; text-align: right;">{{ $item['length'] ?? 0 }}</td>
                                    <td style="padding: 8px 16px; text-align: right;">{{ $item['unit_sq_area'] ?? '-' }}</td>
                                    <td style="padding: 8px 16px; text-align: right;">{{ number_format((float)($item['unit_weight'] ?? 0), 2, ',', '.') }}</td>
                                    <td style="padding: 8px 16px; text-align: right; font-weight: 600;">{{ number_format((float)($item['total_weight'] ?? 0), 2, ',', '.') }}</td>
                                    <td style="padding: 8px 16px;">{{ $item['remarks'] ?? '-' }}</td>
                                </tr>
                            @endforeach
                            <tr style="border-bottom: 1px solid #e2e8f0; font-weight: 600; color: #334155; background: #f8fafc;">
                                <td colspan="9" style="padding: 8px 16px; text-align: right;">Subtotal {{ strtolower($label) }}</td>
                                <td style="padding: 8px 16px; text-align: right;">{{ number_format($subtotal, 2, ',', '.') }}</td>
                                <td></td>
                            </tr>
                        @endif
                    @endforeach
                    @if(empty($project->bom_data['structure']) && empty($project->bom_data['bolt_nut_washer']))
                        <tr><td colspan="11" style="text-align:center; color:var(--text-light); padding:20px;">{{ __('messages.no_data') }}</td></tr>
                    @else
                        <tr style="background: #1e293b; color: white; font-weight: 700; font-size: 14px;">
                            <td colspan="9" style="padding: 12px 16px; text-align: right;">{{ __('messages.grand_total') }} weight</td>
                            <td style="padding: 12px 16px; text-align: right;">{{ number_format($grandTotalBOM, 2, ',', '.') }}</td>
                            <td></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div style="margin: 20px; padding: 15px; border: 1px solid #e2e8f0; border-radius: 8px; background: #f8fafc;">
            <div style="display: flex; justify-content: space-between; font-size: 12px; font-weight: 600; margin-bottom: 5px; color: #475569;">
                <span>{{ __('messages.total_progress') }}</span>
                <span>{{ $project->prog_bill_of_material ?? 0 }}%</span>
            </div>
            <div style="background: #e2e8f0; height: 5px; border-radius: 4px; width: 100%; overflow: hidden;">
                <div style="background: #55ACEE; margin: 0; height: 100%; width: {{ $project->prog_bill_of_material ?? 0 }}%;"></div>
            </div>
        </div>
    </div>
</div>

{{-- 5. Material Take Off --}}
<div id="tab-mto" class="detail-section mb-4 custom-tab-content">
    <div class="detail-section-header bg-primary text-white p-3 rounded-top">
        <span class="fw-bold">{{ __('messages.material_take_off') }}</span>
    </div>
    <div class="detail-section-body border border-top-0 rounded-bottom" style="padding: 0; background: transparent;">
        @include('monitoring.partials.mto_show')

        <div style="margin: 20px; padding: 15px; border: 1px solid #e2e8f0; border-radius: 8px; background: #f8fafc;">
            <div style="display: flex; justify-content: space-between; font-size: 12px; font-weight: 600; margin-bottom: 5px; color: #475569;">
                <span>{{ __('messages.total_progress') }}</span>
                <span>{{ $project->prog_material_take_off ?? 0 }}%</span>
            </div>
            <div style="background: #e2e8f0; height: 5px; border-radius: 4px; width: 100%; overflow: hidden;">
                <div style="background: #55ACEE; margin: 0; height: 100%; width: {{ $project->prog_material_take_off ?? 0 }}%;"></div>
            </div>
        </div>
    </div>
</div>

{{-- 6. Material Procurement --}}
<div id="tab-mp" class="detail-section mb-4 custom-tab-content">
    <div class="detail-section-header bg-primary text-white p-3 rounded-top">
        <span class="fw-bold">{{ __('messages.material_procurement') }}</span>
    </div>
    <div class="detail-section-body border border-top-0 rounded-bottom">
        <div class="table-wrapper">
            <table style="min-width: 1000px;">
                <thead>
                    <tr>
                        <th>No. PO</th>
                        <th>Deskripsi</th>
                        <th>Supplier</th>
                        <th>Qty</th>
                        <th>Grade</th>
                        <th>Tanggal PO</th>
                        <th>Estimasi</th>
                        <th>Status</th>
                        <th>MTC</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($project->materialProcurements as $mp)
                    <tr>
                        <td class="fw-600" style="color: #55ACEE;">{{ $mp->no_po }}</td>
                        <td>{{ $mp->deskripsi ?? $mp->part_no }}</td>
                        <td>{{ $mp->supplier }}</td>
                        <td>{{ $mp->qty ?? $mp->qty_ordered }}</td>
                        <td>{{ $mp->grade }}</td>
                        <td>{{ $mp->tanggal_po ? $mp->tanggal_po->format('d M Y') : '-' }}</td>
                        <td>{{ $mp->eta ? $mp->eta->format('d M Y') : '-' }}</td>
                        <td>
                            @if($mp->status == 'Delay')
                            <span style="background:#fee2e2; color:#ef4444; padding:2px 8px; border-radius:12px; font-size:10px; font-weight:600;">Delay</span>
                            @elseif($mp->status == 'Completed' || $mp->status == 'PO Diterbitkan')
                            <span style="background:#E6F9FF; color:#55ACEE; padding:2px 8px; border-radius:12px; font-size:10px; font-weight:600;">{{ $mp->status }}</span>
                            @else
                            <span style="background:#fef3c7; color:#f59e0b; padding:2px 8px; border-radius:12px; font-size:10px; font-weight:600;">{{ $mp->status ?? 'On Track' }}</span>
                            @endif
                        </td>
                        <td>{{ $mp->mtc }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="9" style="text-align:center; color:var(--text-light); padding:20px;">{{ __('messages.no_data') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin: 20px; padding: 15px; border: 1px solid #e2e8f0; border-radius: 8px; background: #f8fafc;">
            <div style="display: flex; justify-content: space-between; font-size: 12px; font-weight: 600; margin-bottom: 5px; color: #475569;">
                <span>{{ __('messages.total_progress') }}</span>
                <span>{{ $project->prog_material_procurement ?? 0 }}%</span>
            </div>
            <div style="background: #e2e8f0; height: 5px; border-radius: 4px; width: 100%; overflow: hidden;">
                <div style="background: #55ACEE; margin: 0; height: 100%; width: {{ $project->prog_material_procurement ?? 0 }}%;"></div>
            </div>
        </div>
    </div>
</div>

{{-- 7. Fabrication --}}
<div id="tab-fab" class="detail-section mb-4 custom-tab-content">
    <div class="detail-section-header bg-primary text-white p-3 rounded-top">
        <span class="fw-bold">{{ __('messages.fabrication') }}</span>
    </div>
    <div class="detail-section-body border border-top-0 rounded-bottom">
        <div class="table-wrapper">
            <table style="width: 100%; border-collapse: collapse; min-width: 1000px; text-align: left; font-size: 12px;">
                <thead style="background-color: #f8fafc; color: #64748b;">
                    <tr>
                        <th style="padding: 10px 12px;">Part no.</th>
                        <th style="padding: 10px 12px;">Description</th>
                        <th style="padding: 10px 12px; text-align: center;">Qty</th>
                        <th style="padding: 10px 12px; text-align: center;">{{ __('messages.fab_cek_matl') }}</th>
                        <th style="padding: 10px 12px; text-align: center;">{{ __('messages.fab_cocok') }}</th>
                        <th style="padding: 10px 12px; text-align: center;">{{ __('messages.fab_dinasting') }}</th>
                        <th style="padding: 10px 12px; text-align: center;">{{ __('messages.fab_potong') }}</th>
                        <th style="padding: 10px 12px; text-align: center;">{{ __('messages.fab_grinda') }}</th>
                        <th style="padding: 10px 12px; text-align: center;">{{ __('messages.fab_assembling') }}</th>
                        <th style="padding: 10px 12px; text-align: center;">{{ __('messages.fab_welding') }}</th>
                        <th style="padding: 10px 12px; text-align: center;">{{ __('messages.fab_cek_finishing') }}</th>
                        <th style="padding: 10px 12px; text-align: center;">Progres</th>
                        <th style="padding: 10px 12px;">Welder</th>
                        <th style="padding: 10px 12px;">PIC</th>
                        <th style="padding: 10px 12px;">{{ __('messages.fab_update_terakhir') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $fabItems = $project->fabrication_data['items'] ?? [];
                    @endphp
                    @forelse($fabItems as $item)
                    @php
                        $qty  = (float)($item['qty_target'] ?? 0);
                        $s1   = (float)($item['cek_material']  ?? $item['cutting']   ?? 0);
                        $s2   = (float)($item['pencocokan']    ?? $item['fitup']     ?? 0);
                        $s3   = (float)($item['dinasting']     ?? 0);
                        $s4   = (float)($item['potong']        ?? 0);
                        $s5   = (float)($item['grinda']        ?? 0);
                        $s6   = (float)($item['assembling']    ?? 0);
                        $s7   = (float)($item['welding']       ?? 0);
                        $s8   = (float)($item['cek_finishing'] ?? $item['finishing'] ?? 0);
                        $pct  = $qty > 0 ? min(100, round((($s1+$s2+$s3+$s4+$s5+$s6+$s7+$s8) / ($qty * 8)) * 100)) : 0;
                    @endphp
                    <tr>
                        <td style="padding: 8px 12px; font-weight: 600;">{{ $item['part_no'] ?? '-' }}</td>
                        <td style="padding: 8px 12px;">{{ $item['description'] ?? '-' }}</td>
                        <td style="padding: 8px 12px; text-align: center;">{{ $item['qty_target'] ?? 0 }}</td>
                        <td style="padding: 8px 12px; text-align: center;">{{ $s1 }}</td>
                        <td style="padding: 8px 12px; text-align: center;">{{ $s2 }}</td>
                        <td style="padding: 8px 12px; text-align: center;">{{ $s3 }}</td>
                        <td style="padding: 8px 12px; text-align: center;">{{ $s4 }}</td>
                        <td style="padding: 8px 12px; text-align: center;">{{ $s5 }}</td>
                        <td style="padding: 8px 12px; text-align: center;">{{ $s6 }}</td>
                        <td style="padding: 8px 12px; text-align: center;">{{ $s7 }}</td>
                        <td style="padding: 8px 12px; text-align: center;">{{ $s8 }}</td>
                        <td style="padding: 8px 12px; text-align: center; font-weight: 600;">@include('monitoring._prog_badge', ['v' => $pct])</td>
                        <td style="padding: 8px 12px;">{{ $item['welder_id'] ?? '-' }}</td>
                        <td style="padding: 8px 12px;">{{ $item['pic'] ?? '-' }}</td>
                        <td style="padding: 8px 12px;">{{ $item['tgl_update'] ?? $item['tanggal_mulai'] ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="15" style="text-align:center; color:var(--text-light); padding:20px;">{{ __('messages.no_data') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @php
            $ncrItems = $project->fabrication_data['ncr'] ?? [];
        @endphp
        @if(count($ncrItems) > 0)
        <div style="margin: 20px; padding: 15px; border: 1px solid #fee2e2; border-radius: 8px; background: #fff5f5;">
            <h4 style="color: #dc2626; font-size: 14px; font-weight: bold; margin-top: 0; margin-bottom: 10px;">Non-Conformance Report (NCR)</h4>
            <div class="table-wrapper">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 12px;">
                    <thead style="background-color: #fee2e2; color: #991b1b;">
                        <tr>
                            <th style="padding: 10px 14px;">Part no</th>
                            <th style="padding: 10px 14px;">Deskripsi Masalah / Perbaikan</th>
                            <th style="padding: 10px 14px;">Status NCR</th>
                            <th style="padding: 10px 14px;">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ncrItems as $ncr)
                        <tr style="border-bottom: 1px solid #fecaca;">
                            <td style="padding: 10px 14px; font-weight: 600; color: #b91c1c;">{{ $ncr['part_no'] ?? '-' }}</td>
                            <td style="padding: 10px 14px;">{{ $ncr['deskripsi'] ?? '-' }}</td>
                            <td style="padding: 10px 14px;">
                                <span style="background-color: #fef2f2; color: #dc2626; padding: 3px 10px; border-radius: 12px; font-weight: 600; font-size: 11px; border: 1px solid #fca5a5;">
                                    {{ $ncr['status'] ?? 'Open' }}
                                </span>
                            </td>
                            <td style="padding: 10px 14px;">{{ $ncr['tanggal'] ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <div style="margin: 20px; padding: 15px; border: 1px solid #e2e8f0; border-radius: 8px; background: #f8fafc;">
            <div style="display: flex; justify-content: space-between; font-size: 12px; font-weight: 600; margin-bottom: 5px; color: #475569;">
                <span>{{ __('messages.total_progress') }}</span>
                <span>{{ $project->prog_fabrication ?? 0 }}%</span>
            </div>
            <div style="background: #e2e8f0; height: 5px; border-radius: 4px; width: 100%; overflow: hidden;">
                <div style="background: #55ACEE; margin: 0; height: 100%; width: {{ $project->prog_fabrication ?? 0 }}%;"></div>
            </div>
        </div>
    </div>
</div>

{{-- 8. Galvanized --}}
<div id="tab-gal" class="detail-section mb-4 custom-tab-content">
    <div class="detail-section-header bg-primary text-white p-3 rounded-top">
        <span class="fw-bold">{{ __('messages.galvanized') }}</span>
    </div>
    <div class="detail-section-body border border-top-0 rounded-bottom">
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>{{ __('messages.process') }}</th>
                        <th>{{ __('messages.date') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.description') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($project->galvanizeds as $gal)
                    <tr>
                        <td class="fw-600">{{ $gal->process }}</td>
                        <td>{{ $gal->date?->format('d-m-Y') ?? '-' }}</td>
                        <td>
                            @if($gal->status === 'Done')
                                <span class="badge badge-done">Done</span>
                            @elseif($gal->status === 'On-Go')
                                <span class="badge badge-ongoing">On-Go</span>
                            @else
                                <span class="badge badge-pending">Pending</span>
                            @endif
                        </td>
                        <td style="color:var(--text-mid);">{{ $gal->description }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="text-align:center; color:var(--text-light); padding:20px;">{{ __('messages.no_data') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin: 20px; padding: 15px; border: 1px solid #e2e8f0; border-radius: 8px; background: #f8fafc;">
            <div style="display: flex; justify-content: space-between; font-size: 12px; font-weight: 600; margin-bottom: 5px; color: #475569;">
                <span>{{ __('messages.total_progress') }}</span>
                <span>{{ $project->prog_galvanized ?? 0 }}%</span>
            </div>
            <div style="background: #e2e8f0; height: 5px; border-radius: 4px; width: 100%; overflow: hidden;">
                <div style="background: #55ACEE; margin: 0; height: 100%; width: {{ $project->prog_galvanized ?? 0 }}%;"></div>
            </div>
        </div>
    </div>
</div>

{{-- 9. Delivery --}}
<div id="tab-del" class="detail-section mb-4 custom-tab-content">
    <div class="detail-section-header bg-primary text-white p-3 rounded-top">
        <span class="fw-bold">{{ __('messages.delivery') }} List</span>
    </div>
    <div class="detail-section-body border border-top-0 rounded-bottom" style="padding: 20px;">
        @if($project->deliveries->count() > 0)
            @php 
                $firstDel = $project->deliveries->first(); 
                $grandTotal = $project->deliveries->sum('total_weight_kg');
                $groupedDeliveries = $project->deliveries->groupBy('section');
            @endphp
            
            <div style="margin-bottom: 24px; font-size: 13px; color: #334155;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
                    <div>
                        <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #e2e8f0; padding: 8px 0;">
                            <span style="color: #64748b;">Contract no.</span>
                            <strong>{{ $project->work_order }}</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #e2e8f0; padding: 8px 0;">
                            <span style="color: #64748b;">Project</span>
                            <strong>{{ $project->bridge_type }}</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #e2e8f0; padding: 8px 0;">
                            <span style="color: #64748b;">Material</span>
                            <strong>{{ $firstDel->product }}</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #e2e8f0; padding: 8px 0;">
                            <span style="color: #64748b;">Customer</span>
                            <strong>{{ $firstDel->customer ?? $project->customer }}</strong>
                        </div>
                    </div>
                    <div>
                        <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #e2e8f0; padding: 8px 0;">
                            <span style="color: #64748b;">No. document</span>
                            <strong>{{ $firstDel->document_no }}</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #e2e8f0; padding: 8px 0;">
                            <span style="color: #64748b;">Rev</span>
                            <strong>{{ $firstDel->rev }}</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #e2e8f0; padding: 8px 0;">
                            <span style="color: #64748b;">Date</span>
                            <strong>{{ $firstDel->delivery_date ? $firstDel->delivery_date->format('d M Y') : '-' }}</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #e2e8f0; padding: 8px 0;">
                            <span style="color: #64748b;">Location</span>
                            <strong>{{ $firstDel->location }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-wrapper">
                <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                    <thead>
                        <tr style="background: #f8fafc; border-bottom: 2px solid #cbd5e1; color: #64748b;">
                            <th style="padding: 10px; text-align: left;">No</th>
                            <th style="padding: 10px; text-align: left;">Rev</th>
                            <th style="padding: 10px; text-align: left;">{{ __('messages.fab_assembling') }} no.</th>
                            <th style="padding: 10px; text-align: right;">Qty (pcs)</th>
                            <th style="padding: 10px; text-align: left;">Class</th>
                            <th style="padding: 10px; text-align: left;">Description</th>
                            <th style="padding: 10px; text-align: right;">Length (mm)</th>
                            <th style="padding: 10px; text-align: right;">Unit weight (kg)</th>
                            <th style="padding: 10px; text-align: right;">Total weight (kg)</th>
                            <th style="padding: 10px; text-align: left;">Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $globalItemNumber = 1; @endphp
                        
                        @foreach(['Loose part', 'Assembly part', 'Bolt, nut & washer'] as $secName)
                            @if(isset($groupedDeliveries[$secName]))
                                <tr style="background: #f1f5f9;">
                                    <td colspan="10" style="padding: 8px 10px; font-weight: 700; color: #334155;">{{ $secName }}</td>
                                </tr>
                                @php $subtotal = 0; @endphp
                                @foreach($groupedDeliveries[$secName] as $item)
                                    @php $subtotal += $item->total_weight_kg; @endphp
                                    <tr style="border-bottom: 1px solid #e2e8f0;">
                                        <td style="padding: 8px 10px;">{{ $globalItemNumber++ }}</td>
                                        <td style="padding: 8px 10px;">{{ $item->rev ?? $firstDel->rev }}</td>
                                        <td style="padding: 8px 10px;">{{ $item->assembly_no }}</td>
                                        <td style="padding: 8px 10px; text-align: right;">{{ $item->quantity }}</td>
                                        <td style="padding: 8px 10px;">{{ $item->class }}</td>
                                        <td style="padding: 8px 10px;">{{ $item->description }}</td>
                                        <td style="padding: 8px 10px; text-align: right;">{{ $item->length_mm }}</td>
                                        <td style="padding: 8px 10px; text-align: right;">{{ number_format((float)$item->weight_kg, 2, ',', '.') }}</td>
                                        <td style="padding: 8px 10px; text-align: right;">{{ number_format((float)$item->total_weight_kg, 2, ',', '.') }}</td>
                                        <td style="padding: 8px 10px;">{{ $item->remark }}</td>
                                    </tr>
                                @endforeach
                                <tr style="border-bottom: 1px solid #cbd5e1; font-weight: 600;">
                                    <td colspan="8" style="padding: 10px; text-align: left; color: #334155;">Subtotal {{ strtolower($secName) }}</td>
                                    <td style="padding: 10px; text-align: right;">{{ number_format($subtotal, 2, ',', '.') }}</td>
                                    <td></td>
                                </tr>
                            @endif
                        @endforeach
                        
                        <tr style="background: #1e293b; color: white; font-weight: 700; font-size: 14px;">
                            <td colspan="8" style="padding: 12px 10px; text-align: right;">{{ __('messages.grand_total') }} weight (kg)</td>
                            <td style="padding: 12px 10px; text-align: right;">{{ number_format($grandTotal, 2, ',', '.') }}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @else
            <div style="text-align:center; color:var(--text-light); padding:20px; border: 1px solid #e2e8f0; border-radius: 8px;">
                {{ __('messages.no_data') }}
            </div>
        @endif
        <div style="margin: 20px 0 0 0; padding: 15px; border: 1px solid #e2e8f0; border-radius: 8px; background: #f8fafc;">
            <div style="display: flex; justify-content: space-between; font-size: 12px; font-weight: 600; margin-bottom: 5px; color: #475569;">
                <span>{{ __('messages.total_progress') }}</span>
                <span>{{ $project->prog_delivery ?? 0 }}%</span>
            </div>
            <div style="background: #e2e8f0; height: 5px; border-radius: 4px; width: 100%; overflow: hidden;">
                <div style="background: #55ACEE; margin: 0; height: 100%; width: {{ $project->prog_delivery ?? 0 }}%;"></div>
            </div>
        </div>
    </div>
</div>

<!-- FLOATING BUTTON (Selalu Melayang di Kanan Bawah dari POV Layar) -->
<button class="floating-fixed-btn btn btn-primary rounded-pill px-4 py-2 shadow-lg d-flex align-items-center gap-2 font-weight-bold" 
        onclick="toggleGlobalChat()" 
        type="button">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
    </svg>
    <span>Write Comment here</span>
    <span class="badge bg-white text-primary rounded-pill ms-1 fw-bold" style="font-size: 12px;">{{ $totalCommentsCount }}</span>
</button>

<!-- FLOATING CHAT BOX (Melayang di atas Tombol) -->
<div id="globalChatWidget" class="floating-chat-box shadow-lg rounded" style="display: none;">
    <!-- Header Pop-up -->
    <div class="chat-header" style="background-color: #55ACEE; color: white; padding: 10px 16px; display: flex; justify-content: space-between; align-items: center; border-top-left-radius: 6px; border-top-right-radius: 6px;">
        <span style="font-weight: bold; font-size: 13px;">Discussion Comments</span>
        <button type="button" onclick="toggleGlobalChat()" style="background: none; border: none; color: white; font-size: 18px; cursor: pointer; line-height: 1; padding: 0;">&times;</button>
    </div>

    <!-- Body Pop-up (Daftar Komentar) -->
    <div class="chat-body custom-scrollbar" style="background-color: #f8f9fa; padding: 12px; overflow-y: auto; height: 350px;">
        @forelse($commentsData as $item)
            @php
                $isMine = auth()->check() && $item->user_id === auth()->id();
            @endphp
            <div class="chat-message-row {{ $isMine ? 'is-mine' : 'is-other' }}">
                <div class="chat-message-wrapper">
                    
                    @if(!$isMine)
                    <!-- Avatar -->
                    <div class="chat-avatar">
                        {{ strtoupper(substr($item->user->name ?? 'U', 0, 2)) }}
                    </div>
                    @endif

                    <div class="chat-message-content">
                        <div class="chat-message-header">
                            <span class="chat-message-author">
                                {{ $isMine ? 'Anda' : ($item->user->name ?? 'User') }}
                            </span>
                            <span class="chat-message-time">
                                {{ $item->created_at->format('d M, H:i') }}
                            </span>
                        </div>

                        <div class="chat-bubble {{ $isMine ? 'bubble-mine' : 'bubble-other' }}">
                            {{ $item->comment }}

                            @if($isMine)
                                <form action="{{ route('documents.comments.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus komentar ini?');" class="delete-comment-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-comment-btn" title="Hapus">
                                        X
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="chat-empty-state">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 8px;">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
                <p style="margin: 0; font-weight: bold; color: #6c757d;">{{ __('messages.no_activity') }}</p>
                <p style="margin: 0; font-size: 11px; color: #6c757d;">Jadilah yang pertama untuk berdiskusi!</p>
            </div>
        @endforelse
    </div>

    <!-- Footer Pop-up (Form Input) -->
    <div class="chat-footer" style="background-color: white; padding: 12px; border-top: 1px solid #dee2e6; border-bottom-left-radius: 6px; border-bottom-right-radius: 6px;">
        <form action="{{ route('documents.comments.store') }}" method="POST" style="margin: 0;">
            @csrf
            <input type="hidden" name="work_order" value="{{ $project->work_order }}">
            <input type="hidden" name="section" value="general">

            <div style="display: flex; gap: 8px;">
                <input type="text" name="comment" style="flex: 1; padding: 6px 12px; font-size: 13px; border: 1px solid #ced4da; border-radius: 4px; outline: none; background-color: #f8f9fa;" placeholder="Tulis komentar..." required autocomplete="off">
                <button type="submit" style="background-color: #55ACEE; color: white; border: none; padding: 6px 16px; font-size: 13px; font-weight: bold; border-radius: 4px; cursor: pointer;">Kirim</button>
            </div>
        </form>
    </div>
</div>

<style>
/* Chat Messages Styles */
.chat-message-row {
    display: flex;
    width: 100%;
    margin-bottom: 12px;
}
.chat-message-row.is-mine {
    justify-content: flex-end;
}
.chat-message-row.is-other {
    justify-content: flex-start;
}
.chat-message-wrapper {
    display: flex;
    gap: 8px;
    max-width: 85%;
}
.chat-message-row.is-mine .chat-message-wrapper {
    flex-direction: row-reverse;
}
.chat-avatar {
    background-color: #55ACEE;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    width: 32px;
    height: 32px;
    font-size: 11px;
    font-weight: bold;
    border: 2px solid #fff;
    box-shadow: 0 1px 2px rgba(0,0,0,0.1);
}
.chat-message-content {
    display: flex;
    flex-direction: column;
}
.chat-message-row.is-mine .chat-message-content {
    align-items: flex-end;
}
.chat-message-row.is-other .chat-message-content {
    align-items: flex-start;
}
.chat-message-header {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 4px;
    padding: 0 4px;
}
.chat-message-author {
    font-weight: bold;
    color: #212529;
    font-size: 11px;
}
.chat-message-time {
    color: #6c757d;
    font-size: 10px;
}
.chat-bubble {
    position: relative;
    padding: 8px 10px;
    border-radius: 12px;
    font-size: 12.5px;
    line-height: 1.4;
    word-break: break-word;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    border: 1px solid rgba(0,0,0,0.05);
}
.bubble-mine {
    background-color: #55ACEE;
    color: white;
    border-top-right-radius: 0;
    border-color: #0099CC;
}
.bubble-other {
    background-color: white;
    color: #212529;
    border-top-left-radius: 0;
}
.delete-comment-form {
    position: absolute;
    top: -8px;
    right: -8px;
    margin: 0;
    z-index: 10;
}
.delete-comment-btn {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background-color: #dc3545;
    color: white;
    border: 1.5px solid #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    padding: 0;
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
.delete-comment-btn:hover {
    background-color: #bb2d3b;
}
.chat-empty-state {
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
}

/* Custom Scrollbar for Chat */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: #f1f1f1; 
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #c1c1c1; 
    border-radius: 4px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8; 
}

/* Tombol Melayang Mengunci Layar di Kanan Bawah dari POV */
.floating-fixed-btn {
    position: fixed !important;
    bottom: 25px !important;
    right: 35px !important;
    z-index: 1080 !important;
    font-size: 14px;
    background-color: #55ACEE !important;
    border: none;
}

/* Chat Pop-up Box Melayang di atas Tombol Kanan Bawah */
.floating-chat-box {
    position: fixed !important;
    bottom: 75px !important;
    right: 35px !important;
    width: 350px;
    z-index: 1090 !important;
    background-color: #fff;
    border: 1px solid rgba(0, 0, 0, 0.15);
    animation: slideUp 0.2s ease-out;
}

@keyframes slideUp {
    from {
        transform: translateY(10px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}
</style>

<script>
function openTab(tabId, btnElement) {
    document.querySelectorAll('.custom-tab-content').forEach(el => el.classList.remove('active'));
    document.querySelectorAll('.custom-tab-btn').forEach(el => el.classList.remove('active'));
    document.getElementById(tabId).classList.add('active');
    btnElement.classList.add('active');
}

function toggleGlobalChat() {
    var widget = document.getElementById("globalChatWidget");
    if (widget.style.display === "none" || widget.style.display === "") {
        widget.style.display = "block";
    } else {
        widget.style.display = "none";
    }
}
</script>

@extends('layouts.app')
@section('title', __('messages.edit') . ' ' . __('messages.project'))

@section('content')
<style>
    .update-header { font-size: 14px; color: var(--text-mid); font-weight: 600; margin-bottom: 4px; }
    .project-title { font-size: 28px; font-weight: 700; color: #354259; margin-bottom: 2px; }
    .project-subtitle { font-size: 16px; color: var(--text-mid); margin-bottom: 30px; }
    
    .tabs-nav {
        display: flex;
        align-items: center;
        gap: 22px;
        border-bottom: 2px solid #e2e8f0;
        margin-bottom: 24px;
        white-space: nowrap;
        overflow-x: auto;
        max-width: 100%;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .tabs-nav::-webkit-scrollbar,
    .subtabs-nav::-webkit-scrollbar {
        display: none;
    }

    .tab-btn {
        background: none; border: none; padding: 12px 16px;
        font-size: 15px; font-weight: 600; color: #64748b;
        cursor: pointer; position: relative; font-family: inherit; flex-shrink: 0;
    }
    .tab-btn.active { color: var(--primary); }
    .tab-btn.active::after {
        content: ''; position: absolute; bottom: -2px; left: 0; right: 0;
        height: 3px; background: var(--primary); border-radius: 2px 2px 0 0;
    }
    
    .subtabs-nav {
        display: flex; gap: 24px; margin-bottom: 20px; justify-content: center;
        overflow-x: auto; max-width: 100%; white-space: nowrap; scrollbar-width: none; -ms-overflow-style: none;
    }
    .subtab-btn {
        background: none; border: none; padding: 8px 30px;
        font-size: 14px; font-weight: 600; color: #64748b;
        cursor: pointer; position: relative; font-family: inherit;
    }
    .subtab-btn.active { color: var(--text-dark); }
    .subtab-btn.active::after {
        content: ''; position: absolute; bottom: -2px; left: 0; right: 0;
        height: 3px; background: var(--primary); border-radius: 2px 2px 0 0;
    }
    
    .tab-content { 
        display: none;
    }
    .tab-content.active { display: block; }
    
    .subtab-content { display: none; }
    .subtab-content.active { display: block; }
    
    .custom-input-group { max-width: 100%; margin: 0 auto; margin-bottom: 16px; }
    .custom-input-group label { display: block; font-size: 13px; color: #64748b; margin-bottom: 4px; }
    .custom-input-group input, .custom-input-group textarea {
        width: 100%; border: 1px solid #cbd5e1; border-radius: 4px; padding: 10px 14px;
        font-size: 14px; color: #334155; outline: none; font-family: inherit;
    }
    .custom-input-group input:focus, .custom-input-group textarea:focus { border-color: var(--primary); }
    
    .slider-container { max-width: 100%; margin: 30px auto; position: relative; }
    .slider-label { display: flex; justify-content: space-between; font-size: 13px; color: #64748b; margin-bottom: 10px; font-weight: 500; }
    input[type=range] {
        -webkit-appearance: none; width: 100%; background: transparent; cursor: pointer;
    }
    input[type=range]::-webkit-slider-runnable-track {
        width: 100%; height: 4px; background: #e2e8f0; border-radius: 2px;
    }
    input[type=range]::-webkit-slider-thumb {
        -webkit-appearance: none; height: 18px; width: 18px; border-radius: 50%;
        background: var(--primary); border: 4px solid #bae6fd; box-shadow: 0 0 0 1px #38bdf8;
        margin-top: -7px;
    }
    .slider-value-badge {
        position: absolute; bottom: 35px; transform: translateX(-50%);
        color: #334155; font-size: 15px; font-weight: 700;
    }
    
    .action-buttons { display: flex; justify-content: center; gap: 16px; margin-top: 50px; }
    .btn-cancel { border: 1px solid #cbd5e1; background: white; color: #334155; padding: 10px 30px; border-radius: 4px; font-weight: 600; cursor: pointer; text-decoration: none; }
    .btn-save { background: #354259; border: none; color: white; padding: 10px 30px; border-radius: 4px; font-weight: 600; cursor: pointer; }

    #progress-slider::-webkit-slider-thumb {
        -webkit-appearance: none; appearance: none; width: 20px; height: 20px; border-radius: 50%; background: #55ACEE; cursor: pointer; border: 4px solid #E6F9FF; box-shadow: 0 0 0 1px #55ACEE;
    }
    #mto-slider::-webkit-slider-thumb, #galvanis-slider::-webkit-slider-thumb {
        -webkit-appearance: none; appearance: none; width: 0px; height: 0px; 
    }
</style>

<div class="card" style="padding:40px;">
    <div class="update-header">{{ __('messages.update_project') }}</div>
    <div class="project-title">{{ $project->bridge_type }}</div>
    <div class="project-subtitle">Customer: {{ $project->customer }} | Work Order: {{ $project->work_order }}</div>
    
    <form action="{{ route('monitoring.update', $project) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        
        @php
            $userRole = auth()->user()->role ?? 'Staff / Operator';
            $isAdmin = in_array($userRole, ['Direksi']);
            
            $roleTabAccess = [
                'Marketing'             => ['tab-project','tab-payment'],
                'Purchasing'            => ['tab-procurement', 'tab-quantity'],
                'Design & Engineering'  => ['tab-design'],
                'Fabrikasi'             => ['tab-fabrication', 'tab-galvanized'],
                'Staff / Operator'      => [''],
                'PPIC'                  => ['tab-delivery', 'tab-takeoff', 'tab-material'],
                'project-control'       => ['tab-fabrication', 'tab-galvanized'],
            ];
            
            $allowedTabs = $isAdmin 
                ? ['tab-project','tab-payment','tab-quantity','tab-material','tab-design','tab-takeoff','tab-procurement','tab-fabrication','tab-galvanized','tab-delivery'] 
                : ($roleTabAccess[$userRole] ?? []);
            
            $firstAllowedTab = $allowedTabs[0] ?? 'tab-payment';
            
            $allTabs = [
                'tab-project'     => __('messages.project'),
                'tab-payment'     => __('messages.bill_of_payment'),
                'tab-quantity'    => __('messages.bill_of_quantity'),
                'tab-material'    => __('messages.bill_of_material'),
                'tab-design'      => __('messages.design_engineering'),
                'tab-takeoff'     => __('messages.material_take_off'),
                'tab-procurement' => __('messages.material_procurement'),
                'tab-fabrication' => __('messages.fabrication'),
                'tab-galvanized'  => __('messages.galvanized'),
                'tab-delivery'    => __('messages.delivery'),
            ];
        @endphp

        <!-- Hidden fields for non-admin roles -->
        @if(!$isAdmin)
        <input type="hidden" name="bridge_type" value="{{ $project->bridge_type }}">
        <input type="hidden" name="customer" value="{{ $project->customer }}">
        <input type="hidden" name="work_order" value="{{ $project->work_order }}">
        <input type="hidden" name="contract_value" value="{{ $project->contract_value }}">
        <input type="hidden" name="timeline_start" value="{{ $project->timeline_start->format('Y-m-d') }}">
        <input type="hidden" name="timeline_end" value="{{ $project->timeline_end->format('Y-m-d') }}">
        @endif
        <input type="hidden" name="status" value="{{ $project->status }}">

        <!-- TABS NAV -->
        <div class="tabs-nav">
            @foreach($allTabs as $tabId => $tabLabel)
                @if(in_array($tabId, $allowedTabs))
                    <button type="button" class="tab-btn {{ $tabId === $firstAllowedTab ? 'active' : '' }}" onclick="switchTab(this, '{{ $tabId }}')">{{ $tabLabel }}</button>
                @endif
            @endforeach
        </div>

        <!-- TAB CONTENT: DATA PROJECT -->
        @if(in_array('tab-project', $allowedTabs))
        <div id="tab-project" class="tab-content {{ 'tab-project' === $firstAllowedTab ? 'active' : '' }}">
            <div style="max-width: 100%; margin: 0 auto;">
                {{-- Baris 1: Customer, Work Order, Bridge Type --}}
                <div style="display: flex; gap: 16px; margin-bottom: 20px; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 250px;">
                        <label for="customer" style="display: block; font-weight: 600; font-size: 14px; color: #374151; margin-bottom: 6px;">
                            Customer <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" id="customer" name="customer"
                            value="{{ old('customer', $project->customer) }}"
                            placeholder="e.g. PT. XYZ" required
                            style="width: 100%; padding: 10px 12px; font-size: 14px; border: 1px solid #d1d5db; border-radius: 6px; outline: none; background-color: #fff;">
                    </div>
                    <div style="flex: 1; min-width: 250px;">
                        <label for="work_order" style="display: block; font-weight: 600; font-size: 14px; color: #374151; margin-bottom: 6px;">
                            {{ __('messages.work_order') }} <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" id="work_order" name="work_order"
                            value="{{ old('work_order', $project->work_order) }}"
                            placeholder="e.g. O0001" required
                            style="width: 100%; padding: 10px 12px; font-size: 14px; border: 1px solid #d1d5db; border-radius: 6px; outline: none; background-color: #fff;">
                    </div>
                    <div style="flex: 1; min-width: 250px;">
                        <label for="bridge_type" style="display: block; font-weight: 600; font-size: 14px; color: #374151; margin-bottom: 6px;">
                            {{ __('messages.bridge_type') }} <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" id="bridge_type" name="bridge_type"
                            value="{{ old('bridge_type', $project->bridge_type) }}"
                            placeholder="e.g. Girder A20" required
                            style="width: 100%; padding: 10px 12px; font-size: 14px; border: 1px solid #d1d5db; border-radius: 6px; outline: none; background-color: #fff;">
                    </div>
                </div>

                {{-- Baris 2: Timeline Start, Timeline End, Contract Value --}}
                <div style="display: flex; gap: 16px; margin-bottom: 20px; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 250px;">
                        <label for="timeline_start" style="display: block; font-weight: 600; font-size: 14px; color: #374151; margin-bottom: 6px;">
                            {{ __('messages.timeline_start') }} <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="date" id="timeline_start" name="timeline_start"
                            value="{{ old('timeline_start', $project->timeline_start->format('Y-m-d')) }}" required
                            style="width: 100%; padding: 10px 12px; font-size: 14px; border: 1px solid #d1d5db; border-radius: 6px; outline: none; background-color: #fff;">
                    </div>
                    <div style="flex: 1; min-width: 250px;">
                        <label for="timeline_end" style="display: block; font-weight: 600; font-size: 14px; color: #374151; margin-bottom: 6px;">
                            {{ __('messages.timeline_end') }} <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="date" id="timeline_end" name="timeline_end"
                            value="{{ old('timeline_end', $project->timeline_end->format('Y-m-d')) }}" required
                            style="width: 100%; padding: 10px 12px; font-size: 14px; border: 1px solid #d1d5db; border-radius: 6px; outline: none; background-color: #fff;">
                    </div>
                    <div style="flex: 1; min-width: 250px;">
                        <label for="contract_value" style="display: block; font-weight: 600; font-size: 14px; color: #374151; margin-bottom: 6px;">
                            {{ __('messages.contract_value') }} <span style="color: #ef4444;">*</span>
                        </label>
                        <div style="position: relative;">
                            <span style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #64748b; font-size: 14px; font-weight: 600;">Rp</span>
                            <input type="number" id="contract_value" name="contract_value"
                                value="{{ old('contract_value', intval($project->contract_value)) }}"
                                placeholder="0" required
                                style="width: 100%; padding: 10px 12px 10px 40px; font-size: 14px; border: 1px solid #d1d5db; border-radius: 6px; outline: none; background-color: #fff;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- TAB CONTENT: BILL OF PAYMENT -->
        @if(in_array('tab-payment', $allowedTabs))
        <div id="tab-payment" class="tab-content {{ 'tab-payment' === $firstAllowedTab ? 'active' : '' }}">
            @include('monitoring.partials.bop_edit')
        </div>
        @endif

        <!-- TAB CONTENT: BILL OF QUANTITY -->
        @if(in_array('tab-quantity', $allowedTabs))
        <div id="tab-quantity" class="tab-content {{ 'tab-quantity' === $firstAllowedTab ? 'active' : '' }}">
            <h3 style="text-align:center; color:#64748b;">{{ __('messages.bill_of_quantity') }}</h3>

            @include('monitoring.partials.boq_edit')

            <div class="slider-container">
                <div class="slider-label"><span>{{ __('messages.progress_percentage') }}</span></div>
                <input type="range" name="prog_bill_of_material" min="0" max="100" value="{{ $project->prog_bill_of_material ?? 0 }}" oninput="updateSliderValue(this, 'val-quantity')">
                <div id="val-quantity" class="slider-value-badge" style="left: {{ $project->prog_bill_of_material ?? 0 }}%;">{{ $project->prog_bill_of_material ?? 0 }}%</div>
                <div style="display:flex; justify-content:space-between; font-size:12px; color:#64748b; margin-top:4px;"><span>0</span><span>100%</span></div>
            </div>
        </div>
        @endif

        <!-- TAB CONTENT: MATERIAL PROCUREMENT -->
        @if(in_array('tab-procurement', $allowedTabs))
        <div id="tab-procurement" class="tab-content {{ 'tab-procurement' === $firstAllowedTab ? 'active' : '' }}">
            <div>
                <h3 style="font-size:18px; font-weight:700; color:#1e293b; margin-bottom:4px;">{{ __('messages.material_purchase') }}</h3>
                <p style="font-size:13px; color:#94a3b8; margin-bottom:20px;">
                    {{ __('messages.material_purchase_desc') }}
                </p>

                @include('monitoring.partials.procurement_edit')

                <div class="slider-container">
                    <div class="slider-label">
                        <span>{{ __('messages.progress_percentage') }}</span>
                    </div>
                    <input type="range" name="prog_material_procurement" min="0" max="100" value="{{ $project->prog_material_procurement ?? 0 }}" oninput="updateSliderValue(this, 'val-procurement')">
                    <div id="val-procurement" class="slider-value-badge" style="left: {{ $project->prog_material_procurement ?? 0 }}%;">{{ $project->prog_material_procurement ?? 0 }}%</div>
                    <div style="display:flex; justify-content:space-between; font-size:12px; color:#64748b; margin-top:4px;">
                        <span>0</span>
                        <span>100%</span>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- TAB CONTENT: STATUS -->
        @if(in_array('tab-status', $allowedTabs))
        <div id="tab-status" class="tab-content {{ 'tab-status' === $firstAllowedTab ? 'active' : '' }}">
            <div style="max-width:1000px; margin:0 auto;">
                <p style="font-size:12px; color:#94a3b8; margin-bottom:24px;">
                    When the project is completed, please set the status to "Done".
                </p>

                <div class="status-radio-group">
                    <label class="status-radio-option">
                        <input type="radio" name="status" value="pending" {{ $project->status == 'pending' ? 'checked' : '' }}>
                        <span class="radio-circle"></span>
                        <span class="radio-text">Pending</span>
                    </label>

                    <label class="status-radio-option">
                        <input type="radio" name="status" value="on-going" {{ $project->status == 'on-going' ? 'checked' : '' }}>
                        <span class="radio-circle"></span>
                        <span class="radio-text">On-Going</span>
                    </label>

                    <label class="status-radio-option">
                        <input type="radio" name="status" value="done" {{ $project->status == 'done' ? 'checked' : '' }}>
                        <span class="radio-circle"></span>
                        <span class="radio-text">Done</span>
                    </label>
                </div>
            </div>
        </div>
        @endif

        <!-- TAB CONTENT: BILL OF MATERIAL -->
        @if(in_array('tab-material', $allowedTabs))
        <div id="tab-material" class="tab-content {{ 'tab-material' === $firstAllowedTab ? 'active' : '' }}">
            <h3 style="text-align:center; color:#64748b;">{{ __('messages.bill_of_material') }}</h3>
            <div style="max-width: 100%; margin: 20px auto; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; box-sizing: border-box;">
                
            @include('monitoring.partials.bom_edit')

                <div class="slider-container">
                    <div class="slider-label">
                        <span>{{ __('messages.progress_percentage') }}</span>
                    </div>
                    <input type="range" name="prog_bill_of_material" min="0" max="100" value="{{ $project->prog_bill_of_material ?? 0 }}" oninput="updateSliderValue(this, 'val-bill')">
                    <div id="val-bill" class="slider-value-badge" style="left: {{ $project->prog_bill_of_material ?? 0 }}%;">{{ $project->prog_bill_of_material ?? 0 }}%</div>
                    <div style="display:flex; justify-content:space-between; font-size:12px; color:#64748b; margin-top:4px;">
                        <span>0</span>
                        <span>100%</span>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- TAB CONTENT: DESIGN ENGINEERING -->
        @if(in_array('tab-design', $allowedTabs))
        <div id="tab-design" class="tab-content {{ 'tab-design' === $firstAllowedTab ? 'active' : '' }}">
            <h3 style="text-align:center; color:#64748b;">{{ __('messages.design_engineering') }}</h3>
            <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 30px; max-width: 100%; width: 100%; margin: 20px auto; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                <h3 style="font-size: 16px; font-weight: bold; color: #1e293b; margin: 0 0 4px 0;">Progres Desain Engineering</h3>
                <p style="font-size: 12px; color: #64748b; margin: 0 0 30px 0;">When the invest duration change, the interest is recalculated</p>
                
                <div style="margin-bottom: 25px;">
                    <label for="design_date" style="display: block; font-size: 13px; color: #334155; margin-bottom: 8px;">date</label>
                    <div style="display: flex; align-items: center; border-bottom: 1.5px solid #55ACEE; padding-bottom: 8px;">
                        <svg style="width: 20px; height: 20px; color: #55ACEE; margin-right: 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <input type="date" id="design_date" name="design_date" value="{{ $project->design_date ? $project->design_date->format('Y-m-d') : '' }}" style="border: none; outline: none; font-size: 14px; color: #1e293b; width: 100%; background: transparent; cursor: pointer;">
                    </div>
                </div>

                {{-- Upload Area --}}
                <div style="border: 2px dashed #cbd5e1; border-radius: 16px; padding: 30px 20px; text-align: center; background-color: #f8fafc; margin-bottom: 20px;">
                    <svg style="width:40px;height:40px;color:#94a3b8;margin:0 auto 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    <h4 style="font-size: 18px; font-weight: 600; color: #334155; margin: 0 0 6px 0;">Pilih file atau drag & drop di sini</h4>
                    <p style="font-size: 13px; color: #94a3b8; margin: 0 0 16px 0;">PDF, JPEG, PNG, DWG, XLSX, dll. Maks 50MB per file. Bisa pilih lebih dari 1 file.</p>
                    <label id="upload-label" style="background: #55ACEE; color:#fff; border: none; padding: 10px 28px; border-radius: 30px; font-size: 14px; cursor: pointer; font-weight: 600; display:inline-block;">
                        Browse File
                        <input type="file" name="documents[]" id="design-documents-input" multiple style="display: none;" onchange="showSelectedFiles(this)">
                    </label>
                    <div id="selected-files-preview" style="margin-top:12px; text-align:left;"></div>
                </div>

                {{-- Daftar File yang Sudah Di-upload --}}
                @php $docs = $project->design_documents ?? []; @endphp
                @if(count($docs) > 0)
                <div style="margin-bottom: 20px;">
                    <h5 style="font-size: 13px; font-weight: 700; color: #475569; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.05em;">
                        File Tersimpan ({{ count($docs) }})
                    </h5>
                    <div id="uploaded-files-list">
                        @foreach($docs as $doc)
                        <div style="display:flex; align-items:center; justify-content:space-between; padding:10px 14px; background:#fff; border:1px solid #e2e8f0; border-radius:8px; margin-bottom:8px;">
                            <div style="display:flex; align-items:center; gap:10px; overflow:hidden;">
                                <svg style="width:20px;height:20px;flex-shrink:0;color:#55ACEE;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <a href="{{ asset('storage/' . $doc) }}" target="_blank" style="color:#1e293b; text-decoration:none; font-size:13px; font-weight:500; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:320px; display:block;" title="{{ basename($doc) }}">
                                    {{ basename($doc) }}
                                </a>
                            </div>
                            <div style="display:flex; align-items:center; gap:8px; flex-shrink:0;">
                                <a href="{{ asset('storage/' . $doc) }}" target="_blank" style="font-size:12px; color:#55ACEE; text-decoration:none; font-weight:600;">Buka</a>
                                <label style="display:flex; align-items:center; gap:4px; font-size:12px; color:#ef4444; cursor:pointer; font-weight:600;">
                                    <input type="checkbox" name="delete_documents[]" value="{{ $doc }}" style="accent-color:#ef4444;">
                                    Hapus
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <p style="font-size:11px; color:#94a3b8; margin-top:6px;">Centang "Hapus" pada file yang ingin dihapus, lalu klik Simpan.</p>
                </div>
                @endif

                <div class="slider-container">
                    <div class="slider-label">
                        <span>{{ __('messages.progress_percentage') }}</span>
                    </div>
                    <input type="range" name="prog_design_engineering" min="0" max="100" value="{{ $project->prog_design_engineering ?? 0 }}" oninput="updateSliderValue(this, 'val-design')">
                    <div id="val-design" class="slider-value-badge" style="left: {{ $project->prog_design_engineering ?? 0 }}%;">{{ $project->prog_design_engineering ?? 0 }}%</div>
                    <div style="display:flex; justify-content:space-between; font-size:12px; color:#64748b; margin-top:4px;">
                        <span>0</span>
                        <span>100%</span>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- TAB CONTENT: MATERIAL TAKE OFF -->
        @if(in_array('tab-takeoff', $allowedTabs))
        <div id="tab-takeoff" class="tab-content {{ 'tab-takeoff' === $firstAllowedTab ? 'active' : '' }}">
            <h3 style="text-align:center; color:#64748b;">{{ __('messages.material_take_off') }}</h3>
            <div style="max-width: 100%; margin: 20px auto; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; box-sizing: border-box;">

                @include('monitoring.partials.mto_edit')

                <div style="display: flex; gap: 20px; margin-bottom: 24px;">
                    <div style="flex: 1;">
                        <label style="display: block; font-size: 13px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">Start date</label>
                        <div style="display: flex; align-items: center; border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px 12px; background-color: #ffffff;">
                            <svg style="width: 20px; height: 20px; color: #64748b; margin-right: 10px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <input type="date" name="start_date" value="01.01.2020" style="border: none; outline: none; width: 100%; font-size: 14px; color: #1e293b; background: transparent;">
                        </div>
                    </div>
                    <div style="flex: 1;">
                        <label style="display: block; font-size: 13px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">End date</label>
                        <div style="display: flex; align-items: center; border: 1px solid #55ACEE; border-radius: 6px; padding: 10px 12px; background-color: #f8fafc; box-shadow: 0 0 0 2px rgba(85, 172, 238, 0.1);">
                            <svg style="width: 20px; height: 20px; color: #55ACEE; margin-right: 10px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <input type="date" name="end_date" value="01.03.2021" style="border: none; outline: none; width: 100%; font-size: 14px; color: #1e293b; background: transparent;">
                        </div>
                    </div>
                </div>

                <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 24px; margin-bottom: 30px;">
                    <div class="slider-container">
                        <div class="slider-label">
                            <span>{{ __('messages.progress_percentage') }}</span>
                        </div>
                        <input type="range" name="prog_material_take_off" min="0" max="100" value="{{ $project->prog_material_take_off ?? 0 }}" oninput="updateSliderValue(this, 'val-takeoff')">
                        <div id="val-takeoff" class="slider-value-badge" style="left: {{ $project->prog_material_take_off ?? 0 }}%;">{{ $project->prog_material_take_off ?? 0 }}%</div>
                        <div style="display:flex; justify-content:space-between; font-size:12px; color:#64748b; margin-top:4px;">
                            <span>0</span>
                            <span>100%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- TAB CONTENT: FABRICATION -->
        @if(in_array('tab-fabrication', $allowedTabs))
        <div id="tab-fabrication" class="tab-content {{ 'tab-fabrication' === $firstAllowedTab ? 'active' : '' }}">
            <h3 style="text-align:center; color:#64748b;">{{ __('messages.fabrication') }}</h3>
            <div style="max-width: 100%; margin: 20px auto; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
                <!DOCTYPE html>

                @include('monitoring.partials.fabrikasi_edit')

                <div class="slider-container">
                    <div class="slider-label">
                        <span>{{ __('messages.progress_percentage') }}</span>
                    </div>
                    <input type="range" name="prog_fabrication" min="0" max="100" value="{{ $project->prog_fabrication ?? 0 }}" oninput="updateSliderValue(this, 'val-fabrication')">
                    <div id="val-fabrication" class="slider-value-badge" style="left: {{ $project->prog_fabrication ?? 0 }}%;">{{ $project->prog_fabrication ?? 0 }}%</div>
                    <div style="display:flex; justify-content:space-between; font-size:12px; color:#64748b; margin-top:4px;">
                        <span>0</span>
                        <span>100%</span>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- TAB CONTENT: GALVANIZED -->
        @if(in_array('tab-galvanized', $allowedTabs))
        <div id="tab-galvanized" class="tab-content {{ 'tab-galvanized' === $firstAllowedTab ? 'active' : '' }}">
            <h3 style="text-align:center; color:#64748b;">{{ __('messages.galvanized') }}</h3>
            <div style="max-width: 100%; margin: 20px auto; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">

                {{-- Tabel Galvanized --}}
                <div style="background:#fff; border:1px solid #e2e8f0; border-radius:12px; padding:20px; margin-bottom:20px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                        <h4 style="font-size:15px; font-weight:700; color:#334155; margin:0;">Data Galvanized</h4>
                        <button type="button" onclick="addGalvanizedRow()" style="background:#3b82f6; color:#fff; border:none; padding:8px 18px; border-radius:8px; font-size:13px; font-weight:600; cursor:pointer;">
                            + Tambah Baris
                        </button>
                    </div>
                    <div style="overflow-x:auto; border:1px solid #e2e8f0; border-radius:10px;">
                        <table style="width:100%; border-collapse:collapse; font-size:13px; min-width:700px;">
                            <thead style="background:#f8fafc; color:#64748b;">
                                <tr>
                                    <th style="padding:12px 14px; font-weight:600; text-align:left; border-bottom:1px solid #e2e8f0;">Proses</th>
                                    <th style="padding:12px 14px; font-weight:600; text-align:left; border-bottom:1px solid #e2e8f0;">Tanggal</th>
                                    <th style="padding:12px 14px; font-weight:600; text-align:left; border-bottom:1px solid #e2e8f0;">Status</th>
                                    <th style="padding:12px 14px; font-weight:600; text-align:left; border-bottom:1px solid #e2e8f0;">Deskripsi</th>
                                    <th style="padding:12px 14px; border-bottom:1px solid #e2e8f0;"></th>
                                </tr>
                            </thead>
                            <tbody id="galvanized_tbody">
                                @forelse($project->galvanizeds ?? [] as $gi => $gal)
                                <tr style="border-bottom:1px solid #f1f5f9;">
                                    <input type="hidden" name="galvanized[{{ $gi }}][id]" value="{{ $gal->id }}">
                                    <td style="padding:8px 10px;">
                                        <input type="text" name="galvanized[{{ $gi }}][process]" value="{{ $gal->process }}"
                                            placeholder="mis. Persiapan" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; box-sizing:border-box;">
                                    </td>
                                    <td style="padding:8px 10px;">
                                        <input type="date" name="galvanized[{{ $gi }}][date]" value="{{ $gal->date ? $gal->date->format('Y-m-d') : '' }}"
                                            style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; color:#475569; box-sizing:border-box;">
                                    </td>
                                    <td style="padding:8px 10px;">
                                        <select name="galvanized[{{ $gi }}][status]" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
                                            <option value="Pending" {{ ($gal->status ?? '') === 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="On-Go" {{ ($gal->status ?? '') === 'On-Go' ? 'selected' : '' }}>On-Go</option>
                                            <option value="Done" {{ ($gal->status ?? '') === 'Done' ? 'selected' : '' }}>Done</option>
                                        </select>
                                    </td>
                                    <td style="padding:8px 10px;">
                                        <input type="text" name="galvanized[{{ $gi }}][description]" value="{{ $gal->description }}"
                                            placeholder="Keterangan tambahan" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; box-sizing:border-box;">
                                    </td>
                                    <td style="padding:8px 10px; text-align:center;">
                                        <button type="button" onclick="this.closest('tr').remove()" style="background:none; border:none; color:#ef4444; font-size:18px; font-weight:bold; cursor:pointer;">&times;</button>
                                    </td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Slider Progress --}}
                <div class="slider-container">
                    <div class="slider-label">
                        <span>{{ __('messages.progress_percentage') }}</span>
                    </div>
                    <input type="range" name="prog_galvanized" min="0" max="100" value="{{ $project->prog_galvanized ?? 0 }}" oninput="updateSliderValue(this, 'val-galvanized')">
                    <div id="val-galvanized" class="slider-value-badge" style="left: {{ $project->prog_galvanized ?? 0 }}%;">{{ $project->prog_galvanized ?? 0 }}%</div>
                    <div style="display:flex; justify-content:space-between; font-size:12px; color:#64748b; margin-top:4px;">
                        <span>0</span>
                        <span>100%</span>
                    </div>
                </div>
            </div>
        </div>

        <script>
        let galvanizedIndex = {{ isset($project->galvanizeds) ? count($project->galvanizeds) : 0 }};

        function addGalvanizedRow() {
            const tbody = document.getElementById('galvanized_tbody');
            const i = galvanizedIndex++;
            const tr = document.createElement('tr');
            tr.style.borderBottom = '1px solid #f1f5f9';
            tr.innerHTML = `
                <td style="padding:8px 10px;">
                    <input type="text" name="galvanized[${i}][process]" placeholder="mis. Persiapan"
                        style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; box-sizing:border-box;">
                </td>
                <td style="padding:8px 10px;">
                    <input type="date" name="galvanized[${i}][date]"
                        style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; color:#475569; box-sizing:border-box;">
                </td>
                <td style="padding:8px 10px;">
                    <select name="galvanized[${i}][status]" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
                        <option value="Pending">Pending</option>
                        <option value="On-Go">On-Go</option>
                        <option value="Done">Done</option>
                    </select>
                </td>
                <td style="padding:8px 10px;">
                    <input type="text" name="galvanized[${i}][description]" placeholder="Keterangan tambahan"
                        style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; box-sizing:border-box;">
                </td>
                <td style="padding:8px 10px; text-align:center;">
                    <button type="button" onclick="this.closest('tr').remove()" style="background:none; border:none; color:#ef4444; font-size:18px; font-weight:bold; cursor:pointer;">&times;</button>
                </td>
            `;
            tbody.appendChild(tr);
        }
        </script>

        @endif

        <!-- TAB CONTENT: DELIVERY (GENERAL INFO & ITEM DETAIL) -->
        @if(in_array('tab-delivery', $allowedTabs))
        <div id="tab-delivery" class="tab-content {{ 'tab-delivery' === $firstAllowedTab ? 'active' : '' }}">
            
            @include('monitoring.partials.delivery_edit')

            <!-- Range Slider Progress Delivery -->
            <div class="slider-container" style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; margin-bottom: 24px;">
                <div class="slider-label" style="margin-bottom: 8px;">
                    <span>{{ __('messages.progress_percentage') }}</span>
                </div>
                <input type="range" name="prog_delivery" min="0" max="100" value="{{ $project->prog_delivery ?? 0 }}" oninput="updateSliderValue(this, 'val-delivery')" style="width: 100%;">
                <div id="val-delivery" class="slider-value-badge" style="left: {{ $project->prog_delivery ?? 0 }}%;">{{ $project->prog_delivery ?? 0 }}%</div>
                <div style="display:flex; justify-content:space-between; font-size:12px; color:#64748b; margin-top:4px;">
                    <span>0%</span>
                    <span>100%</span>
                </div>
            </div>
        </div>
        @endif

        <div class="action-buttons">
            <a href="{{ route('monitoring.show', $project) }}" class="btn-cancel">{{ __('messages.cancel') }}</a>
            <button type="submit" class="btn-save">{{ __('messages.save_changes') }}</button>
        </div>
    </form>
</div> {{-- Tag penutup untuk <div class="card"> --}}

@push('scripts')
<script>
    function switchTab(btn, targetId) {
        document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
        btn.classList.add('active');
        
        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        document.getElementById(targetId).classList.add('active');
    }
    
    function switchSubTab(btn, targetId) {
        document.querySelectorAll('.subtab-btn').forEach(el => el.classList.remove('active'));
        btn.classList.add('active');
        
        document.querySelectorAll('.subtab-content').forEach(el => el.classList.remove('active'));
        document.getElementById(targetId).classList.add('active');
    }

    function updateSliderValue(slider, badgeId) {
        const badge = document.getElementById(badgeId);
        if (badge) {
            badge.innerText = slider.value + '%';
            badge.style.left = slider.value + '%';
        }
        
        const value = (slider.value - slider.min) / (slider.max - slider.min) * 100;
        slider.style.background = `linear-gradient(to right, #38bdf8 0%, #38bdf8 ${value}%, #e2e8f0 ${value}%, #e2e8f0 100%)`;
    }

    document.querySelectorAll('input[type=range]').forEach(slider => {
        const value = (slider.value - slider.min) / (slider.max - slider.min) * 100;
        slider.style.background = `linear-gradient(to right, #38bdf8 0%, #38bdf8 ${value}%, #e2e8f0 ${value}%, #e2e8f0 100%)`;
    });

    let itemIndex = {{ isset($project->deliveries) ? count($project->deliveries) : 0 }};

    function calcItemTotalWeight() {
        const qty = parseFloat(document.getElementById('item_qty').value) || 0;
        const unitWeight = parseFloat(document.getElementById('item_unit_weight').value) || 0;
        const totalWeight = qty * unitWeight;
        document.getElementById('item_total_weight').value = totalWeight ? totalWeight.toFixed(2) : '';
    }

    function addItemToTable() {
        const section = document.getElementById('item_section').value;
        const assemblyNo = document.getElementById('item_assembly_no').value || '-';
        const qty = parseFloat(document.getElementById('item_qty').value) || 0;
        const itemClass = document.getElementById('item_class').value || '-';
        const description = document.getElementById('item_description').value || '-';
        const length = document.getElementById('item_length').value || 0;
        const unitWeight = parseFloat(document.getElementById('item_unit_weight').value) || 0;
        const totalWeight = (qty * unitWeight).toFixed(2);
        const remark = document.getElementById('item_remark').value || '-';

        const tr = document.createElement('tr');
        tr.style.borderBottom = '1px solid #f1f5f9';
        tr.innerHTML = `
            <td style="padding: 12px 16px;">
                ${section}
                <input type="hidden" name="delivery[${itemIndex}][section]" value="${section}">
            </td>
            <td style="padding: 12px 16px; font-weight:600; color:#55ACEE;">
                ${assemblyNo}
                <input type="hidden" name="delivery[${itemIndex}][assembly_no]" value="${assemblyNo}">
            </td>
            <td style="padding: 12px 16px;">${description}<input type="hidden" name="delivery[${itemIndex}][description]" value="${description}"></td>
            <td style="padding: 12px 16px; text-align:right;">${qty}<input type="hidden" name="delivery[${itemIndex}][quantity]" value="${qty}"></td>
            <td style="padding: 12px 16px;">${itemClass}<input type="hidden" name="delivery[${itemIndex}][class]" value="${itemClass}"></td>
            <td style="padding: 12px 16px; text-align:right;">${length}<input type="hidden" name="delivery[${itemIndex}][length_mm]" value="${length}"></td>
            <td style="padding: 12px 16px; text-align:right;">${unitWeight.toFixed(2)}<input type="hidden" name="delivery[${itemIndex}][weight_kg]" value="${unitWeight}"></td>
            <td style="padding: 12px 16px; text-align:right;">${totalWeight}<input type="hidden" name="delivery[${itemIndex}][total_weight_kg]" value="${totalWeight}"></td>
            <td style="padding: 12px 16px;">${remark}<input type="hidden" name="delivery[${itemIndex}][remark]" value="${remark}"></td>
            <td style="padding: 12px 16px;">
                <button type="button" onclick="this.closest('tr').remove()" style="background:none; border:none; color:#ef4444; cursor:pointer; font-weight:bold;">&times;</button>
            </td>
        `;

        const tbody = document.getElementById('item_tbody');
        const emptyState = document.getElementById('item_empty_state');
        if (emptyState) emptyState.remove();

        tbody.appendChild(tr);
        itemIndex++;

        // Reset Form
        document.getElementById('item_assembly_no').value = '';
        document.getElementById('item_qty').value = '';
        document.getElementById('item_class').value = '';
        document.getElementById('item_description').value = '';
        document.getElementById('item_length').value = '';
        document.getElementById('item_unit_weight').value = '';
        document.getElementById('item_total_weight').value = '';
        document.getElementById('item_remark').value = '';
    }

    function showSelectedFiles(input) {
        const preview = document.getElementById('selected-files-preview');
        preview.innerHTML = '';
        if (input.files.length === 0) return;

        const title = document.createElement('p');
        title.style = 'font-size:12px;font-weight:700;color:#475569;margin-bottom:6px;';
        title.textContent = `${input.files.length} file dipilih:`;
        preview.appendChild(title);

        Array.from(input.files).forEach(file => {
            const row = document.createElement('div');
            row.style = 'display:flex;align-items:center;gap:8px;padding:6px 10px;background:#E6F9FF;border:1px solid #E6F9FF;border-radius:6px;margin-bottom:4px;font-size:12px;color:#0099CC;';
            row.innerHTML = `<svg style="width:14px;height:14px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            <span>${file.name}</span> <span style="color:#94a3b8;">(${(file.size/1024/1024).toFixed(2)} MB)</span>`;
            preview.appendChild(row);
        });
    }
</script>
@endpush

@endsection

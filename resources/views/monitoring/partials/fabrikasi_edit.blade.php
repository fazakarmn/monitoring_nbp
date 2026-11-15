{{-- resources/views/monitoring/partials/fabrikasi_edit.blade.php --}}
<div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; max-width: 100%; width: 100%; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">

    {{-- Info Header --}}
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px 32px; border-bottom: 1px solid #e2e8f0; padding-bottom: 20px; margin-bottom: 24px; font-size: 13px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: #64748b;">Contract no.</span>
            <span style="font-weight: 600; color: #1e293b;">{{ $project->work_order }}</span>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: #64748b;">Project</span>
            <span style="font-weight: 600; color: #1e293b;">{{ $project->bridge_type }}</span>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: #64748b;">Customer</span>
            <span style="font-weight: 600; color: #1e293b;">{{ $project->customer }}</span>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: #64748b;">Location</span>
            <span style="font-weight: 600; color: #1e293b;">{{ $project->boq_data['header']['location'] ?? $project->fabrication_data['header']['location'] ?? '-' }}</span>
        </div>
    </div>


    {{-- Form Update Progres Komponen --}}
    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; margin-bottom: 24px;">
        <h4 style="font-size: 15px; font-weight: bold; color: #334155; margin: 0 0 16px 0;">Update progres komponen</h4>

        {{-- Row 1: PART NO + DESCRIPTION + QTY TARGET --}}
        <div style="display: grid; grid-template-columns: 1fr 2fr 1fr; gap: 12px; margin-bottom: 12px;">
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">PART NO.</label>
                <input type="text" id="fab_part_no" placeholder="mis. B25G-SP6" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">DESCRIPTION</label>
                <input type="text" id="fab_description" placeholder="mis. PLT26×300" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">QTY TARGET</label>
                <input type="number" id="fab_qty_target" value="0" min="0" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
            </div>
        </div>

        {{-- Qty selesai per tahap --}}
        <p style="font-size:12px; font-weight:700; color:#334155; margin: 0 0 10px 0;">Qty selesai per tahap</p>

        {{-- Row 2: Tahap 1-4 --}}
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-bottom: 12px;">
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">1. {{ __('messages.fab_cek_material') }}</label>
                <input type="number" id="fab_cek_material" value="0" min="0" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">2. {{ __('messages.fab_pencocokan') }}</label>
                <input type="number" id="fab_{{ __('messages.fab_pencocokan') }}" value="0" min="0" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">3. {{ __('messages.fab_dinasting') }}</label>
                <input type="number" id="fab_dinasting" value="0" min="0" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">4. {{ __('messages.fab_potong') }}</label>
                <input type="number" id="fab_{{ __('messages.fab_potong') }}" value="0" min="0" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
            </div>
        </div>

        {{-- Row 3: Tahap 5-8 --}}
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-bottom: 12px;">
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">5. {{ __('messages.fab_grinda') }}</label>
                <input type="number" id="fab_{{ __('messages.fab_grinda') }}" value="0" min="0" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">6. {{ __('messages.fab_assembling') }}</label>
                <input type="number" id="fab_{{ __('messages.fab_assembling') }}" value="0" min="0" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">7. {{ __('messages.fab_welding') }}</label>
                <input type="number" id="fab_{{ __('messages.fab_welding') }}" value="0" min="0" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">8. {{ __('messages.fab_cek_finishing') }}</label>
                <input type="number" id="fab_cek_finishing" value="0" min="0" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
            </div>
        </div>

        {{-- Row 4: WELDER ID + WPS REF + PIC + TANGGAL UPDATE --}}
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-bottom: 12px;">
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">WELDER ID</label>
                <input type="text" id="fab_welder_id" placeholder="mis. W-04" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">WPS REF.</label>
                <input type="text" id="fab_wps_ref" placeholder="mis. WPS-SMAW-01" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">PIC</label>
                <input type="text" id="fab_pic" placeholder="Nama PIC" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">TANGGAL UPDATE TERAKHIR</label>
                <input type="date" id="fab_tgl_update" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff; box-sizing:border-box; color:#475569;" value="{{ date('Y-m-d') }}">
            </div>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 16px;">
            <span style="font-size: 11px; color: #94a3b8;">Progres komponen dihitung otomatis dari rata-rata qty selesai di 8 tahap dibagi (Qty target × 8).</span>
            <button type="button" onclick="addFabToTable()" style="background-color: #3b82f6; color: #ffffff; border: none; padding: 10px 24px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer;">
                Tambah / update komponen
            </button>
        </div>
    </div>

    {{-- Tabel Komponen Fabrikasi --}}
    <div style="overflow-x: auto; border: 1px solid #e2e8f0; border-radius: 12px; margin-bottom: 32px;">
        <table style="width: 100%; border-collapse: collapse; min-width: 1200px; text-align: left; font-size: 12px;">
            <thead style="background-color: #f8fafc; color: #64748b;">
                <tr>
                    <th style="padding: 10px 12px; border-bottom: 1px solid #e2e8f0; font-weight: 600;">Part no.</th>
                    <th style="padding: 10px 12px; border-bottom: 1px solid #e2e8f0; font-weight: 600;">Description</th>
                    <th style="padding: 10px 12px; border-bottom: 1px solid #e2e8f0; text-align: center; font-weight: 600;">Qty</th>
                    <th style="padding: 10px 12px; border-bottom: 1px solid #e2e8f0; text-align: center; font-weight: 600;">Cek matl</th>
                    <th style="padding: 10px 12px; border-bottom: 1px solid #e2e8f0; text-align: center; font-weight: 600;">Cocok</th>
                    <th style="padding: 10px 12px; border-bottom: 1px solid #e2e8f0; text-align: center; font-weight: 600;">Dinasting</th>
                    <th style="padding: 10px 12px; border-bottom: 1px solid #e2e8f0; text-align: center; font-weight: 600;">{{ __('messages.fab_potong') }}</th>
                    <th style="padding: 10px 12px; border-bottom: 1px solid #e2e8f0; text-align: center; font-weight: 600;">{{ __('messages.fab_grinda') }}</th>
                    <th style="padding: 10px 12px; border-bottom: 1px solid #e2e8f0; text-align: center; font-weight: 600;">Assembly</th>
                    <th style="padding: 10px 12px; border-bottom: 1px solid #e2e8f0; text-align: center; font-weight: 600;">{{ __('messages.fab_welding') }}</th>
                    <th style="padding: 10px 12px; border-bottom: 1px solid #e2e8f0; text-align: center; font-weight: 600;">Finishing</th>
                    <th style="padding: 10px 12px; border-bottom: 1px solid #e2e8f0; text-align: center; font-weight: 600;">Progres</th>
                    <th style="padding: 10px 12px; border-bottom: 1px solid #e2e8f0; font-weight: 600;">Welder</th>
                    <th style="padding: 10px 12px; border-bottom: 1px solid #e2e8f0; font-weight: 600;">PIC</th>
                    <th style="padding: 10px 12px; border-bottom: 1px solid #e2e8f0; font-weight: 600;">Update terakhir</th>
                    <th style="padding: 10px 12px; border-bottom: 1px solid #e2e8f0;"></th>
                </tr>
            </thead>
            <tbody id="fab_tbody">
                @php
                    $fabItems = $project->fabrication_data['items'] ?? [];
                @endphp
                @forelse($fabItems as $i => $item)
                @php
                    $target = $item['qty_target'] ?? 1;
                    $cek    = $item['cek_material']  ?? $item['cutting']   ?? 0;
                    $cocok  = $item['pencocokan']    ?? $item['fitup']     ?? 0;
                    $din    = $item['dinasting']     ?? 0;
                    $pot    = $item['potong']        ?? 0;
                    $grin   = $item['grinda']        ?? 0;
                    $assem  = $item['assembling']    ?? 0;
                    $weld   = $item['welding']       ?? 0;
                    $fin    = $item['cek_finishing'] ?? $item['finishing'] ?? 0;
                    $pct    = $target > 0 ? min(100, round((($cek + $cocok + $din + $pot + $grin + $assem + $weld + $fin) / (8 * $target)) * 100)) : 0;
                @endphp
                <tr class="fab-item-row" style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 10px 12px; font-weight: 600;">
                        <input type="text" name="fabrication_data[items][{{ $i }}][part_no]" value="{{ $item['part_no'] ?? '' }}" style="width:100%; border:none; background:transparent; outline:none; font-weight:600;">
                    </td>
                    <td style="padding: 10px 12px;">
                        <input type="text" name="fabrication_data[items][{{ $i }}][description]" value="{{ $item['description'] ?? '' }}" style="width:100%; border:none; background:transparent; outline:none;">
                    </td>
                    <td style="padding: 10px 12px; text-align: center;">
                        <input type="number" name="fabrication_data[items][{{ $i }}][qty_target]" value="{{ $target }}" class="fab-qty-target" oninput="calcAllFabProgress()" style="width:50px; border:none; background:transparent; outline:none; text-align:center;">
                    </td>
                    <td style="padding: 10px 12px; text-align: center;">
                        <input type="number" name="fabrication_data[items][{{ $i }}][cek_material]" value="{{ $cek }}" class="fab-s1" oninput="calcAllFabProgress()" style="width:50px; border:none; background:transparent; outline:none; text-align:center;">
                    </td>
                    <td style="padding: 10px 12px; text-align: center;">
                        <input type="number" name="fabrication_data[items][{{ $i }}][pencocokan]" value="{{ $cocok }}" class="fab-s2" oninput="calcAllFabProgress()" style="width:50px; border:none; background:transparent; outline:none; text-align:center;">
                    </td>
                    <td style="padding: 10px 12px; text-align: center;">
                        <input type="number" name="fabrication_data[items][{{ $i }}][dinasting]" value="{{ $din }}" class="fab-s3" oninput="calcAllFabProgress()" style="width:50px; border:none; background:transparent; outline:none; text-align:center;">
                    </td>
                    <td style="padding: 10px 12px; text-align: center;">
                        <input type="number" name="fabrication_data[items][{{ $i }}][potong]" value="{{ $pot }}" class="fab-s4" oninput="calcAllFabProgress()" style="width:50px; border:none; background:transparent; outline:none; text-align:center;">
                    </td>
                    <td style="padding: 10px 12px; text-align: center;">
                        <input type="number" name="fabrication_data[items][{{ $i }}][grinda]" value="{{ $grin }}" class="fab-s5" oninput="calcAllFabProgress()" style="width:50px; border:none; background:transparent; outline:none; text-align:center;">
                    </td>
                    <td style="padding: 10px 12px; text-align: center;">
                        <input type="number" name="fabrication_data[items][{{ $i }}][assembling]" value="{{ $assem }}" class="fab-s6" oninput="calcAllFabProgress()" style="width:50px; border:none; background:transparent; outline:none; text-align:center;">
                    </td>
                    <td style="padding: 10px 12px; text-align: center;">
                        <input type="number" name="fabrication_data[items][{{ $i }}][welding]" value="{{ $weld }}" class="fab-s7" oninput="calcAllFabProgress()" style="width:50px; border:none; background:transparent; outline:none; text-align:center;">
                    </td>
                    <td style="padding: 10px 12px; text-align: center;">
                        <input type="number" name="fabrication_data[items][{{ $i }}][cek_finishing]" value="{{ $fin }}" class="fab-s8" oninput="calcAllFabProgress()" style="width:50px; border:none; background:transparent; outline:none; text-align:center;">
                    </td>
                    <td style="padding: 10px 12px; text-align: center; font-weight: 600;" class="fab-pct">{{ $pct }}%</td>
                    <td style="padding: 10px 12px;">
                        <input type="text" name="fabrication_data[items][{{ $i }}][welder_id]" value="{{ $item['welder_id'] ?? '' }}" style="width:100%; border:none; background:transparent; outline:none;">
                        <input type="hidden" name="fabrication_data[items][{{ $i }}][wps_ref]" value="{{ $item['wps_ref'] ?? '' }}">
                    </td>
                    <td style="padding: 10px 12px;">
                        <input type="text" name="fabrication_data[items][{{ $i }}][pic]" value="{{ $item['pic'] ?? '' }}" style="width:100%; border:none; background:transparent; outline:none;">
                    </td>
                    <td style="padding: 10px 12px;">
                        <input type="text" name="fabrication_data[items][{{ $i }}][tgl_update]" value="{{ $item['tgl_update'] ?? $item['tanggal_mulai'] ?? '' }}" style="width:100%; border:none; background:transparent; outline:none;">
                    </td>
                    <td style="padding: 10px 12px; text-align: center;">
                        <button type="button" onclick="this.closest('tr').remove(); calcAllFabProgress();" style="background:none; border:none; color:#ef4444; cursor:pointer; font-weight:bold;">&times;</button>
                    </td>
                </tr>
                @empty
                <tr id="fab_empty_state">
                    <td colspan="16" style="text-align: center; padding: 30px; color: #94a3b8;">
                        {{ __('messages.no_items') }}
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- NCR Section --}}
    <div style="margin-bottom: 24px;">
        <h4 style="font-size: 16px; font-weight: bold; color: #1e293b; margin: 0 0 16px 0;">Non-Conformance Report (NCR)</h4>

        <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; margin-bottom: 16px;">
            <div style="display: grid; grid-template-columns: 1fr 2fr 1fr; gap: 12px; margin-bottom: 12px;">
                <div>
                    <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">PART NO.</label>
                    <input type="text" id="ncr_part_no" placeholder="mis. B25G-SP6" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">DESKRIPSI CACAT</label>
                    <input type="text" id="ncr_deskripsi" placeholder="mis. Keropos las root pass" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">STATUS</label>
                    <input type="text" id="ncr_status" value="Terbuka" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
                </div>
            </div>
            <div style="display: flex; justify-content: flex-end;">
                <button type="button" onclick="addNCRToTable()" style="background-color: #ef4444; color: #ffffff; border: none; padding: 10px 24px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer;">
                    Tambah NCR
                </button>
            </div>
        </div>

        <div style="overflow-x: auto; border: 1px solid #e2e8f0; border-radius: 12px;">
            <table style="width: 100%; border-collapse: collapse; min-width: 700px; text-align: left; font-size: 13px;">
                <thead style="background-color: #f8fafc; color: #64748b;">
                    <tr>
                        <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; font-weight: 600;">Part no.</th>
                        <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; font-weight: 600;">Deskripsi cacat</th>
                        <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; font-weight: 600;">Status</th>
                        <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; font-weight: 600;">Tanggal</th>
                        <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0;"></th>
                    </tr>
                </thead>
                <tbody id="ncr_tbody">
                    @php $ncrItems = $project->fabrication_data['ncr'] ?? []; @endphp
                    @forelse($ncrItems as $j => $ncr)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 12px 16px; font-weight: 600;">
                            {{ $ncr['part_no'] ?? '-' }}
                            <input type="hidden" name="fabrication_data[ncr][{{ $j }}][part_no]" value="{{ $ncr['part_no'] ?? '' }}">
                        </td>
                        <td style="padding: 12px 16px;">
                            {{ $ncr['deskripsi'] ?? '-' }}
                            <input type="hidden" name="fabrication_data[ncr][{{ $j }}][deskripsi]" value="{{ $ncr['deskripsi'] ?? '' }}">
                        </td>
                        <td style="padding: 12px 16px;">
                            <span style="background-color: #fee2e2; color: #dc2626; padding: 3px 10px; border-radius: 12px; font-weight: 600; font-size: 11px;">{{ $ncr['status'] ?? 'Terbuka' }}</span>
                            <input type="hidden" name="fabrication_data[ncr][{{ $j }}][status]" value="{{ $ncr['status'] ?? 'Terbuka' }}">
                        </td>
                        <td style="padding: 12px 16px;">
                            {{ $ncr['tanggal'] ?? '-' }}
                            <input type="hidden" name="fabrication_data[ncr][{{ $j }}][tanggal]" value="{{ $ncr['tanggal'] ?? '' }}">
                        </td>
                        <td style="padding: 12px 16px; text-align: center;">
                            <button type="button" onclick="this.closest('tr').remove();" style="background:none; border:none; color:#ef4444; cursor:pointer; font-weight:bold;">&times;</button>
                        </td>
                    </tr>
                    @empty
                    <tr id="ncr_empty_state">
                        <td colspan="5" style="text-align: center; padding: 20px; color: #94a3b8;">{{ __('messages.no_ncr_items') }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
let fabIndex = {{ isset($project->fabrication_data['items']) ? count($project->fabrication_data['items']) : 0 }};
let ncrIndex = {{ isset($project->fabrication_data['ncr']) ? count($project->fabrication_data['ncr']) : 0 }};

function addFabToTable() {
    const partNo      = document.getElementById('fab_part_no').value.trim() || '-';
    const description = document.getElementById('fab_description').value.trim() || '-';
    const qtyTarget   = parseFloat(document.getElementById('fab_qty_target').value) || 0;
    const s1 = parseFloat(document.getElementById('fab_cek_material').value) || 0;
    const s2 = parseFloat(document.getElementById('fab_{{ __('messages.fab_pencocokan') }}').value) || 0;
    const s3 = parseFloat(document.getElementById('fab_dinasting').value) || 0;
    const s4 = parseFloat(document.getElementById('fab_{{ __('messages.fab_potong') }}').value) || 0;
    const s5 = parseFloat(document.getElementById('fab_{{ __('messages.fab_grinda') }}').value) || 0;
    const s6 = parseFloat(document.getElementById('fab_{{ __('messages.fab_assembling') }}').value) || 0;
    const s7 = parseFloat(document.getElementById('fab_{{ __('messages.fab_welding') }}').value) || 0;
    const s8 = parseFloat(document.getElementById('fab_cek_finishing').value) || 0;
    const welderId  = document.getElementById('fab_welder_id').value.trim() || '-';
    const wpsRef    = document.getElementById('fab_wps_ref').value.trim() || '';
    const pic       = document.getElementById('fab_pic').value.trim() || '-';
    const tglUpdate = document.getElementById('fab_tgl_update').value || '';

    const pct = qtyTarget > 0 ? Math.min(100, Math.round(((s1+s2+s3+s4+s5+s6+s7+s8) / (8 * qtyTarget)) * 100)) : 0;

    const tr = document.createElement('tr');
    tr.className = 'fab-item-row';
    tr.style.borderBottom = '1px solid #f1f5f9';
    tr.innerHTML = `
        <td style="padding:10px 12px; font-weight:600;">
            <input type="text" name="fabrication_data[items][${fabIndex}][part_no]" value="${partNo}" style="width:100%; border:none; background:transparent; outline:none; font-weight:600;">
        </td>
        <td style="padding:10px 12px;">
            <input type="text" name="fabrication_data[items][${fabIndex}][description]" value="${description}" style="width:100%; border:none; background:transparent; outline:none;">
        </td>
        <td style="padding:10px 12px; text-align:center;">
            <input type="number" name="fabrication_data[items][${fabIndex}][qty_target]" value="${qtyTarget}" class="fab-qty-target" oninput="calcAllFabProgress()" style="width:50px; border:none; background:transparent; outline:none; text-align:center;">
        </td>
        <td style="padding:10px 12px; text-align:center;">
            <input type="number" name="fabrication_data[items][${fabIndex}][cek_material]" value="${s1}" class="fab-s1" oninput="calcAllFabProgress()" style="width:50px; border:none; background:transparent; outline:none; text-align:center;">
        </td>
        <td style="padding:10px 12px; text-align:center;">
            <input type="number" name="fabrication_data[items][${fabIndex}][{{ __('messages.fab_pencocokan') }}]" value="${s2}" class="fab-s2" oninput="calcAllFabProgress()" style="width:50px; border:none; background:transparent; outline:none; text-align:center;">
        </td>
        <td style="padding:10px 12px; text-align:center;">
            <input type="number" name="fabrication_data[items][${fabIndex}][dinasting]" value="${s3}" class="fab-s3" oninput="calcAllFabProgress()" style="width:50px; border:none; background:transparent; outline:none; text-align:center;">
        </td>
        <td style="padding:10px 12px; text-align:center;">
            <input type="number" name="fabrication_data[items][${fabIndex}][{{ __('messages.fab_potong') }}]" value="${s4}" class="fab-s4" oninput="calcAllFabProgress()" style="width:50px; border:none; background:transparent; outline:none; text-align:center;">
        </td>
        <td style="padding:10px 12px; text-align:center;">
            <input type="number" name="fabrication_data[items][${fabIndex}][{{ __('messages.fab_grinda') }}]" value="${s5}" class="fab-s5" oninput="calcAllFabProgress()" style="width:50px; border:none; background:transparent; outline:none; text-align:center;">
        </td>
        <td style="padding:10px 12px; text-align:center;">
            <input type="number" name="fabrication_data[items][${fabIndex}][{{ __('messages.fab_assembling') }}]" value="${s6}" class="fab-s6" oninput="calcAllFabProgress()" style="width:50px; border:none; background:transparent; outline:none; text-align:center;">
        </td>
        <td style="padding:10px 12px; text-align:center;">
            <input type="number" name="fabrication_data[items][${fabIndex}][{{ __('messages.fab_welding') }}]" value="${s7}" class="fab-s7" oninput="calcAllFabProgress()" style="width:50px; border:none; background:transparent; outline:none; text-align:center;">
        </td>
        <td style="padding:10px 12px; text-align:center;">
            <input type="number" name="fabrication_data[items][${fabIndex}][cek_finishing]" value="${s8}" class="fab-s8" oninput="calcAllFabProgress()" style="width:50px; border:none; background:transparent; outline:none; text-align:center;">
        </td>
        <td style="padding:10px 12px; text-align:center; font-weight:600;" class="fab-pct">${pct}%</td>
        <td style="padding:10px 12px;">
            <input type="text" name="fabrication_data[items][${fabIndex}][welder_id]" value="${welderId}" style="width:100%; border:none; background:transparent; outline:none;">
            <input type="hidden" name="fabrication_data[items][${fabIndex}][wps_ref]" value="${wpsRef}">
        </td>
        <td style="padding:10px 12px;">
            <input type="text" name="fabrication_data[items][${fabIndex}][pic]" value="${pic}" style="width:100%; border:none; background:transparent; outline:none;">
        </td>
        <td style="padding:10px 12px;">
            <input type="text" name="fabrication_data[items][${fabIndex}][tgl_update]" value="${tglUpdate}" style="width:100%; border:none; background:transparent; outline:none;">
        </td>
        <td style="padding:10px 12px; text-align:center;">
            <button type="button" onclick="this.closest('tr').remove(); calcAllFabProgress();" style="background:none; border:none; color:#ef4444; cursor:pointer; font-weight:bold;">&times;</button>
        </td>
    `;

    const tbody      = document.getElementById('fab_tbody');
    const emptyState = document.getElementById('fab_empty_state');
    if (emptyState) emptyState.remove();

    tbody.appendChild(tr);
    fabIndex++;

    // Reset form
    document.getElementById('fab_part_no').value       = '';
    document.getElementById('fab_description').value   = '';
    document.getElementById('fab_qty_target').value    = '0';
    document.getElementById('fab_cek_material').value  = '0';
    document.getElementById('fab_{{ __('messages.fab_pencocokan') }}').value    = '0';
    document.getElementById('fab_dinasting').value     = '0';
    document.getElementById('fab_{{ __('messages.fab_potong') }}').value        = '0';
    document.getElementById('fab_{{ __('messages.fab_grinda') }}').value        = '0';
    document.getElementById('fab_{{ __('messages.fab_assembling') }}').value    = '0';
    document.getElementById('fab_{{ __('messages.fab_welding') }}').value       = '0';
    document.getElementById('fab_cek_finishing').value = '0';
    document.getElementById('fab_welder_id').value     = '';
    document.getElementById('fab_wps_ref').value       = '';
    document.getElementById('fab_pic').value           = '';
    document.getElementById('fab_tgl_update').value    = new Date().toISOString().split('T')[0];
}

function calcAllFabProgress() {
    document.querySelectorAll('.fab-item-row').forEach(row => {
        const target = parseFloat(row.querySelector('.fab-qty-target').value) || 0;
        const s = ['fab-s1','fab-s2','fab-s3','fab-s4','fab-s5','fab-s6','fab-s7','fab-s8']
            .reduce((sum, cls) => sum + (parseFloat(row.querySelector('.' + cls)?.value) || 0), 0);
        const pct = target > 0 ? Math.min(100, Math.round((s / (8 * target)) * 100)) : 0;
        row.querySelector('.fab-pct').innerText = pct + '%';
    });
}

function addNCRToTable() {
    const partNo    = document.getElementById('ncr_part_no').value.trim() || '-';
    const deskripsi = document.getElementById('ncr_deskripsi').value.trim() || '-';
    const status    = document.getElementById('ncr_status').value.trim() || 'Terbuka';
    const today     = new Date().toISOString().split('T')[0];

    const tr = document.createElement('tr');
    tr.style.borderBottom = '1px solid #f1f5f9';
    tr.innerHTML = `
        <td style="padding:12px 16px; font-weight:600;">
            ${partNo}
            <input type="hidden" name="fabrication_data[ncr][${ncrIndex}][part_no]" value="${partNo}">
        </td>
        <td style="padding:12px 16px;">
            ${deskripsi}
            <input type="hidden" name="fabrication_data[ncr][${ncrIndex}][deskripsi]" value="${deskripsi}">
        </td>
        <td style="padding:12px 16px;">
            <span style="background-color:#fee2e2; color:#dc2626; padding:3px 10px; border-radius:12px; font-weight:600; font-size:11px;">${status}</span>
            <input type="hidden" name="fabrication_data[ncr][${ncrIndex}][status]" value="${status}">
        </td>
        <td style="padding:12px 16px;">
            ${today}
            <input type="hidden" name="fabrication_data[ncr][${ncrIndex}][tanggal]" value="${today}">
        </td>
        <td style="padding:12px 16px; text-align:center;">
            <button type="button" onclick="this.closest('tr').remove();" style="background:none; border:none; color:#ef4444; cursor:pointer; font-weight:bold;">&times;</button>
        </td>
    `;

    const tbody      = document.getElementById('ncr_tbody');
    const emptyState = document.getElementById('ncr_empty_state');
    if (emptyState) emptyState.remove();

    tbody.appendChild(tr);
    ncrIndex++;

    document.getElementById('ncr_part_no').value  = '';
    document.getElementById('ncr_deskripsi').value = '';
    document.getElementById('ncr_status').value   = 'Terbuka';
}
</script>

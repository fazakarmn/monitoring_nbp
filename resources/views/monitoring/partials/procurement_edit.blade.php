{{-- resources/views/monitoring/partials/procurement_edit.blade.php --}}
<div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; max-width: 100%; width: 100%; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">

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
            <span style="font-weight: 600; color: #1e293b;">{{ $project->boq_data['header']['location'] ?? '-' }}</span>
        </div>
    </div>

    {{-- Form Tambah PO --}}
    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; margin-bottom: 24px;">
        <h4 style="font-size: 15px; font-weight: bold; color: #334155; margin: 0 0 16px 0;">Tambah PO</h4>

        {{-- Row 1: NO. PO + DESKRIPSI --}}
        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 16px; margin-bottom: 16px;">
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">NO. PO</label>
                <input type="text" id="po_no" placeholder="mis. PO-026-2026" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">DESKRIPSI</label>
                <input type="text" id="po_deskripsi" placeholder="mis. Deformedbar dia. 22mm" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
            </div>
        </div>

        {{-- Row 2: SUPPLIER + QTY + GRADE --}}
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 16px;">
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">SUPPLIER</label>
                <input type="text" id="po_supplier" placeholder="Nama supplier" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">QTY</label>
                <input type="text" id="po_qty" placeholder="mis. 30 Btg" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">GRADE</label>
                <input type="text" id="po_grade" placeholder="mis. SS400" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
            </div>
        </div>

        {{-- Row 3: TANGGAL PO + ESTIMASI + STATUS --}}
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 16px;">
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">TANGGAL PO</label>
                <input type="date" id="po_tanggal" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff; box-sizing:border-box; color:#475569;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">ESTIMASI (ETA)</label>
                <input type="date" id="po_eta" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff; box-sizing:border-box; color:#475569;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">STATUS</label>
                <input type="text" id="po_status" placeholder="PO Diterbitkan" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
            </div>
        </div>

        {{-- Row 4: MTC --}}
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 16px;">
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">MTC</label>
                <input type="text" id="po_mtc" placeholder="Belum ada" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff; box-sizing:border-box;">
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; align-items: center; margin-top: 20px;">
            <button type="button" onclick="addPOToTable()" style="background-color: #3b82f6; color: #ffffff; border: none; padding: 10px 24px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;">
                Tambah ke tabel
            </button>
        </div>
    </div>

    {{-- Tabel PO --}}
    <div style="overflow-x: auto; border: 1px solid #e2e8f0; border-radius: 12px; margin-bottom: 16px;">
        <table style="width: 100%; border-collapse: collapse; min-width: 900px; text-align: left; font-size: 13px;">
            <thead style="background-color: #f8fafc; color: #64748b;">
                <tr>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; font-weight: 600;">No. PO</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; font-weight: 600;">Deskripsi</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; font-weight: 600;">Supplier</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; font-weight: 600;">Qty</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; font-weight: 600;">Grade</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; font-weight: 600;">Tanggal PO</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; font-weight: 600;">Estimasi</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; font-weight: 600;">Status</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; font-weight: 600;">MTC</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0;"></th>
                </tr>
            </thead>
            <tbody id="po_tbody">
                @forelse($project->materialProcurements ?? [] as $i => $po)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 12px 16px;">
                        {{ $po->no_po }}
                        <input type="hidden" name="procurement[{{ $i }}][id]" value="{{ $po->id }}">
                        <input type="hidden" name="procurement[{{ $i }}][no_po]" value="{{ $po->no_po }}">
                    </td>
                    <td style="padding: 12px 16px;">
                        {{ $po->deskripsi ?? $po->part_no }}
                        <input type="hidden" name="procurement[{{ $i }}][deskripsi]" value="{{ $po->deskripsi ?? $po->part_no }}">
                    </td>
                    <td style="padding: 12px 16px;">
                        {{ $po->supplier }}
                        <input type="hidden" name="procurement[{{ $i }}][supplier]" value="{{ $po->supplier }}">
                    </td>
                    <td style="padding: 12px 16px;">
                        {{ $po->qty ?? $po->qty_ordered }}
                        <input type="hidden" name="procurement[{{ $i }}][qty]" value="{{ $po->qty ?? $po->qty_ordered }}">
                    </td>
                    <td style="padding: 12px 16px;">
                        {{ $po->grade }}
                        <input type="hidden" name="procurement[{{ $i }}][grade]" value="{{ $po->grade }}">
                    </td>
                    <td style="padding: 12px 16px;">
                        {{ $po->tanggal_po ? $po->tanggal_po->format('d M Y') : '-' }}
                        <input type="hidden" name="procurement[{{ $i }}][tanggal_po]" value="{{ $po->tanggal_po ? $po->tanggal_po->format('Y-m-d') : '' }}">
                    </td>
                    <td style="padding: 12px 16px;">
                        {{ $po->eta ? $po->eta->format('d M Y') : '-' }}
                        <input type="hidden" name="procurement[{{ $i }}][eta]" value="{{ $po->eta ? $po->eta->format('Y-m-d') : '' }}">
                    </td>
                    <td style="padding: 12px 16px;">
                        {{ $po->status }}
                        <input type="hidden" name="procurement[{{ $i }}][status]" value="{{ $po->status }}">
                    </td>
                    <td style="padding: 12px 16px;">
                        {{ $po->mtc }}
                        <input type="hidden" name="procurement[{{ $i }}][mtc]" value="{{ $po->mtc }}">
                    </td>
                    <td style="padding: 12px 16px;">
                        <button type="button" onclick="this.closest('tr').remove()" style="background:none; border:none; color:#ef4444; cursor:pointer; font-weight:bold;">&times;</button>
                    </td>
                </tr>
                @empty
                <tr id="po_empty_state">
                    <td colspan="10" style="text-align: center; padding: 30px; color: #94a3b8;">
                        {{ __('messages.no_po_items') }}
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
let poIndex = {{ isset($project->materialProcurements) ? count($project->materialProcurements) : 0 }};

function addPOToTable() {
    const noPo      = document.getElementById('po_no').value.trim() || '-';
    const deskripsi = document.getElementById('po_deskripsi').value.trim() || '-';
    const supplier  = document.getElementById('po_supplier').value.trim() || '-';
    const qty       = document.getElementById('po_qty').value.trim() || '-';
    const grade     = document.getElementById('po_grade').value.trim() || '-';
    const tglPo     = document.getElementById('po_tanggal').value;
    const eta       = document.getElementById('po_eta').value;
    const status    = document.getElementById('po_status').value.trim() || '-';
    const mtc       = document.getElementById('po_mtc').value.trim() || '-';

    const tr = document.createElement('tr');
    tr.style.borderBottom = '1px solid #f1f5f9';
    tr.innerHTML = `
        <td style="padding: 12px 16px;">
            ${noPo}
            <input type="hidden" name="procurement[${poIndex}][no_po]" value="${noPo}">
        </td>
        <td style="padding: 12px 16px;">
            ${deskripsi}
            <input type="hidden" name="procurement[${poIndex}][deskripsi]" value="${deskripsi}">
        </td>
        <td style="padding: 12px 16px;">
            ${supplier}
            <input type="hidden" name="procurement[${poIndex}][supplier]" value="${supplier}">
        </td>
        <td style="padding: 12px 16px;">
            ${qty}
            <input type="hidden" name="procurement[${poIndex}][qty]" value="${qty}">
        </td>
        <td style="padding: 12px 16px;">
            ${grade}
            <input type="hidden" name="procurement[${poIndex}][grade]" value="${grade}">
        </td>
        <td style="padding: 12px 16px;">
            ${tglPo || '-'}
            <input type="hidden" name="procurement[${poIndex}][tanggal_po]" value="${tglPo}">
        </td>
        <td style="padding: 12px 16px;">
            ${eta || '-'}
            <input type="hidden" name="procurement[${poIndex}][eta]" value="${eta}">
        </td>
        <td style="padding: 12px 16px;">
            ${status}
            <input type="hidden" name="procurement[${poIndex}][status]" value="${status}">
        </td>
        <td style="padding: 12px 16px;">
            ${mtc}
            <input type="hidden" name="procurement[${poIndex}][mtc]" value="${mtc}">
        </td>
        <td style="padding: 12px 16px;">
            <button type="button" onclick="this.closest('tr').remove()" style="background:none; border:none; color:#ef4444; cursor:pointer; font-weight:bold;">&times;</button>
        </td>
    `;

    const tbody      = document.getElementById('po_tbody');
    const emptyState = document.getElementById('po_empty_state');
    if (emptyState) emptyState.remove();

    tbody.appendChild(tr);
    poIndex++;

    // Reset form
    document.getElementById('po_no').value       = '';
    document.getElementById('po_deskripsi').value = '';
    document.getElementById('po_supplier').value  = '';
    document.getElementById('po_qty').value       = '';
    document.getElementById('po_grade').value     = '';
    document.getElementById('po_tanggal').value   = '';
    document.getElementById('po_eta').value       = '';
    document.getElementById('po_status').value    = '';
    document.getElementById('po_mtc').value       = '';
}
</script>

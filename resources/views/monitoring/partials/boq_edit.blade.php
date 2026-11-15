<!-- resources/views/monitoring/partials/boq_edit.blade.php -->
<div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; max-width: 100%; width: 100%; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
    
    <!-- Readonly Header Info -->

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px 32px; border-bottom: 1px solid #e2e8f0; padding-bottom: 20px; margin-bottom: 24px; font-size: 13px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: #64748b;">Contract no. / SPK</span>
            <input type="text" name="boq_data[header][contract_no]" value="{{ $project->work_order ?? '...' }}" style="font-weight: 600; color: #1e293b; border: none; border-bottom: 1px dashed #cbd5e1; outline: none; background: transparent; text-align: right; width: 60%;">
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: #64748b;">Project</span>
            <span style="font-weight: 600; color: #1e293b;">{{ $project->bridge_type ?? '...' }}</span>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: #64748b;">Customer</span>
            <span style="font-weight: 600; color: #1e293b;">{{ $project->customer ?? '...' }}</span>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: #64748b;">Location</span>
            <input type="text" name="boq_data[header][location]" value="{{ $project->boq_data['header']['location'] ?? '...' }}" style="font-weight: 600; color: #1e293b; border: none; border-bottom: 1px dashed #cbd5e1; outline: none; background: transparent; text-align: right; width: 60%;">
        </div>
    </div>

    <!-- Form Tambah Item Pekerjaan -->
    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; margin-bottom: 24px;">
        <h4 style="font-size: 15px; font-weight: bold; color: #334155; margin: 0 0 16px 0;">Tambah item pekerjaan</h4>
        
        <div style="display: grid; grid-template-columns: 1fr 3fr 1.5fr; gap: 12px; margin-bottom: 12px;">
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Item No.</label>
                <input type="text" id="boq_item_no" placeholder="auto" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Description of Work</label>
                <input type="text" id="boq_description" placeholder="mis. Fabrikasi & pengiriman Girder B25 M-SP" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Unit</label>
                <input type="text" id="boq_unit" value="Ton" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-bottom: 12px;">
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Quantity</label>
                <input type="number" step="0.01" id="boq_qty" value="0" min="0" oninput="calcBOQFormTotal()" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Unit Price (Rp)</label>
                <input type="number" id="boq_unit_price" value="0" min="0" oninput="calcBOQFormTotal()" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Total Price (Rp)</label>
                <input type="text" id="boq_total_price" value="Rp 0" readonly style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#e2e8f0; color:#475569; font-weight:600;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Progress Fisik (%)</label>
                <input type="number" step="0.1" id="boq_progress" value="0" min="0" max="100" oninput="calcBOQFormTotal()" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 12px;">
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Referensi Gambar / Spek</label>
                <input type="text" id="boq_ref" placeholder="mis. SD-C30-001 Rev.03" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Nilai Tertagih (Rp)</label>
                <input type="text" id="boq_nilai_tertagih" value="Rp 0" readonly style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#e2e8f0; color:#475569; font-weight:600;">
            </div>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 16px;">
            <span style="font-size: 11px; color: #94a3b8;">Total price = Quantity × Unit Price. Nilai tertagih = Total Price × Progress Fisik — otomatis, tidak perlu Anda hitung manual.</span>
            <button type="button" onclick="addBOQToTable()" style="background-color: #55ACEE; color: #ffffff; border: none; padding: 10px 24px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer;">
                Tambah ke tabel
            </button>
        </div>
    </div>

    <!-- Tabel BOQ -->
    <div style="overflow-x: auto; border: 1px solid #e2e8f0; border-radius: 12px; margin-bottom: 16px;">
        <table style="width: 100%; border-collapse: collapse; min-width: 1000px; text-align: left; font-size: 12px;">
            <thead style="background-color: #f8fafc; color: #64748b;">
                <tr>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0;">No.</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0;">Description of work</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0;">Unit</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; text-align: right;">Qty</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; text-align: right;">Unit price</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; text-align: right;">Total price</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; text-align: center;">Progress</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; text-align: right;">Nilai tertagih</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0;"></th>
                </tr>
            </thead>
            <tbody id="boq_tbody">
                @php
                    $boqItems = $project->boq_data['items'] ?? [];
                @endphp

                @forelse($boqItems as $i => $item)
                @php
                    $totalPrice = ($item['qty'] ?? 0) * ($item['unit_price'] ?? 0);
                    $nilaiTertagih = $totalPrice * (($item['progress'] ?? 0) / 100);
                @endphp
                <tr class="boq-item-row" style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 12px 16px;">
                        <input type="text" name="boq_data[items][{{ $i }}][no]" value="{{ $item['no'] }}" style="width:100%; border:none; background:transparent; outline:none;">
                    </td>
                    <td style="padding: 12px 16px; font-weight: 600;">
                        <input type="text" name="boq_data[items][{{ $i }}][description]" value="{{ $item['description'] }}" style="width:100%; border:none; background:transparent; outline:none;">
                        <input type="hidden" name="boq_data[items][{{ $i }}][ref]" value="{{ $item['ref'] ?? '' }}">
                    </td>
                    <td style="padding: 12px 16px;">
                        <input type="text" name="boq_data[items][{{ $i }}][unit]" value="{{ $item['unit'] }}" style="width:100%; border:none; background:transparent; outline:none;">
                    </td>
                    <td style="padding: 12px 16px; text-align: right;">
                        <input type="number" step="0.01" name="boq_data[items][{{ $i }}][qty]" value="{{ $item['qty'] }}" class="boq-input-qty" oninput="calcAllBOQTotals()" style="width:100%; border:none; background:transparent; outline:none; text-align:right;">
                    </td>
                    <td style="padding: 12px 16px; text-align: right;">
                        <input type="number" name="boq_data[items][{{ $i }}][unit_price]" value="{{ $item['unit_price'] }}" class="boq-input-unit-price" oninput="calcAllBOQTotals()" style="width:100%; border:none; background:transparent; outline:none; text-align:right;">
                    </td>
                    <td style="padding: 12px 16px; text-align: right; font-weight: 600;" class="boq-row-total-price">
                        Rp {{ number_format($totalPrice, 0, ',', '.') }}
                    </td>
                    <td style="padding: 12px 16px; text-align: center;">
                        <input type="number" step="0.1" name="boq_data[items][{{ $i }}][progress]" value="{{ $item['progress'] }}" class="boq-input-progress" oninput="calcAllBOQTotals()" style="width:60px; border:none; background:transparent; outline:none; text-align:center;">%
                    </td>
                    <td style="padding: 12px 16px; text-align: right; font-weight: 600;" class="boq-row-nilai-tertagih">
                        Rp {{ number_format($nilaiTertagih, 0, ',', '.') }}
                    </td>
                    <td style="padding: 12px 16px; text-align: center;">
                        <button type="button" onclick="this.closest('tr').remove(); calcAllBOQTotals();" style="background:none; border:none; color:#ef4444; cursor:pointer; font-weight:bold;">&times;</button>
                    </td>
                </tr>
                @empty
                <tr id="boq_empty_state">
                    <td colspan="9" style="text-align: center; padding: 30px; color: #94a3b8;">
                        {{ __('messages.no_boq_items') }}
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Footer Summary Bar -->
    <div style="background-color: #1e2530; color: #ffffff; display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; padding: 16px 20px; border-radius: 8px;">
        <div>
            <div style="font-size: 11px; color: #94a3b8; font-weight: 600; text-transform: uppercase;">Total Nilai Kontrak</div>
            <div style="font-size: 16px; font-weight: 700; margin-top: 2px;" id="boq_summary_total_kontrak">Rp 0</div>
        </div>
        <div>
            <div style="font-size: 11px; color: #94a3b8; font-weight: 600; text-transform: uppercase;">Total Nilai Tertagih</div>
            <div style="font-size: 16px; font-weight: 700; margin-top: 2px;" id="boq_summary_total_tertagih">Rp 0</div>
        </div>
        <div>
            <div style="font-size: 11px; color: #94a3b8; font-weight: 600; text-transform: uppercase;">Sisa Nilai Belum Tertagih</div>
            <div style="font-size: 16px; font-weight: 700; margin-top: 2px;" id="boq_summary_sisa_tertagih">Rp 0</div>
        </div>
    </div>
</div>

<script>
let boqIndex = {{ isset($project->boq_data['items']) ? count($project->boq_data['items']) : 0 }};

function formatRupiah(number) {
    return 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.round(number));
}

function calcBOQFormTotal() {
    const qty = parseFloat(document.getElementById('boq_qty').value) || 0;
    const unitPrice = parseFloat(document.getElementById('boq_unit_price').value) || 0;
    const progress = parseFloat(document.getElementById('boq_progress').value) || 0;

    const totalPrice = qty * unitPrice;
    const nilaiTertagih = totalPrice * (progress / 100);

    document.getElementById('boq_total_price').value = formatRupiah(totalPrice);
    document.getElementById('boq_nilai_tertagih').value = formatRupiah(nilaiTertagih);
}

function addBOQToTable() {
    const itemNo = document.getElementById('boq_item_no').value || '-';
    const description = document.getElementById('boq_description').value || '-';
    const unit = document.getElementById('boq_unit').value || 'Ton';
    const qty = parseFloat(document.getElementById('boq_qty').value) || 0;
    const unitPrice = parseFloat(document.getElementById('boq_unit_price').value) || 0;
    const progress = parseFloat(document.getElementById('boq_progress').value) || 0;
    const ref = document.getElementById('boq_ref').value || '';

    const totalPrice = qty * unitPrice;
    const nilaiTertagih = totalPrice * (progress / 100);

    const tr = document.createElement('tr');
    tr.className = 'boq-item-row';
    tr.style.borderBottom = '1px solid #f1f5f9';

    tr.innerHTML = `
        <td style="padding: 12px 16px;">
            <input type="text" name="boq_data[items][${boqIndex}][no]" value="${itemNo}" style="width:100%; border:none; background:transparent; outline:none;">
        </td>
        <td style="padding: 12px 16px; font-weight: 600;">
            <input type="text" name="boq_data[items][${boqIndex}][description]" value="${description}" style="width:100%; border:none; background:transparent; outline:none;">
            <input type="hidden" name="boq_data[items][${boqIndex}][ref]" value="${ref}">
        </td>
        <td style="padding: 12px 16px;">
            <input type="text" name="boq_data[items][${boqIndex}][unit]" value="${unit}" style="width:100%; border:none; background:transparent; outline:none;">
        </td>
        <td style="padding: 12px 16px; text-align: right;">
            <input type="number" step="0.01" name="boq_data[items][${boqIndex}][qty]" value="${qty}" class="boq-input-qty" oninput="calcAllBOQTotals()" style="width:100%; border:none; background:transparent; outline:none; text-align:right;">
        </td>
        <td style="padding: 12px 16px; text-align: right;">
            <input type="number" name="boq_data[items][${boqIndex}][unit_price]" value="${unitPrice}" class="boq-input-unit-price" oninput="calcAllBOQTotals()" style="width:100%; border:none; background:transparent; outline:none; text-align:right;">
        </td>
        <td style="padding: 12px 16px; text-align: right; font-weight: 600;" class="boq-row-total-price">
            ${formatRupiah(totalPrice)}
        </td>
        <td style="padding: 12px 16px; text-align: center;">
            <input type="number" step="0.1" name="boq_data[items][${boqIndex}][progress]" value="${progress}" class="boq-input-progress" oninput="calcAllBOQTotals()" style="width:60px; border:none; background:transparent; outline:none; text-align:center;">%
        </td>
        <td style="padding: 12px 16px; text-align: right; font-weight: 600;" class="boq-row-nilai-tertagih">
            ${formatRupiah(nilaiTertagih)}
        </td>
        <td style="padding: 12px 16px; text-align: center;">
            <button type="button" onclick="this.closest('tr').remove(); calcAllBOQTotals();" style="background:none; border:none; color:#ef4444; cursor:pointer; font-weight:bold;">&times;</button>
        </td>
    `;

    const tbody = document.getElementById('boq_tbody');
    const emptyState = document.getElementById('boq_empty_state');
    if (emptyState) emptyState.remove();

    tbody.appendChild(tr);
    boqIndex++;
    calcAllBOQTotals();

    // Reset Form Input
    document.getElementById('boq_item_no').value = '';
    document.getElementById('boq_description').value = '';
    document.getElementById('boq_unit').value = 'Ton';
    document.getElementById('boq_qty').value = '0';
    document.getElementById('boq_unit_price').value = '0';
    document.getElementById('boq_total_price').value = 'Rp 0';
    document.getElementById('boq_progress').value = '0';
    document.getElementById('boq_ref').value = '';
    document.getElementById('boq_nilai_tertagih').value = 'Rp 0';
}

function calcAllBOQTotals() {
    let grandTotalKontrak = 0;
    let grandTotalTertagih = 0;

    const rows = document.querySelectorAll('.boq-item-row');

    rows.forEach(row => {
        const qty = parseFloat(row.querySelector('.boq-input-qty').value) || 0;
        const unitPrice = parseFloat(row.querySelector('.boq-input-unit-price').value) || 0;
        const progress = parseFloat(row.querySelector('.boq-input-progress').value) || 0;

        const totalPrice = qty * unitPrice;
        const nilaiTertagih = totalPrice * (progress / 100);

        row.querySelector('.boq-row-total-price').innerText = formatRupiah(totalPrice);
        row.querySelector('.boq-row-nilai-tertagih').innerText = formatRupiah(nilaiTertagih);

        grandTotalKontrak += totalPrice;
        grandTotalTertagih += nilaiTertagih;
    });

    const sisaBelumTertagih = grandTotalKontrak - grandTotalTertagih;

    document.getElementById('boq_summary_total_kontrak').innerText = formatRupiah(grandTotalKontrak);
    document.getElementById('boq_summary_total_tertagih').innerText = formatRupiah(grandTotalTertagih);
    document.getElementById('boq_summary_sisa_tertagih').innerText = formatRupiah(sisaBelumTertagih);
}

document.addEventListener("DOMContentLoaded", () => {
    calcAllBOQTotals();
});
</script>

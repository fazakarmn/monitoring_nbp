<!-- CONTAINER UTAMA -->
<div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; max-width: 100%; width: 100%; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); margin-bottom: 24px; box-sizing: border-box;">

    <!-- SECTION 1: GENERAL INFO GRID (TETAP SAMA) -->
    <h3 style="font-size: 16px; font-weight: bold; color: #1e293b; margin: 0 0 16px 0;">General MTO Info</h3>

    <div style="display: grid; grid-template-columns: 1fr; gap: 16px; margin-bottom: 16px;">
        <div>
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">No. Document</label>
            <input type="text" name="mto_data[header][no_document]" value="{{ $project->mto_data['header']['no_document'] ?? '' }}" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff; box-sizing: border-box;">
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
        <div>
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Date</label>
            <input type="date" name="mto_data[header][date]" value="{{ $project->mto_data['header']['date'] ?? '' }}" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff; box-sizing: border-box;">
        </div>
        <div>
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Rev</label>
            <input type="text" name="mto_data[header][rev]" value="{{ $project->mto_data['header']['rev'] ?? '' }}" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:6px; font-size:13px; outline:none; background:#fff; box-sizing: border-box;">
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
        <div>
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Contract No.</label>
            <input type="text" name="mto_data[header][contract_no]" value="{{ $project->mto_data['header']['contract_no'] ?? ($project->work_order ?? '') }}" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff; box-sizing: border-box;">
        </div>
        <div>
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Project</label>
            <input type="text" name="mto_data[header][project_name]" value="{{ $project->mto_data['header']['project_name'] ?? ($project->bridge_type ?? '') }}" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:6px; font-size:13px; outline:none; background:#fff; box-sizing: border-box;">
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px;">
        <div>
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Material</label>
            <input type="text" name="mto_data[header][material]" value="{{ $project->mto_data['header']['material'] ?? ($project->bridge_type ?? '') }}" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:6px; font-size:13px; outline:none; background:#fff; box-sizing: border-box;">
        </div>
        <div>
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Customer</label>
            <input type="text" name="mto_data[header][customer]" value="{{ $project->mto_data['header']['customer'] ?? ($project->customer ?? '') }}" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:6px; font-size:13px; outline:none; background:#fff; box-sizing: border-box;">
        </div>
    </div>

    <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 24px 0;">

    <!-- SECTION 2: FORM TAMBAH ITEM MTO (SAMA SEPERTI TAMPILAN GAMBAR) -->
    <h3 style="font-size: 16px; font-weight: bold; color: #1e293b; margin: 0 0 16px 0;">Tambah Item MTO</h3>

    <!-- ROW 1 -->
    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; margin-bottom: 16px;">
        <div>
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Kategori Material</label>
            <select id="form_kategori" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff; box-sizing: border-box;">
                <option value="profile">Profile</option>
                <option value="plate">Plate</option>
                <option value="welded_beam">Welded Beam</option>
                <option value="accessories">Accessories</option>
                <option value="bolt">Bolt, Nut & Washer</option>
            </select>
        </div>
        <div>
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Part No. / Description</label>
            <input type="text" id="form_description" placeholder="mis. B25G-SP6 / Plat 12mm" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff; box-sizing: border-box;">
        </div>
        <div>
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Grade</label>
            <input type="text" id="form_grade" placeholder="mis. SS400 / SM490" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:6px; font-size:13px; outline:none; background:#fff; box-sizing: border-box;">
        </div>
    </div>

    <!-- ROW 2 -->
    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 16px; margin-bottom: 16px;">
        <div>
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Length (mm)</label>
            <input type="number" id="form_length" placeholder="0" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff; box-sizing: border-box;">
        </div>
        <div>
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Qty</label>
            <input type="number" id="form_qty" placeholder="0" oninput="calculateFormTotalWeight()" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff; box-sizing: border-box;">
        </div>
        <div>
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Unit Weight (kg)</label>
            <input type="number" step="0.01" id="form_unit_weight" placeholder="0" oninput="calculateFormTotalWeight()" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff; box-sizing: border-box;">
        </div>
        <div>
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Total Weight (kg)</label>
            <input type="number" step="0.01" id="form_total_weight" placeholder="0" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#f1f5f9; box-sizing: border-box;">
        </div>
    </div>

    <!-- ROW 3 -->
    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; margin-bottom: 16px;">
        <div>
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Purchase Order (PO)</label>
            <input type="text" id="form_po" placeholder="mis. PO-026-2026" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff; box-sizing: border-box;">
        </div>
        <div>
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Stock Status</label>
            <input type="text" id="form_stock" placeholder="mis. Ready / Indent" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff; box-sizing: border-box;">
        </div>
        <div>
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Remarks</label>
            <input type="text" id="form_remarks" placeholder="Opsional" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff; box-sizing: border-box;">
        </div>
    </div>

    <!-- FOOTER FORM & BUTTON -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
        <span style="font-size: 12px; color: #94a3b8;">Item yang ditambahkan akan otomatis masuk ke daftar tabel di bawah.</span>
        <button type="button" onclick="addItemToMtoTable()" style="background-color: #55ACEE; color: #ffffff; border: none; padding: 10px 20px; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);">
            Tambah ke tabel
        </button>
    </div>

</div>

<!-- SECTION 3: TABEL DAFTAR ITEM MTO -->
<div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; max-width: 100%; width: 100%; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); box-sizing: border-box;">
    <div style="overflow-x: auto;">
        <table id="mto_summary_table" style="width: 100%; border-collapse: collapse; min-width: 1000px; text-align: left; font-size: 12px;">
            <thead style="background-color: #f8fafc; color: #64748b; text-transform: uppercase; font-size: 11px; font-weight: 600;">
                <tr>
                    <th style="padding: 12px; border-bottom: 1px solid #e2e8f0;">KATEGORI</th>
                    <th style="padding: 12px; border-bottom: 1px solid #e2e8f0;">DESCRIPTION / PART NO</th>
                    <th style="padding: 12px; border-bottom: 1px solid #e2e8f0;">GRADE</th>
                    <th style="padding: 12px; border-bottom: 1px solid #e2e8f0; text-align: right;">LENGTH (MM)</th>
                    <th style="padding: 12px; border-bottom: 1px solid #e2e8f0; text-align: right;">QTY</th>
                    <th style="padding: 12px; border-bottom: 1px solid #e2e8f0; text-align: right;">UNIT WT (KG)</th>
                    <th style="padding: 12px; border-bottom: 1px solid #e2e8f0; text-align: right;">TOTAL WT (KG)</th>
                    <th style="padding: 12px; border-bottom: 1px solid #e2e8f0;">PO</th>
                    <th style="padding: 12px; border-bottom: 1px solid #e2e8f0;">STOCK</th>
                    <th style="padding: 12px; border-bottom: 1px solid #e2e8f0;">REMARKS</th>
                    <th style="padding: 12px; border-bottom: 1px solid #e2e8f0; width: 30px;"></th>
                </tr>
            </thead>
            <tbody id="mto_table_body">
                <!-- RENDER LOADED DATA FROM BACKEND IF AVAILABLE -->
                @php 
                    $existingItems = [];
                    if(isset($project->mto_data)) {
                        foreach(['profile', 'plate', 'welded_beam', 'accessories', 'bolt'] as $cat) {
                            if(!empty($project->mto_data[$cat])) {
                                foreach($project->mto_data[$cat] as $row) {
                                    $row['_category'] = $cat;
                                    $existingItems[] = $row;
                                }
                            }
                        }
                    }
                @endphp

                @foreach($existingItems as $index => $item)
                @php $cat = $item['_category']; @endphp
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 10px; text-transform: capitalize; font-weight: 600; color: #334155;">
                        {{ str_replace('_', ' ', $cat) }}
                        <input type="hidden" name="mto_data[{{ $cat }}][{{ $index }}][kategori]" value="{{ $cat }}">
                    </td>
                    <td style="padding: 10px;"><input type="text" name="mto_data[{{ $cat }}][{{ $index }}][description]" value="{{ $item['description'] ?? $item['profile'] ?? $item['pl'] ?? $item['profile_welded_beam'] ?? $item['code'] ?? '' }}" style="width:100%; border:none; background:transparent; font-size:12px;"></td>
                    <td style="padding: 10px;"><input type="text" name="mto_data[{{ $cat }}][{{ $index }}][grade]" value="{{ $item['grade'] ?? '' }}" style="width:100%; border:none; background:transparent; font-size:12px;"></td>
                    <td style="padding: 10px; text-align: right;"><input type="text" name="mto_data[{{ $cat }}][{{ $index }}][length]" value="{{ $item['length'] ?? '' }}" style="width:100%; border:none; background:transparent; text-align:right; font-size:12px;"></td>
                    <td style="padding: 10px; text-align: right;"><input type="text" name="mto_data[{{ $cat }}][{{ $index }}][qty]" value="{{ $item['qty'] ?? '' }}" style="width:100%; border:none; background:transparent; text-align:right; font-size:12px;"></td>
                    <td style="padding: 10px; text-align: right;"><input type="text" name="mto_data[{{ $cat }}][{{ $index }}][unit_weight]" value="{{ $item['unit_weight'] ?? '' }}" style="width:100%; border:none; background:transparent; text-align:right; font-size:12px;"></td>
                    <td style="padding: 10px; text-align: right;"><input type="text" name="mto_data[{{ $cat }}][{{ $index }}][total_weight]" value="{{ $item['total_weight'] ?? '' }}" class="row-total-weight" style="width:100%; border:none; background:transparent; text-align:right; font-size:12px; font-weight:600;"></td>
                    <td style="padding: 10px;"><input type="text" name="mto_data[{{ $cat }}][{{ $index }}][purchase_order]" value="{{ $item['purchase_order'] ?? '' }}" style="width:100%; border:none; background:transparent; font-size:12px;"></td>
                    <td style="padding: 10px;"><input type="text" name="mto_data[{{ $cat }}][{{ $index }}][stock]" value="{{ $item['stock'] ?? '' }}" style="width:100%; border:none; background:transparent; font-size:12px;"></td>
                    <td style="padding: 10px;"><input type="text" name="mto_data[{{ $cat }}][{{ $index }}][remarks]" value="{{ $item['remarks'] ?? '' }}" style="width:100%; border:none; background:transparent; font-size:12px;"></td>
                    <td style="padding: 10px; text-align:center;">
                        <button type="button" onclick="removeMtoRow(this)" style="background:none; border:none; color:#ef4444; cursor:pointer; font-weight:bold; font-size:16px;">&times;</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
let mtoRowIndex = {{ count($existingItems) }};

function calculateFormTotalWeight() {
    const qty = parseFloat(document.getElementById('form_qty').value) || 0;
    const unitWt = parseFloat(document.getElementById('form_unit_weight').value) || 0;
    const total = qty * unitWt;
    document.getElementById('form_total_weight').value = total ? total.toFixed(2) : '';
}

function addItemToMtoTable() {
    const kategori = document.getElementById('form_kategori').value;
    const description = document.getElementById('form_description').value;
    const grade = document.getElementById('form_grade').value;
    const length = document.getElementById('form_length').value;
    const qty = document.getElementById('form_qty').value;
    const unitWt = document.getElementById('form_unit_weight').value;
    const totalWt = document.getElementById('form_total_weight').value;
    const po = document.getElementById('form_po').value;
    const stock = document.getElementById('form_stock').value;
    const remarks = document.getElementById('form_remarks').value;

    if (!description) {
        alert('Harap isi Part No. / Description');
        return;
    }

    const tbody = document.getElementById('mto_table_body');
    const newRow = document.createElement('tr');
    newRow.style.borderBottom = '1px solid #f1f5f9';

    const labelKategori = kategori.replace('_', ' ');

    newRow.innerHTML = `
        <td style="padding: 10px; text-transform: capitalize; font-weight: 600; color: #334155;">
            ${labelKategori}
            <input type="hidden" name="mto_data[${kategori}][${mtoRowIndex}][kategori]" value="${kategori}">
        </td>
        <td style="padding: 10px;"><input type="text" name="mto_data[${kategori}][${mtoRowIndex}][description]" value="${description}" style="width:100%; border:none; background:transparent; font-size:12px;"></td>
        <td style="padding: 10px;"><input type="text" name="mto_data[${kategori}][${mtoRowIndex}][grade]" value="${grade}" style="width:100%; border:none; background:transparent; font-size:12px;"></td>
        <td style="padding: 10px; text-align: right;"><input type="text" name="mto_data[${kategori}][${mtoRowIndex}][length]" value="${length}" style="width:100%; border:none; background:transparent; text-align:right; font-size:12px;"></td>
        <td style="padding: 10px; text-align: right;"><input type="text" name="mto_data[${kategori}][${mtoRowIndex}][qty]" value="${qty}" style="width:100%; border:none; background:transparent; text-align:right; font-size:12px;"></td>
        <td style="padding: 10px; text-align: right;"><input type="text" name="mto_data[${kategori}][${mtoRowIndex}][unit_weight]" value="${unitWt}" style="width:100%; border:none; background:transparent; text-align:right; font-size:12px;"></td>
        <td style="padding: 10px; text-align: right;"><input type="text" name="mto_data[${kategori}][${mtoRowIndex}][total_weight]" value="${totalWt}" class="row-total-weight" style="width:100%; border:none; background:transparent; text-align:right; font-size:12px; font-weight:600;"></td>
        <td style="padding: 10px;"><input type="text" name="mto_data[${kategori}][${mtoRowIndex}][purchase_order]" value="${po}" style="width:100%; border:none; background:transparent; font-size:12px;"></td>
        <td style="padding: 10px;"><input type="text" name="mto_data[${kategori}][${mtoRowIndex}][stock]" value="${stock}" style="width:100%; border:none; background:transparent; font-size:12px;"></td>
        <td style="padding: 10px;"><input type="text" name="mto_data[${kategori}][${mtoRowIndex}][remarks]" value="${remarks}" style="width:100%; border:none; background:transparent; font-size:12px;"></td>
        <td style="padding: 10px; text-align:center;">
            <button type="button" onclick="removeMtoRow(this)" style="background:none; border:none; color:#ef4444; cursor:pointer; font-weight:bold; font-size:16px;">&times;</button>
        </td>
    `;

    tbody.appendChild(newRow);
    mtoRowIndex++;

    // Reset Form Input
    document.getElementById('form_description').value = '';
    document.getElementById('form_grade').value = '';
    document.getElementById('form_length').value = '';
    document.getElementById('form_qty').value = '';
    document.getElementById('form_unit_weight').value = '';
    document.getElementById('form_total_weight').value = '';
    document.getElementById('form_po').value = '';
    document.getElementById('form_stock').value = '';
    document.getElementById('form_remarks').value = '';
}

function removeMtoRow(btn) {
    const row = btn.closest('tr');
    row.remove();
}
</script>

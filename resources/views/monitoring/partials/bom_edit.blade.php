<!-- resources/views/monitoring/partials/bom_edit.blade.php -->
<div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; max-width: 100%; width: 100%; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
    
    <!-- Readonly Header Info -->

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px 32px; border-bottom: 1px solid #e2e8f0; padding-bottom: 20px; margin-bottom: 24px; font-size: 13px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: #64748b;">Contract no.</span>
            <input type="text" name="bom_data[header][contract_no]" value="{{ $project->bom_data['header']['contract_no'] ?? '' }}" style="font-weight: 600; color: #1e293b; border: none; border-bottom: 1px dashed #cbd5e1; outline: none; background: transparent; text-align: right; width: 60%;">
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: #64748b;">No. document</span>
            <input type="text" name="bom_data[header][no_document]" value="{{ $project->bom_data['header']['no_document'] ?? '' }}" style="font-weight: 600; color: #1e293b; border: none; border-bottom: 1px dashed #cbd5e1; outline: none; background: transparent; text-align: right; width: 60%;">
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: #64748b;">Project</span>
            <span style="font-weight: 600; color: #1e293b;">{{ $project->bridge_type ?? '' }}</span>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: #64748b;">Rev</span>
            <input type="text" name="bom_data[header][rev]" value="{{ $project->bom_data['header']['rev'] ?? '' }}" style="font-weight: 600; color: #1e293b; border: none; border-bottom: 1px dashed #cbd5e1; outline: none; background: transparent; text-align: right; width: 60%;">
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: #64748b;">Customer</span>
            <span style="font-weight: 600; color: #1e293b;">{{ $project->customer ?? '' }}</span>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: #64748b;">Date</span>
            <input type="date" name="bom_data[header][date]" value="{{ $project->bom_data['header']['date'] ?? '' }}" style="font-weight: 600; color: #1e293b; border: none; border-bottom: 1px dashed #cbd5e1; outline: none; background: transparent; text-align: right;">
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: #64748b;">Location</span>
            <input type="text" name="bom_data[header][location]" value="{{ $project->bom_data['header']['location'] ?? '' }}" style="font-weight: 600; color: #1e293b; border: none; border-bottom: 1px dashed #cbd5e1; outline: none; background: transparent; text-align: right; width: 60%;">
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span style="color: #64748b;">Prepared by</span>
            <input type="text" name="bom_data[header][prepared_by]" value="{{ $project->bom_data['header']['prepared_by'] ?? '' }}" style="font-weight: 600; color: #1e293b; border: none; border-bottom: 1px dashed #cbd5e1; outline: none; background: transparent; text-align: right; width: 60%;">
        </div>
    </div>

    <!-- Form Tambah Item -->
    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; margin-bottom: 24px;">
        <h4 style="font-size: 15px; font-weight: bold; color: #334155; margin: 0 0 16px 0;">Tambah item</h4>
        
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-bottom: 12px;">
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Item No</label>
                <input type="text" id="bom_no" placeholder="auto" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Part No.</label>
                <input type="text" id="bom_part_no" placeholder="mis. B25G-SP6" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Rev</label>
                <input type="text" id="bom_rev" value="0" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Description</label>
                <input type="text" id="bom_description" placeholder="mis. PLT26×300" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 12px; margin-bottom: 12px;">
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Section</label>
                <select id="bom_section" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff;">
                    <option value="structure">Structure</option>
                    <option value="bolt_nut_washer">Bolt, nut & washer</option>
                </select>
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Grade</label>
                <input type="text" id="bom_grade" placeholder="mis. SM490YA" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Quantity (pcs)</label>
                <input type="number" id="bom_qty" value="0" min="0" oninput="calcBOMRowWeight()" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Length (mm)</label>
                <input type="number" id="bom_length" value="0" min="0" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Unit Sq. Area (m²)</label>
                <input type="text" id="bom_sq_area" placeholder="—" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(12, 1fr); gap: 12px; margin-bottom: 16px;">
            <div style="grid-column: span 3;">
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Unit Weight (kg)</label>
                <input type="number" step="0.01" id="bom_unit_weight" value="0" min="0" oninput="calcBOMRowWeight()" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff;">
            </div>
            <div style="grid-column: span 3;">
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Total Weight (kg)</label>
                <input type="text" id="bom_total_weight" value="0,00" readonly style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#e2e8f0; color:#475569; font-weight:600;">
            </div>
            <div style="grid-column: span 6;">
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Remarks</label>
                <input type="text" id="bom_remarks" placeholder="Opsional" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:8px; font-size:13px; outline:none; background:#fff;">
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; align-items: center; margin-top: 16px;">
            <button type="button" onclick="addBOMToTable()" style="background-color: #55ACEE; color: #ffffff; border: none; padding: 10px 24px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer;">
                Tambah ke tabel
            </button>
        </div>
    </div>

    <!-- Tabel BOM -->
    <div style="overflow-x: auto; border: 1px solid #e2e8f0; border-radius: 12px; margin-bottom: 16px;">
        <table style="width: 100%; border-collapse: collapse; min-width: 1100px; text-align: left; font-size: 12px;" id="bomTable">
            <thead style="background-color: #f8fafc; color: #64748b; text-transform: uppercase;">
                <tr>
                    <th style="padding: 12px 10px; border-bottom: 1px solid #e2e8f0;">No</th>
                    <th style="padding: 12px 10px; border-bottom: 1px solid #e2e8f0;">Part no.</th>
                    <th style="padding: 12px 10px; border-bottom: 1px solid #e2e8f0;">Rev</th>
                    <th style="padding: 12px 10px; border-bottom: 1px solid #e2e8f0;">Description</th>
                    <th style="padding: 12px 10px; border-bottom: 1px solid #e2e8f0;">Grade</th>
                    <th style="padding: 12px 10px; border-bottom: 1px solid #e2e8f0; text-align: right;">Qty (pcs)</th>
                    <th style="padding: 12px 10px; border-bottom: 1px solid #e2e8f0; text-align: right;">Length (mm)</th>
                    <th style="padding: 12px 10px; border-bottom: 1px solid #e2e8f0; text-align: right;">Unit sq. area (m²)</th>
                    <th style="padding: 12px 10px; border-bottom: 1px solid #e2e8f0; text-align: right;">Unit weight (kg)</th>
                    <th style="padding: 12px 10px; border-bottom: 1px solid #e2e8f0; text-align: right;">Total weight (kg)</th>
                    <th style="padding: 12px 10px; border-bottom: 1px solid #e2e8f0;">Remarks</th>
                    <th style="padding: 12px 10px; border-bottom: 1px solid #e2e8f0; text-align: center;"></th>
                </tr>
            </thead>

            <!-- Section: Structure -->
            <tbody id="section-structure">
                <tr style="background-color: #f8fafc; font-weight: 700; color: #334155; border-bottom: 1px solid #e2e8f0;">
                    <td colspan="12" style="padding: 10px;">Structure</td>
                </tr>
                @php $structureItems = $project->bom_data['structure'] ?? []; @endphp
                @foreach($structureItems as $i => $item)
                <tr class="bom-item-row" data-section="structure" style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 8px 10px;"><input type="text" name="bom_data[structure][{{ $i }}][no]" value="{{ $item['no'] ?? '' }}" style="width:100%; border:none; background:transparent; outline:none;"></td>
                    <td style="padding: 8px 10px; font-weight: 600;"><input type="text" name="bom_data[structure][{{ $i }}][part_no]" value="{{ $item['part_no'] ?? '' }}" style="width:100%; border:none; background:transparent; outline:none;"></td>
                    <td style="padding: 8px 10px;"><input type="text" name="bom_data[structure][{{ $i }}][rev]" value="{{ $item['rev'] ?? '0' }}" style="width:100%; border:none; background:transparent; outline:none;"></td>
                    <td style="padding: 8px 10px; font-weight: 600;"><input type="text" name="bom_data[structure][{{ $i }}][description]" value="{{ $item['description'] ?? '' }}" style="width:100%; border:none; background:transparent; outline:none;"></td>
                    <td style="padding: 8px 10px;"><input type="text" name="bom_data[structure][{{ $i }}][grade]" value="{{ $item['grade'] ?? '' }}" style="width:100%; border:none; background:transparent; outline:none;"></td>
                    <td style="padding: 8px 10px; text-align: right;"><input type="number" name="bom_data[structure][{{ $i }}][qty]" value="{{ $item['qty'] ?? 0 }}" class="input-qty" oninput="calcAllBOMTotals()" style="width:100%; border:none; background:transparent; outline:none; text-align:right;"></td>
                    <td style="padding: 8px 10px; text-align: right;"><input type="number" name="bom_data[structure][{{ $i }}][length]" value="{{ $item['length'] ?? 0 }}" style="width:100%; border:none; background:transparent; outline:none; text-align:right;"></td>
                    <td style="padding: 8px 10px; text-align: right;"><input type="text" name="bom_data[structure][{{ $i }}][unit_sq_area]" value="{{ $item['unit_sq_area'] ?? '—' }}" style="width:100%; border:none; background:transparent; outline:none; text-align:right;"></td>
                    <td style="padding: 8px 10px; text-align: right;"><input type="number" step="0.01" name="bom_data[structure][{{ $i }}][unit_weight]" value="{{ $item['unit_weight'] ?? 0 }}" class="input-unit-weight" oninput="calcAllBOMTotals()" style="width:100%; border:none; background:transparent; outline:none; text-align:right;"></td>
                    <td style="padding: 8px 10px; text-align: right; font-weight: 600;" class="row-total-weight">{{ number_format((float)($item['total_weight'] ?? 0), 2, ',', '.') }}</td>
                    <input type="hidden" name="bom_data[structure][{{ $i }}][total_weight]" class="input-total-weight-hidden" value="{{ $item['total_weight'] ?? 0 }}">
                    <td style="padding: 8px 10px;"><input type="text" name="bom_data[structure][{{ $i }}][remarks]" value="{{ $item['remarks'] ?? '' }}" style="width:100%; border:none; background:transparent; outline:none;"></td>
                    <td style="padding: 8px 10px; text-align: center;"><button type="button" onclick="this.closest('tr').remove(); calcAllBOMTotals();" style="background:none; border:none; color:#ef4444; cursor:pointer; font-weight:bold;">&times;</button></td>
                </tr>
                @endforeach
            </tbody>
            <tr style="border-bottom: 1px solid #e2e8f0; font-weight: 600; color: #334155;">
                <td colspan="9" style="padding: 10px;">Subtotal structure</td>
                <td style="padding: 10px; text-align: right;" id="subtotal-structure">0,00</td>
                <td colspan="2"></td>
            </tr>

            <!-- Section: Bolt, Nut & Washer -->
            <tbody id="section-bolt_nut_washer">
                <tr style="background-color: #f8fafc; font-weight: 700; color: #334155; border-bottom: 1px solid #e2e8f0;">
                    <td colspan="12" style="padding: 10px;">Bolt, nut & washer</td>
                </tr>
                @php $boltItems = $project->bom_data['bolt_nut_washer'] ?? []; @endphp
                @foreach($boltItems as $i => $item)
                <tr class="bom-item-row" data-section="bolt_nut_washer" style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 8px 10px;"><input type="text" name="bom_data[bolt_nut_washer][{{ $i }}][no]" value="{{ $item['no'] ?? '' }}" style="width:100%; border:none; background:transparent; outline:none;"></td>
                    <td style="padding: 8px 10px; font-weight: 600;"><input type="text" name="bom_data[bolt_nut_washer][{{ $i }}][part_no]" value="{{ $item['part_no'] ?? '' }}" style="width:100%; border:none; background:transparent; outline:none;"></td>
                    <td style="padding: 8px 10px;"><input type="text" name="bom_data[bolt_nut_washer][{{ $i }}][rev]" value="{{ $item['rev'] ?? '0' }}" style="width:100%; border:none; background:transparent; outline:none;"></td>
                    <td style="padding: 8px 10px; font-weight: 600;"><input type="text" name="bom_data[bolt_nut_washer][{{ $i }}][description]" value="{{ $item['description'] ?? '' }}" style="width:100%; border:none; background:transparent; outline:none;"></td>
                    <td style="padding: 8px 10px;"><input type="text" name="bom_data[bolt_nut_washer][{{ $i }}][grade]" value="{{ $item['grade'] ?? '' }}" style="width:100%; border:none; background:transparent; outline:none;"></td>
                    <td style="padding: 8px 10px; text-align: right;"><input type="number" name="bom_data[bolt_nut_washer][{{ $i }}][qty]" value="{{ $item['qty'] ?? 0 }}" class="input-qty" oninput="calcAllBOMTotals()" style="width:100%; border:none; background:transparent; outline:none; text-align:right;"></td>
                    <td style="padding: 8px 10px; text-align: right;"><input type="number" name="bom_data[bolt_nut_washer][{{ $i }}][length]" value="{{ $item['length'] ?? 0 }}" style="width:100%; border:none; background:transparent; outline:none; text-align:right;"></td>
                    <td style="padding: 8px 10px; text-align: right;"><input type="text" name="bom_data[bolt_nut_washer][{{ $i }}][unit_sq_area]" value="{{ $item['unit_sq_area'] ?? '—' }}" style="width:100%; border:none; background:transparent; outline:none; text-align:right;"></td>
                    <td style="padding: 8px 10px; text-align: right;"><input type="number" step="0.01" name="bom_data[bolt_nut_washer][{{ $i }}][unit_weight]" value="{{ $item['unit_weight'] ?? 0 }}" class="input-unit-weight" oninput="calcAllBOMTotals()" style="width:100%; border:none; background:transparent; outline:none; text-align:right;"></td>
                    <td style="padding: 8px 10px; text-align: right; font-weight: 600;" class="row-total-weight">{{ number_format((float)($item['total_weight'] ?? 0), 2, ',', '.') }}</td>
                    <input type="hidden" name="bom_data[bolt_nut_washer][{{ $i }}][total_weight]" class="input-total-weight-hidden" value="{{ $item['total_weight'] ?? 0 }}">
                    <td style="padding: 8px 10px;"><input type="text" name="bom_data[bolt_nut_washer][{{ $i }}][remarks]" value="{{ $item['remarks'] ?? '' }}" style="width:100%; border:none; background:transparent; outline:none;"></td>
                    <td style="padding: 8px 10px; text-align: center;"><button type="button" onclick="this.closest('tr').remove(); calcAllBOMTotals();" style="background:none; border:none; color:#ef4444; cursor:pointer; font-weight:bold;">&times;</button></td>
                </tr>
                @endforeach
            </tbody>
            <tr style="border-bottom: 1px solid #e2e8f0; font-weight: 600; color: #334155;">
                <td colspan="9" style="padding: 10px;">Subtotal bolt, nut & washer</td>
                <td style="padding: 10px; text-align: right;" id="subtotal-bolt_nut_washer">0,00</td>
                <td colspan="2"></td>
            </tr>
        </table>
    </div>

    <!-- Grand Total -->
    <div style="background-color: #1e2530; color: #ffffff; display: flex; justify-content: space-between; align-items: center; padding: 12px 20px; border-radius: 8px; font-size: 13px; font-weight: 700;">
        <span>Grand total weight (kg)</span>
        <span id="grand-total-weight">0,00</span>
    </div>
</div>

<script>
function calcBOMRowWeight() {
    const qty = parseFloat(document.getElementById('bom_qty').value) || 0;
    const unitWeight = parseFloat(document.getElementById('bom_unit_weight').value) || 0;
    const total = qty * unitWeight;
    document.getElementById('bom_total_weight').value = new Intl.NumberFormat('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(total);
}

function formatIDRNumber(num) {
    return new Intl.NumberFormat('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(num);
}

function addBOMToTable() {
    const section = document.getElementById('bom_section').value;
    const tbody = document.getElementById(`section-${section}`);
    const index = tbody.querySelectorAll('.bom-item-row').length;

    const no = document.getElementById('bom_no').value || '-';
    const partNo = document.getElementById('bom_part_no').value || '-';
    const rev = document.getElementById('bom_rev').value || '0';
    const description = document.getElementById('bom_description').value || '-';
    const grade = document.getElementById('bom_grade').value || '-';
    const qty = parseFloat(document.getElementById('bom_qty').value) || 0;
    const length = document.getElementById('bom_length').value || '0';
    const sqArea = document.getElementById('bom_sq_area').value || '—';
    const unitWeight = parseFloat(document.getElementById('bom_unit_weight').value) || 0;
    const totalWeight = qty * unitWeight;
    const remarks = document.getElementById('bom_remarks').value || '';

    const tr = document.createElement('tr');
    tr.className = 'bom-item-row';
    tr.dataset.section = section;
    tr.style.borderBottom = '1px solid #f1f5f9';

    tr.innerHTML = `
        <td style="padding: 8px 10px;"><input type="text" name="bom_data[${section}][${index}][no]" value="${no}" style="width:100%; border:none; background:transparent; outline:none;"></td>
        <td style="padding: 8px 10px; font-weight: 600;"><input type="text" name="bom_data[${section}][${index}][part_no]" value="${partNo}" style="width:100%; border:none; background:transparent; outline:none;"></td>
        <td style="padding: 8px 10px;"><input type="text" name="bom_data[${section}][${index}][rev]" value="${rev}" style="width:100%; border:none; background:transparent; outline:none;"></td>
        <td style="padding: 8px 10px; font-weight: 600;"><input type="text" name="bom_data[${section}][${index}][description]" value="${description}" style="width:100%; border:none; background:transparent; outline:none;"></td>
        <td style="padding: 8px 10px;"><input type="text" name="bom_data[${section}][${index}][grade]" value="${grade}" style="width:100%; border:none; background:transparent; outline:none;"></td>
        <td style="padding: 8px 10px; text-align: right;"><input type="number" name="bom_data[${section}][${index}][qty]" value="${qty}" class="input-qty" oninput="calcAllBOMTotals()" style="width:100%; border:none; background:transparent; outline:none; text-align:right;"></td>
        <td style="padding: 8px 10px; text-align: right;"><input type="number" name="bom_data[${section}][${index}][length]" value="${length}" style="width:100%; border:none; background:transparent; outline:none; text-align:right;"></td>
        <td style="padding: 8px 10px; text-align: right;"><input type="text" name="bom_data[${section}][${index}][unit_sq_area]" value="${sqArea}" style="width:100%; border:none; background:transparent; outline:none; text-align:right;"></td>
        <td style="padding: 8px 10px; text-align: right;"><input type="number" step="0.01" name="bom_data[${section}][${index}][unit_weight]" value="${unitWeight}" class="input-unit-weight" oninput="calcAllBOMTotals()" style="width:100%; border:none; background:transparent; outline:none; text-align:right;"></td>
        <td style="padding: 8px 10px; text-align: right; font-weight: 600;" class="row-total-weight">${formatIDRNumber(totalWeight)}</td>
        <input type="hidden" name="bom_data[${section}][${index}][total_weight]" class="input-total-weight-hidden" value="${totalWeight}">
        <td style="padding: 8px 10px;"><input type="text" name="bom_data[${section}][${index}][remarks]" value="${remarks}" style="width:100%; border:none; background:transparent; outline:none;"></td>
        <td style="padding: 8px 10px; text-align: center;"><button type="button" onclick="this.closest('tr').remove(); calcAllBOMTotals();" style="background:none; border:none; color:#ef4444; cursor:pointer; font-weight:bold;">&times;</button></td>
    `;

    tbody.appendChild(tr);
    calcAllBOMTotals();

    // Reset Form
    document.getElementById('bom_no').value = '';
    document.getElementById('bom_part_no').value = '';
    document.getElementById('bom_rev').value = '0';
    document.getElementById('bom_description').value = '';
    document.getElementById('bom_grade').value = '';
    document.getElementById('bom_qty').value = '0';
    document.getElementById('bom_length').value = '0';
    document.getElementById('bom_sq_area').value = '';
    document.getElementById('bom_unit_weight').value = '0';
    document.getElementById('bom_total_weight').value = '0,00';
    document.getElementById('bom_remarks').value = '';
}

function calcAllBOMTotals() {
    const sections = ['structure', 'bolt_nut_washer'];
    let grandTotal = 0;

    sections.forEach(sec => {
        let sectionSubtotal = 0;
        const rows = document.querySelectorAll(`tr.bom-item-row[data-section="${sec}"]`);

        rows.forEach(row => {
            const qty = parseFloat(row.querySelector('.input-qty').value) || 0;
            const unitWeight = parseFloat(row.querySelector('.input-unit-weight').value) || 0;
            const totalWeight = qty * unitWeight;

            row.querySelector('.row-total-weight').innerText = formatIDRNumber(totalWeight);
            row.querySelector('.input-total-weight-hidden').value = totalWeight;
            sectionSubtotal += totalWeight;
        });

        const subtotalElem = document.getElementById(`subtotal-${sec}`);
        if (subtotalElem) {
            subtotalElem.innerText = formatIDRNumber(sectionSubtotal);
        }
        grandTotal += sectionSubtotal;
    });

    document.getElementById('grand-total-weight').innerText = formatIDRNumber(grandTotal);
}

document.addEventListener("DOMContentLoaded", () => {
    calcAllBOMTotals();
});
</script>

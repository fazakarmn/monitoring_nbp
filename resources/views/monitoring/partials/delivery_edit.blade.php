@php 
    $deliveries = $project->deliveries->count()
        ? $project->deliveries 
        : collect([new \App\Models\Delivery()]);
    $firstDel = $deliveries->first();
@endphp

<div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; max-width: 100%; width: 100%; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); margin-bottom: 24px;">
    
    <!-- SECTION 1: GENERAL DELIVERY INFO -->
    <h3 style="font-size: 16px; font-weight: bold; color: #1e293b; margin: 0 0 16px 0;">General Delivery Info</h3>

    <div style="display: grid; grid-template-columns: 1fr; gap: 16px; margin-bottom: 16px;">
        <div>
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">No. Document</label>
            <input type="text" name="delivery_header[document_no]" value="{{ $firstDel->document_no ?? '' }}" placeholder="" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff;">
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
        <div>
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Material</label>
            <input type="text" name="delivery_header[product]" value="{{ $firstDel->product ?? '' }}" placeholder="" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff;">
        </div>
        <div>
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Date</label>
            <input type="date" name="delivery_header[delivery_date]" value="{{ isset($firstDel->delivery_date) ? $firstDel->delivery_date->format('Y-m-d') : '' }}" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff;">
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
        <div>
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Customer</label>
            <input type="text" name="delivery_header[customer]" value="{{ $firstDel->customer ?? $project->customer }}" placeholder="" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff;">
        </div>
        <div>
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Location</label>
            <input type="text" name="delivery_header[location]" value="{{ $firstDel->location ?? '' }}" placeholder="" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff;">
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px;">
        <div>
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Status Pengiriman</label>
            <select name="delivery_header[status]" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff;">
                <option value="Pending" {{ ($firstDel->status ?? '') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="On-Go" {{ ($firstDel->status ?? '') == 'On-Go' ? 'selected' : '' }}>On Delivery</option>
                <option value="Done" {{ ($firstDel->status ?? '') == 'Done' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
        <div>
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Rev</label>
            <input type="text" name="delivery_header[rev]" value="{{ $firstDel->rev ?? '' }}" placeholder="" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff;">
        </div>
    </div>

    <!-- SECTION 2: ITEM DETAIL (INPUT FORM) -->
    <h3 style="font-size: 16px; font-weight: bold; color: #1e293b; margin: 24px 0 16px 0;">Item Detail</h3>

    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; margin-bottom: 24px;">
        
        <div style="margin-bottom: 16px;">
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Section</label>
            <select id="item_section" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff;">
                <option value="Assembly part">Assembly part</option>
                <option value="Single part">Loose part</option>
                <option value="Loose part">Bold, nut, Washer</option>
            </select>
        </div>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 16px;">
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Assembly No.</label>
                <input type="text" id="item_assembly_no" placeholder="" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Quantity (PCS)</label>
                <input type="number" id="item_qty" value="" min="0" oninput="calcItemTotalWeight()" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Class</label>
                <input type="text" id="item_class" placeholder="" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff;">
            </div>
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Description</label>
            <input type="text" id="item_description" placeholder="" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff;">
        </div>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 16px;">
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Length (MM)</label>
                <input type="number" id="item_length" placeholder="" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Unit Weight (KG)</label>
                <input type="number" step="0.01" id="item_unit_weight" oninput="calcItemTotalWeight()" placeholder="" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff;">
            </div>
            <div>
                <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Total Weight (KG)</label>
                <input type="text" id="item_total_weight" readonly placeholder="" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#e2e8f0; color:#475569; font-weight:600;">
            </div>
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display:block; font-size:11px; font-weight:600; color:#64748b; margin-bottom:6px; text-transform:uppercase;">Remark</label>
            <input type="text" id="item_remark" placeholder="Opsional" style="width:100%; border:1px solid #cbd5e1; border-radius:6px; padding:10px; font-size:13px; outline:none; background:#fff;">
        </div>

        <div style="display: flex; justify-content: flex-end; align-items: center; margin-top: 20px;">
            <button type="button" onclick="addItemToTable()" style="background-color: #55ACEE; color: #ffffff; border: none; padding: 10px 24px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer;">
                Tambah Item
            </button>
        </div>
    </div>

    {{-- TABEL ITEM DETAIL --}}
    <div style="overflow-x: auto; border: 1px solid #e2e8f0; border-radius: 12px; margin-bottom: 24px;">
        <table style="width: 100%; border-collapse: collapse; min-width: 1000px; text-align: left; font-size: 12px;">
            <thead style="background-color: #f8fafc; color: #64748b; text-transform: uppercase;">
                <tr>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0;">Section</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0;">Assembly No.</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0;">Description</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; text-align: right;">Qty (PCS)</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0;">Class</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; text-align: right;">Length (MM)</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; text-align: right;">Unit Weight (KG)</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; text-align: right;">Total Weight (KG)</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0;">Remark</th>
                    <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0;"></th>
                </tr>
            </thead>
            <tbody id="item_tbody">
                @forelse($deliveries->skip(0) as $i => $del)
                @if($del->id && $del->assembly_no)
                <tr data-index="{{ $i }}" style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 12px 16px;">
                        {{ $del->section }}
                        <input type="hidden" name="delivery[{{ $i }}][id]" value="{{ $del->id }}">
                        <input type="hidden" name="delivery[{{ $i }}][section]" value="{{ $del->section }}">
                    </td>
                    <td style="padding: 12px 16px; font-weight:600; color:#55ACEE;">{{ $del->assembly_no }}<input type="hidden" name="delivery[{{ $i }}][assembly_no]" value="{{ $del->assembly_no }}"></td>
                    <td style="padding: 12px 16px;">{{ $del->description }}<input type="hidden" name="delivery[{{ $i }}][description]" value="{{ $del->description }}"></td>
                    <td style="padding: 12px 16px; text-align:right;">{{ $del->quantity }}<input type="hidden" name="delivery[{{ $i }}][quantity]" value="{{ $del->quantity }}"></td>
                    <td style="padding: 12px 16px;">{{ $del->class }}<input type="hidden" name="delivery[{{ $i }}][class]" value="{{ $del->class }}"></td>
                    <td style="padding: 12px 16px; text-align:right;">{{ $del->length_mm }}<input type="hidden" name="delivery[{{ $i }}][length_mm]" value="{{ $del->length_mm }}"></td>
                    <td style="padding: 12px 16px; text-align:right;">{{ number_format($del->weight_kg, 2) }}<input type="hidden" name="delivery[{{ $i }}][weight_kg]" value="{{ $del->weight_kg }}"></td>
                    <td style="padding: 12px 16px; text-align:right;">{{ number_format($del->quantity * $del->weight_kg, 2) }}<input type="hidden" name="delivery[{{ $i }}][total_weight_kg]" value="{{ $del->quantity * $del->weight_kg }}"></td>
                    <td style="padding: 12px 16px;">{{ $del->remark }}<input type="hidden" name="delivery[{{ $i }}][remark]" value="{{ $del->remark }}"></td>
                    <td style="padding: 12px 16px;">
                        <button type="button" onclick="this.closest('tr').remove()" style="background:none; border:none; color:#ef4444; cursor:pointer; font-weight:bold;">&times;</button>
                    </td>
                </tr>
                @endif
                @empty
                <tr id="item_empty_state">
                    <td colspan="10" style="text-align: center; padding: 30px; color: #94a3b8;">
                        {{ __('messages.no_items') }}
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

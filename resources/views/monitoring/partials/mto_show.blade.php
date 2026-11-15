<style>
    .mto-container { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; font-size: 11px; color: #1e293b; background: #fff; padding: 20px; border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 30px; }
    .mto-header { display: flex; justify-content: space-between; margin-bottom: 20px; border-bottom: 2px solid #f1f5f9; padding-bottom: 15px; }
    .mto-title { font-size: 16px; font-weight: 700; margin-bottom: 10px; }
    .mto-info-grid { display: grid; grid-template-columns: 100px 1fr 100px 1fr; gap: 5px 15px; margin-bottom: 20px; }
    .mto-info-label { color: #64748b; }
    .mto-info-val { font-weight: 600; }
    .mto-section { margin-bottom: 25px; }
    .mto-section-title { background: #1e293b; color: #fff; padding: 6px 12px; font-weight: 600; border-radius: 4px 4px 0 0; font-size: 12px; }
    .mto-table { width: 100%; border-collapse: collapse; border-left: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0; }
    .mto-table th { background: #f8fafc; color: #64748b; font-weight: 600; padding: 8px; border-bottom: 1px solid #e2e8f0; text-align: right; }
    .mto-table th:first-child, .mto-table td:first-child, .mto-table th.left-align, .mto-table td.left-align { text-align: left; }
    .mto-table th.center-align, .mto-table td.center-align { text-align: center; }
    .mto-table td { padding: 8px; border-bottom: 1px solid #f1f5f9; text-align: right; }
    .mto-table input { width: 100%; border: 1px solid #cbd5e1; border-radius: 4px; padding: 4px; font-size: 11px; box-sizing: border-box; text-align: right; }
    .mto-table td.left-align input { text-align: left; }
    .mto-table td.center-align input { text-align: center; }
    .mto-subtotal-row { background: #f8fafc; font-weight: 700; }
    .mto-subtotal-row td { border-bottom: 1px solid #e2e8f0; }
    .mto-add-btn { display: inline-block; color: #55ACEE; text-decoration: none; margin-top: 8px; font-weight: 600; cursor: pointer; }
    .mto-summary { background: #334155; color: #fff; padding: 15px 20px; border-radius: 6px; display: flex; justify-content: space-between; align-items: center; }
    .mto-summary-left div { margin-bottom: 6px; font-size: 12px; }
    .mto-summary-left span { display: inline-block; width: 150px; }
    .mto-summary-left strong { font-size: 14px; }
    .mto-progress-bar { width: 300px; }
    .progress-item { margin-bottom: 8px; }
    .progress-label { display: flex; justify-content: space-between; font-size: 10px; color: #cbd5e1; margin-bottom: 4px; }
    .progress-track { height: 6px; background: #475569; border-radius: 3px; overflow: hidden; }
    .progress-fill.blue { background: #55ACEE; }
    .progress-fill.orange { background: #f59e0b; }
    .mto-footer { display: flex; justify-content: space-between; margin-top: 30px; color: #64748b; }
    .approval-box { border: 1px solid #e2e8f0; padding: 15px; text-align: center; border-radius: 6px; min-width: 200px; }
    .approval-box div:first-child { color: #94a3b8; margin-bottom: 40px; }
</style>
<div class="mto-container">
    <div class="mto-info-grid">
        <div class="mto-info-label">No. document</div>
        <div class="mto-info-val">{{ $project->mto_data['header']['no_document'] ?? '...' }}</div>
        <div class="mto-info-label">Rev</div>
        <div class="mto-info-val">{{ $project->mto_data['header']['rev'] ?? '...' }}</div>
        <div class="mto-info-label">Date</div>
        <div class="mto-info-val">{{ $project->mto_data['header']['date'] ?? '...' }}</div>
        <div class="mto-info-label">Contract no.</div>
        <div class="mto-info-val">{{ $project->mto_data['header']['contract_no'] ?? ($project->work_order ?? '...') }}</div>
        <div class="mto-info-label">Project</div>
        <div class="mto-info-val">{{ $project->mto_data['header']['project_name'] ?? ($project->bridge_type ?? '...') }}</div>
        <div class="mto-info-label">Material</div>
        <div class="mto-info-val">{{ $project->mto_data['header']['material'] ?? ($project->bridge_type ?? '...') }}</div>
        <div class="mto-info-label">Customer</div>
        <div class="mto-info-val">{{ $project->mto_data['header']['customer'] ?? '...sdf' }}</div>
    </div>
    <!-- PROFILE -->
    <div class="mto-section">
        <div class="mto-section-title">PROFILE</div>
        <table class="mto-table">
            <thead>
                <tr>
                    <th class="center-align">Item</th>
                    <th class="center-align">Rev</th>
                    <th class="left-align">Profile</th>
                    <th>Length (mm)</th>
                    <th>Grade</th>
                    <th>Qty</th>
                    <th>Unit weight (kg)</th>
                    <th>Total weight (kg)</th>
                    <th>Remarks</th>
                    <th>Stock</th>
                    <th>Purchase order</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $items = $project->mto_data['profile'] ?? [];
                    $subtotal_profile = 0;
                @endphp
                @forelse($items as $item)
                @php $subtotal_profile += (float)($item['total_weight'] ?? 0); @endphp
                <tr>
                    <td class="center-align">{{ $item['item'] ?? '' }}</td>
                    <td class="center-align">{{ $item['rev'] ?? '' }}</td>
                    <td class="left-align">{{ $item['profile'] ?? '' }}</td>
                    <td>{{ $item['length'] ?? '' }}</td>
                    <td>{{ $item['grade'] ?? '' }}</td>
                    <td>{{ $item['qty'] ?? '' }}</td>
                    <td>{{ $item['unit_weight'] ?? '' }}</td>
                    <td>{{ $item['total_weight'] ?? '' }}</td>
                    <td>{{ $item['remarks'] ?? '' }}</td>
                    <td>{{ $item['stock'] ?? '' }}</td>
                    <td>{{ $item['purchase_order'] ?? '' }}</td>
                </tr>
                @empty
                <tr><td colspan="11" class="center-align" style="color:#94a3b8;">No data</td></tr>
                @endforelse
                <tr class="mto-subtotal-row">
                    <td colspan="7" class="left-align">Subtotal profile</td>
                    <td>{{ number_format($subtotal_profile, 2) }}</td>
                    <td colspan="3"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- PLATE -->
    <div class="mto-section">
        <div class="mto-section-title">PLATE</div>
        <table class="mto-table">
            <thead>
                <tr>
                    <th class="center-align">Item</th>
                    <th class="center-align">Rev</th>
                    <th class="left-align">PL</th>
                    <th>Thick (mm)</th>
                    <th>Width (mm)</th>
                    <th>Length (mm)</th>
                    <th>Grade</th>
                    <th>Qty</th>
                    <th>Unit weight (kg)</th>
                    <th>Total weight (kg)</th>
                    <th>Remarks</th>
                    <th>Stock</th>
                    <th>Purchase order</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $items = $project->mto_data['plate'] ?? [];
                    $subtotal_plate = 0;
                @endphp
                @forelse($items as $item)
                @php $subtotal_plate += (float)($item['total_weight'] ?? 0); @endphp
                <tr>
                    <td class="center-align">{{ $item['item'] ?? '' }}</td>
                    <td class="center-align">{{ $item['rev'] ?? '' }}</td>
                    <td class="left-align">{{ $item['pl'] ?? '' }}</td>
                    <td>{{ $item['thick'] ?? '' }}</td>
                    <td>{{ $item['width'] ?? '' }}</td>
                    <td>{{ $item['length'] ?? '' }}</td>
                    <td>{{ $item['grade'] ?? '' }}</td>
                    <td>{{ $item['qty'] ?? '' }}</td>
                    <td>{{ $item['unit_weight'] ?? '' }}</td>
                    <td>{{ $item['total_weight'] ?? '' }}</td>
                    <td>{{ $item['remarks'] ?? '' }}</td>
                    <td>{{ $item['stock'] ?? '' }}</td>
                    <td>{{ $item['purchase_order'] ?? '' }}</td>
                </tr>
                @empty
                <tr><td colspan="13" class="center-align" style="color:#94a3b8;">No data</td></tr>
                @endforelse
                <tr class="mto-subtotal-row">
                    <td colspan="9" class="left-align">Subtotal plate</td>
                    <td>{{ number_format($subtotal_plate, 2) }}</td>
                    <td colspan="3"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- WELDED BEAM -->
    <div class="mto-section">
        <div class="mto-section-title">WELDED BEAM</div>
        <table class="mto-table">
            <thead>
                <tr>
                    <th class="center-align">Item</th>
                    <th class="center-align">Rev</th>
                    <th class="left-align">Profile welded beam</th>
                    <th>Grade</th>
                    <th>Qty</th>
                    <th>Unit weight (kg)</th>
                    <th>Total weight (kg)</th>
                    <th>Remarks</th>
                    <th>Stock</th>
                    <th>Purchase order</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $items = $project->mto_data['welded_beam'] ?? [];
                    $subtotal_welded_beam = 0;
                @endphp
                @forelse($items as $item)
                @php $subtotal_welded_beam += (float)($item['total_weight'] ?? 0); @endphp
                <tr>
                    <td class="center-align">{{ $item['item'] ?? '' }}</td>
                    <td class="center-align">{{ $item['rev'] ?? '' }}</td>
                    <td class="left-align">{{ $item['profile_welded_beam'] ?? '' }}</td>
                    <td>{{ $item['grade'] ?? '' }}</td>
                    <td>{{ $item['qty'] ?? '' }}</td>
                    <td>{{ $item['unit_weight'] ?? '' }}</td>
                    <td>{{ $item['total_weight'] ?? '' }}</td>
                    <td>{{ $item['remarks'] ?? '' }}</td>
                    <td>{{ $item['stock'] ?? '' }}</td>
                    <td>{{ $item['purchase_order'] ?? '' }}</td>
                </tr>
                @empty
                <tr><td colspan="10" class="center-align" style="color:#94a3b8;">No data</td></tr>
                @endforelse
                <tr class="mto-subtotal-row">
                    <td colspan="6" class="left-align">Subtotal welded beam</td>
                    <td>{{ number_format($subtotal_welded_beam, 2) }}</td>
                    <td colspan="3"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- ACCESSORIES -->
    <div class="mto-section">
        <div class="mto-section-title">ACCESSORIES</div>
        <table class="mto-table">
            <thead>
                <tr>
                    <th class="center-align">Item</th>
                    <th class="center-align">Rev</th>
                    <th class="left-align">Code</th>
                    <th class="left-align">Description</th>
                    <th>Grade</th>
                    <th>Qty</th>
                    <th>Unit</th>
                    <th>Length (mm)</th>
                    <th>Total weight (kg)</th>
                    <th>Remarks</th>
                    <th>Stock</th>
                    <th>Purchase order</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $items = $project->mto_data['accessories'] ?? [];
                    $subtotal_accessories = 0;
                @endphp
                @forelse($items as $item)
                @php $subtotal_accessories += (float)($item['total_weight'] ?? 0); @endphp
                <tr>
                    <td class="center-align">{{ $item['item'] ?? '' }}</td>
                    <td class="center-align">{{ $item['rev'] ?? '' }}</td>
                    <td class="left-align">{{ $item['code'] ?? '' }}</td>
                    <td class="left-align">{{ $item['description'] ?? '' }}</td>
                    <td>{{ $item['grade'] ?? '' }}</td>
                    <td>{{ $item['qty'] ?? '' }}</td>
                    <td>{{ $item['unit'] ?? '' }}</td>
                    <td>{{ $item['length'] ?? '' }}</td>
                    <td>{{ $item['total_weight'] ?? '' }}</td>
                    <td>{{ $item['remarks'] ?? '' }}</td>
                    <td>{{ $item['stock'] ?? '' }}</td>
                    <td>{{ $item['purchase_order'] ?? '' }}</td>
                </tr>
                @empty
                <tr><td colspan="12" class="center-align" style="color:#94a3b8;">No data</td></tr>
                @endforelse
                <tr class="mto-subtotal-row">
                    <td colspan="8" class="left-align">Subtotal accessories</td>
                    <td>{{ number_format($subtotal_accessories, 2) }}</td>
                    <td colspan="3"></td>
                </tr>
            </tbody>
        </table>
        <div style="color:#94a3b8; font-size:10px; margin-top:8px;">Total Weight di section ini diketik manual (bukan hasil kali Qty*Length) karena berat aksesoris biasanya diambil dari katalog, bukan rumus sederhana.</div>
    </div>

    <!-- BOLT, NUT & WASHER -->
    <div class="mto-section">
        <div class="mto-section-title">BOLT, NUT & WASHER</div>
        <table class="mto-table">
            <thead>
                <tr>
                    <th class="center-align">Item</th>
                    <th class="center-align">Rev</th>
                    <th class="left-align">Description</th>
                    <th>Grade</th>
                    <th>Qty</th>
                    <th>Unit</th>
                    <th>Length (mm)</th>
                    <th>Total weight (kg)</th>
                    <th>Remarks</th>
                    <th>Stock</th>
                    <th>Purchase order</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $items = $project->mto_data['bolt'] ?? [];
                    $subtotal_bolt = 0;
                @endphp
                @forelse($items as $item)
                @php $subtotal_bolt += (float)($item['total_weight'] ?? 0); @endphp
                <tr>
                    <td class="center-align">{{ $item['item'] ?? '' }}</td>
                    <td class="center-align">{{ $item['rev'] ?? '' }}</td>
                    <td class="left-align">{{ $item['description'] ?? '' }}</td>
                    <td>{{ $item['grade'] ?? '' }}</td>
                    <td>{{ $item['qty'] ?? '' }}</td>
                    <td>{{ $item['unit'] ?? '' }}</td>
                    <td>{{ $item['length'] ?? '' }}</td>
                    <td>{{ $item['total_weight'] ?? '' }}</td>
                    <td>{{ $item['remarks'] ?? '' }}</td>
                    <td>{{ $item['stock'] ?? '' }}</td>
                    <td>{{ $item['purchase_order'] ?? '' }}</td>
                </tr>
                @empty
                <tr><td colspan="11" class="center-align" style="color:#94a3b8;">No data</td></tr>
                @endforelse
                <tr class="mto-subtotal-row">
                    <td colspan="7" class="left-align">Subtotal bolt, nut & washer</td>
                    <td>{{ number_format($subtotal_bolt, 2) }}</td>
                    <td colspan="3"></td>
                </tr>
            </tbody>
        </table>
    </div>

    @php
        $total_mto_weight = ($subtotal_profile ?? 0) + ($subtotal_plate ?? 0) + ($subtotal_welded_beam ?? 0) + ($subtotal_accessories ?? 0) + ($subtotal_bolt ?? 0);
        $total_bom_weight = $project->mto_data['summary']['bom_total'] ?? 0;
        
        $total_stock = 0;
        $total_purchase = 0;
        
        foreach(['profile', 'plate', 'welded_beam', 'accessories', 'bolt'] as $sec) {
            foreach($project->mto_data[$sec] ?? [] as $item) {
                $total_stock += (float)str_replace(',', '', $item['stock'] ?? 0);
                $total_purchase += (float)str_replace(',', '', $item['purchase_order'] ?? 0);
            }
        }
        
        $waste = max(0, $total_mto_weight - $total_bom_weight);
        $waste_percent = $total_bom_weight > 0 ? ($waste / $total_bom_weight) * 100 : 0;
        
        $stock_percent = $total_mto_weight > 0 ? ($total_stock / $total_mto_weight) * 100 : 0;
        $purchase_percent = $total_mto_weight > 0 ? ($total_purchase / $total_mto_weight) * 100 : 0;
    @endphp
    <div class="mto-summary">
        <div class="mto-summary-left">
            <div><span>Total weight in MTO</span> <strong>{{ number_format($total_mto_weight, 2) }} kg</strong></div>
            <div><span>Total weight in BOM</span> <strong>{{ number_format((float)$total_bom_weight, 2) }} kg</strong></div>
            <div style="margin-top:10px;"><span>Waste</span> <strong>{{ number_format($waste, 2) }} kg ({{ round($waste_percent) }}%)</strong></div>
        </div>
        <div class="mto-progress-bar">
            <div class="progress-item">
                <div class="progress-label"><span>Stock</span><span>{{ number_format($total_stock, 2) }} kg tersedia dari stok</span></div>
                <div class="progress-track"><div class="progress-fill blue" style="width: {{ min(100, $stock_percent) }}%;"></div></div>
            </div>
            <div class="progress-item">
                <div class="progress-label"><span>Purchase</span><span>Estimasi {{ round($purchase_percent) }}% dari total perlu dibeli ({{ number_format($total_purchase, 2) }} kg)</span></div>
                <div class="progress-track"><div class="progress-fill orange" style="width: {{ min(100, $purchase_percent) }}%;"></div></div>
            </div>
        </div>
    </div>
    
</div>

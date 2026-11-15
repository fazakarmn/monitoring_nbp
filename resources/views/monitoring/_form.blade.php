{{-- Shared form partial for create/edit project --}}

<div style="background-color: #ffffff; border: 1px solid #0f58e900; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0);">
    {{-- Card Header --}}
    <div style="padding: 16px 24px; border-bottom: 1px solid #f3f4f6;">
        <h5 style="margin: 0; font-size: 16px; font-weight: 700; color: #111827;">
            {{ __('messages.new_project_data') }}
        </h5>
    </div>

    {{-- Card Body --}}
    <div style="padding: 24px;">
        {{-- Baris 1: Customer, Bridge Type & Work Order --}}
        <div style="display: flex; gap: 16px; margin-bottom: 20px; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 250px;">
                <label for="customer" style="display: block; font-weight: 600; font-size: 14px; color: #374151; margin-bottom: 6px;">
                    Customer <span style="color: #ef4444;">*</span>
                </label>
                <input type="text" id="customer" name="customer"
                    value="{{ old('customer', $project->customer ?? '') }}"
                    placeholder="e.g. PT. XYZ" required
                    style="width: 100%; padding: 10px 12px; font-size: 14px; border: 1px solid #d1d5db; border-radius: 6px; outline: none; background-color: #fff;"
                    class="{{ $errors->has('customer') ? 'is-invalid' : '' }}">
                @error('customer')
                    <div style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="flex: 1; min-width: 250px;">
                <label for="work_order" style="display: block; font-weight: 600; font-size: 14px; color: #374151; margin-bottom: 6px;">
                    {{ __('messages.work_order') }} <span style="color: #ef4444;">*</span>
                </label>
                <input type="text" id="work_order" name="work_order"
                    value="{{ old('work_order', $project->work_order ?? '') }}"
                    placeholder="e.g. O0001" required
                    style="width: 100%; padding: 10px 12px; font-size: 14px; border: 1px solid #d1d5db; border-radius: 6px; outline: none; background-color: #fff;"
                    class="{{ $errors->has('work_order') ? 'is-invalid' : '' }}">
                @error('work_order')
                    <div style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="flex: 1; min-width: 250px;">
                <label for="bridge_type" style="display: block; font-weight: 600; font-size: 14px; color: #374151; margin-bottom: 6px;">
                    {{ __('messages.bridge_type') }} <span style="color: #ef4444;">*</span>
                </label>
                <input type="text" id="bridge_type" name="bridge_type"
                    value="{{ old('bridge_type', $project->bridge_type ?? '') }}"
                    placeholder="e.g. Girder A20" required
                    style="width: 100%; padding: 10px 12px; font-size: 14px; border: 1px solid #d1d5db; border-radius: 6px; outline: none; background-color: #fff;"
                    class="{{ $errors->has('bridge_type') ? 'is-invalid' : '' }}">
                @error('bridge_type')
                    <div style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Baris 2: Timeline Start & Timeline End --}}
        <div style="display: flex; gap: 16px; margin-bottom: 20px; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 250px;">
                <label for="timeline_start" style="display: block; font-weight: 600; font-size: 14px; color: #374151; margin-bottom: 6px;">
                    {{ __('messages.timeline_start') }} <span style="color: #ef4444;">*</span>
                </label>
                <input type="date" id="timeline_start" name="timeline_start"
                    value="{{ old('timeline_start', isset($project->timeline_start) ? $project->timeline_start->format('Y-m-d') : '') }}" required
                    style="width: 100%; padding: 10px 12px; font-size: 14px; border: 1px solid #d1d5db; border-radius: 6px; outline: none; background-color: #fff;"
                    class="{{ $errors->has('timeline_start') ? 'is-invalid' : '' }}">
                <small style="display: block; color: #6b7280; font-size: 12px; margin-top: 4px;">DD/MM/YYYY</small>
                @error('timeline_start')
                    <div style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="flex: 1; min-width: 250px;">
                <label for="timeline_end" style="display: block; font-weight: 600; font-size: 14px; color: #374151; margin-bottom: 6px;">
                    {{ __('messages.timeline_end') }} <span style="color: #ef4444;">*</span>
                </label>
                <input type="date" id="timeline_end" name="timeline_end"
                    value="{{ old('timeline_end', isset($project->timeline_end) ? $project->timeline_end->format('Y-m-d') : '') }}" required
                    style="width: 100%; padding: 10px 12px; font-size: 14px; border: 1px solid #d1d5db; border-radius: 6px; outline: none; background-color: #fff;"
                    class="{{ $errors->has('timeline_end') ? 'is-invalid' : '' }}">
                <small style="display: block; color: #6b7280; font-size: 12px; margin-top: 4px;">DD/MM/YYYY</small>
                @error('timeline_end')
                    <div style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="flex: 1; min-width: 250px;">
                <label for="contract_value" style="display: block; font-weight: 600; font-size: 14px; color: #374151; margin-bottom: 6px;">
                    {{ __('messages.contract_value') }} <span style="color: #ef4444;">*</span>
                </label>
                <div style="position: relative;">
                    <span style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #64748b; font-size: 14px; font-weight: 600;">Rp</span>
                    <input type="number" id="contract_value" name="contract_value"
                        value="{{ old('contract_value', isset($project) ? intval($project->contract_value) : '') }}"
                        placeholder="0" required
                        style="width: 100%; padding: 10px 12px 10px 40px; font-size: 14px; border: 1px solid #d1d5db; border-radius: 6px; outline: none; background-color: #fff;"
                        class="{{ $errors->has('contract_value') ? 'is-invalid' : '' }}">
                </div>
                @error('contract_value')
                    <div style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>
        </div>


    </div>
</div>

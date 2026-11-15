@extends('layouts.app')
@section('title', __('messages.monitoring'))

@section('content')

<div class="page-header">
    <h1 class="page-title">{{ __('messages.monitoring') }}</h1>
    <nav class="breadcrumb">
        <a href="{{ route('dashboard') }}">{{ __('messages.dashboard') }}</a>
        <span class="sep">›</span>
        <span class="current">{{ __('messages.monitoring') }}</span>
    </nav>
</div>

{{-- Toolbar --}}
<div class="monitoring-toolbar">
    <div style="font-weight:700; font-size:15px; color:var(--text-dark);">{{ __('messages.project') }}</div>

    <div class="monitoring-filters">
        <form action="{{ route('monitoring.index') }}" method="GET" style="display:flex; gap:8px; align-items:center;">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="{{ __('messages.search_work_order') }}"
                class="form-control"
                style="width:180px; padding:7px 12px;">
        </form>

        <a href="{{ route('monitoring.create') }}" class="btn btn-primary btn-sm">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            {{ __('messages.add_project') }}
        </a>
    </div>
</div>

{{-- Table --}}
<div class="card" style="padding:0; overflow:hidden;">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>{{ __('messages.contract_value') }}</th>
                    <th>{{ __('messages.work_order') }}</th>
                    <th>{{ __('messages.bridge_type') }}</th>
                    <th>{{ __('messages.timeline') }}</th>
                    <th>{{ __('messages.bill_of_quantity') }}</th>
                    <th>{{ __('messages.bill_of_payment') }}</th>
                    <th>{{ __('messages.design_engineering') }}</th>
                    <th>{{ __('messages.bill_of_material') }}</th>
                    <th>{{ __('messages.material_take_off') }}</th>
                    <th>{{ __('messages.material_procurement') }}</th>
                    <th>{{ __('messages.fabrication') }}</th>
                    <th>{{ __('messages.galvanized') }}</th>
                    <th>{{ __('messages.delivery') }}</th>
                    <th>{{ __('messages.status') }}</th>
                    <th>{{ __('messages.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr>
                    <td class="fw-600">{{ $project->customer }}</td>
                    <td class="fw-600">Rp {{ number_format($project->contract_value ?? 0, 0, ',', '.') }}</td>
                    <td style="color:var(--text-mid);">{{ $project->work_order }}</td>
                    <td class="fw-600">{{ $project->bridge_type }}</td>
                    <td style="font-size:12px; color:var(--text-mid);">
                        {{ $project->timeline_start->format('d-m-Y') }}<br>
                        {{ $project->timeline_end->format('d-m-Y') }}
                    </td>
                    <td>{{ $project->bill_of_quantity_ton ? $project->bill_of_quantity_ton . ' ton' : '-' }}</td>
                    {{-- Progress Badges --}}
                    <td>@include('monitoring._prog_badge', ['v' => $project->prog_bill_of_payment])</td>
                    <td>@include('monitoring._prog_badge', ['v' => $project->prog_design_engineering])</td>
                    <td>@include('monitoring._prog_badge', ['v' => $project->prog_bill_of_material])</td>
                    <td>@include('monitoring._prog_badge', ['v' => $project->prog_material_take_off])</td>
                    <td>@include('monitoring._prog_badge', ['v' => $project->prog_material_procurement])</td>
                    <td>@include('monitoring._prog_badge', ['v' => $project->prog_fabrication])</td>
                    <td>@include('monitoring._prog_badge', ['v' => $project->prog_galvanized])</td>
                    <td>@include('monitoring._prog_badge', ['v' => $project->prog_delivery])</td>

                    {{-- Status --}}
                    <td>
                        @if($project->status === 'done')
                            <span class="badge badge-done">Done</span>
                        @elseif($project->status === 'on-going')
                            <span class="badge badge-ongoing">On-Going</span>
                        @else
                            <span class="badge badge-pending">Pending</span>
                        @endif
                    </td>

                    {{-- Actions --}}
                    <td>
                        <div style="display:flex; gap:4px;">
                            <a href="{{ route('monitoring.show', $project) }}" class="btn-icon" title="{{ __('messages.view') }}">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <a href="{{ route('monitoring.edit', $project) }}" class="btn-icon" title="{{ __('messages.edit') }}">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <button type="button" class="btn-icon delete" title="{{ __('messages.delete') }}" onclick="openDeleteModal('{{ route('monitoring.destroy', $project) }}')">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="15" style="text-align:center; color:var(--text-light); padding:40px;">
                        {{ __('messages.no_projects') }} <a href="{{ route('monitoring.create') }}" class="text-primary">{{ __('messages.add_project') }}</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($projects->hasPages())
    <div class="pagination-wrapper" style="padding:6px 2px;">
        {{ $projects->withQueryString()->links() }}
    </div>
    @endif
</div>

<!-- Custom Delete Modal -->
<div id="customDeleteModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-title">{{ __('messages.delete_project') }}</div>
        <div class="modal-subtitle">{{ __('messages.delete_confirm') }}</div>
        
        <div class="modal-actions">
            <button type="button" class="btn-modal-cancel" onclick="closeDeleteModal()">{{ __('messages.cancel') }}</button>
            <form id="deleteProjectForm" method="POST" style="margin: 0; display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-modal-delete">{{ __('messages.delete') }}</button>
            </form>
        </div>
    </div>
</div>

<style>
    .modal-overlay {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.5);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 2000;
    }
    .modal-overlay.active {
        display: flex;
    }
    .modal-content {
        background: #ffffff;
        padding: 32px 40px;
        border-radius: 8px;
        width: 100%;
        max-width: 380px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        text-align: center;
    }
    .modal-title {
        color: #354259;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 10px;
    }
    .modal-subtitle {
        color: #6c7a89;
        font-size: 13px;
        margin-bottom: 28px;
    }
    .modal-actions {
        display: flex;
        justify-content: center;
        gap: 16px;
    }
    .btn-modal-cancel {
        background: #ffffff;
        border: 1px solid #354259;
        color: #354259;
        padding: 9px 0;
        border-radius: 4px;
        font-weight: 600;
        cursor: pointer;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 14px;
        width: 130px;
        transition: all 0.2s;
    }
    .btn-modal-cancel:hover {
        background: #f8f9fa;
    }
    .btn-modal-delete {
        background: #354259;
        border: 1px solid #354259;
        color: #ffffff;
        padding: 9px 0;
        border-radius: 4px;
        font-weight: 600;
        cursor: pointer;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 14px;
        width: 130px;
        transition: all 0.2s;
    }
    .btn-modal-delete:hover {
        background: #2a3547;
    }
</style>

@push('scripts')
<script>
    function openDeleteModal(actionUrl) {
        document.getElementById('deleteProjectForm').action = actionUrl;
        document.getElementById('customDeleteModal').classList.add('active');
    }

    function closeDeleteModal() {
        document.getElementById('customDeleteModal').classList.remove('active');
        document.getElementById('deleteProjectForm').action = '';
    }
</script>
@endpush

@endsection

@extends('layouts.app')
@section('title', 'Dokumen')

@section('content')

<div class="page-header">
    <h1 class="page-title">Dokumen</h1>
    <nav class="breadcrumb">
        <a href="{{ route('dashboard') }}">{{ __('messages.dashboard') }}</a>
        <span class="sep">&bull;</span>
        <span class="current">Dokumen</span>
    </nav>
</div>

<div class="card" style="padding: 24px; margin-bottom: 24px;">
    <form method="GET" action="{{ route('documents') }}">
        <div style="display: flex; gap: 16px; align-items: flex-end;">
            <div style="flex: 1; max-width: 300px;">
                <label for="work_order" style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Pilih Work Order</label>
                <select name="work_order" id="work_order" style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 6px; outline: none;">
                    <option value="">-- Pilih Work Order --</option>
                    @foreach($projects as $p)
                        <option value="{{ $p->work_order }}" {{ request('work_order') == $p->work_order ? 'selected' : '' }}>
                            {{ $p->work_order }} - {{ $p->bridge_type }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary" style="padding: 10px 20px; font-weight: 600; border-radius: 6px; background-color: var(--primary); color: white; border: none; cursor: pointer;">Tampilkan</button>
            </div>
        </div>
    </form>
</div>

@if(isset($selectedProject))
    @php
        $project = $selectedProject; // Aliasing for the partial
    @endphp
    @include('monitoring._show_content')
@else
    @if(request()->has('work_order'))
        <div class="card" style="padding: 24px; text-align: center; color: #6b7280;">
            Data tidak ditemukan untuk Work Order tersebut.
        </div>
    @else
        <div class="card" style="padding: 24px; text-align: center; color: #6b7280;">
            Silakan pilih Work Order untuk menampilkan dokumen dan data.
        </div>
    @endif
@endif

@endsection
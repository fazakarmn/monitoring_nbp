@extends('layouts.app')
@section('title', __('messages.add_project'))

@section('content')
<div class="page-header">
    <h1 class="page-title">{{ __('messages.add_project') }}</h1>
    <nav class="breadcrumb">
        <a href="{{ route('dashboard') }}">{{ __('messages.dashboard') }}</a>
        <span class="sep">›</span>
        <a href="{{ route('monitoring.index') }}">{{ __('messages.monitoring') }}</a>
        <span class="sep">›</span>
        <span class="current">{{ __('messages.add_project') }}</span>
    </nav>
</div>

<div class="card" style="max-width: 1920px;">
    <div class="card-header">
        <h2 class="card-title">{{ __('messages.new_project_data') }}</h2>
    </div>

    <form action="{{ route('monitoring.store') }}" method="POST">
        @csrf
        @php $project = null; @endphp
        @include('monitoring._form')

        <div style="display:flex; gap:8px; justify-content:flex-end; margin-top:8px;">
            <a href="{{ route('monitoring.index') }}" class="btn btn-outline">{{ __('messages.back') }}</a>
            <button type="submit" class="btn btn-primary">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                {{ __('messages.save_project') }}
            </button>
        </div>
    </form>
</div>
@endsection

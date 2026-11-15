@extends('layouts.app')
@section('title', __('messages.detail_project'))

@section('content')

<div class="page-header">
    <h1 class="page-title">{{ __('messages.detail_project') }}</h1>
    <nav class="breadcrumb">
        <a href="{{ route('dashboard') }}">{{ __('messages.dashboard') }}</a>
        <span class="sep">&bull;</span>
        <a href="{{ route('monitoring.index') }}">{{ __('messages.monitoring') }}</a>
        <span class="sep">&bull;</span>
        <span class="current">{{ __('messages.detail_project') }}</span>
    </nav>
</div>

@include('monitoring._show_content', ['comments' => $comments ?? null,])

@endsection

@extends('layouts.app')
@section('title', __('messages.settings') ?? 'Settings')

@section('content')
<div class="page-header">
    <h1 class="page-title">{{ __('messages.settings') ?? 'Settings' }}</h1>
    <nav class="breadcrumb">
        <a href="{{ route('dashboard') }}">{{ __('messages.dashboard') ?? 'Dashboard' }}</a>
        <span class="sep">›</span>
        <span class="current">{{ __('messages.settings') ?? 'Settings' }}</span>
    </nav>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header"><h2 class="card-title">{{ __('messages.profile_information') ?? 'Profile Information' }}</h2></div>
            <div class="card-body">
                <form action="{{ route('settings.profile') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group mb-3">
                        <label class="form-label">{{ __('messages.name') ?? 'Name' }}</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', auth()->user()->name) }}" required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="form-label">{{ __('messages.email') ?? 'Email' }}</label>
                        <input type="email" class="form-control" value="{{ auth()->user()->email }}" readonly style="background:#F8FAFC;">
                        <small class="text-muted">{{ __('messages.email_cannot_be_changed') ?? 'Email cannot be changed.' }}</small>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('messages.save') ?? 'Save' }}</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header"><h2 class="card-title">{{ __('messages.update_password') ?? 'Update Password' }}</h2></div>
            <div class="card-body">
                <form action="{{ route('settings.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group mb-3">
                        <label class="form-label">{{ __('messages.current_password') ?? 'Current Password' }}</label>
                        <div style="position: relative;">
                            <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required style="padding-right: 40px;">
                            <button type="button" class="toggle-password" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #64748b; padding: 0;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="eye-icon"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </button>
                        </div>
                        @error('current_password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">{{ __('messages.new_password') ?? 'New Password' }}</label>
                        <div style="position: relative;">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required style="padding-right: 40px;">
                            <button type="button" class="toggle-password" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #64748b; padding: 0;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="eye-icon"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </button>
                        </div>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">{{ __('messages.confirm_password') ?? 'Confirm Password' }}</label>
                        <div style="position: relative;">
                            <input type="password" name="password_confirmation" class="form-control" required style="padding-right: 40px;">
                            <button type="button" class="toggle-password" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #64748b; padding: 0;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="eye-icon"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('messages.save') ?? 'Save' }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('.toggle-password');
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const icon = this.querySelector('svg');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
                } else {
                    input.type = 'password';
                    icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
                }
            });
        });
    });
</script>
@endpush

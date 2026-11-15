@extends('layouts.app')
@section('title', __('messages.users'))

@section('content')
<div class="page-header">
    <h1 class="page-title">{{ __('messages.users') }}</h1>
    <nav class="breadcrumb">
        <a href="{{ route('dashboard') }}">{{ __('messages.dashboard') }}</a>
        <span class="sep">›</span>
        <span class="current">{{ __('messages.users') }}</span>
    </nav>
</div>

@if(session('error'))
<div style="margin-bottom: 16px; padding: 12px 16px; background-color: #fee2e2; border: 1px solid #fecaca; border-radius: 8px; color: #dc2626; font-size: 14px; font-weight: 500;">
    ⚠️ {{ session('error') }}
</div>
@endif

<div class="card" style="padding:0; overflow:hidden;">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.email') }}</th>
                    <th>Peran</th>
                    <th>Bergabung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $i => $user)
                <tr>
                    <td style="color:var(--text-light);">{{ $i + 1 }}</td>
                    <td>
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div class="activity-avatar" style="width:32px; height:32px; font-size:13px;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <span class="fw-600">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td style="color:var(--text-mid);">{{ $user->email }}</td>
                    <td>
                        @if(auth()->user()->role === 'Direksi')
                        <form action="{{ route('users.update', $user->id) }}" method="POST" style="margin: 0;">
                            @csrf
                            @method('PUT')
                            <select name="role" onchange="this.form.submit()" style="padding: 6px 12px; border: 1px solid #e2e8f0; border-radius: 6px; background-color: #f1f5f9; color: #334155; font-size: 13px; font-weight: 600; cursor: pointer; outline: none; appearance: none; padding-right: 24px; background-image: url('data:image/svg+xml;utf8,<svg fill=\'%2364748b\' height=\'20\' viewBox=\'0 0 24 24\' width=\'20\' xmlns=\'http://www.w3.org/2000/svg\'><path d=\'M7 10l5 5 5-5z\'/></svg>'); background-repeat: no-repeat; background-position: right 4px center;">
                                @php
                                    $roles = ['Direksi', 'Fabrikasi', 'Marketing', 'PPIC', 'Purchasing', 'Design & Engineering', 'Staff / Operator', 'project-control', 'tukangan'];
                                    $currentRole = $user->role ?? 'Staff / Operator';
                                @endphp
                                @foreach($roles as $role)
                                    <option value="{{ $role }}" {{ $currentRole === $role ? 'selected' : '' }}>{{ $role }}</option>
                                @endforeach
                            </select>
                        </form>
                        @else
                        @php
                            $currentRole = $user->role ?? 'Staff / Operator';
                        @endphp
                        <span style="display:inline-block; padding: 6px 12px; border: 1px solid #e2e8f0; border-radius: 6px; background-color: #f8fafc; color: #94a3b8; font-size: 13px; font-weight: 600;">
                            {{ $currentRole }}
                        </span>
                        @endif
                    </td>
                    <td style="color:var(--text-light); font-size:12px;">{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                        <div style="display:flex; align-items:center; gap:8px;">
                            <button type="button" onclick="alert('Modal pengaturan pengguna (Placeholder)')" style="background: none; border: 1px solid #e2e8f0; border-radius: 6px; padding: 6px; cursor: pointer; color: #64748b;" title="Edit">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                            @if(auth()->user()->role === 'Direksi')
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: #fee2e2; border: 1px solid #fecaca; border-radius: 6px; padding: 6px; cursor: pointer; color: #ef4444;" title="Delete">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.register') }} - PT Nusantara Baja Prima</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'montserrat', sans-serif;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .auth-container {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            box-sizing: border-box;
            text-align: center;
        }

        .auth-logo {
            margin-bottom: 12px;
        }

        .auth-logo img {
            max-width: 200px;
            height: auto;
        }

        .auth-brand {
            font-size: 22px;
            font-weight: 700;
            color: #354259;
            margin-bottom: 40px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .form-group {
            margin-bottom: 15px;
            position: relative;
        }

        .form-control, .form-select {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 1px solid #5a6a85;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 13px;
            color: #2D3748;
            outline: none;
            background-color: #ffffff;
            transition: border-color 0.3s, box-shadow 0.3s;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .form-control::placeholder {
            color: #2D3748;
            font-weight: 500;
        }

        .form-control:focus, .form-select:focus {
            border-color: #55b2ff;
        }

        .form-select {
            color: #2c3e50;
            font-weight: 700;
            cursor: pointer;
        }

        .form-select option {
            font-weight: normal;
            color: #333333;
            padding: 8px;
        }

        .form-icon {
            position: absolute;
            top: 50%;
            left: 18px;
            transform: translateY(-50%);
            color: #3b4859;
            font-size: 14px;
            pointer-events: none;
        }

        .select-icon {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            color: #3b4859;
            font-size: 13px;
            pointer-events: none;
        }

        .btn-outline-primary {
            width: 100%;
            padding: 12px;
            background-color: transparent;
            color: #55b2ff;
            border: 1px solid #55b2ff;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 15px;
            margin-bottom: 20px;
        }

        .btn-outline-primary:hover {
            background-color: #f4faff;
            border-color: #3bb0ff;
        }

        .login-link {
            margin-top: 15px;
            font-size: 12px;
            color: #5a6a85;
            font-weight: 500;
        }

        .login-link a {
            color: #55b2ff;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 10px;
            background-color: #f8d7da;
            color: #721c24;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
            text-align: left;
            border: 1px solid #f5c6cb;
        }

        .alert ul {
            margin: 0;
            padding-left: 18px;
        }

        /* Language switcher on auth page */
        .auth-lang-switcher {
            display: flex;
            justify-content: flex-end;
            gap: 4px;
            margin-bottom: 16px;
        }
        .auth-lang-btn {
            padding: 4px 10px;
            border-radius: 16px;
            font-size: 11px;
            font-weight: 700;
            text-decoration: none;
            letter-spacing: 0.5px;
            color: #64748B;
            background: #F1F5F9;
            border: none;
            transition: all 0.2s;
        }
        .auth-lang-btn.active {
            background: #354259;
            color: #ffffff;
        }
    </style>
</head>
<body>

<div class="auth-container">
    {{-- Language Switcher --}}
    <div class="auth-lang-switcher">
        <a href="{{ route('lang.switch', 'id') }}" class="auth-lang-btn {{ app()->getLocale() === 'id' ? 'active' : '' }}">ID</a>
        <a href="{{ route('lang.switch', 'en') }}" class="auth-lang-btn {{ app()->getLocale() === 'en' ? 'active' : '' }}">EN</a>
    </div>

    <div class="auth-logo">
        <img src="{{ asset('img/logo.png') }}" alt="Logo nBp">
    </div>
    
    <div class="auth-brand">PT NUSANTARA BAJA PRIMA</div>

    @if($errors->any())
        <div class="alert">
            <ul style="margin: 0; padding-left: 16px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.post') }}" method="POST">
        @csrf

        <!-- Username -->
        <div class="form-group">
            <i class="fa-solid fa-user form-icon"></i>
            <input
                type="text"
                id="name"
                name="name"
                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                value="{{ old('name') }}"
                placeholder="{{ __('messages.username') }}"
                required
                autofocus>
        </div>

        <!-- Email -->
        <div class="form-group">
            <i class="fa-solid fa-user form-icon"></i>
            <input
                type="email"
                id="email"
                name="email"
                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                value="{{ old('email') }}"
                placeholder="{{ __('messages.email') }}"
                required>
        </div>

        <!-- Role Dropdown -->
        <!-- <div class="form-group">
            <i class="fa-solid fa-user form-icon"></i>
            <select
                id="role"
                name="role"
                class="form-select {{ $errors->has('role') ? 'is-invalid' : '' }}"
                required>
                <option value="" disabled {{ old('role') ? '' : 'selected' }} hidden>{{ __('messages.role') }}</option>
                @foreach($roles as $roleOption)
                    <option value="{{ $roleOption }}" {{ old('role') == $roleOption ? 'selected' : '' }}>
                        {{ $roleOption }}
                    </option>
                @endforeach
            </select>
            <i class="fa-solid fa-chevron-down select-icon"></i>
        </div> -->

        <!-- Password -->
        <div class="form-group">
            <i class="fa-solid fa-lock form-icon"></i>
            <input
                type="password"
                id="password"
                name="password"
                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                placeholder="{{ __('messages.password') }}"
                required>
        </div>

        <button type="submit" class="btn-outline-primary">
            {{ __('messages.register') }}
        </button>
    </form>

    <div class="login-link">
        {{ __('messages.already_account') }} <a href="{{ route('login') }}">{{ __('messages.login') }}</a>
    </div>
</div>

</body>
</html>

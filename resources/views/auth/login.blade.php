<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login PT Nusantara Baja Prima</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
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

        .form-control {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 1px solid #a0aabf;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 13px;
            color: #333;
            outline: none;
            transition: border-color 0.3s;
        }

        .form-control::placeholder {
            color: #5a6a85;
            font-weight: 500;
        }

        .form-control:focus {
            border-color: #55b2ff;
        }

        .form-icon {
            position: absolute;
            top: 50%;
            left: 18px;
            transform: translateY(-50%);
            color: #5a6a85;
            font-size: 14px;
        }

        .forgot-password {
            display: block;
            text-align: right;
            font-size: 12px;
            color: #55b2ff;
            text-decoration: none;
            margin-bottom: 25px;
            font-weight: 500;
        }

        .forgot-password:hover {
            text-decoration: underline;
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
        }

        .btn-outline-primary:hover {
            background-color: #f4faff;
        }

        .register-link {
            margin-top: 15px;
            font-size: 12px;
            color: #5a6a85;
            font-weight: 500;
        }

        .register-link a {
            color: #55b2ff;
            text-decoration: none;
        }

        .register-link a:hover {
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
    
    <div class="auth-brand">PT Nusantara Baja Prima</div>

    @if($errors->any())
        <div class="alert alert-error">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login.post') }}" method="POST">
        @csrf

        <div class="form-group">
            <i class="fa-solid fa-user form-icon"></i>
            <input
                type="text"
                id="email"
                name="email"
                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                value="{{ old('email') }}"
                placeholder="{{ __('messages.email') }}"
                required
                autofocus>
        </div>

        <div class="form-group">
            <i class="fa-solid fa-lock form-icon"></i>
            <input
                type="password"
                id="password"
                name="password"
                class="form-control"
                placeholder="{{ __('messages.password') }}"
                required>
        </div>

        <a href="#" class="forgot-password">{{ __('messages.forgot_password') }}</a>

        <button type="submit" class="btn-outline-primary">
            {{ __('messages.sign_in') }}
        </button>
    </form>

    <div class="register-link">
        {{ __('messages.no_account') }} <a href="{{ route('register') }}">{{ __('messages.register') }}</a>
    </div>
</div>

</body>
</html>
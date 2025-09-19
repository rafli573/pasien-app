<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Manajemen Pasien</title>
    <style>
        /* --- RESET --- */
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);
            min-height:100vh; display:flex; align-items:center; justify-content:center;
            padding:1rem;
        }

        /* --- PARTIKEL BACKGROUND --- */
        .particles { position:fixed; inset:0; overflow:hidden; z-index:0; pointer-events:none; }
        .particle {
            position:absolute; background:rgba(255,255,255,.1); border-radius:50%;
            animation:float 6s ease-in-out infinite;
        }
        .particle:nth-child(1){width:20px;height:20px;top:20%;left:20%;animation-delay:0s}
        .particle:nth-child(2){width:30px;height:30px;top:60%;left:80%;animation-delay:1s}
        .particle:nth-child(3){width:15px;height:15px;top:80%;left:40%;animation-delay:2s}
        .particle:nth-child(4){width:25px;height:25px;top:30%;left:70%;animation-delay:3s}
        .particle:nth-child(5){width:18px;height:18px;top:70%;left:10%;animation-delay:4s}
        @keyframes float{
            0%,100%{transform:translateY(0) rotate(0deg);}
            50%{transform:translateY(-20px) rotate(180deg);}
        }

        /* --- KONTENER LOGIN --- */
        .login-container {
            background:rgba(255,255,255,.1); backdrop-filter:blur(20px);
            border-radius:20px; padding:3rem 2.5rem; max-width:450px; width:100%;
            border:1px solid rgba(255,255,255,.2); box-shadow:0 20px 40px rgba(0,0,0,.1);
            z-index:1;
        }
        .login-header{text-align:center;margin-bottom:2rem}
        .login-logo{font-size:3rem;margin-bottom:1rem;animation:pulse 2s infinite}
        @keyframes pulse{0%,100%{transform:scale(1)}50%{transform:scale(1.05)}}
        .login-title{font-size:2rem;font-weight:700;color:#fff;margin-bottom:.5rem}
        .login-subtitle{color:rgba(255,255,255,.8)}

        /* --- STATUS --- */
        .session-status{
            background:rgba(76,175,80,.2); border:1px solid rgba(76,175,80,.3);
            color:#4CAF50; padding:.8rem 1rem; border-radius:10px;
            margin-bottom:1.5rem; font-size:.9rem; text-align:center;
        }

        /* --- FORM --- */
        .form-group{margin-bottom:1.5rem}
        .form-label{display:block;color:#fff;font-weight:600;margin-bottom:.5rem}
        .form-input{
            width:100%; padding:1rem 1.2rem;
            border:2px solid rgba(255,255,255,.2); border-radius:12px;
            background:rgba(255,255,255,.1); color:#fff; font-size:1rem;
        }
        .form-input::placeholder{color:rgba(255,255,255,.6)}
        .form-input:focus{
            outline:none; border-color:rgba(255,255,255,.4);
            background:rgba(255,255,255,.15);
            box-shadow:0 0 20px rgba(255,255,255,.1);
        }
        .error-message{color:#ff6b6b;font-size:.85rem;margin-top:.4rem;display:block}

        /* --- CHECKBOX --- */
        .checkbox-group{display:flex;align-items:center;margin-bottom:1.5rem}
        .custom-checkbox{display:flex;align-items:center;cursor:pointer;position:relative}
        .custom-checkbox input{position:absolute;opacity:0;cursor:pointer}
        .checkmark{
            width:20px;height:20px;margin-right:.8rem;
            background:rgba(255,255,255,.1);border:2px solid rgba(255,255,255,.3);
            border-radius:4px;display:flex;align-items:center;justify-content:center;
        }
        .custom-checkbox input:checked ~ .checkmark{
            background:linear-gradient(45deg,#4CAF50,#45a049);border-color:#4CAF50;
        }
        .custom-checkbox input:checked ~ .checkmark::after{
            content:"✓";color:#fff;font-weight:bold;font-size:12px;
        }
        .checkbox-label{color:rgba(255,255,255,.9);font-size:.9rem}

        /* --- ACTIONS --- */
        .form-actions{display:flex;justify-content:space-between;align-items:center;margin-top:1rem}
        .forgot-password{
            color:rgba(255,255,255,.8);text-decoration:none;font-size:.9rem;
        }
        .forgot-password:hover{color:#fff;text-decoration:underline}
        .login-button{
            background:linear-gradient(45deg,#4CAF50,#45a049);color:#fff;
            border:none;padding:1rem 2rem;border-radius:12px;
            font-weight:600;font-size:1rem;cursor:pointer;
        }
        .login-button:hover{
            background:linear-gradient(45deg,#45a049,#4CAF50);
            box-shadow:0 6px 20px rgba(76,175,80,.4);
        }

        .login-footer{text-align:center;margin-top:2rem}
        .register-link{
            color:rgba(255,255,255,.8);text-decoration:none;font-size:.95rem;
        }
        .register-link strong{color:#4CAF50}
        .register-link:hover{color:#fff;text-decoration:underline}
    </style>
</head>
<body>
    <!-- Partikel latar -->
    <div class="particles">
        <div class="particle"></div><div class="particle"></div>
        <div class="particle"></div><div class="particle"></div><div class="particle"></div>
    </div>

    <div class="login-container">
        <div class="login-header">
            <div class="login-logo">🏥</div>
            <h1 class="login-title">Selamat Datang</h1>
            <p class="login-subtitle">Masuk ke Sistem Manajemen Pasien</p>
        </div>

        <!-- Status Session -->
        @if (session('status'))
            <div class="session-status">
                {{ session('status') }}
            </div>
        @endif

        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-input" type="email"
                       name="email" value="{{ old('email') }}"
                       required autofocus autocomplete="username"
                       placeholder="Masukkan email Anda">
                @if ($errors->has('email'))
                    <span class="error-message">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" class="form-input" type="password"
                       name="password" required autocomplete="current-password"
                       placeholder="Masukkan password Anda">
                @if ($errors->has('password'))
                    <span class="error-message">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="checkbox-group">
                <label for="remember_me" class="custom-checkbox">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span class="checkmark"></span>
                    <span class="checkbox-label">Ingat saya</span>
                </label>
            </div>

            <div class="form-actions">
                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif

                <button type="submit" class="login-button">
                    Masuk
                </button>
            </div>
        </form>

        <div class="login-footer">
            <a href="{{ route('register') }}" class="register-link">
                Belum punya akun? <strong>Daftar di sini</strong>
            </a>
        </div>
    </div>
</body>
</html>

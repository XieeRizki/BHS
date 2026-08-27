<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Balong Hardi Sumedang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg-dark: #0A0F1D;
            --card-bg: #111827;
            --accent-gold: #EAB308;
            --accent-gold-hover: #CA8A04;
            --text-light: #F9FAFB;
            --text-muted: #9CA3AF;
            --border-dark: rgba(255, 255, 255, 0.08);
            --danger: #EF4444;
        }

        body {
            background-color: var(--bg-dark);
            min-height: 100vh;
            min-height: 100dvh; /* Support mobile viewport height */
            display: flex;
            align-items: center;
            justify-content: center;
            padding: clamp(1rem, 3vw, 2rem);
            position: relative;
            overflow-x: hidden;
        }

        /* Ambient Glow Effect */
        body::before {
            content: '';
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: min(350px, 80vw);
            height: min(350px, 80vw);
            background: radial-gradient(circle, rgba(234, 179, 8, 0.12) 0%, rgba(0,0,0,0) 70%);
            pointer-events: none;
            z-index: 0;
        }

        .login-card {
            background: var(--card-bg);
            width: 100%;
            max-width: 420px;
            padding: clamp(1.75rem, 5vw, 2.5rem) clamp(1.25rem, 4vw, 2.25rem);
            border-radius: clamp(16px, 4vw, 24px);
            border: 1px solid var(--border-dark);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6);
            position: relative;
            z-index: 10;
        }

        .brand-header {
            text-align: center;
            margin-bottom: clamp(1.25rem, 4vw, 2rem);
        }

        .brand-logo-img {
            width: clamp(44px, 10vw, 56px);
            height: clamp(44px, 10vw, 56px);
            object-fit: contain;
            margin: 0 auto 0.75rem auto;
            display: block;
        }

        .brand-header h1 {
            font-weight: 900;
            color: var(--text-light);
            font-size: clamp(1.1rem, 3vw, 1.25rem);
            text-transform: uppercase;
            letter-spacing: -0.01em;
            line-height: 1.2;
        }

        .brand-header p {
            font-size: clamp(0.6rem, 2vw, 0.65rem);
            font-weight: 800;
            color: var(--accent-gold);
            letter-spacing: 0.2em;
            text-transform: uppercase;
            margin-top: 0.25rem;
        }

        .error-alert {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.25);
            color: #FCA5A5;
            font-size: 0.8rem;
            padding: 0.85rem 1rem;
            border-radius: 12px;
            margin-bottom: 1.25rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            word-break: break-word;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            color: var(--text-muted);
            font-size: 0.7rem;
            font-weight: 800;
            margin-bottom: 0.4rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper input {
            width: 100%;
            padding: 0.85rem 1rem;
            padding-right: 3.25rem; /* Space for toggle button */
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-dark);
            border-radius: 14px;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-light);
            transition: all 0.2s ease;
            -webkit-appearance: none;
        }

        .input-wrapper input::placeholder {
            color: #4B5563;
        }

        .input-wrapper input:focus {
            outline: none;
            border-color: var(--accent-gold);
            background: rgba(255, 255, 255, 0.05);
            box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.15);
        }

        .toggle-password {
            position: absolute;
            right: 0.5rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 0.75rem;
            font-weight: 700;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.5rem 0.6rem;
            border-radius: 8px;
            touch-action: manipulation;
        }

        .toggle-password:hover,
        .toggle-password:focus {
            color: var(--accent-gold);
            background: rgba(255, 255, 255, 0.05);
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            margin-top: 0.5rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            color: var(--text-muted);
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            user-select: none;
            touch-action: manipulation;
        }

        .remember-me input[type="checkbox"] {
            accent-color: var(--accent-gold);
            width: 18px;
            height: 18px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-submit {
            width: 100%;
            background: var(--accent-gold);
            color: #0A0A0A;
            border: none;
            padding: 0.9rem 1.5rem;
            border-radius: 14px;
            font-weight: 900;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 14px rgba(234, 179, 8, 0.25);
            touch-action: manipulation;
            -webkit-tap-highlight-color: transparent;
        }

        .btn-submit:hover {
            background: var(--accent-gold-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(234, 179, 8, 0.35);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .footer-copyright {
            text-align: center;
            margin-top: clamp(1.25rem, 3vw, 1.75rem);
            font-size: 0.7rem;
            color: #4B5563;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Mobile Adjustments */
        @media (max-width: 480px) {
            .input-wrapper input {
                font-size: 0.95rem; /* Cegah auto-zoom di iOS Safari */
            }

            .btn-submit {
                padding: 1rem 1.25rem;
            }
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="brand-header">
            <img src="{{ asset('images/logow.png') }}" alt="Logo Balong Hardi Sumedang" class="brand-logo-img" />
            <h1>Balong Hardi</h1>
            <p>Admin Panel Access</p>
        </div>

        @if ($errors->any())
            <div class="error-alert">
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email Akses</label>
                <div class="input-wrapper">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="admin@balonghardi.com" autocomplete="email">
                </div>
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" required placeholder="••••••••">
                    <button type="button" class="toggle-password" id="togglePasswordBtn" aria-label="Tampilkan Kata Sandi">Lihat</button>
                </div>
            </div>

            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember"> 
                    <span>Ingat Sesi Saya</span>
                </label>
            </div>

            <button type="submit" class="btn-submit">
                Masuk ke Admin
            </button>
        </form>

        <div class="footer-copyright">
            &copy; {{ date('Y') }} Balong Hardi Sumedang
        </div>
    </div>

    <script>
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passwordInput = document.getElementById('password');

        toggleBtn?.addEventListener('click', function () {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            this.textContent = isPassword ? 'Sembunyi' : 'Lihat';
        });
    </script>
</body>
</html>
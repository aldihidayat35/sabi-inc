<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            /* Gradasi cream elegan */
            background: linear-gradient(135deg, #fdf6e3 0%, #f5e8ca 50%, #f7d9aa 100%);
        }
        .login-card {
            border-radius: 18px;
            box-shadow: 0 6px 32px rgba(210, 180, 140, 0.10);
            background: #fffbea;
        }
        .logo-wrapper {
            text-align: center;
        }
        .logo-wrapper img {
            height: 64px;
            margin-bottom: 18px;
        }
        .login-narration {
            font-size: 1.08rem;
            color: #b08968;
            margin-bottom: 18px;
            text-align: center;
            font-weight: 500;
        }
        .form-label {
            font-weight: 500;
            color: #b08968;
        }
        .btn-primary {
            background: #b08968;
            border: none;
        }
        .btn-primary:hover {
            background: #a0764b;
        }
        .card {
            border: none;
        }
        .text-decoration-none {
            color: #b08968 !important;
        }
        .text-decoration-none:hover {
            color: #a0764b !important;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card login-card p-4" style="width: 100%; max-width: 410px;">
            <div class="logo-wrapper mb-3 pt-8">
                <a href="{{ url('/') }}">
                    <img alt="Logo" src="{{ asset('sabi.inc.png') }}" class="theme-light-show">
                </a>
            </div>

            <h2 class="text-center mb-4 fw-bold" style="letter-spacing:0.5px; color:#b08968;">Student Login</h2>
            <form action="{{ route('student.login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required autocomplete="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required autocomplete="current-password">
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
            </form>
            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    {{ $errors->first() }}
                </div>
            @endif
            <div class="text-center mt-3">
                <a href="{{ route('teacher.login') }}" class="text-decoration-none">Login sebagai Guru</a>
            </div>
            <div class="text-center mt-2">
                <a href="{{ route('student.register') }}" class="text-decoration-none">Belum punya akun? Registrasi</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

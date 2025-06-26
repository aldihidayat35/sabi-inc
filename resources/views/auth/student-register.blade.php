{{-- filepath: c:\xampp\htdocs\sabi-inc\resources\views\auth\student-register.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <style>
        body {
            background: linear-gradient(135deg, #fdf6e3 0%, #fceabb 100%);
            min-height: 100vh;
        }
        .card {
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.10);
            background: rgba(255,255,255,0.97);
            border: 1px solid #ffe5b4;
        }
        .form-control:focus {
            border-color: #ffd6a0;
            box-shadow: 0 0 0 0.2rem rgba(255,214,160,.15);
        }
        .btn-primary {
            background: linear-gradient(90deg, #ffe5b4 0%, #b5ead7 100%);
            color: #6d4c41;
            border: none;
            transition: background 0.3s, color 0.3s;
        }
        .btn-primary:hover {
            background: linear-gradient(90deg, #b5ead7 0%, #ffe5b4 100%);
            color: #fff;
        }
        .input-group-text {
            background: #fff8ee;
            border: none;
            color: #bfa27a;
        }
        label.form-label {
            color: #bfa27a;
            font-weight: 500;
        }
        .fw-bold, h2.fw-bold {
            color: #bfa27a !important;
        }
        .text-muted {
            color: #bfa27a !important;
        }
        .alert-danger {
            background: #ffe5e5;
            color: #bfa27a;
            border: 1px solid #ffd6a0;
        }
        .text-danger {
            color: #e57373 !important;
        }
        @media (max-width: 576px) {
            .card {
                padding: 1.5rem 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 w-100" style="max-width: 480px;">
            <div class="text-center mb-4">
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135768.png" alt="Student Icon" width="64" class="mb-2">
                <h2 class="fw-bold mb-1">Student Registration</h2>
                <p class="text-muted mb-0">Buat akun baru untuk siswa</p>
            </div>
            <form action="{{ route('student.register') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="mb-3">
                    <label for="nisn" class="form-label">NISN</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                        <input type="text" name="nisn" id="nisn" class="form-control" value="{{ old('nisn') }}" required>
                    </div>
                    @error('nisn')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
                    </div>
                    @error('nama')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-school"></i></span>
                        <input type="text" name="asal_sekolah" id="asal_sekolah" class="form-control" value="{{ old('asal_sekolah') }}" required>
                    </div>
                    @error('asal_sekolah')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="photo_profil" class="form-label">Photo Profil</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-image"></i></span>
                        <input type="file" name="photo_profil" id="photo_profil" class="form-control">
                    </div>
                    @error('photo_profil')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    @error('password')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                    <i class="fa-solid fa-user-plus me-2"></i> Register
                </button>
            </form>
            @if ($errors->has('register'))
                <div class="alert alert-danger mt-3">
                    {{ $errors->first('register') }}
                </div>
            @endif
            <div class="text-center mt-4">
                <span class="text-muted">Sudah punya akun?</span>
                <a href="{{ route('student.login') }}" class="text-decoration-none fw-semibold" style="color:#bfa27a;">Login</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

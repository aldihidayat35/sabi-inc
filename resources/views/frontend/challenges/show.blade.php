@extends('frontend.layouts.app')

@section('title', $challenge->name)

@section('content')
<div class="container my-5">
    <a href="{{ route('frontend.home') }}" class="btn btn-link mb-3 px-0">
        <i class="bi bi-arrow-left"></i> Kembali ke Beranda
    </a>
    <div class="card shadow-sm">
        @if ($challenge->cover_photo)
            <img src="{{ asset($challenge->cover_photo) }}" class="card-img-top" alt="Cover Photo" style="max-height:320px;object-fit:cover;">
        @endif
        <div class="card-body">
            <h1 class="fw-bold mb-2">{{ $challenge->name }}</h1>
            <div class="mb-3 text-muted small">
                <i class="bi bi-calendar-event"></i>
                {{ \Carbon\Carbon::parse($challenge->start_time)->format('d M Y') }}
                &ndash;
                {{ \Carbon\Carbon::parse($challenge->end_time)->format('d M Y') }}
            </div>
            <h5 class="fw-bold">Reward Diamond Points:</h5>
            <p>{{ $challenge->reward_diamond_points }}</p>
            <h5 class="fw-bold">Reward:</h5>
            <p>{{ $challenge->reward }}</p>
            <h5 class="fw-bold">Deskripsi:</h5>
            <p>{{ $challenge->details }}</p>

            {{-- Challenge Registration Form --}}
            @auth('student')
                @php
                    $alreadyRegistered = \App\Models\ChallengeRegistration::where('challenge_id', $challenge->id)
                        ->where('student_id', auth('student')->id())->exists();
                @endphp
                @if(!$alreadyRegistered)
                    <form method="POST" action="{{ route('frontend.challenges.register', $challenge->id) }}" class="mt-4">
                        @csrf
                        <div class="mb-3">
                            <label for="submission" class="form-label fw-bold">Link Google Drive (Jawaban / Submission)</label>
                            <input type="url" name="submission" id="submission" class="form-control" required placeholder="https://drive.google.com/..." value="{{ old('submission') }}">
                            <div class="form-text text-muted">
                                Upload jawaban Anda ke Google Drive, lalu tempelkan link drive di sini. Pastikan link dapat diakses oleh penilai.
                            </div>
                            @error('submission')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim </button>
                    </form>
                @else
                    <div class="alert alert-info mt-4">
                        Anda sudah mendaftar challenge ini.
                    </div>
                @endif
            @else
                <div class="alert alert-warning mt-4">
                    Silakan <a href="{{ route('student.login') }}">login sebagai siswa</a> untuk mendaftar challenge ini.
                </div>
            @endauth
            {{-- End Registration Form --}}
        </div>
    </div>
</div>

{{-- SweetAlert CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6'
        });
    @endif
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
            confirmButtonColor: '#d33'
        });
    @endif
</script>
@endsection

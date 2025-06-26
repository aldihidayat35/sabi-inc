@extends('frontend.layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container py-4">
        {{-- Profil Header --}}
        <a href="{{ route('student.profile.show', $student->id) }}" >

            <div class="card shadow-sm rounded-3 border-0 mb-4 px-4 py-4">

                <div class="d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-light mb-3"
                        style="width:120px; height:120px; background:linear-gradient(135deg,#ffe0d3,#ffd6e0);">
                        <img src="{{ asset($student->photo_profil ?? 'default.png') }}" alt="Avatar"
                            class="rounded-circle border" style="width:110px; height:110px; object-fit:cover;">
                    </div>
                    <div class="fw-bold mb-1" style="font-size:1.5rem;">{{ $student->nama ?? '-' }}</div>
                    <div class="text-muted mb-3" style="font-size:1.1rem;">{{ $student->email ?? '-' }}</div>
                    <form id="logout-form" action="{{ route('student.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <button id="logout-btn" type="button" class="btn btn-outline-danger px-4 py-2 fw-semibold" style="border-width:2px; border-radius: 24px;">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </button>
                </div>

            </div>
            {{-- End Profil Header --}}
        </a>

        <div class="card shadow-sm rounded-3 border-0 p-0">
            <div class="card-body pt-8">
                <ul class="list-group list-group-flush">

                    {{-- menu akun saya --}}
                    <li class="list-group-item d-flex align-items-center py-3 border-0 border-bottom" style="gap: 12px;">
                        <i class="bi bi-person me-3" style="font-size: 1.3rem; color: #795548;"></i>
                        <a href="{{ route('frontend.profil.detail') }}"
                            class="flex-grow-1 fw-medium text-decoration-none text-dark">Akun Saya</a>
                        <i class="bi bi-chevron-right ms-auto text-muted"></i>
                    </li>
                    {{-- end menu akun saya  --}}
                    {{-- <li class="list-group-item d-flex align-items-center py-3 border-0 border-bottom" style="gap: 12px;">
                        <i class="bi bi-geo-alt me-3" style="font-size: 1.3rem; color: #795548;"></i>
                        <span class="flex-grow-1 fw-medium">Bio</span>
                        <i class="bi bi-chevron-right ms-auto text-muted"></i>
                    </li> --}}
                    {{-- menu  karya saya --}}
                    <li class="list-group-item d-flex align-items-center py-3 border-0 border-bottom" style="gap: 12px;">
                        <i class="bi bi-folder me-3" style="font-size: 1.3rem; color: #795548;"></i>
                        <a href="{{ route('frontend.karya-saya') }}"
                            class="flex-grow-1 fw-medium text-decoration-none text-dark">Karya Saya</a>
                        <i class="bi bi-chevron-right ms-auto text-muted"></i>
                    </li>
                    <li class="list-group-item d-flex align-items-center py-3 border-0 border-bottom" style="gap: 12px;">
                        <i class="bi bi-star me-3" style="font-size: 1.3rem; color: #795548;"></i>
                        <a href="{{ route('frontend.penilaian-guru') }}"
                            class="flex-grow-1 fw-medium text-decoration-none text-dark">Penilaian Guru</a>
                        <i class="bi bi-chevron-right ms-auto text-muted"></i>
                    </li>
                    {{-- menu favorit saya --}}
                    <li class="list-group-item d-flex align-items-center py-3 border-0 border-bottom" style="gap: 12px;">
                        <i class="bi bi-heart me-3" style="font-size: 1.3rem; color: #e53935;"></i>
                        <a href="{{ route('frontend.favorit-saya') }}"
                            class="flex-grow-1 fw-medium text-decoration-none text-dark">Favorit Saya</a>
                        <i class="bi bi-chevron-right ms-auto text-muted"></i>
                    </li>
                    {{-- end menu favorit saya --}}
                    {{-- menu tentang sabi --}}
                    <li class="list-group-item d-flex align-items-center py-3 border-0 border-bottom" style="gap: 12px;">
                        <i class="bi bi-info-circle me-3" style="font-size: 1.3rem; color: #795548;"></i>
                        <a href="{{ route('frontend.tentang-sabi') }}"
                            class="flex-grow-1 fw-medium text-decoration-none text-dark">Tentang SABI</a>
                        <i class="bi bi-chevron-right ms-auto text-muted"></i>
                    </li>
                    <li class="list-group-item d-flex align-items-center py-3 border-0" style="gap: 12px;">
                        <i class="bi bi-question-circle me-3" style="font-size: 1.3rem; color: #795548;"></i>
                        <span class="flex-grow-1 fw-medium">Help Center</span>
                        <i class="bi bi-chevron-right ms-auto text-muted"></i>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- SweetAlert2 CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('logout-btn').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Logout?',
                text: 'Apakah Anda yakin ingin keluar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        });
    </script>
@endsection

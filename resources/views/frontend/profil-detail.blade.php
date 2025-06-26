@extends('frontend.layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container px-0" style="max-width: 430px;">
    {{-- Header --}}
    <div class="d-flex align-items-center py-3 px-2 border-bottom shadow-sm sticky-top" style="z-index:10;">
        <h5 class="mb-0 fw-bold flex-grow-1 text-center" style="letter-spacing:0.5px;color:#795548;">Profil Saya</h5>
    </div>
    {{-- Profile Picture --}}
    <div class="d-flex flex-column align-items-center py-4" >
        <div class="rounded-circle overflow-hidden mb-2 shadow" style="width:100px;height:100px;border:4px solid #e0cfc2;">
            <img src="{{ asset($student->photo_profil ?? 'default.png') }}" alt="Avatar" style="width:100%;height:100%;object-fit:cover;">
        </div>
    </div>
    {{-- Form --}}
    <form class="px-4 py-4" autocomplete="off" method="POST" action="{{ route('frontend.profil.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label fw-semibold" style="color:#795548;">Foto Profil</label>
            <input type="file" class="form-control" name="photo_profil" accept="image/*">
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold" style="color:#795548;">NISN</label>
            <input type="text" class="form-control rounded-3" name="nisn" value="{{ old('nisn', $student->nisn) }}">
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold" style="color:#795548;">Nama</label>
            <input type="text" class="form-control rounded-3" name="nama" value="{{ old('nama', $student->nama) }}">
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold" style="color:#795548;">Email</label>
            <input type="email" class="form-control rounded-3" name="email" value="{{ old('email', $student->email) }}">
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold" style="color:#795548;">Asal Sekolah</label>
            <input type="text" class="form-control rounded-3" name="asal_sekolah" value="{{ old('asal_sekolah', $student->asal_sekolah) }}">
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold" style="color:#795548;">Password Baru <span class="text-muted" style="font-weight:normal;font-size:0.9em;">(Kosongkan jika tidak ingin mengubah)</span></label>
            <input type="password" class="form-control rounded-3" name="password" autocomplete="new-password">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('title', $title)

@section('content')
<!--begin::Breadcrumb-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}" class="text-gray-600 text-hover-primary">Dashboard</a>
        </li>
        @if (isset($breadcrumbs))
            @foreach ($breadcrumbs as $breadcrumb)
                <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                    @if (!$loop->last)
                        <a href="{{ $breadcrumb['url'] }}" class="text-gray-600 text-hover-primary">{{ $breadcrumb['label'] }}</a>
                    @else
                        {{ $breadcrumb['label'] }}
                    @endif
                </li>
            @endforeach
        @endif
    </ol>
</nav>
<!--end::Breadcrumb-->

<!--begin::Page Header-->
<div class="mb-4">
    <h1 class="text-dark fw-bold">{{ $title }}</h1>
    <p class="text-muted">{{ $description }}</p>
</div>
<!--end::Page Header-->

<div class="card">
    <div class="card-body">
        <form action="{{ route('teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" name="nip" id="nip" class="form-control" value="{{ $teacher->nip }}" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $teacher->email }}" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ $teacher->nama }}" required>
                </div>
                <div class="col-md-6">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="{{ $teacher->tempat_lahir }}" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ $teacher->tanggal_lahir }}" required>
                </div>
                <div class="col-md-6">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" required>{{ $teacher->alamat }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="photo_profil" class="form-label">Photo Profil</label>
                    <input type="file" name="photo_profil" id="photo_profil" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select name="level" id="status" class="form-control" required>
                        <option value="">Pilih Status</option>
                        <option value="admin" {{ $teacher->level == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="teacher" {{ $teacher->level == 'teacher' ? 'selected' : '' }}>Teacher</option>
                    </select>
                    @error('level')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter new password">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection

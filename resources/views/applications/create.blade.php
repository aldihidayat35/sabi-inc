@extends('layouts.app')

@section('title', $title)

@section('content')
<!--begin::Page Header-->
<div class="mb-4">
    <h1 class="text-dark fw-bold">{{ $title }}</h1>
    <p class="text-muted">{{ $description }}</p>
</div>
<!--end::Page Header--><!--begin::Breadcrumb-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">

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



<div class="card">
    <div class="card-body">
        <form action="{{ route('applications.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nama_institusi" class="form-label">Nama Institusi</label>
                    <input type="text" name="nama_institusi" id="nama_institusi" class="form-control" placeholder="Enter institution name" required>
                </div>
                <div class="col-md-6">
                    <label for="nama_pengelola" class="form-label">Nama Pengelola</label>
                    <input type="text" name="nama_pengelola" id="nama_pengelola" class="form-control" placeholder="Enter manager name" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="tahun" class="form-label">Tahun</label>
                    <input type="number" name="tahun" id="tahun" class="form-control" placeholder="Enter year" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection

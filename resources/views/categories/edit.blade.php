@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
<!--begin::Breadcrumb-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}" class="text-gray-600 text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('categories.index') }}" class="text-gray-600 text-hover-primary">Categories</a>
        </li>
        <li class="breadcrumb-item active">Edit Category</li>
    </ol>
</nav>
<!--end::Breadcrumb-->

<!--begin::Page Header-->
<div class="mb-4">
    <h1 class="text-dark fw-bold">Edit Category</h1>
    <p class="text-muted">Update the details of the selected category.</p>
</div>
<!--end::Page Header-->

<div class="card">
    <div class="card-body">
        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="logo" class="form-label">Logo</label>
                <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
                @if($category->logo)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $category->logo) }}" alt="Logo" width="60" height="60" style="object-fit:contain;">
                    </div>
                @endif
                @error('logo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection

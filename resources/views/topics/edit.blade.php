@extends('layouts.app')

@section('title', 'Edit Topic')

@section('content')
<!--begin::Breadcrumb-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}" class="text-gray-600 text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('topics.index') }}" class="text-gray-600 text-hover-primary">Topics</a>
        </li>
        <li class="breadcrumb-item active">Edit Topic</li>
    </ol>
</nav>
<!--end::Breadcrumb-->

<!--begin::Page Header-->
<div class="mb-4">
    <h1 class="text-dark fw-bold">Edit Topic</h1>
    <p class="text-muted">Update the details of the selected topic.</p>
</div>
<!--end::Page Header-->

<div class="card">
    <div class="card-body">
        <form action="{{ route('topics.update', $topic->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $topic->title }}" required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Description</label>
                <textarea name="description" id="description" class="form-control">{{ $topic->description }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="cover_photo" class="form-label fw-bold">Cover Photo</label>
                <input type="file" name="cover_photo" id="cover_photo" class="form-control">
                @error('cover_photo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="reward_diamond" class="form-label fw-bold">Reward Diamond</label>
                <input type="number" name="reward_diamond" id="reward_diamond" class="form-control" value="{{ $topic->reward_diamond }}" required>
                @error('reward_diamond')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection

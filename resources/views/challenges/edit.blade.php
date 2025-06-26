@extends('layouts.app')

@section('title', 'Edit Challenge')

@section('content')
<!--begin::Breadcrumb-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}" class="text-gray-600 text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('challenges.index') }}" class="text-gray-600 text-hover-primary">Challenges</a>
        </li>
        <li class="breadcrumb-item active">Edit Challenge</li>
    </ol>
</nav>
<!--end::Breadcrumb-->

<!--begin::Page Header-->
<div class="mb-4">
    <h1 class="text-dark fw-bold">Edit Challenge</h1>
    <p class="text-muted">Update the details of the selected challenge.</p>
</div>
<!--end::Page Header-->

<div class="card">
    <div class="card-body">
        <form action="{{ route('challenges.update', $challenge->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Challenge Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $challenge->name }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="reward_diamond_points" class="form-label fw-bold">Reward Diamond Points</label>
                <input type="number" name="reward_diamond_points" id="reward_diamond_points" class="form-control" value="{{ $challenge->reward_diamond_points }}" required>
                @error('reward_diamond_points')
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
                <label for="reward" class="form-label fw-bold">Reward</label>
                <input type="text" name="reward" id="reward" class="form-control" value="{{ $challenge->reward }}">
                @error('reward')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="details" class="form-label fw-bold">Details</label>
                <textarea name="details" id="details" class="form-control" rows="5" required>{{ $challenge->details }}</textarea>
                @error('details')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="start_time" class="form-label fw-bold">Start Time</label>
                    <input type="datetime-local" name="start_time" id="start_time" class="form-control" value="{{ \Carbon\Carbon::parse($challenge->start_time)->format('Y-m-d\TH:i') }}" required>
                    @error('start_time')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="end_time" class="form-label fw-bold">End Time</label>
                    <input type="datetime-local" name="end_time" id="end_time" class="form-control" value="{{ \Carbon\Carbon::parse($challenge->end_time)->format('Y-m-d\TH:i') }}" required>
                    @error('end_time')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection

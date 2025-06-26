@extends('layouts.app')

@section('title', $challenge->name)

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
        <li class="breadcrumb-item active">{{ $challenge->name }}</li>
    </ol>
</nav>
<!--end::Breadcrumb-->

<!--begin::Page Header-->
<div class="mb-4">
    <h1 class="text-dark fw-bold">{{ $challenge->name }}</h1>
    <p class="text-muted">View all details of the selected challenge.</p>
</div>
<!--end::Page Header-->

<div class="card">
    <div class="card-body">
        <h5 class="fw-bold">Reward Diamond Points:</h5>
        <p>{{ $challenge->reward_diamond_points }}</p>

        <h5 class="fw-bold">Reward:</h5>
        <p>{{ $challenge->reward }}</p>

        <h5 class="fw-bold">Details:</h5>
        <p>{{ $challenge->details }}</p>

        <h5 class="fw-bold">Start Time:</h5>
        <p>{{ $challenge->start_time }}</p>

        <h5 class="fw-bold">End Time:</h5>
        <p>{{ $challenge->end_time }}</p>

        @if ($challenge->cover_photo)
            <h5 class="fw-bold">Cover Photo:</h5>
            <img src="{{ asset($challenge->cover_photo) }}" alt="Cover Photo" class="img-thumbnail" width="300">
        @endif
    </div>
</div>
@endsection

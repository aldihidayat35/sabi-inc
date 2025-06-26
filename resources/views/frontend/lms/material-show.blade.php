@extends('frontend.layouts.app')

@section('title', $material->title)

@section('content')
<div class="container py-4">
    <a href="{{ route('frontend.lms.materials', $material->topic_id) }}" class="btn btn-light mb-3">
        <i class="bi bi-arrow-left"></i> Kembali ke Materi
    </a>
    <div class="card shadow-sm border-0">
        @if($material->cover_photo)
            <img src="{{ asset($material->cover_photo) }}" class="card-img-top" alt="{{ $material->title }}">
        @endif
        <div class="card-body">
            <h2 class="card-title fw-bold">{{ $material->title }}</h2>
            <p class="text-muted">{{ $material->abstract }}</p>
            <div class="mt-3">
                {!! $material->content !!}
            </div>
        </div>
        <div class="card-footer bg-white border-0">
            <span class="badge bg-success">Reward: {{ $material->reward_diamond ?? 0 }} 💎</span>
        </div>
    </div>
</div>
@endsection

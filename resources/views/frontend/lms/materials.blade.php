@extends('frontend.layouts.app')

@section('title', 'Materi: ' . $topic->title)

@section('content')
<div class="container py-4">
    <a href="{{ route('frontend.lms.topics') }}" class="btn btn-light mb-3"><i class="bi bi-arrow-left"></i> Kembali ke Topik</a>
    <h2 class="mb-4 fw-bold">Learning Path: {{ $topic->title }}</h2>
    <div class="row g-3" style="margin-left:-12px;margin-right:-12px;">
        @forelse($materials as $material)
            <div class="col-12 px-0">
                <a href="{{ route('frontend.lms.material.show', $material->id) }}" class="text-decoration-none">
                    <div class="card flex-row align-items-center rounded-4 shadow-sm border-0 p-2" style="min-height:110px;">
                        <div class="flex-shrink-0">
                            <img src="{{ $material->cover_photo ? asset($material->cover_photo) : asset('assets2/media/illustrations/sketchy-1/2.png') }}"
                                 alt="{{ $material->title }}"
                                 class="rounded-3"
                                 style="width:90px;height:90px;object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3 d-flex flex-column justify-content-between" style="min-height:90px;">
                            <div>
                                <div class="fw-semibold text-dark fs-5 mb-1">{{ $material->title }}</div>
                                <div class="text-muted small mb-1">learning path</div>
                                <div class="d-flex align-items-center gap-1 mb-1">
                                    <i >💎</i>
                                    <span class="fw-semibold text-dark" style="font-size:15px;">{{ $material->reward_diamond }}</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3 mt-1">
                                <span class="text-muted small"><i class="bi bi-hand-thumbs-up"></i> 50K</span>
                                <span class="text-muted small"><i class="bi bi-chat"></i> 800</span>
                                <span class="text-muted small"><i class="bi bi-share"></i> 30</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Belum ada materi pada topik ini.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection

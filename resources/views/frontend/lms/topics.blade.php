@extends('frontend.layouts.app')

@section('title', 'LMS - Topik')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold">Learning Path</h2>
    <div class="row g-3" style="margin-left:-12px;margin-right:-12px;">
        @forelse($topics as $topic)
            <div class="col-12">
                <a href="{{ route('frontend.lms.materials', $topic->id) }}" class="text-decoration-none">
                    <div class="card flex-row align-items-center rounded-4 shadow-sm border-0 p-2" style="min-height:110px;">
                        <div class="flex-shrink-0">
                            <img src="{{ $topic->cover_photo ? asset($topic->cover_photo) : asset('assets2/media/illustrations/sketchy-1/1.png') }}"
                                 alt="{{ $topic->title }}"
                                 class="rounded-3"
                                 style="width:90px;height:90px;object-fit:cover;">
                        </div>
                        <div class="flex-grow-1 ms-3 d-flex flex-column justify-content-between" style="min-height:90px;">
                            <div>
                                <div class="fw-semibold text-dark fs-5 mb-1">{{ $topic->title }}</div>
                                <div class="text-muted small mb-1">learning path</div>
                                <div class="mb-2 mt-2 px-3 py-1 border rounded-1" style="font-size:1.05rem; border-color:#b0b6bd; color:#3a3a3a; background-color:#f8fafc;">
                                    Total : {{ $topic->materials->count() }} Materi
                                </div>
                            </div>
                            {{-- <div class="d-flex align-items-center gap-1 mb-1">
                                <i >💎</i>
                                <span class="fw-semibold text-dark" style="font-size:15px;">{{ $topic->reward_diamond }}</span>
                            </div> --}}
                            {{-- <div class="d-flex align-items-center gap-3 mt-1">
                                <span class="text-muted small"><i class="bi bi-hand-thumbs-up"></i> 50K</span>
                                <span class="text-muted small"><i class="bi bi-chat"></i> 800</span>
                                <span class="text-muted small"><i class="bi bi-share"></i> 30</span>
                            </div> --}}
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Belum ada topik tersedia.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection

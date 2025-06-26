@extends('frontend.layouts.app')

@section('title', 'Karya Kategori: ' . $category->name)

@section('content')
<div class="container my-5">
    <div class="d-flex align-items-center mb-4">
        <h2 class="fw-bold mb-0 text-primary" style="font-size:2rem;">{{ $category->name }}</h2>
        <div class="flex-grow-1 border-bottom ms-3" style="height:2px; background:linear-gradient(90deg,#0d6efd 60%,#fff 100%);"></div>
    </div>
    <p class="text-muted mb-4" style="font-size:1.1rem;">Menampilkan semua karya pada kategori <span class="fw-semibold">{{ $category->name }}</span>.</p>
    @if($works->count() > 0)
        {{-- Desktop --}}
        <div class="row g-4 d-none d-md-flex">
            @foreach($works as $idx => $work)
                <div class="col-md-2 px-2 d-flex">
                    <div class="card work-card-desktop w-100 h-100 shadow-sm border-0 cursor-pointer animate-fade-in embos-card"
                        style="animation-delay: {{ $idx * 0.08 }}s"
                        onclick="window.location='{{ route('frontend.works.show', $work->id) }}'">
                        @if ($work->cover_photo)
                            <img src="{{ asset($work->cover_photo) }}" class="card-img-top img-margin" alt="Work Cover" style="object-fit:cover; height:150px;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center img-margin" style="height:150px;">
                                <span class="text-muted">No Image</span>
                            </div>
                        @endif
                        <div class="card-body">
                            <h6 class="card-title fw-bold mb-1" style="font-size: 1rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                {{ $work->title }}
                            </h6>
                            <p class="card-text text-muted mb-2" style="font-size: 0.9rem;">
                                {{ $category->name }}
                            </p>
                            <div class="d-flex align-items-center mb-2" style="font-size:0.9rem;">
                                <i class="bi bi-eye me-1"></i> {{ $work->views ?? 0 }} views
                            </div>
                            <div class="d-flex align-items-center gap-2" style="font-size:0.9rem;">
                                <span title="Like"><i class="bi bi-hand-thumbs-up text-success"></i> {{ $work->likesCount() }}</span>
                                <span title="Dislike"><i class="bi bi-hand-thumbs-down text-danger"></i> {{ $work->dislikesCount() }}</span>
                                <span title="Rating"><i class="bi bi-star-fill text-warning"></i> {{ number_format($work->averageRating(), 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- Mobile --}}
        <div class="d-md-none">
            @php
                $mobileChunks = $works->chunk(2);
            @endphp
            @foreach($mobileChunks as $chunk)
                <div class="row g-3 mb-3">
                    @foreach($chunk as $idx => $work)
                        <div class="col-6 d-flex">
                            <div class="card work-card-mobile w-100 h-100 shadow-sm border-0 cursor-pointer animate-fade-in embos-card"
                                style="animation-delay: {{ $idx * 0.08 }}s"
                                onclick="window.location='{{ route('frontend.works.show', $work->id) }}'">
                                @if ($work->cover_photo)
                                    <img src="{{ asset($work->cover_photo) }}" class="card-img-top img-margin" alt="Work Cover" style="object-fit:cover; height:90px;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center img-margin" style="height:90px;">
                                        <span class="text-muted" style="font-size:10px;">No Image</span>
                                    </div>
                                @endif
                                <div class="card-body p-2">
                                    <h6 class="card-title fw-bold mb-1" style="font-size: 10px; overflow:hidden; text-overflow:ellipsis;">
                                        {{ $work->title }}
                                    </h6>
                                    <p class="card-text text-muted small mb-1" style="font-size: 10px;">
                                        {{ $category->name }}
                                    </p>
                                    <div class="d-flex align-items-center" style="font-size:10px;">
                                        <i class="bi bi-eye me-1"></i> {{ $work->views ?? 0 }} views
                                    </div>
                                    <div class="d-flex align-items-center gap-2 mt-1" style="font-size:10px;">
                                        <span title="Like"><i class="bi bi-hand-thumbs-up text-success"></i> {{ $work->likesCount() }}</span>
                                        <span title="Dislike"><i class="bi bi-hand-thumbs-down text-danger"></i> {{ $work->dislikesCount() }}</span>
                                        <span title="Rating"><i class="bi bi-star-fill text-warning"></i> {{ number_format($work->averageRating(), 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted mb-5">Belum ada karya pada kategori ini.</p>
    @endif
</div>

@push('styles')
    <style>
        .work-card-desktop {
            border-radius: 1rem;
            transition: box-shadow 0.2s, border-color 0.2s;
            background: #fff;
            border: 2px solid #0d6efd33;
            box-shadow: 0 0 0 0 #0d6efd, 0 8px 32px rgba(60,60,60,0.12);
            outline: none;
        }
        .work-card-desktop:hover, .work-card-desktop:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 12px 2px #0d6efd88, 0 8px 32px rgba(60,60,60,0.12);
        }
        .work-card-desktop .card-body {
            border-radius: 0 0 1rem 1rem;
            background: #fff;
        }
        .work-card-mobile {
            border-radius: 0.75rem;
            border: 2px solid #0d6efd33;
            box-shadow: 0 0 0 0 #0d6efd, 0 4px 16px rgba(60,60,60,0.10);
            outline: none;
            background: #fff;
            margin-bottom: 0.5rem;
            transition: box-shadow 0.2s, border-color 0.2s;
        }
        .work-card-mobile:hover, .work-card-mobile:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 8px 1px #0d6efd88, 0 4px 16px rgba(60,60,60,0.10);
        }
        .work-card-mobile .card-body {
            border-radius: 0 0 0.75rem 0.75rem;
            background: #fff;
        }
        .img-margin {
            margin: 10px 10px 0 10px;
            border-radius: 0.75rem 0.75rem 0 0;
        }
        .animate-fade-in {
            opacity: 0;
            transform: translateY(30px) scale(0.98);
            animation: fadeInUp 0.5s forwards;
        }
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        /* Efek embos */
        .embos-card {
            box-shadow:
                3px 3px 8px 0 #d1d9e6,
                -3px -3px 8px 0 #ffffff,
                0 0 0 0 #0d6efd,
                0 8px 32px rgba(60,60,60,0.12);
        }
        .embos-card:hover, .embos-card:focus {
            box-shadow:
                3px 3px 12px 0 #bfc8db,
                -3px -3px 12px 0 #ffffff,
                0 0 12px 2px #0d6efd88,
                0 8px 32px rgba(60,60,60,0.12);
        }
        @media (min-width: 768px) {
            .col-md-2 {
                flex: 0 0 20%;
                max-width: 20%;
                display: flex;
            }
            .row {
                display: flex;
                flex-wrap: wrap;
            }
            .work-card-desktop {
                margin-bottom: 0.5rem;
            }
        }
    </style>
@endpush
@endsection

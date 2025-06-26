@extends('frontend.layouts.app')

@section('title', 'Works')

@section('content')
{{-- mobile view --}}
    <!--begin::Latest Works Carousel-->
    <div class="container my-5">
        <h2 class="fw-bold mb-2">Karya Terbaru</h2>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <p class="text-muted mb-0">10 karya terbaru dari semua kategori.</p>
        </div>

        @php
            $itemsPerSlide = 10;
            $latestWorksChunks = $latestWorks->chunk($itemsPerSlide);
        @endphp
        @if($latestWorks->count() > 0)
            <div class="position-relative">
                <div id="latestWorksCarousel" class="carousel slide mb-5" data-bs-ride="carousel" data-bs-interval="8000">
                    <div class="carousel-inner">
                        @foreach ($latestWorksChunks as $slideIndex => $chunk)
                            <div class="carousel-item @if ($slideIndex == 0) active @endif">
                                <div class="d-flex flex-nowrap overflow-auto gap-3 justify-content-start">
                                    @foreach ($chunk as $work)
                                        <div class="card work-card h-10 sm border-0 cursor-pointer"
                                            style="flex: 0 0 110px; max-width: 110px; min-width: 110px; aspect-ratio: 1/1;"
                                            onclick="window.location='{{ route('frontend.works.show', $work->id) }}'">
                                            @if ($work->cover_photo)
                                                <div class="ratio ratio-1x1">
                                                    <img src="{{ asset($work->cover_photo) }}" alt="Work Cover"
                                                        class="card-img-top rounded-top" style="object-fit: cover;">
                                                </div>
                                            @else
                                                <div
                                                    class="ratio ratio-1x1 bg-light d-flex align-items-center justify-content-center rounded-top">
                                                    <span class="text-muted" style="font-size:10px;">No Image</span>
                                                </div>
                                            @endif
                                            <div class="card-body p-2">
                                                <h6 class="card-title fw-bold mb-1"
                                                    style="font-size: 10px;  overflow:hidden; text-overflow:ellipsis;  white-space:nowrap; ">
                                                    {{ $work->title }}</h6>
                                                <p class="card-text text-muted small mb-1" style="font-size: 10px;">
                                                    {{-- Tampilkan kategori pertama --}}
                                                    {{ $work->categories->first()->name ?? '-' }}
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
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- Tombol geser hanya untuk desktop --}}
                    @if($latestWorksChunks->count() > 1)
                        <button class="carousel-control-prev d-none d-md-flex" type="button" data-bs-target="#latestWorksCarousel" data-bs-slide="prev" style="top:35%; left:-30px;">
                            <span class="carousel-control-prev-icon" aria-hidden="true" style="filter:invert(1);"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next d-none d-md-flex" type="button" data-bs-target="#latestWorksCarousel" data-bs-slide="next" style="top:35%; right:-30px;">
                            <span class="carousel-control-next-icon" aria-hidden="true" style="filter:invert(1);"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>
            </div>
        @else
            <p class="text-muted mb-5">Belum ada karya terbaru.</p>
        @endif
    </div>
    <!--end::Latest Works Carousel-->
 {{-- Search Works --}}
        <div class="mb-4">
            <div class="card shadow-sm border-0" style="background: linear-gradient(90deg, #f8fafc 60%, #e0e7ef 100%);">
                <div class="card-body">
                    <form method="GET" action="{{ route('frontend.works.index') }}">
                        <div class="input-group input-group-lg">
                            <input type="text" name="search_work" class="form-control rounded-start-pill border-0 shadow-none" placeholder="🔍 Cari karya berdasarkan judul..." value="{{ request('search_work') }}" style="background: #fff;">
                            <button class="btn btn-primary rounded-end-pill px-4" type="submit" style="font-weight: 600;">
                                Cari
                            </button>
                        </div>
                    </form>
                    @if(isset($searchWorks) && request('search_work'))
                        <div class="mt-4">
                            <h5 class="mb-3">
                                <span class="badge bg-primary bg-opacity-75 text-white px-3 py-2 rounded-pill">
                                    Hasil pencarian: "{{ request('search_work') }}"
                                </span>
                            </h5>
                            @if($searchWorks->count() > 0)
                                <div class="list-group list-group-flush">
                                    @foreach($searchWorks as $work)
                                        <a href="{{ route('frontend.works.show', $work->id) }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between gap-3" style="border-radius: 12px;">
                                            <div class="d-flex align-items-center gap-3">
                                                <div style="width:40px; height:40px; flex-shrink:0;">
                                                    @if($work->cover_photo)
                                                        <img src="{{ asset($work->cover_photo) }}" alt="Cover" class="rounded-circle object-fit-cover" style="width:40px; height:40px;">
                                                    @else
                                                        <span class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width:40px; height:40px; font-size:18px; color:#bbb;">
                                                            <i class="bi bi-image"></i>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="text-muted small mb-1">
                                                        <i class="bi bi-person-circle me-1"></i>
                                                        {{ $work->author->name ?? '-' }}
                                                    </div>
                                                    <div class="fw-semibold">{{ $work->title }}</div>
                                                    <div class="text-muted small">
                                                        {{ $work->categories->first()->name ?? '-' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-end" style="min-width: 90px;">
                                                <div class="d-flex flex-column align-items-end gap-1">
                                                    <span class="text-muted" style="font-size:12px;">
                                                        <i class="bi bi-eye me-1"></i>{{ $work->views ?? 0 }}
                                                    </span>
                                                    <span class="text-warning" style="font-size:12px;">
                                                        <i class="bi bi-star-fill"></i> {{ number_format($work->averageRating(), 2) }}
                                                    </span>
                                                    <span class="text-success" style="font-size:12px;">
                                                        <i class="bi bi-hand-thumbs-up"></i> {{ $work->likesCount() }}
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-warning mt-3 mb-0 rounded-pill px-4 py-2" role="alert">
                                    <i class="bi bi-exclamation-circle me-2"></i>
                                    Tidak ditemukan karya dengan judul tersebut.
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
        {{-- End Search Works --}}
    {{-- Desktop view per Category --}}
    <div class="container my-5 d-none d-md-block">
        @foreach($categories as $category)
            <div class="mb-5">
                <div class="d-flex align-items-center mb-3">
                    <h2 class="fw-bold mb-0 text-primary" style="font-size:2rem;">{{ $category->name }}</h2>
                    <div class="flex-grow-1 border-bottom ms-3" style="height:2px; background:linear-gradient(90deg,#0d6efd 60%,#fff 100%);"></div>
                    <a href="{{ route('frontend.works.byCategory', $category->id) }}" class="btn btn-outline-primary ms-3 d-inline-block">Lihat Selengkapnya</a>
                </div>
                @php
                    $works = $category->works;
                    $chunks = $works->chunk(6);
                @endphp
                @if($works->count() > 0)
                    @foreach($chunks as $chunk)
                        <div class="row mb-4 g-4">
                            @foreach($chunk as $idx => $work)
                                <div class="col-md-2 px-2 d-flex">
                                    <div class="card work-card-desktop w-100 h-100 shadow-sm border-0 cursor-pointer animate-fade-in"
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
                    @endforeach
                @else
                    <p class="text-muted mb-5">Belum ada karya pada kategori ini.</p>
                @endif
            </div>
        @endforeach
    </div>
    {{-- End Desktop view per Category --}}

    <!--begin::Works Carousel Section per Category (Mobile Only)-->
    <div class="container my-5 d-md-none">
        @foreach($categories as $category)
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="fw-bold mb-2">{{ $category->name }}</h2>
                    <a href="{{ route('frontend.works.byCategory', $category->id) }}" class="btn btn-outline-primary btn-sm ms-2">Lihat Selengkapnya</a>
                </div>
                <p class="text-muted mb-2" style="font-size: 1rem;">Explore works in {{ $category->name }}.</p>
                @php
                    $itemsPerSlide = 10;
                    $worksChunks = $category->works->chunk($itemsPerSlide);
                @endphp
                @if($category->works->count() > 0)
                    <div id="worksCarousel-{{ $category->id }}" class="carousel slide mb-5" data-bs-ride="carousel" data-bs-interval="8000">
                        <div class="carousel-inner">
                            @foreach ($worksChunks as $slideIndex => $chunk)
                                <div class="carousel-item @if ($slideIndex == 0) active @endif">
                                    <div class="d-flex flex-nowrap overflow-auto gap-3 justify-content-start">
                                        @foreach ($chunk as $work)
                                            <div class="card work-card h-10 sm border-0 cursor-pointer"
                                                style="flex: 0 0 110px; max-width: 110px; min-width: 110px; aspect-ratio: 1/1;"
                                                onclick="window.location='{{ route('frontend.works.show', $work->id) }}'">
                                                @if ($work->cover_photo)
                                                    <div class="ratio ratio-1x1">
                                                        <img src="{{ asset($work->cover_photo) }}" alt="Work Cover"
                                                            class="card-img-top rounded-top" style="object-fit: cover;">
                                                    </div>
                                                @else
                                                    <div
                                                        class="ratio ratio-1x1 bg-light d-flex align-items-center justify-content-center rounded-top">
                                                        <span class="text-muted" style="font-size:10px;">No Image</span>
                                                    </div>
                                                @endif
                                                <div class="card-body p-2">
                                                    <h6 class="card-title fw-bold mb-1"
                                                        style="font-size: 10px;  overflow:hidden; text-overflow:ellipsis;">
                                                        {{ $work->title }}</h6>
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
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($worksChunks->count() > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#worksCarousel-{{ $category->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true" style="filter:invert(1);"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#worksCarousel-{{ $category->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true" style="filter:invert(1);"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                    </div>
                @else
                    <p class="text-muted mb-5">Belum ada karya pada kategori ini.</p>
                @endif
            </div>
        @endforeach
    </div>
    <!--end::Works Carousel Section per Category (Mobile Only)-->

    @push('styles')
        <style>
            .work-card {
                border-radius: 0.75rem;
            }
            .work-card .card-body {
                border-radius: 0 0 0.75rem 0.75rem;
                background: #fff;
            }
            .ratio-1x1 {
                aspect-ratio: 1/1;
                width: 70%;
                display: block;
            }
            .cursor-pointer {
                cursor: pointer;
            }
            /* Desktop card style */
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
            .img-margin {
                margin: 10px 10px 0 10px;
                border-radius: 0.75rem 0.75rem 0 0;
            }
            /* Animasi masuk */
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
            /* 5 columns for desktop */
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
                .work-card { display: none !important; }
            }
            @media (max-width: 767.98px) {
                .work-card-desktop { display: none !important; }
            }
        </style>
    @endpush
{{--end mobile view --}}

@endsection

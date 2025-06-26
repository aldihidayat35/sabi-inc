@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
    {{-- slide karya terbaik --}}
    <div class="container my-5">
        {{-- <h2 class="fw-bold mb-4"><i class="bi bi-trophy text-warning"></i> Karya Terbaik</h2> --}}
        @if ($bestRatedWorks->count() > 0)
            <div id="bestRatedWorksSlider" class="carousel slide mb-5" data-bs-ride="carousel" data-bs-interval="6000">
                <div class="carousel-indicators">
                    @foreach ($bestRatedWorks as $i => $work)
                        <button type="button" data-bs-target="#bestRatedWorksSlider" data-bs-slide-to="{{ $i }}"
                            class="@if ($i == 0) active @endif rounded-circle"
                            style="width:10px; height:10px; background-color:#fff; opacity:0.7; border:none; margin:0 4px;"></button>
                    @endforeach
                </div>
                <div class="carousel-inner rounded-4 shadow" style="overflow:hidden;">
                    @foreach ($bestRatedWorks as $i => $work)
                        <div class="carousel-item @if ($i == 0) active @endif">
                            <div class="position-relative challenge-slide-img" style="height: 220px;">
                                <a href="{{ route('frontend.works.show', $work->id) }}"
                                    style="display:block; width:100%; height:100%;">
                                    <img src="{{ asset($work->cover_photo ?? 'default.png') }}"
                                        class="w-100 h-100 object-fit-cover" style="filter: brightness(0.5);"
                                        alt="Karya Terbaik {{ $i + 1 }}">
                                    <div class="position-absolute top-50 start-50 translate-middle text-center px-3"
                                        style="width:100%;">
                                        <h2 class="fw-bold text-white" style="text-shadow:0 2px 8px rgba(0,0,0,0.7);">
                                            {{ $work->title }}
                                        </h2>
                                        <div class="text-white-50 mb-0" style="text-shadow:0 1px 4px rgba(0,0,0,0.6);">
                                            <span class="me-2">
                                                <i class="bi bi-person-circle"></i> {{ $work->author->name ?? '-' }}
                                            </span>
                                            <span>
                                                <i class="bi bi-folder2-open"></i>
                                                {{ $work->categories->first()->name ?? '-' }}
                                            </span>
                                        </div>
                                        <div class="mt-2 text-white small" style="text-shadow:0 1px 4px rgba(0,0,0,0.7);">
                                            <span class="me-3">
                                                <i class="bi bi-star-fill text-warning"></i>
                                                {{ number_format($work->avg_rating, 2) }} / 5
                                            </span>
                                            <span class="me-3">
                                                <i class="bi bi-people"></i>
                                                {{ $work->ratings_count }} penilai
                                            </span>
                                            <span>
                                                <i class="bi bi-bar-chart"></i>
                                                Total: {{ number_format($work->avg_rating * $work->ratings_count, 2) }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if ($bestRatedWorks->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#bestRatedWorksSlider"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true" style="filter:invert(1);"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#bestRatedWorksSlider"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true" style="filter:invert(1);"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                @endif
            </div>
            <style>
                @media (min-width: 992px) {

                    /* Desktop: make slide taller */
                    .challenge-slide-img {
                        height: 380px !important;
                    }
                }
            </style>
        @else
            <p class="text-muted">Belum ada karya terbaik.</p>
        @endif
    </div>
    {{-- end::slide karya terbaik --}}

    <div class="separator mx-10"></div>

    {{-- begin::Search Works --}}
    <div class="container my-5">
        <div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(90deg, #f8fafc 60%, #e0e7ef 100%);">
            <div class="card-body">
                <form method="GET" action="{{ route('frontend.home') }}">
                    <div class="input-group input-group-lg">
                        <input type="text" name="search_work"
                            class="form-control rounded-start-pill border-0 shadow-none"
                            placeholder="🔍 Cari karya berdasarkan judul..." value="{{ request('search_work') }}"
                            style="background: #fff;">
                        <button class="btn btn-primary rounded-end-pill px-4" type="submit" style="font-weight: 600;">
                            Cari
                        </button>
                    </div>
                </form>
                @if (isset($searchWorks) && request('search_work'))
                    <div class="mt-4">
                        <h5 class="mb-3">
                            <span class="badge bg-primary bg-opacity-75 text-white px-3 py-2 rounded-pill">
                                Hasil pencarian: "{{ request('search_work') }}"
                            </span>
                        </h5>
                        @if ($searchWorks->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach ($searchWorks as $work)
                                    <a href="{{ route('frontend.works.show', $work->id) }}"
                                        class="list-group-item list-group-item-action d-flex align-items-center justify-content-between gap-3"
                                        style="border-radius: 12px;">
                                        <div class="d-flex align-items-center gap-3">
                                            <div style="width:40px; height:40px; flex-shrink:0;">
                                                @if ($work->cover_photo)
                                                    <img src="{{ asset($work->cover_photo) }}" alt="Cover"
                                                        class="rounded-circle object-fit-cover"
                                                        style="width:40px; height:40px;">
                                                @else
                                                    <span
                                                        class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                                        style="width:40px; height:40px; font-size:18px; color:#bbb;">
                                                        <i class="bi bi-image"></i>
                                                    </span>
                                                @endif
                                            </div>
                                            <div>
                                                {{-- Penulis --}}
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
                                                    <i class="bi bi-star-fill"></i>
                                                    {{ number_format($work->averageRating(), 2) }}
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
    {{-- end::Search Works --}}
    <br>
    {{-- begin::Trending Works Carousel --}}
    <div class="container my-5">
        <h2 class="fw-bold mb-2"><i class="bi bi-fire text-danger"></i> Trending</h2>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <p class="text-muted mb-0">5 karya dengan jumlah views terbanyak.</p>
        </div>
        @if ($trendingWorks->count() > 0)
            <div id="trendingWorksCarousel" class="carousel slide mb-5" data-bs-ride="carousel" data-bs-interval="7000">
                <div class="carousel-inner rounded-4 shadow" style="overflow:hidden;">
                    @foreach ($trendingWorks as $i => $work)
                        <div class="carousel-item @if ($i == 0) active @endif">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <a href="{{ route('frontend.works.show', $work->id) }}">
                                        <img src="{{ asset($work->cover_photo ?? 'default.png') }}"
                                            class="w-100 rounded-4"
                                            style="object-fit:cover; height:220px; background:#f8fafc;">
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <div class="p-3">
                                        <div class="mb-2 text-muted small">
                                            <i class="bi bi-person-circle me-1"></i>
                                            {{ $work->author->name ?? '-' }}
                                        </div>
                                        <h4 class="fw-bold mb-2">
                                            <a href="{{ route('frontend.works.show', $work->id) }}"
                                                class="text-dark text-decoration-none">
                                                {{ $work->title }}
                                            </a>
                                        </h4>
                                        <div class="mb-2 text-muted small">
                                            <i class="bi bi-folder2-open"></i>
                                            {{ $work->categories->first()->name ?? '-' }}
                                        </div>
                                        <div class="d-flex gap-3 align-items-center mt-3">
                                            <span class="text-muted" style="font-size:15px;">
                                                <i class="bi bi-eye me-1"></i>{{ $work->views ?? 0 }} views
                                            </span>
                                            <span class="text-success" style="font-size:15px;">
                                                <i class="bi bi-hand-thumbs-up"></i> {{ $work->likesCount() }}
                                            </span>
                                            <span class="text-warning" style="font-size:15px;">
                                                <i class="bi bi-star-fill"></i>
                                                {{ number_format($work->averageRating(), 2) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if ($trendingWorks->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#trendingWorksCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true" style="filter:invert(1);"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#trendingWorksCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true" style="filter:invert(1);"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                @endif
            </div>
        @else
            <p class="text-muted mb-5">Belum ada karya trending.</p>
        @endif
    </div>
    {{-- end::Trending Works Carousel --}}

    {{-- begin::Latest Works Carousel --}}
    <div class="container my-5">
        <h2 class="fw-bold mb-2">Karya Terbaru</h2>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <p class="text-muted mb-0">10 karya terbaru dari semua kategori.</p>
        </div>
        @php
            $itemsPerSlide = 10;
            $latestWorksChunks = $latestWorks->chunk($itemsPerSlide);
        @endphp
        @if ($latestWorks->count() > 0)
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
                                                style="font-size: 10px;  overflow:hidden; text-overflow:ellipsis;">
                                                {{ $work->title }}</h6>
                                            <p class="card-text text-muted small mb-1" style="font-size: 10px;">
                                                {{-- Tampilkan kategori pertama --}}
                                                {{ $work->categories->first()->name ?? '-' }}
                                            </p>
                                            <div class="d-flex align-items-center" style="font-size:10px;">
                                                <i class="bi bi-eye me-1"></i> {{ $work->views ?? 0 }} views
                                            </div>
                                            <div class="d-flex align-items-center gap-2 mt-1" style="font-size:10px;">
                                                <span title="Like"><i class="bi bi-hand-thumbs-up text-success"></i>
                                                    {{ $work->likesCount() }}</span>
                                                <span title="Dislike"><i class="bi bi-hand-thumbs-down text-danger"></i>
                                                    {{ $work->dislikesCount() }}</span>
                                                <span title="Rating"><i class="bi bi-star-fill text-warning"></i>
                                                    {{ number_format($work->averageRating(), 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                @if ($latestWorksChunks->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#latestWorksCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true" style="filter:invert(1);"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#latestWorksCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true" style="filter:invert(1);"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                @endif
            </div>
        @else
            <p class="text-muted mb-5">Belum ada karya terbaru.</p>
        @endif
    </div>
    {{-- end::Latest Works Carousel --}}

    {{-- begin::Latest Topics Carousel --}}
    <div class="container my-5">
        <h2 class="fw-bold mb-2">Topik Terbaru</h2>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <p class="text-muted mb-0">10 topik terbaru.</p>
        </div>
        @php
            $itemsPerSlide = 8;
            $latestTopicsChunks = $latestTopics->chunk($itemsPerSlide);
        @endphp
        @if ($latestTopics->count() > 0)
            <div id="latestTopicsCarousel" class="carousel slide mb-5" data-bs-ride="carousel" data-bs-interval="8000">

                <div class="carousel-inner">
                    @foreach ($latestTopicsChunks as $slideIndex => $chunk)
                        <div class="carousel-item @if ($slideIndex == 0) active @endif">
                            <div class="d-flex flex-nowrap overflow-auto gap-3 justify-content-start">
                                @foreach ($chunk as $topic)
                                    <div class="card topic-card h-10 sm border-0 cursor-pointer"
                                        style="flex: 0 0 110px; max-width: 110px; min-width: 110px; aspect-ratio: 1/1;"
                                        {{-- Ganti route sesuai kebutuhan jika ada halaman detail topic --}}>
                                        @if ($topic->cover_photo)
                                            <div class="ratio ratio-1x1">
                                                <img src="{{ asset($topic->cover_photo) }}" alt="Topic Cover"
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
                                                {{ $topic->title }}</h6>
                                            <p class="card-text text-muted small mb-1" style="font-size: 10px;">
                                                {{ \Illuminate\Support\Str::limit($topic->description, 30) }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                @if ($latestTopicsChunks->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#latestTopicsCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true" style="filter:invert(1);"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#latestTopicsCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true" style="filter:invert(1);"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                @endif
            </div>
        @else
            <p class="text-muted mb-5">Belum ada topik terbaru.</p>
        @endif
    </div>
    {{-- end::Latest Topics Carousel --}}

    {{-- end slide challenge --}}
    <div class="separator mx-10"></div>

    {{-- Crousel Challenge List (Bottom Section) --}}
    <div class="container my-5">
        <h2 class="fw-bold mb-2">Tantangan Terbaru</h2>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <p class="text-muted mb-0">3 Tantangan terbaru.</p>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($challenges2 as $challenge)
                <div class="col pt-2">
                    <div class="card h-100 shadow-sm d-flex flex-row align-items-stretch" style="min-height: 180px;">
                        <a href="{{ route('frontend.challenges.show', $challenge->id) }}" class="d-block"
                            style="flex: 0 0 45%; max-width: 45%;">
                            <img src="{{ asset($challenge->cover_photo ?? 'default.png') }}"
                                class="img-fluid rounded-start h-100 w-100" alt="Cover"
                                style="object-fit:cover; min-height:180px;">
                        </a>
                        <div class="card-body d-flex flex-column justify-content-between"
                            style="flex: 1 1 0; min-width:0;">
                            <div>
                                <h5 class="card-title fw-bold mb-1">
                                    <a href="{{ route('frontend.challenges.show', $challenge->id) }}"
                                        class="text-dark text-decoration-none">
                                        {{ $challenge->name }}
                                    </a>
                                </h5>
                                <div class="mb-2 text-muted small">
                                    <i class="bi bi-calendar-event"></i>
                                    {{ \Carbon\Carbon::parse($challenge->start_time)->format('d M Y') }}
                                    &ndash;
                                    {{ \Carbon\Carbon::parse($challenge->end_time)->format('d M Y') }}
                                </div>
                                <p class="card-text text-muted mb-0" style="font-size: 13px;">
                                    {{ \Illuminate\Support\Str::limit($challenge->details, 80) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- End Crousel Challenge List --}}
@endsection

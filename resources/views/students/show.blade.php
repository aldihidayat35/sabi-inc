@extends('layouts.app')

@section('title', 'Student Details')

@section('content')
    <!--begin::Breadcrumb-->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}" class="text-gray-600 text-hover-primary">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('students.index') }}" class="text-gray-600 text-hover-primary">Students</a>
            </li>
            <li class="breadcrumb-item active">Student Details</li>
        </ol>
    </nav>
    <!--end::Breadcrumb-->

    <!--begin::Page Header-->
    <div class="mb-4">
        <h1 class="text-dark fw-bold">Student Details</h1>
        <p class="text-muted">View all details of the selected student.</p>
    </div>
    <!--end::Page Header-->

    <div class="card border-0 shadow-sm" style="background: #f8fafc;">
        <div class="card-body">
            <!--begin::Details-->
            <div class="d-flex flex-wrap flex-sm-nowrap">

                <!--begin::Info-->
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex align-items-center mb-3 flex-wrap" style="gap: 20px;">
                        <!--begin::Photo-->
                        <div class="me-3 mb-3" style="flex-shrink:0;">
                            <div class="symbol symbol-100px symbol-fixed" style="width:100px;height:100px;">
                                <img src="{{ asset($student->photo_profil ?? 'default.png') }}" alt="Profile Photo"
                                    class="rounded-3" style="object-fit:cover;width:100px;height:100px;">
                            </div>
                        </div>
                        <!--end::Photo-->

                        <div class="d-flex flex-column">
                            <!--begin::Name-->
                            <div class="d-flex align-items-center mb-2">
                                <span class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $student->nama }}</span>
                                @php
                                    // Ambil ranking berdasarkan diamond (urutan ke berapa)
                                    $diamond = $totalDiamond ?? 0;
                                    $rank = \App\Models\Student::orderByDesc('diamond_points')
                                        ->pluck('id')
                                        ->search($student->id) + 1;
                                @endphp
                                <span class="badge bg-info-subtle text-info ms-3 d-flex align-items-center px-3 py-2 rounded-3 border border-info-subtle" style="font-size:1rem;">
                                    <i class="fas fa-gem me-1"></i> #{{ $rank }} Diamond Rank
                                </span>
                            </div>
                            <!--end::Name-->
                            <!--begin::Info-->
                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-2 gap-3">
                                <span class="d-flex align-items-center text-gray-600 mb-2">
                                    <i class="fas fa-envelope fs-5 me-2 text-primary"></i>{{ $student->email }}
                                </span>
                                <span class="d-flex align-items-center text-gray-600 mb-2">
                                    <i class="fas fa-school fs-5 me-2 text-success"></i>{{ $student->asal_sekolah }}
                                </span>
                                <span class="d-flex align-items-center text-gray-600 mb-2">
                                    <i class="fas fa-id-card fs-5 me-2 text-info"></i>{{ $student->nisn }}
                                </span>
                            </div>
                            <!--end::Info-->
                        </div>
                    </div>
                    <!--end::Title-->

                    <!--begin::Stats-->
                    <div class="d-flex flex-wrap flex-stack w-100">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column flex-grow-1 pe-0 w-100">
                            <!--begin::Stats-->
                            <div class="row g-3 w-100">
                                <div class="col-6 col-md-4 col-lg-2">
                                    <div class="border border-2 border-primary-subtle rounded-3 bg-white px-4 py-3 h-100 d-flex flex-column align-items-center">
                                        <div class="fw-semibold fs-6 text-gray-600 mb-1">
                                            <i class="fas fa-paint-brush me-1 text-primary"></i>Total Karya
                                        </div>
                                        <div class="fs-2 fw-bold text-primary">{{ $totalWorks ?? 0 }}</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4 col-lg-2">
                                    <div class="border border-2 border-success-subtle rounded-3 bg-white px-4 py-3 h-100 d-flex flex-column align-items-center">
                                        <div class="fw-semibold fs-6 text-gray-600 mb-1">
                                            <i class="fas fa-trophy me-1 text-success"></i>Total Tantangan
                                        </div>
                                        <div class="fs-2 fw-bold text-success">{{ $totalChallenges ?? 0 }}</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4 col-lg-2">
                                    <div class="border border-2 border-danger-subtle rounded-3 bg-white px-4 py-3 h-100 d-flex flex-column align-items-center">
                                        <div class="fw-semibold fs-6 text-gray-600 mb-1">
                                            <i class="fas fa-heart me-1 text-danger"></i>Total Like
                                        </div>
                                        <div class="fs-2 fw-bold text-danger">{{ $totalLikes ?? 0 }}</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4 col-lg-2">
                                    <div class="border border-2 border-warning-subtle rounded-3 bg-white px-4 py-3 h-100 d-flex flex-column align-items-center">
                                        <div class="fw-semibold fs-6 text-gray-600 mb-1">
                                            <i class="fas fa-star me-1 text-warning"></i>Rata-rata Rating
                                        </div>
                                        <div class="fs-2 fw-bold text-warning">{{ $avgRating ?? 0 }}</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4 col-lg-2">
                                    <div class="border border-2 border-info-subtle rounded-3 bg-white px-4 py-3 h-100 d-flex flex-column align-items-center">
                                        <div class="fw-semibold fs-6 text-gray-600 mb-1">
                                            <i class="fas fa-gem me-1 text-info"></i>Total Diamond
                                        </div>
                                        <div class="fs-2 fw-bold text-info">{{ $totalDiamond ?? 0 }}</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4 col-lg-2">
                                    <div class="border border-2 border-primary-subtle rounded-3 bg-white px-4 py-3 h-100 d-flex flex-column align-items-center">
                                        <div class="fw-semibold fs-6 text-gray-600 mb-1">
                                            <i class="fas fa-users me-1 text-primary"></i>Total Follower
                                        </div>
                                        <div class="fs-2 fw-bold text-primary">{{ $followersCount ?? 0 }}</div>
                                    </div>
                                </div>
                                {{-- <div class="col-6 col-md-4 col-lg-2">
                                    <div class="border border-2 border-info-subtle rounded-3 bg-white px-4 py-3 h-100 d-flex flex-column align-items-center">
                                        <div class="fw-semibold fs-6 text-gray-600 mb-1">
                                            <i class="fas fa-user-friends me-1 text-info"></i>Total Followed
                                        </div>
                                        <div class="fs-2 fw-bold text-info">{{ $followingsCount ?? 0 }}</div>
                                    </div>
                                </div> --}}
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Details-->
        </div>
    </div>

    <!--begin::Profile Tabs-->
    <div class="card mt-4 w-100 border-0 shadow-sm" style="background: #f8fafc;">
        <div class="card-body p-4">
            <ul class="nav nav-pills nav-fill nav-justified bg-white border-bottom border-2 border-primary-subtle rounded-top"
                id="profileTab" role="tablist" style="width:100%;">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active py-3" id="karya-tab" data-bs-toggle="pill" data-bs-target="#karya"
                        type="button" role="tab" aria-controls="karya" aria-selected="true">
                        <i class="fas fa-paint-brush me-2 text-primary"></i>Karya
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link py-3" id="tantangan-tab" data-bs-toggle="pill" data-bs-target="#tantangan"
                        type="button" role="tab" aria-controls="tantangan" aria-selected="false">
                        <i class="fas fa-trophy me-2 text-success"></i>Tantangan
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link py-3" id="follower-tab" data-bs-toggle="pill" data-bs-target="#follower"
                        type="button" role="tab" aria-controls="follower" aria-selected="false">
                        <i class="fas fa-users me-2 text-secondary"></i>Follower
                    </button>
                </li>
            </ul>
            <hr>
            <div class="tab-content p-4" id="profileTabContent" style="background:#f8fafc;border-radius:0 0 1rem 1rem;">
                <!-- Karya Tab -->
                <div class="tab-pane fade show active" id="karya" role="tabpanel" aria-labelledby="karya-tab">
                    @if (isset($student->works) && $student->works->count())
                        <div class="row g-4">
                            @foreach ($student->works as $work)
                                <div class="col-12 col-md-6 col-lg-3">
                                    <div class="card h-100 shadow-sm border-0" style="background: #fff;">
                                        <div class="d-flex align-items-start">
                                            <img src="{{ $work->cover_photo ? asset($work->cover_photo) : asset('assets/media/stock/ecommerce/210.png') }}"
                                                alt="Cover" class="rounded-start border border-2 border-primary-subtle"
                                                style="object-fit:cover;width:100px;height:130px;">
                                            <div class="flex-grow-1 ms-3 py-2">
                                                <a href="{{ route('works.show', $work->id) }}"
                                                    class="fw-bold text-gray-900 text-hover-primary fs-5 d-block mb-1">
                                                    {{ $work->title }}
                                                </a>
                                                <div class="mb-2 text-muted small" style="min-height:40px;">
                                                    {{ Str::limit($work->description, 80) }}
                                                </div>
                                                <div class="d-flex flex-wrap align-items-center mb-2 gap-2">
                                                    <span class="badge bg-primary-subtle text-primary">
                                                        <i class="fas fa-heart me-1"></i>{{ $work->likesCount() }}
                                                    </span>
                                                    <span class="badge bg-warning-subtle text-warning">
                                                        <i
                                                            class="fas fa-star me-1"></i>{{ number_format($work->averageRating(), 2) }}
                                                    </span>
                                                    <span class="badge bg-info-subtle text-info">
                                                        <i class="fas fa-eye me-1"></i>{{ $work->views ?? 0 }}
                                                    </span>
                                                </div>
                                                <div class="text-muted small">
                                                    <i class="fas fa-calendar-alt me-1"></i>
                                                    {{ $work->created_at ? $work->created_at->format('d M Y H:i') : '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center text-muted py-5">Belum ada karya.</div>
                    @endif
                </div>
                <!-- Tantangan Tab -->
                <div class="tab-pane fade" id="tantangan" role="tabpanel" aria-labelledby="tantangan-tab">
                    @if (isset($student->challengeRegistrations) && $student->challengeRegistrations->count())
                        <div class="row g-4">
                            @foreach ($student->challengeRegistrations as $reg)
                                <div class="col-12 col-md-6 col-lg-2">
                                    <div class="card h-100 shadow-sm border-0" style="background: #fff;">
                                        <div class="card-body d-flex flex-column">
                                            <div class="mb-3 text-center">
                                                <img src="{{ $reg->challenge->cover_photo ? asset($reg->challenge->cover_photo) : asset('assets/media/stock/ecommerce/210.png') }}"
                                                    alt="Cover" class="rounded border border-2 border-success-subtle"
                                                    style="object-fit:cover;width:100%;height:120px;">
                                            </div>
                                            <div class="mb-2">
                                                <span
                                                    class="fw-bold fs-5 text-gray-900">{{ $reg->challenge->name ?? '-' }}</span>
                                            </div>
                                            <div class="mb-2 text-muted small" style="min-height:32px;">
                                                {{ Str::limit($reg->challenge->details ?? '', 60) }}
                                            </div>
                                            <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                                <span class="badge bg-primary-subtle text-primary">
                                                    <i class="fas fa-star me-1"></i>Skor: {{ $reg->score ?? '-' }}
                                                </span>
                                                <span class="badge bg-success-subtle text-success">
                                                    <i class="fas fa-gem me-1"></i>Diamond:
                                                    {{ $reg->diamond_awarded ?? 0 }}
                                                </span>
                                            </div>
                                            <div class="text-muted small mt-auto">
                                                <i class="fas fa-calendar-alt me-1"></i>
                                                {{ $reg->created_at ? $reg->created_at->format('d M Y H:i') : '-' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center text-muted py-5">Belum mengikuti tantangan.</div>
                    @endif
                </div>

                <div class="tab-pane fade" id="follower" role="tabpanel" aria-labelledby="follower-tab">
                    @if (isset($student->followers) && $student->followers->count())
                        <div class="row g-4 justify-content-center">
                            @foreach ($student->followers as $follower)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-2 d-flex justify-content-center">
                                    <div class="follower-card bg-white rounded-4 shadow-sm p-4 text-center border border-2 border-secondary-subtle"
                                        style="min-width:220px;max-width:260px;">
                                        <div class="mb-3">
                                            <img src="{{ asset($follower->photo_profil ?? 'default.png') }}"
                                                class="rounded-circle border border-2 border-primary-subtle"
                                                style="width:80px;height:80px;object-fit:cover;">
                                        </div>
                                        <div class="fw-bold fs-5 mb-2 ">{{ $follower->nama }}</div>
                                        <div class="fw-bold fs-8 mb-2 ">{{ $follower->email }}</div>

                                        <div class="d-flex justify-content-center gap-3">
                                            <div class="follower-stat px-3 py-2 rounded-3 border bg-light">
                                                <span
                                                    class="fw-bold fs-6 text-primary">{{ $follower->followers()->count() }}</span>
                                                <span class="ms-1 text-primary"><i class="fas fa-users"></i></span>
                                                <div class="small text-muted" style="line-height:1;">Follower</div>
                                            </div>
                                            <div class="follower-stat px-3 py-2 rounded-3 border bg-light">
                                                <span class="fw-bold fs-6 text-warning">
                                                    {{ number_format(
                                                        $follower->works()->with('ratings')->get()->avg(function ($work) {
                                                                return $work->ratings()->avg('rating');
                                                            }) ?? 0,
                                                        1,
                                                    ) }}
                                                </span>
                                                <span class="ms-1 text-warning"><i class="fas fa-star"></i></span>
                                                <div class="small text-muted" style="line-height:1;">Rate Profil</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center text-muted py-5">Belum ada follower.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--end::Profile Tabs-->

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
        <style>
            .border-primary-subtle {
                border-color: #b6d4fe !important;
            }

            .border-success-subtle {
                border-color: #b6fcd5 !important;
            }

            .border-danger-subtle {
                border-color: #fecaca !important;
            }

            .border-warning-subtle {
                border-color: #fef9c3 !important;
            }

            .border-info-subtle {
                border-color: #bae6fd !important;
            }

            .border-secondary-subtle {
                border-color: #e5e7eb !important;
            }

            .bg-primary-subtle {
                background: #e0f2fe !important;
            }

            .bg-success-subtle {
                background: #d1fae5 !important;
            }

            .bg-danger-subtle {
                background: #fee2e2 !important;
            }

            .bg-warning-subtle {
                background: #fef9c3 !important;
            }

            .bg-info-subtle {
                background: #e0f2fe !important;
            }

            .bg-secondary-subtle {
                background: #f3f4f6 !important;
            }
        </style>
    @endpush

    {{-- <a href="{{ route('students.index') }}" class="btn btn-secondary mt-4">Back to List</a> --}}
@endsection

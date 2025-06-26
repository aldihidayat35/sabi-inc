@extends('frontend.layouts.app')

@section('title', 'Profil Siswa')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card shadow border-0 p-4">
                    <div class="d-flex flex-column align-items-center">
                        <div class="profile-img-wrapper mb-3">
                            <img src="{{ asset($student->photo_profil ?? 'default.png') }}" class="rounded-circle profile-img"
                                width="120" height="120" alt="Foto Profil">
                        </div>
                        @php
                            $diamond = $totalDiamond ?? 0;
                            $rank = \App\Models\Student::orderByDesc('diamond_points')->pluck('id')->search($student->id) + 1;
                        @endphp
                        <div class="mb-2 d-flex justify-content-center">
                            <span class="badge px-3 py-2"
                                style="background: linear-gradient(90deg, #ff9800 0%, #f44336 100%); color: #fff; font-size:1.05rem; box-shadow: 0 2px 8px rgba(255,152,0,0.15); border-radius: 1.5rem;">
                                <i class="bi bi-trophy-fill me-1 text-light"></i> #{{ $rank }}
                            </span>
                        </div>
                        <h3 class="mb-1 fw-bold d-flex align-items-center justify-content-center">
                            {{ $student->nama }}

                        </h3>
                        <div class="text-muted mb-2">{{ $student->asal_sekolah }}</div>
                        <div class="d-flex justify-content-center gap-5 mb-3">
                            <div class="text-center">
                                <span class="fw-bold fs-4 text-primary" id="followers-count" style="cursor:pointer;"
                                    data-bs-toggle="modal" data-bs-target="#followersModal">
                                    <i class="bi bi-people-fill me-1"></i>{{ $followersCount }}
                                </span>
                                <div class="small text-muted">Pengikut</div>
                            </div>
                            <div class="text-center">
                                <span class="fw-bold fs-4 text-info" id="followings-count" style="cursor:pointer;"
                                    data-bs-toggle="modal" data-bs-target="#followingsModal">
                                    <i class="bi bi-person-check-fill me-1"></i>{{ $followingsCount }}
                                </span>
                                <div class="small text-muted">Mengikuti</div>
                            </div>
                        </div>
                        <div class="row justify-content-center mb-3">
                            <div class="col-6 col-md-3 mb-2">
                                <div class="border rounded-3 py-2 px-2 text-center bg-light shadow-sm">
                                    <div class="fw-bold fs-5 text-success">
                                        <i class="bi bi-collection-play-fill me-1"></i>{{ $totalWorks }}
                                    </div>
                                    <div class="small text-muted">Total Karya</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 mb-2">
                                <div class="border rounded-3 py-2 px-2 text-center bg-light shadow-sm">
                                    <div class="fw-bold fs-5 text-warning">
                                        <i class="bi bi-star-fill me-1"></i>{{ number_format($avgRating, 2) }}
                                    </div>
                                    <div class="small text-muted">Rata-rata Rating</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 mb-2">
                                <div class="border rounded-3 py-2 px-2 text-center bg-light shadow-sm">
                                    <div class="fw-bold fs-5" style="color:#00bcd4;">
                                        <i class="bi bi-gem me-1"></i>{{ $totalDiamond }}
                                    </div>
                                    <div class="small text-muted">Diamond</div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 mb-2">
                                <div class="border rounded-3 py-2 px-2 text-center bg-light shadow-sm">
                                    <div class="fw-bold fs-5 text-danger">
                                        <i class="bi bi-hand-thumbs-up-fill me-1"></i>{{ $totalLikes }}
                                    </div>
                                    <div class="small text-muted">Total Like</div>
                                </div>
                            </div>
                        </div>
                        @auth('student')
                            @if (auth('student')->id() !== $student->id)
                                <form
                                    action="{{ $isFollowing ? route('student.profile.unfollow', $student->id) : route('student.profile.follow', $student->id) }}"
                                    method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit"
                                        class="btn {{ $isFollowing ? 'btn-danger' : 'btn-outline-primary' }} px-4 py-2 fw-semibold"
                                        id="follow-btn" style="transition:all 0.2s;">
                                        <span class="follow-text">{{ $isFollowing ? 'Mengikuti' : 'Ikuti' }}</span>
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Followers --}}
    <div class="modal fade" id="followersModal" tabindex="-1" aria-labelledby="followersModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="followersModalLabel">Pengikut</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="followers-list">
                    @if (isset($followersList) && $followersList->count())
                        @foreach ($followersList as $f)
                            <div class="d-flex align-items-center mb-2">
                                <img src="{{ asset($f->photo_profil ?? 'default.png') }}" class="rounded-circle me-2"
                                    width="36" height="36">
                                <span>{{ $f->nama }}</span>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center text-muted">Belum ada pengikut.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Followings --}}
    <div class="modal fade" id="followingsModal" tabindex="-1" aria-labelledby="followingsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="followingsModalLabel">Mengikuti</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="followings-list">
                    @if (isset($followingsList) && $followingsList->count())
                        @foreach ($followingsList as $f)
                            <div class="d-flex align-items-center mb-2">
                                <img src="{{ asset($f->photo_profil ?? 'default.png') }}" class="rounded-circle me-2"
                                    width="36" height="36">
                                <span>{{ $f->nama }}</span>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center text-muted">Belum mengikuti siapapun.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Card List Karya --}}
    <div class="row mt-5">
        <div class="col-12">
            <div class="">
                <div class="">
                    <h5 class="mb-3 fw-bold"><i class="bi bi-collection-play-fill text-primary me-2"></i>Semua Karya</h5>
                    @if ($worksLatest->count())
                        <div class="row">
                            @foreach ($worksLatest as $work)
                                <div class="col-md-6 mb-3">
                                    <div class="card border-0 shadow-sm rounded-4 flex-row align-items-stretch bg-white h-100"
                                        style="min-height: 160px;">
                                        @if ($work->cover_photo)
                                            <div class="d-flex flex-column align-items-center justify-content-center p-0"
                                                style="width: 120px; min-width:120px; background: #f8f9fa; height: 160px; overflow: hidden; border-top-left-radius: 0.75rem; border-bottom-left-radius: 0.75rem;">
                                                <img src="{{ asset($work->cover_photo) }}" alt="Cover"
                                                    class="img-fluid"
                                                    style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                                            </div>
                                        @else
                                            <div class="d-flex flex-column align-items-center justify-content-center p-0"
                                                style="width: 120px; min-width:120px; background: #f0f0f0; height: 160px; border-top-left-radius: 0.75rem; border-bottom-left-radius: 0.75rem;">
                                                <span class="text-muted small"><i class="bi bi-image"></i> No Cover</span>
                                            </div>
                                        @endif
                                        <div class="card-body py-3 px-4 d-flex flex-column justify-content-between"
                                            style="min-height: 160px;">
                                            <div>
                                                <h6 class="fw-bold mb-1">
                                                    <a href="{{ route('frontend.works.show', $work->id) }}"
                                                        class="text-decoration-none text-dark">{{ $work->title }}</a>
                                                </h6>
                                                <div class="small text-muted mb-1"><i
                                                        class="bi bi-calendar-event me-1"></i>{{ $work->created_at->format('d M Y') }}
                                                </div>
                                                <div class="mb-2 text-grey">
                                                    {{ \Illuminate\Support\Str::limit(strip_tags($work->description), 80) }}
                                                </div>
                                                <div class="d-flex gap-2 mt-2">
                                                    <span
                                                        class="badge bg-success bg-opacity-10 text-success border border-success d-flex align-items-center px-2 py-1">
                                                        <i class="bi bi-hand-thumbs-up-fill me-1"></i>
                                                        {{ $work->likesCount() }}
                                                    </span>
                                                    <span
                                                        class="badge bg-warning bg-opacity-10 text-warning border border-warning d-flex align-items-center px-2 py-1">
                                                        <i class="bi bi-star-fill me-1"></i>
                                                        {{ number_format($work->averageRating(), 2) }}
                                                    </span>
                                                    <span
                                                        class="badge bg-info bg-opacity-10 text-info border border-info d-flex align-items-center px-2 py-1">
                                                        <i class="bi bi-eye-fill me-1"></i> {{ $work->views }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center text-muted">Belum ada karya.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @push('styles')
    @endpush
    @push('styles')
        <style>
            .card.flex-row {
                flex-direction: row;
            }

            .card.flex-row .card-body {
                flex: 1 1 auto;
            }
        </style>
    @endpush

    @push('styles')
        <style>
            .profile-img-wrapper {
                padding: 4px;
                background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
                border-radius: 50%;
                display: inline-block;
            }

            .profile-img {
                border: 4px solid #fff;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            }

            #follow-btn {
                min-width: 120px;
                transition: background 0.2s, color 0.2s, border 0.2s;
            }

            #follow-btn.following {
                background: #dc3545;
                color: #fff;
                border: none;
            }

            #follow-btn:not(.following):hover {
                background: #0d6efd;
                color: #fff;
            }

            .card {
                border-radius: 18px;
            }

            .card .badge {
                font-size: 0.95rem;
                font-weight: 500;
                border-radius: 1rem;
            }

            .card .card-body {
                background: transparent;
            }
        </style>
    @endpush
@endsection

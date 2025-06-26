@extends('frontend.layouts.app')

@section('title', $work->title)

@section('content')
    <!--begin::Content-->
    <div class="flex-lg-row-fluid me-xl-15">
        <!--begin::Post content-->
        <div class="mb-17">
            <!--begin::Wrapper-->
            <div class="mb-8">
                <!--begin::Info-->
                <div class="d-flex flex-wrap mb-6">
                    <!--begin::Item-->
                    <div class="me-9 my-1">
                        <i class="ki-duotone ki-element-11 text-primary fs-2 me-1"></i>
                        <span class="fw-bold text-gray-500">{{ $work->created_at->format('d M Y') }}</span>
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    {{-- <div class="me-9 my-1">
                        <i class="ki-duotone ki-briefcase text-primary fs-2 me-1"></i>
                        <span class="fw-bold text-gray-500">{{ $work->status }}</span>
                    </div> --}}
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="me-9 my-1">
                        <i class="bi bi-eye text-primary fs-2 me-1"></i>
                        <span class="fw-bold text-gray-500">{{ $work->views ?? 0 }} Views</span>
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="my-1">
                        <i class="ki-duotone ki-message-text-2 text-primary fs-2 me-1"></i>
                        <span class="fw-bold text-gray-500">{{ $work->comments_count ?? 0 }} Komentar</span>
                    </div>
                    <!--end::Item-->
                </div>
                <!--end::Info-->
                <!--begin::Title-->
                <h1 class="text-gray-900 text-hover-primary fs-2 fw-bold mb-2">{{ $work->title }}</h1>
                <p class="mb-4 text-gray-600 fs-5">{{ $work->description }}</p>
                <div class="d-flex flex-wrap align-items-center gap-2 mb-4">
                    <span class="badge p-2 bg-success d-flex align-items-center px-3 py-2 fs-6">
                        <i class="text-light bi bi-hand-thumbs-up me-1 "></i> {{ $work->likesCount() }} Like
                    </span>
                    <span class="badge p-2 bg-danger d-flex align-items-center px-3 py-2 fs-6">
                        <i class="text-light bi bi-hand-thumbs-down me -1"></i> {{ $work->dislikesCount() }} Dislike
                    </span>
                    <span class="badge p-2 bg-warning text-dark d-flex align-items-center px-3 py-2 fs-6">
                        <i class="text-light bi bi-star-fill me-1"></i>
                        {{ number_format($work->averageRating(), 2) ?? '0.00' }} / 5
                    </span>
                </div>
                <!--end::Title-->
                <!--begin::Container-->
                @if ($work->cover_photo)
                    <div class="overlay mt-8">
                        <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-350px"
                            style="background-image:url('{{ asset($work->cover_photo) }}')"></div>
                    </div>
                @endif
                <!--end::Container-->
            </div>
            <!--end::Wrapper-->
            <!--begin::Description-->
            <div class="fs-5 fw-semibold text-gray-600">
                <div class="p-4 border ">
                    {!! $work->content !!}
                </div>
            </div>
            <!--end::Description-->
            <br>
            <!--begin::Block-->
            @if ($work->author)
                <a href="{{ route('student.profile.show', $work->author->id) }}" class="text-decoration-none">
                    <div class="d-flex align-items-center border-3 border-dashed card-rounded p-5 p-lg-10 mb-14 author-card" style="cursor:pointer; transition:box-shadow 0.2s;">
                        <!--begin::Section-->
                        <div class="text-center flex-shrink-0 me-7 me-lg-13">
                            <div class="symbol symbol-70px symbol-circle mb-2">
                                <img src="{{ asset($work->author->photo_profil ?? 'default.png') }}" alt="Author Photo">
                            </div>

                        </div>
                        <!--end::Section-->
                        <!--begin::Text-->
                        <div class="mb-0 ">
                            <div class="mb-0">
                                <span class="text-gray-700 fs-4 fw-bold text-hover-primary">{{ $work->author->nama }}</span>
                                <span class="text-gray-500 fs-7 fw-semibold d-block mt-1">Author</span>
                            </div>
                            {{-- <div class="text-muted fw-semibold lh-lg mb-2">{{ $work->author->bio ?? 'No bio available.' }}</div> --}}
                            <span class="fw-semibold link-primary">Lihat Profil</span>
                        </div>
                        <!--end::Text-->
                    </div>
                </a>
            @endif
            <!--end::Block-->
            <!--begin::Item-->
            <!-- resources/views/components/rating-feedback.blade.php -->
            <div class="d-flex flex-column gap-3 p-4 rounded border bg-white shadow-sm " id="like-dislike-rating"
                style="max-width: 400px;">



                <h4 class="mb-3 mt-2 text-center">Berikan Feedback</h4>
                @auth('student')
                    @php
                        $userRating = $work
                            ->ratings()
                            ->where('student_id', auth('student')->id())
                            ->first();
                    @endphp
                    <form action="{{ route('frontend.works.rating.store', $work->id) }}" method="POST"
                        class="d-flex flex-column gap-3">
                        @csrf

                        <!-- Star Rating -->
                        <div class="d-flex align-items-center gap-2 flex-wrap justify-content-center" id="star-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                <input type="radio" class="btn-check" name="rating" id="star-{{ $i }}"
                                    value="{{ $i }}" autocomplete="off"
                                    {{ old('rating', $userRating->rating ?? '') == $i ? 'checked' : '' }}>
                                <label
                                    class="btn btn-light border-0 px-2 py-1 {{ old('rating', $userRating->rating ?? '') == $i ? 'selected' : '' }}"
                                    for="star-{{ $i }}" style="font-size: 1.5rem;">
                                    <i class="bi {{ old('rating', $userRating->rating ?? 0) >= $i ? 'bi-star-fill text-warning fs-1' : 'bi-star text-muted' }}"
                                        data-value="{{ $i }}"></i>
                                </label>
                            @endfor
                        </div>

                        <!-- Like / Dislike -->
                        <div class="d-flex justify-content-center gap-3">
                            <button type="submit" name="type" value="like"
                                class="btn btn-icon rounded-circle {{ old('type', $userRating->type ?? '') == 'like' ? 'active' : '' }}"
                                id="like-btn"
                                style="width: 45px; height: 45px; background: transparent; border: 2px solid {{ old('type', $userRating->type ?? '') == 'like' ? '#198754' : 'transparent' }};">
                                <i class="bi bi-hand-thumbs-up fs-1" style="color: #198754;"></i>
                            </button>
                            <button type="submit" name="type" value="dislike"
                                class="btn btn-icon rounded-circle {{ old('type', $userRating->type ?? '') == 'dislike' ? 'active' : '' }}"
                                id="dislike-btn"
                                style="width: 45px; height: 45px; background: transparent; border: 2px solid {{ old('type', $userRating->type ?? '') == 'dislike' ? '#dc3545' : 'transparent' }};">
                                <i class="bi bi-hand-thumbs-down fs-1" style="color: #dc3545;"></i>
                            </button>
                        </div>
                        <!-- Star Rating Outline -->
                        <style>
                            #star-rating label.btn {
                                border: 2px solid transparent;
                                border-radius: 50%;
                                background: transparent !important;
                                width: 45px;
                                height: 45px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                margin: 0 2px;
                                transition: border-color 0.2s;
                                padding: 0;
                            }

                            #star-rating label.btn.selected {
                                border-color: #ffc107 !important;
                                background: transparent !important;
                            }

                            #star-rating .bi-star,
                            #star-rating .bi-star-fill {
                                font-size: 1.3rem;
                                cursor: pointer;
                                color: #e4e5e9;
                                transition: color 0.2s;
                            }

                            #star-rating .bi-star.selected,
                            #star-rating .bi-star-fill.selected {
                                color: #ffc107 !important;
                            }
                        </style>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Star outline and fill effect
                                let starRadios = document.querySelectorAll('#star-rating input[type="radio"]');
                                let starLabels = document.querySelectorAll('#star-rating label.btn');
                                let starIcons = document.querySelectorAll('#star-rating .bi');

                                function updateStars(idx) {
                                    starLabels.forEach(function(label, i) {
                                        if (i === idx) {
                                            label.classList.add('selected');
                                        } else {
                                            label.classList.remove('selected');
                                        }
                                    });
                                    starIcons.forEach(function(icon, i) {
                                        if (i <= idx) {
                                            icon.classList.add('selected', 'bi-star-fill');
                                            icon.classList.remove('bi-star', 'text-muted');
                                            icon.classList.add('text-warning');
                                        } else {
                                            icon.classList.remove('selected', 'bi-star-fill', 'text-warning');
                                            icon.classList.add('bi-star', 'text-muted');
                                        }
                                    });
                                }
                                starRadios.forEach(function(radio, idx) {
                                    radio.addEventListener('change', function() {
                                        updateStars(idx);
                                    });
                                });
                                // Initial state
                                let checked = document.querySelector('#star-rating input[type=radio]:checked');
                                if (checked) {
                                    let idx = Array.from(starRadios).indexOf(checked);
                                    updateStars(idx);
                                }
                                // Add outline and fill on click (for accessibility)
                                starLabels.forEach(function(label, idx) {
                                    label.addEventListener('click', function() {
                                        updateStars(idx);
                                    });
                                });
                            });
                        </script>
                    </form>
                @else
                    <span class="text-muted small text-center">Login untuk memberikan rating</span>
                @endauth

                @auth('student')
                    <form id="favorite-form" action="{{ route('frontend.works.favorite.toggle', $work->id) }}" method="POST" class="mt-3 text-center">
                        @csrf
                        <button type="submit" id="favorite-btn"
                            class="btn px-4 py-2 rounded-pill shadow-sm d-flex align-items-center justify-content-center mx-auto"
                            style="
                                font-size:1.1rem;
                                border: 2px solid {{ $work->isFavoritedBy(auth('student')->user()) ? '#dc3545' : '#ffc107' }};
                                background: {{ $work->isFavoritedBy(auth('student')->user()) ? '#fff0f3' : '#fffbe6' }};
                                color: {{ $work->isFavoritedBy(auth('student')->user()) ? '#dc3545' : '#ffc107' }};
                                transition: border-color 0.2s, background 0.2s, color 0.2s;
                            ">
                            <i class="bi {{ $work->isFavoritedBy(auth('student')->user()) ? 'bi-heart-fill text-danger' : 'bi-heart text-warning' }}"
                                id="favorite-icon"
                                style="font-size:1.4rem; margin-right: 8px;"></i>
                            <span id="favorite-text" style="font-weight: 600;">
                                {{ $work->isFavoritedBy(auth('student')->user()) ? 'Favorit' : 'Tambah ke Favorit' }}
                            </span>
                        </button>
                    </form>
                    <style>
                        #favorite-btn:hover, #favorite-btn:focus {
                            border-color: #fd7e14 !important;
                            background: #fff3e6 !important;
                            color: #fd7e14 !important;
                        }
                        #favorite-btn .bi-heart, #favorite-btn .bi-heart-fill {
                            transition: color 0.2s;
                        }
                        #favorite-btn:hover .bi-heart, #favorite-btn:hover .bi-heart-fill {
                            color: #fd7e14 !important;
                        }
                    </style>
                @endauth
            </div>

            @push('styles')
                <style>
                    #like-dislike-rating .btn-icon {
                        transition: box-shadow 0.2s, border-color 0.2s;
                        background: transparent !important;
                        border-width: 2px;
                        border-color: transparent;
                    }

                    #like-dislike-rating .btn-icon.active#like-btn {
                        border-color: #198754 !important;
                        background: transparent !important;
                    }

                    #like-dislike-rating .btn-icon.active#dislike-btn {
                        border-color: #dc3545 !important;
                        background: transparent !important;
                    }

                    #like-dislike-rating .btn-icon:focus {
                        box-shadow: none;
                    }
                </style>
            @endpush

            @push('scripts')
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Star rating highlight
                        let stars = document.querySelectorAll('#star-rating .bi-star, #star-rating .bi-star-fill');
                        let starLabels = document.querySelectorAll('#star-rating label.btn');
                        stars.forEach(function(star, idx) {
                            star.addEventListener('mouseenter', function() {
                                for (let i = 0; i <= idx; i++) {
                                    stars[i].classList.add('selected', 'bi-star-fill');
                                    stars[i].classList.remove('bi-star', 'text-muted');
                                    stars[i].classList.add('text-warning');
                                }
                                for (let i = idx + 1; i < stars.length; i++) {
                                    stars[i].classList.remove('selected', 'bi-star-fill', 'text-warning');
                                    stars[i].classList.add('bi-star', 'text-muted');
                                }
                                starLabels.forEach(function(label, i) {
                                    if (i === idx) {
                                        label.classList.add('selected');
                                    } else {
                                        label.classList.remove('selected');
                                    }
                                });
                            });
                            star.addEventListener('mouseleave', function() {
                                let checked = document.querySelector('#star-rating input[type=radio]:checked');
                                let val = checked ? parseInt(checked.value) : 0;
                                for (let i = 0; i < stars.length; i++) {
                                    if (i < val) {
                                        stars[i].classList.add('selected', 'bi-star-fill');
                                        stars[i].classList.remove('bi-star', 'text-muted');
                                        stars[i].classList.add('text-warning');
                                    } else {
                                        stars[i].classList.remove('selected', 'bi-star-fill', 'text-warning');
                                        stars[i].classList.add('bi-star', 'text-muted');
                                    }
                                }
                                starLabels.forEach(function(label, i) {
                                    if (i === val - 1) {
                                        label.classList.add('selected');
                                    } else {
                                        label.classList.remove('selected');
                                    }
                                });
                            });
                        });

                        // Like/Dislike outline effect
                        let likeBtn = document.getElementById('like-btn');
                        let dislikeBtn = document.getElementById('dislike-btn');
                        if (likeBtn && dislikeBtn) {
                            likeBtn.addEventListener('click', function(e) {
                                likeBtn.classList.add('active');
                                likeBtn.style.borderColor = '#198754';
                                dislikeBtn.classList.remove('active');
                                dislikeBtn.style.borderColor = 'transparent';
                            });
                            dislikeBtn.addEventListener('click', function(e) {
                                dislikeBtn.classList.add('active');
                                dislikeBtn.style.borderColor = '#dc3545';
                                likeBtn.classList.remove('active');
                                likeBtn.style.borderColor = 'transparent';
                            });
                        }
                    });
                </script>
            @endpush
            {{-- Komentar Karya --}}
            <div class="mt-5 card p-4 shadow-sm rounded">
                <h4>Komentar</h4>
                @php
                    // Ambil komentar utama (parent_id null) beserta relasi replies dan student
                    $comments = $work
                        ->comments()
                        ->whereNull('parent_id')
                        ->with(['replies.student', 'student'])
                        ->latest()
                        ->get();
                    // Fungsi rekursif untuk menampilkan balasan bertingkat
                    function renderReplies($replies, $work)
                    {
                        foreach ($replies as $reply) {
                            echo '<div class="ms-4 mt-2 border-start ps-3">';
                            echo '<div class="d-flex align-items-center mb-1">';
                            echo '<span class="me-1 text-primary">&#8594;</span>'; // tanda panah ke kanan
                            echo '<strong>' . ($reply->student->name ?? 'Siswa') . '</strong>';
                            echo ' <span class="text-muted small ms-2">' .
                                $reply->created_at->diffForHumans() .
                                '</span>';
                            echo '</div>';
                            echo '<div>' . $reply->comment . '</div>';
                            if (auth('student')->check()) {
                                // Accordion header untuk reply form
                                echo '<div class="accordion mb-2" id="replyAccordion-' . $reply->id . '">';
                                echo '<div class="accordion-item border-0">';
                                echo '<h2 class="accordion-header" id="heading-' . $reply->id . '">';
                                echo '<button class="accordion-button collapsed px-2 py-1" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-' .
                                    $reply->id .
                                    '" aria-expanded="false" aria-controls="collapse-' .
                                    $reply->id .
                                    '" style="font-size: 0.95rem; background: transparent;">';
                                echo '<i class="bi bi-reply me-1"></i> Balas';
                                echo '</button>';
                                echo '</h2>';
                                echo '<div id="collapse-' .
                                    $reply->id .
                                    '" class="accordion-collapse collapse" aria-labelledby="heading-' .
                                    $reply->id .
                                    '">';
                                echo '<div class="accordion-body p-0" style="background: transparent;">';
                                echo '<form action="' .
                                    route('frontend.works.comments.store', $work->id) .
                                    '" method="POST" class="wa-chat-input-form mt-3 reply-form animate-reply" id="reply-form-' .
                                    $reply->id .
                                    '">';
                                echo csrf_field();
                                echo '<input type="hidden" name="parent_id" value="' . $reply->id . '">';
                                echo '<div class="wa-chat-input-row d-flex align-items-center rounded-pill px-3 py-2 shadow-sm" style="border:1px solid #ece5dd; background: transparent;">';
                                echo '<textarea name="comment" class="form-control border-0 wa-chat-input-textarea" rows="1" placeholder="Tulis balasan komentar..." required style="resize:none;box-shadow:none;background:transparent;padding:0 8px;min-height:36px;max-height:80px;outline:none;"></textarea>';
                                echo '<button type="submit" class="btn btn-success rounded-circle ms-2 d-flex align-items-center justify-content-center" style="width:40px;height:40px;">';
                                echo '<i class="bi bi-send-fill fs-4 text-white"></i>';
                                echo '</button>';
                                echo '</div>';
                                echo '</form>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                            // Rekursif untuk balasan lebih dalam
                            if ($reply->replies && $reply->replies->count()) {
                                renderReplies($reply->replies, $work);
                            }
                            echo '</div>';
                        }
                    }
                @endphp
                @foreach ($comments as $comment)
                    <div class="mb-3 border-bottom pb-2">
                        <strong>{{ $comment->student->name ?? 'Siswa' }}</strong>
                        <span class="text-muted small">{{ $comment->created_at->diffForHumans() }}</span>
                        <div>{{ $comment->comment }}</div>
                        @auth('student')
                            {{-- <button type="button" class="btn btn-sm btn-light-primary reply-btn d-inline-flex align-items-center px-2 py-1" data-id="{{ $comment->id }}" style="font-size: 0.95rem;">

                            <span class="ms-1">Balas</span>
                        </button> --}}
                            <div class="accordion mb-2" id="replyAccordion-{{ $comment->id }}">
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header" id="heading-{{ $comment->id }}">
                                        <button class="accordion-button collapsed px-2 py-1" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse-{{ $comment->id }}"
                                            aria-expanded="false" aria-controls="collapse-{{ $comment->id }}"
                                            style="font-size: 0.95rem; background: transparent;">
                                            <i class="bi bi-reply me-1"></i> Balas
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $comment->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading-{{ $comment->id }}">
                                        <div class="accordion-body p-0" style="background: transparent;">
                                            <form action="{{ route('frontend.works.comments.store', $work->id) }}"
                                                method="POST" class="wa-chat-input-form mt-3 reply-form animate-reply"
                                                id="reply-form-{{ $comment->id }}">
                                                @csrf
                                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                <div class="wa-chat-input-row d-flex align-items-center rounded-pill px-3 py-2 shadow-sm"
                                                    style="border:1px solid #ece5dd; background: transparent;">
                                                    <textarea name="comment" class="form-control border-0 wa-chat-input-textarea" rows="1"
                                                        placeholder="Tulis balasan komentar..." required
                                                        style="resize:none;box-shadow:none;background:transparent;padding:0 8px;min-height:36px;max-height:80px;outline:none;"></textarea>
                                                    <button type="submit"
                                                        class="btn btn-success rounded-circle ms-2 d-flex align-items-center justify-content-center"
                                                        style="width:40px;height:40px;">
                                                        <i class="bi bi-send-fill fs-4 text-white"></i>
                                                    </button>
                                                </div>
                                                @error('comment')
                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endauth

                        {{-- Tampilkan balasan bertingkat --}}
                        @php
                            if ($comment->replies && $comment->replies->count()) {
                                renderReplies($comment->replies, $work);
                            }
                        @endphp
                    </div>
                @endforeach

                @auth('student')
                    <form action="{{ route('frontend.works.comments.store', $work->id) }}" method="POST"
                        class="wa-chat-input-form mt-3">
                        @csrf
                        <div class="wa-chat-input-row d-flex align-items-center rounded-pill px-3 py-2 shadow-sm"
                            style="border:1px solid #ece5dd; background: transparent;">
                            <textarea name="comment" class="form-control border-0 wa-chat-input-textarea" rows="1"
                                placeholder="Ketik komentar..." required
                                style="resize:none;box-shadow:none;background:transparent;padding:0 8px;min-height:36px;max-height:80px;outline:none;"></textarea>
                            <button type="submit"
                                class="btn btn-success rounded-circle ms-2 d-flex align-items-center justify-content-center"
                                style="width:40px;height:40px;">
                                <i class="bi bi-send-fill fs-4 text-white"></i>
                            </button>
                        </div>
                        @error('comment')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </form>
                @else
                    <div class="alert alert-warning mt-3">
                        Silakan <a href="{{ route('student.login') }}">login sebagai siswa</a> untuk berkomentar.
                    </div>
                @endauth
            </div>

            @push('styles')
                <style>
                    .animate-reply {
                        transition: all 0.3s cubic-bezier(.4, 2, .6, 1);
                        margin-left: 30px;
                        opacity: 0;
                        max-height: 0;
                        overflow: hidden;
                        pointer-events: none;
                    }

                    .animate-reply.active {
                        opacity: 1;
                        max-height: 200px;
                        margin-left: 40px;
                        pointer-events: auto;
                    }

                    .wa-chat-input-form {
                        position: sticky;
                        bottom: 0;
                        background: #f0f0f0;
                        z-index: 10;
                        padding-bottom: 10px;
                    }

                    .wa-chat-input-row {
                        min-height: 48px;
                    }

                    .wa-chat-input-textarea {
                        background: transparent;
                        border: none;
                        outline: none;
                        width: 100%;
                        min-height: 36px;
                        max-height: 80px;
                        resize: none;
                        font-size: 1rem;
                    }

                    .wa-chat-input-form button[type="submit"] {
                        background: #25d366;
                        border: none;
                        transition: background 0.2s;
                    }

                    .wa-chat-input-form button[type="submit"]:hover {
                        background: #128c7e;
                    }

                    #star-rating .bi-star,
                    #star-rating .bi-star-fill {
                        font-size: 1.3rem;
                        cursor: pointer;
                        color: #ffc107;
                        transition: color 0.2s;
                    }

                    #star-rating .bi-star {
                        color: #e4e5e9;
                    }

                    #star-rating .bi-star.selected,
                    #star-rating .bi-star-fill.selected {
                        color: #ffc107;
                    }

                    #like-btn.active,
                    #dislike-btn.active {
                        border: 2px solid #198754;
                        background: #e9fbe7;
                    }

                    #dislike-btn.active {
                        border-color: #dc3545;
                        background: #fbe9e9;
                    }

                    .btn-check:checked+.btn-outline-warning>i {
                        color: #ffc107 !important;
                    }

                    .btn-outline-warning>i {
                        color: #e4e5e9;
                    }

                    .btn-check:checked+.btn-outline-warning {
                        background: #fffbe6;
                        border-color: #ffc107;
                    }
                </style>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
            @endpush

            @push('scripts')
                <script>
                    @auth('student')
                        document.addEventListener('DOMContentLoaded', function() {
                            let likeBtn = document.getElementById('like-btn');
                            let dislikeBtn = document.getElementById('dislike-btn');
                            let typeInput = document.getElementById('type-input');
                            let ratingInput = document.getElementById('rating-input');
                            let stars = document.querySelectorAll('#star-rating .bi-star, #star-rating .bi-star-fill');
                            let feedbackForm = document.getElementById('feedback-form');
                            let submitBtn = document.getElementById('submit-feedback');

                            likeBtn.addEventListener('click', function(e) {
                                e.preventDefault();
                                typeInput.value = 'like';
                                likeBtn.classList.add('active');
                                dislikeBtn.classList.remove('active');
                            });
                            dislikeBtn.addEventListener('click', function(e) {
                                e.preventDefault();
                                typeInput.value = 'dislike';
                                dislikeBtn.classList.add('active');
                                likeBtn.classList.remove('active');
                            });
                            stars.forEach(function(star) {
                                star.addEventListener('click', function() {
                                    let val = parseInt(star.getAttribute('data-value'));
                                    ratingInput.value = val;
                                    stars.forEach(function(s, idx) {
                                        if (idx < val) {
                                            s.classList.add('selected');
                                            s.classList.remove('bi-star');
                                            s.classList.add('bi-star-fill');
                                        } else {
                                            s.classList.remove('selected');
                                            s.classList.remove('bi-star-fill');
                                            s.classList.add('bi-star');
                                        }
                                    });
                                });
                            });

                            feedbackForm.addEventListener('submit', function(e) {
                                // Validasi: harus pilih like/dislike atau rating
                                if (!typeInput.value && !ratingInput.value) {
                                    e.preventDefault();
                                    alert('Pilih Like/Dislike atau Rating bintang terlebih dahulu!');
                                    submitBtn.disabled = false;
                                    return false;
                                }
                                // Pastikan tombol submit tidak mati
                                submitBtn.disabled = false;
                            });
                        });
                    @endauth
                </script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    @if (session('feedback_success'))
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: '{{ session('feedback_success') }}',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    @endif

                    @if ($errors->has('feedback'))
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: '{{ $errors->first('feedback') }}',
                            timer: 2500,
                            showConfirmButton: false
                        });
                    @endif
                </script>
                <script>
                    @if(session('success') && session('swal'))
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: '{{ session('success') }}',
                            timer: 1800,
                            showConfirmButton: false
                        });
                    @endif
                </script>
            @endpush
        </div>
        <!--end::Post content-->
    </div>
    <!--end::Content-->
@endsection

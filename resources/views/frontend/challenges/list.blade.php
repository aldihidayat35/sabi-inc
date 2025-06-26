@extends('frontend.layouts.app')

@section('title', 'Daftar Tantangan')

@section('content')
    <div class="container my-5">
        <h2 class="fw-bold mb-4">Tantangan yang Diikuti</h2>
        @auth('student')
            @if ($joinedChallenges->count())
                <div class="mb-5">
                    <div class="row g-3" style="margin-left:-12px;margin-right:-12px;">
                        @foreach ($joinedChallenges as $challenge)
                            <div class="col-12 px-0">
                                <a href="{{ route('frontend.challenges.show', $challenge->id) }}" class="text-decoration-none">
                                    <div class="card flex-row align-items-center rounded-4 shadow-sm border-0 p-2"
                                        style="min-height:110px;">
                                        <div class="flex-shrink-0">
                                            <img src="{{ $challenge->cover_photo ? asset($challenge->cover_photo) : asset('assets2/media/illustrations/sketchy-1/1.png') }}"
                                                alt="{{ $challenge->name }}" class="rounded-3"
                                                style="width:90px;height:90px;object-fit:cover;">
                                        </div>
                                        <div class="flex-grow-1 ms-3 d-flex flex-column justify-content-between"
                                            style="min-height:90px;">
                                            <div>
                                                <div class="fw-semibold text-dark fs-5 mb-1">{{ $challenge->name }}</div>
                                                <div class="text-muted small mb-1">
                                                    {{ $challenge->registrations_count ?? 0 }} peserta
                                                </div>
                                                <div class="d-flex align-items-center gap-1 mb-1">
                                                    <i>💎</i>
                                                    <span class="fw-semibold text-dark"
                                                        style="font-size:15px;">{{ $challenge->reward_diamond_points ?? 0 }}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center gap-3 mt-1">
                                                <td style="width:220px;">
                                                    <span class="badge badge-light-warning fs-8 fw-bold my-2">
                                                        {{ \Carbon\Carbon::parse($challenge->start_time)->format('d M Y') }} -
                                                        {{ \Carbon\Carbon::parse($challenge->end_time)->format('d M Y') }}
                                                    </span>
                                                </td>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="alert alert-info">Belum ada tantangan yang diikuti.</div>
            @endif
        @else
            <div class="alert alert-warning">Silakan login sebagai siswa untuk melihat tantangan yang diikuti.</div>
        @endauth

        <h2 class="fw-bold mb-4 mt-5">Tantangan Aktif</h2>
        <div class="row g-3" style="margin-left:-12px;margin-right:-12px;">
            @forelse($activeChallenges as $challenge)
                <div class="col-12 px-0">
                    <a href="{{ route('frontend.challenges.show', $challenge->id) }}" class="text-decoration-none">
                        <div class="card flex-row align-items-center rounded-4 shadow-sm border-0 p-2"
                            style="min-height:110px;">
                            <div class="flex-shrink-0">
                                <img src="{{ $challenge->cover_photo ? asset($challenge->cover_photo) : asset('assets2/media/illustrations/sketchy-1/1.png') }}"
                                    alt="{{ $challenge->name }}" class="rounded-3"
                                    style="width:90px;height:90px;object-fit:cover;">
                            </div>
                            <div class="flex-grow-1 ms-3 d-flex flex-column justify-content-between"
                                style="min-height:90px;">
                                <div>
                                    <div class="fw-semibold text-dark fs-5 mb-1">{{ $challenge->name }}</div>
                                    <div class="text-muted small mb-1">
                                        {{ $challenge->registrations_count ?? 0 }} peserta
                                    </div>
                                    <div class="d-flex align-items-center gap-1 mb-1">
                                        <i>💎</i>
                                        <span class="fw-semibold text-dark"
                                            style="font-size:15px;">{{ $challenge->reward_diamond_points ?? 0 }}</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-3 mt-1">
                                    <td style="width:220px;">
                                        <span class="badge badge-light-warning fs-8 fw-bold my-2">
                                            {{ \Carbon\Carbon::parse($challenge->start_time)->format('d M Y') }} -
                                            {{ \Carbon\Carbon::parse($challenge->end_time)->format('d M Y') }}
                                        </span>
                                    </td>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info mb-0">Tidak ada tantangan aktif saat ini.</div>
                </div>
            @endforelse
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.challenge-row-card').forEach(function(card) {
                card.addEventListener('click', function() {
                    window.location = this.getAttribute('data-href');
                });
            });
        });
    </script>
@endsection

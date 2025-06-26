@extends('frontend.layouts.app')

@section('title', 'Penilaian Guru')

@section('content')
<div class="container py-4">
        <h2 class="mb-4 fw-bold">Penilaian Guru</h2>

    <!--begin::Penilaian Guru Card List-->
    @if($worksWithScores->isEmpty())
        <div class="card">
            <div class="card-body text-muted text-center">
                Belum ada karya yang dinilai guru.
            </div>
        </div>
    @else
        <div class="row g-4">
            @foreach($worksWithScores as $item)
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                <div class="symbol symbol-60px symbol-2by3 me-4">
                                    <div class="symbol-label"
                                        style="background-image: url('{{ asset($item['work']->cover_photo)  }}')">
                                    </div>
                                </div>
                                <div>
                                    <a href="{{ route('frontend.works.show', $item['work']->id) }}" class="fw-bold text-gray-900 fs-6 text-decoration-none">
                                        {{ $item['work']->title ?? '-' }}
                                    </a>
                                    <div class="text-muted fs-7">
                                        {{ $item['work']->author->nama ?? '-' }}
                                    </div>
                                </div>
                            </div>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="badge badge-light-success fs-7 fw-bold px-3 py-2">
                                    Nilai: {{ $item['average_score'] }} / {{ $item['teacher_count'] }} Guru
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    <!--end::Penilaian Guru Card List-->
</div>
@endsection

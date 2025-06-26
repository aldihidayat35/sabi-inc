@extends('frontend.layouts.app')

@section('title', 'Karya Saya')

@section('content')
<div class="container py-4" style="max-width: 700px;">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('frontend.profil') }}" class="btn btn-link p-0 me-2" style="font-size:1.5rem;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h5 class="mb-0 fw-bold flex-grow-1 text-center" style="letter-spacing:0.5px;">Karya Saya</h5>
        <span style="width:2.5rem;"></span>
    </div>
    @if($works->count() > 0)
        <div class="row g-3">
            @foreach($works as $work)
                <div class="col-6 col-md-4">
                    <div class="card h-100 border-0 shadow-sm cursor-pointer"
                        onclick="window.location='{{ route('frontend.works.show', $work->id) }}'">
                        @if ($work->cover_photo)
                            <img src="{{ asset($work->cover_photo) }}" class="card-img-top" alt="Cover" style="object-fit:cover; height:120px;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height:120px;">
                                <span class="text-muted small">No Image</span>
                            </div>
                        @endif
                        <div class="card-body p-2">
                            <h6 class="card-title fw-bold mb-1" style="font-size: 13px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                                {{ $work->title }}
                            </h6>
                            <div class="text-muted small" style="font-size:11px;">
                                {{ $work->created_at ? $work->created_at->format('d M Y') : '' }}
                            </div>
                            <div class="text-muted small" style="font-size:11px;">
                                Status: {{ $work->status }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center mt-4">
            Belum ada karya yang kamu buat.
        </div>
    @endif
</div>
@endsection

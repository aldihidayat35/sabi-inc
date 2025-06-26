@extends('frontend.layouts.app')

@section('title', 'Favorit Saya')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Karya Favorit Saya</h3>
    @if($favorites->count())
        <div class="row">
            @foreach($favorites as $favorite)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        @if($favorite->work->cover_photo)
                            <img src="{{ asset($favorite->work->cover_photo) }}" class="card-img-top" style="height:180px;object-fit:cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $favorite->work->title }}</h5>
                            <p class="card-text text-muted" style="font-size:0.95rem;">{{ Str::limit($favorite->work->description, 80) }}</p>
                            <a href="{{ route('frontend.works.show', $favorite->work->id) }}" class="btn btn-primary btn-sm">Lihat Karya</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">Belum ada karya yang difavoritkan.</div>
    @endif
</div>
@endsection

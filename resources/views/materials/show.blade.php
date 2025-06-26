@extends('layouts.app')

@section('title', $material->title)

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
                    <span class="fw-bold text-gray-500">{{ $material->created_at->format('d M Y') }}</span>
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="me-9 my-1">
                    <i class="ki-duotone ki-briefcase text-primary fs-2 me-1"></i>
                    <span class="fw-bold text-gray-500">{{ $material->reward_diamond }} Diamonds</span>
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="my-1">
                    <i class="ki-duotone ki-message-text-2 text-primary fs-2 me-1"></i>
                    <span class="fw-bold text-gray-500">{{ $material->comments_count ?? 0 }} Comments</span>
                </div>
                <!--end::Item-->
            </div>
            <!--end::Info-->
            <!--begin::Title-->
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="text-gray-900 text-hover-primary fs-2 fw-bold">{{ $material->title }}</h1>
                    <p class="mb-8">{{ $material->abstract }}</p>
                </div>
                <!--begin::Action Buttons-->
                <div class="d-flex">
                    <a href="{{ route('materials.edit', $material->id) }}" class="btn btn-warning me-2">Edit</a>
                    <form action="{{ route('materials.destroy', $material->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this material?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
                <!--end::Action Buttons-->
            </div>
            <!--end::Title-->

            <!--begin::Container-->
            @if ($material->cover_photo)
            <div class="overlay mt-8">
                <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-350px" style="background-image:url('{{ asset($material->cover_photo) }}')"></div>
            </div>
            @endif
            <!--end::Container-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Description-->
        <div class="fs-5 fw-semibold text-gray-600">
            <div class="p-4 bg-light border rounded">
                {!! htmlspecialchars_decode($material->content) !!}
            </div>
        </div>
        <!--end::Description-->
        @if ($material->author)

        <!--begin::Author Data-->
        <div class="d-flex align-items-center border-1 border-dashed card-rounded p-5 p-lg-10 mb-14">
            <!--begin::Section-->
            <div class="text-center flex-shrink-0 me-7 me-lg-13">
                <div class="symbol symbol-70px symbol-circle mb-2">
                    <img src="{{ asset($material->author->photo_profil ?? 'default.png') }}" alt="Author Photo">
                </div>
                <div class="mb-0">
                    <a href="{{ route('teachers.show', $material->author->id) }}" class="text-gray-700 fw-bold text-hover-primary">{{ $material->author->nama }}</a>
                    <span class="text-gray-500 fs-7 fw-semibold d-block mt-1">Teacher</span>
                </div>
            </div>
            <!--end::Section-->
            <!--begin::Text-->
            <div class="mb-0 fs-6">
                <div class="text-muted fw-semibold lh-lg mb-2">{{ $material->author->bio ?? 'No bio available.' }}</div>
                <a href="{{ route('teachers.show', $material->author->id) }}" class="fw-semibold link-primary">Teacher’s Profile</a>
            </div>
            <!--end::Text-->
        </div>
        <!--end::Author Data-->
        @endif
    </div>
    <!--end::Post content-->
</div>
<!--end::Content-->
@endsection

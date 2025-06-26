@extends('layouts.app')

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
                <div class="me-9 my-1">
                    <i class="ki-duotone ki-briefcase text-primary fs-2 me-1"></i>
                    <span class="fw-bold text-gray-500">{{ $work->status }}</span>
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="my-1">
                    <i class="ki-duotone ki-message-text-2 text-primary fs-2 me-1"></i>
                    <span class="fw-bold text-gray-500">{{ $work->comments_count ?? 0 }} Comments</span>
                </div>
                <!--end::Item-->
            </div>
            <!--end::Info-->
            <!--begin::Title-->
            <h1 class="text-gray-900 text-hover-primary fs-2 fw-bold">{{ $work->title }}</h1>
                        <p class="mb-8">{{ $work->description }}</p>

            <!--end::Title-->
            <!--begin::Container-->
            @if ($work->cover_photo)
            <div class="overlay mt-8">
                <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-350px" style="background-image:url('{{ asset($work->cover_photo) }}')"></div>
            </div>
            @endif
            <!--end::Container-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Description-->
        <div class="fs-5 fw-semibold text-gray-600">
            <div class="p-4 bg-light border rounded">
                {!! $work->content !!}
            </div>
        </div>
        <!--end::Description-->
        <!--begin::Block-->
        <div class="d-flex align-items-center border-1 border-dashed card-rounded p-5 p-lg-10 mb-14">
            <!--begin::Section-->
            <div class="text-center flex-shrink-0 me-7 me-lg-13">
                <div class="symbol symbol-70px symbol-circle mb-2">
                    <img src="{{ asset($work->author->photo ?? 'default.png') }}" alt="Author Photo">
                </div>
                <div class="mb-0">
                    {{-- <a href="#" class="text-gray-700 fw-bold text-hover-primary">{{ $work->author->name }}</a> --}}
                    <span class="text-gray-500 fs-7 fw-semibold d-block mt-1">Author</span>
                </div>
            </div>
            <!--end::Section-->
            <!--begin::Text-->
            <div class="mb-0 fs-6">
                <div class="text-muted fw-semibold lh-lg mb-2">{{ $work->author->bio ?? 'No bio available.' }}</div>
                <a href="#" class="fw-semibold link-primary">Author’s Profile</a>
            </div>
            <!--end::Text-->
        </div>
        <!--end::Block-->

    </div>
    <!--end::Post content-->
</div>
<!--end::Content-->
@endsection

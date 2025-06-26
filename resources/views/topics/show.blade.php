@extends('layouts.app')

@section('title', $topic->title)

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
                    <span class="fw-bold text-gray-500">{{ $topic->created_at->format('d M Y') }}</span>
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="me-9 my-1">
                    <i class="ki-duotone ki-briefcase text-primary fs-2 me-1"></i>
                    <span class="fw-bold text-gray-500">{{ $topic->reward_diamond }} Diamonds</span>
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="my-1">
                    <i class="ki-duotone ki-message-text-2 text-primary fs-2 me-1"></i>
                    <span class="fw-bold text-gray-500">{{ $topic->materials->count() }} Materials</span>
                </div>
                <!--end::Item-->
            </div>
            <!--end::Info-->
            <!--begin::Title-->
            <h1 class="text-gray-900 text-hover-primary fs-2 fw-bold">{{ $topic->title }}</h1>
            <!--end::Title-->
            <!--begin::Container-->
            @if ($topic->cover_photo)
            <div class="overlay mt-8">
                <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-350px" style="background-image:url('{{ asset($topic->cover_photo) }}')"></div>
            </div>
            @endif
            <!--end::Container-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Description-->
        <div class="fs-5 fw-semibold text-gray-600">
            <p class="mb-8">{{ $topic->description }}</p>
        </div>
        <!--end::Description-->
        <!--begin::Materials-->
        <div class="mt-8">
            <h5 class="fw-bold">Materials:</h5>
            <ul class="list-group">
                @foreach ($topic->materials as $material)
                 <!--begin::Item-->
                    <div class="card mb-3 border-0 bg-light ms-8 material-card"
                     style="cursor:pointer;"
                     onclick="window.location='{{ route('materials.show', $material->id) }}'">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="symbol symbol-50px symbol-2by3 me-3 flex-shrink-0">
                        @if ($material->cover_photo)
                            <div class="symbol-label rounded" style="background-image: url('{{ asset($material->cover_photo) }}'); background-size: cover;"></div>
                        @else
                            <div class="symbol-label bg-white rounded d-flex align-items-center justify-content-center" style="height: 100%;">
                            <span class="text-muted small">No Image</span>
                            </div>
                        @endif
                        </div>
                        <div class="flex-grow-1">
                        <span class="text-gray-800 fw-bold text-hover-primary fs-6">{{ $material->title }}</span>
                        <div class="text-muted fw-normal small pt-1">{{ Str::limit($material->abstract, 120) }}</div>
                        </div>
                        <span class="badge badge-light-success fs-8 fw-bold ms-2">{{ $material->reward_diamond }} Diamonds</span>
                    </div>
                    </div>
                    <!--end::Item-->
                @endforeach
            </ul>
        </div>
        <!--end::Materials-->
    </div>
    <!--end::Post content-->
</div>
<!--end::Content-->
@endsection

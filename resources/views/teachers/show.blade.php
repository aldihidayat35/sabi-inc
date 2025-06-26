@extends('layouts.app')

@section('title', 'Teacher Details')

@section('content')
<!--begin::Breadcrumb-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}" class="text-gray-600 text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('teachers.index') }}" class="text-gray-600 text-hover-primary">Teachers</a>
        </li>
        <li class="breadcrumb-item active">Teacher Details</li>
    </ol>
</nav>
<!--end::Breadcrumb-->

<!--begin::Page Header-->
<div class="mb-4">
    <h1 class="text-dark fw-bold">Teacher Details</h1>
    <p class="text-muted">View all details of the selected teacher.</p>
</div>
<!--end::Page Header-->

<div class="card">
    <div class="card-body">
        <!--begin::Details-->
        <div class="d-flex flex-wrap flex-sm-nowrap">
            <!--begin::Pic-->
            <div class="me-7 mb-4">
                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                    <img src="{{ asset($teacher->photo_profil ?? 'default.png') }}" alt="Profile Photo">
                    <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                </div>

            </div>
            <!--end::Pic-->

            <!--begin::Info-->
            <div class="flex-grow-1">
                <!--begin::Title-->
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <!--begin::User-->
                    <div class="d-flex flex-column">
                        <!--begin::Name-->
                        <div class="d-flex align-items-center mb-2">
                            <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $teacher->nama }}</a>
                            <a href="#">
                                <i class="ki-duotone ki-verify fs-1 text-primary">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </a>

                        </div>
                        <!--end::Name-->
                        <!--begin::Info-->
                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                            <span class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                <i class="ki-duotone ki-profile-circle fs-4 me-1"></i>{{ ucfirst($teacher->level) }}
                            </span>
                            <span class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                <i class="ki-duotone ki-geolocation fs-4 me-1"></i>{{ $teacher->tempat_lahir }}
                            </span>
                            <span class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
                                <i class="ki-duotone ki-sms fs-4 me-1"></i>{{ $teacher->email }}
                            </span>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::User-->
                </div>
                <!--end::Title-->

                <!--begin::Stats-->
                <div class="d-flex flex-wrap flex-stack">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column flex-grow-1 pe-8">
                        <!--begin::Stats-->
                        <div class="d-flex flex-wrap">
                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="fw-semibold fs-6 text-gray-500">NIP</div>
                                <div class="fs-2 fw-bold">{{ $teacher->nip }}</div>
                            </div>
                            <!--end::Stat-->
                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="fw-semibold fs-6 text-gray-500">Tanggal Lahir</div>
                                <div class="fs-2 fw-bold">{{ $teacher->tanggal_lahir }}</div>
                            </div>
                            <!--end::Stat-->
                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="fw-semibold fs-6 text-gray-500">Alamat</div>
                                <div class="fs-2 fw-bold">{{ $teacher->alamat }}</div>
                            </div>
                            <!--end::Stat-->
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Stats-->
            </div>
            <!--end::Info-->
                                                        <a href="{{ route('teachers.index') }}" class="btn btn-secondary mt-4 h-100">Back to List</a>

        </div>
        <!--end::Details-->
    </div>
</div>
@endsection

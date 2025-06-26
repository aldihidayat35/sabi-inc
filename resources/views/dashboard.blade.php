@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-fluid" id="kt_content_container">
            <!--begin::Row-->
            <div class="row g-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4 mb-xl-10">
                    <!--begin::Lists Widget 19-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Heading-->
                        <div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-250px"
                            style="background-image:url('assets/media/svg/shapes/top-green.png')" data-bs-theme="light">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column text-white pt-15">
                                <span class="fw-bold fs-2x mb-3">My Dashboard</span>
                                <div class="fs-4 text-white">
                                    <span class="opacity-75">You have</span>
                                    <span class="position-relative d-inline-block">
                                        <a href="pages/user-profile/projects.html"
                                            class="link-white opacity-75-hover fw-bold d-block mb-1">4 Data</a>
                                        <span
                                            class="position-absolute opacity-50 bottom-0 start-0 border-2 border-body border-bottom w-100"></span>
                                    </span>
                                    <span class="opacity-75"></span>
                                </div>
                            </h3>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="card-body mt-n20">
                            <div class="mt-n20 position-relative">
                                <div class="row g-3 g-lg-6">
                                    <div class="col-6">
                                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                            <div class="symbol symbol-30px me-5 mb-8">
                                                <span class="symbol-label">
                                                    <i class="ki-duotone ki-user fs-1 text-primary">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </span>
                                            </div>
                                            <div class="m-0">
                                                <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">
                                                    {{ $totalStudents ?? 0 }}
                                                </span>
                                                <span class="text-gray-500 fw-semibold fs-6">Total Students</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                            <div class="symbol symbol-30px me-5 mb-8">
                                                <span class="symbol-label">
                                                    <i class="ki-duotone ki-briefcase fs-1 text-primary">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </span>
                                            </div>
                                            <div class="m-0">
                                                <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">
                                                    {{ $totalWorks ?? 0 }}
                                                </span>
                                                <span class="text-gray-500 fw-semibold fs-6">Total Karya</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                            <div class="symbol symbol-30px me-5 mb-8">
                                                <span class="symbol-label">
                                                    <i class="ki-duotone ki-flag fs-1 text-primary">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </span>
                                            </div>
                                            <div class="m-0">
                                                <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">
                                                    {{ $totalChallenges ?? 0 }}
                                                </span>
                                                <span class="text-gray-500 fw-semibold fs-6">Total Challenges</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                            <div class="symbol symbol-30px me-5 mb-8">
                                                <span class="symbol-label">
                                                    <i class="ki-duotone ki-book fs-1 text-primary">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </span>
                                            </div>
                                            <div class="m-0">
                                                <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">
                                                    {{ $totalMaterials ?? 0 }}
                                                </span>
                                                <span class="text-gray-500 fw-semibold fs-6">Total Materials</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (empty($totalStudents) && empty($totalWorks) && empty($totalChallenges) && empty($totalMaterials))
                                    <div class="text-center text-muted mt-5">Tidak ada data statistik yang tersedia.</div>
                                @endif
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Lists Widget 19-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8 mb-5 mb-xl-10">
                    <div class="card card-bordered h-100">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Karya Bulanan</span>
                                <span class="text-muted mt-1 fw-semibold fs-7">Progress setiap bulan (target: 100
                                    karya)</span>
                            </h3>
                        </div>
                        <div class="card-body">
                            @php
                                $worksMonthlyLimited = collect($worksMonthly ?? [])
                                    ->sortByDesc(function ($item) {
                                        return $item['year'] . str_pad($item['month'], 2, '0', STR_PAD_LEFT);
                                    })
                                    ->take(5);
                            @endphp
                            @if ($worksMonthlyLimited->isEmpty())
                                <div class="text-center text-muted mt-5">Tidak ada data grafik karya bulanan.</div>
                            @else
                                <div class="row">
                                    <div class="col-12">
                                        <div class="list-group">
                                            @foreach ($worksMonthlyLimited as $item)
                                                <div
                                                    class="list-group-item d-flex align-items-center justify-content-between flex-wrap py-4 mt-2">
                                                    <div>
                                                        <div class="fw-bold fs-6">{{ $item['month'] . '-' . $item['year'] }}
                                                        </div>
                                                        <div class="text-muted fs-7">Total Karya: {{ $item['total_works'] }}
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 mx-4">
                                                        <div class="progress" style="height: 18px; min-width: 180px;">
                                                            <div class="progress-bar bg-primary" role="progressbar"
                                                                style="width: {{ min(100, ($item['total_works'] / 100) * 100) }}%;"
                                                                aria-valuenow="{{ $item['total_works'] }}" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                                {{ min(100, ($item['total_works'] / 100) * 100) }}%
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="badge badge-light-primary fs-7 fw-bold px-3 py-2">
                                                        {{ $item['total_works'] }}/100
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4 mb-xl-10">
                    <!--begin::Top Students by Works-->
                    <div class="card h-xl-100">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Top 10 Siswa dengan Karya Terbanyak</span>
                                <span class="text-muted mt-1 fw-semibold fs-7">Berdasarkan jumlah karya</span>
                            </h3>
                        </div>
                        <div class="card-body pt-6">
                            @if (isset($topStudents) && count($topStudents) > 0)
                                @foreach ($topStudents as $student)
                                    <div class="d-flex flex-stack mb-4">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-40px me-4">
                                                <img src="{{ $student->photo_profil ? asset($student->photo_profil) : asset('uploads/default-profile.png') }}"
                                                    alt="{{ $student->nama }}" class="symbol-label"
                                                    style="object-fit:cover;width:40px;height:40px;">
                                            </div>
                                            <div>
                                                <div class="fw-bold text-gray-800">{{ $student->nama }}</div>
                                                <div class="text-muted fs-7">{{ $student->asal_sekolah }}</div>
                                            </div>
                                        </div>
                                        <div class="badge badge-light-primary fs-7 fw-bold px-3 py-2">
                                            {{ $student->works_count }} karya
                                        </div>
                                    </div>
                                    @if (!$loop->last)
                                        <div class="separator separator-dashed my-2"></div>
                                    @endif
                                @endforeach
                            @else
                                <div class="text-muted text-center">Belum ada data siswa dengan karya.</div>
                            @endif
                        </div>
                    </div>
                    <!--end::Top Students by Works-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8 mb-5 mb-xl-10"> <!--begin::Nav-->
                    <ul class="nav nav-pills nav-pills-custom mb-3" id="categoryTab" role="tablist">
                        @foreach ($categories as $i => $category)
                            <li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
                                <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden {{ $i == 0 ? 'active' : '' }} w-80px h-85px py-4"
                                    id="cat-tab-{{ $category->id }}" data-bs-toggle="pill"
                                    href="#cat-content-{{ $category->id }}" role="tab"
                                    aria-controls="cat-content-{{ $category->id }}"
                                    aria-selected="{{ $i == 0 ? 'true' : 'false' }}">
                                    <div class="nav-icon mb-2 d-flex justify-content-center align-items-center"
                                        style="height:48px;">
                                        <img alt="" src="{{ asset('storage/' . $category->logo) }}"
                                            class="rounded shadow-sm"
                                            style="height:40px;width:40px;object-fit:contain;background:#f5f8fa;padding:6px;" />
                                    </div>
                                    <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">{{ $category->name }}</span>
                                    <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <!--end::Nav-->
                    <!--begin::Table widget 2-->
                    <div class="card h-md-100">
                        <!--begin::Header-->
                        <div class="card-header align-items-center border-0">
                            <!--begin::Title-->
                            <h3 class="fw-bold text-gray-900 m-0">Top 5 Karya Berdasarkan Kategori</h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-2">


                            <!--begin::Tab Content-->
                            <div class="tab-content" id="categoryTabContent">
                                @foreach ($categories as $i => $category)
                                    <div class="tab-pane fade {{ $i == 0 ? 'show active' : '' }}"
                                        id="cat-content-{{ $category->id }}" role="tabpanel"
                                        aria-labelledby="cat-tab-{{ $category->id }}">
                                        <div class="table-responsive">
                                            @if (isset($categoryWorks[$category->id]) && count($categoryWorks[$category->id]) > 0)
                                                <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                                    <thead>
                                                        <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                            <th class="ps-0 w-50px">COVER</th>
                                                            <th class="min-w-125px">JUDUL</th>
                                                            <th class="min-w-100px">PENULIS</th>
                                                            <th class="text-end min-w-80px">LIKE</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($categoryWorks[$category->id] as $work)
                                                            <tr>
                                                                <td>
                                                                    <img src="{{ $work->cover_photo ? asset($work->cover_photo) : asset('assets/media/stock/ecommerce/210.png') }}"
                                                                        class="w-50px ms-n1" alt=""
                                                                        style="object-fit:cover;height:50px;width:50px;" />
                                                                </td>
                                                                <td class="ps-0">
                                                                    <a href="{{ route('works.show', $work->id) }}"
                                                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">
                                                                        {{ $work->title }}
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="text-gray-800 fw-bold d-block fs-6 ps-0 text-start">
                                                                        {{ $work->author->nama ?? '-' }}
                                                                    </span>
                                                                </td>
                                                                <td class="text-end pe-0">
                                                                    <span
                                                                        class="badge badge-light-primary fs-7 fw-bold px-3 py-2">
                                                                        <i
                                                                            class="ki-duotone ki-like fs-5 text-primary"></i>
                                                                        {{ $work->likes_count }}
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                <div class="text-center text-muted py-10">Belum ada karya pada kategori
                                                    ini.</div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!--end::Tab Content-->
                        </div>
                        <!--end: Card Body-->
                    </div>
                    <!--end::Table widget 2-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Content-->
@endsection

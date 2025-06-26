@extends('layouts.app')

@section('title', $title)

@section('content')
    <!--begin::Breadcrumb-->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}" class="text-gray-600 text-hover-primary">Dashboard</a>
            </li>
            @if (isset($breadcrumbs))
                @foreach ($breadcrumbs as $breadcrumb)
                    <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                        @if (!$loop->last)
                            <a href="{{ $breadcrumb['url'] }}"
                                class="text-gray-600 text-hover-primary">{{ $breadcrumb['label'] }}</a>
                        @else
                            {{ $breadcrumb['label'] }}
                        @endif
                    </li>
                @endforeach
            @endif
        </ol>
    </nav>
    <!--end::Breadcrumb-->

    <!--begin::Page Header-->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="text-dark fw-bold">{{ $title }}</h1>
            <p class="text-muted">{{ $description }}</p>
        </div>
        <a href="{{ route('students.create') }}" class="btn btn-primary">Add New Student</a>
    </div>
    <!--end::Page Header-->

    <div class="card">
        <div class="card-body">
            <table id="kt_datatable_dom_positioning"
                class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 px-7">
                        <th>#</th>
                        <th>NISN</th>
                        <th>Nama</th>
                        <th>Asal Sekolah</th>
                        <th>Email</th>
                        <th style="width: 80px;">
                            Karya
                        </th>
                        <th style="width: 100px;">
                            Tantangan
                        </th>
                        <th style="width: 80px;">
                            Like
                        </th>
                        <th style="width: 80px;">
                            Rating
                        </th>
                        <th style="width: 90px;">
                            Diamond
                        </th>
                        <th style="width: 100px;">
                            Follower
                        </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        @php
                            $totalWorks = $student->works()->count();
                            $totalChallenges = $student->challengeRegistrations()->count();
                            $totalLikes = $student
                                ->works()
                                ->withCount([
                                    'ratings as likes_count' => function ($q) {
                                        $q->where('type', 'like');
                                    },
                                ])
                                ->get()
                                ->sum('likes_count');
                            $works = $student->works()->with('ratings')->get();
                            $totalRating = 0;
                            $ratingCount = 0;
                            foreach ($works as $work) {
                                $avg = $work->ratings()->avg('rating');
                                if ($avg) {
                                    $totalRating += $avg;
                                    $ratingCount++;
                                }
                            }
                            $avgRating = $ratingCount > 0 ? round($totalRating / $ratingCount, 2) : 0;
                            $totalDiamond = $student->diamond_points ?? 0;
                            $followersCount = $student->followers()->count();
                        @endphp
                        <tr>
                            <td>
                                <i class="fas fa-trophy text-warning me-1 fs-8"></i> {{ $loop->iteration }}
                            </td>
                            <td>{{ $student->nisn }}</td>
                            <td>{{ $student->nama }}</td>
                            <td>{{ $student->asal_sekolah }}</td>
                            <td>{{ $student->email }}</td>
                            <td>
                                <span class="badge  bg-primary text-white">
                                    <i class="fas fa-paint-brush me-1"></i>{{ $totalWorks }}
                                </span>
                            </td>
                            <td>
                                <span class="badge  bg-success text-white">
                                    <i class="fas fa-trophy me-1"></i>{{ $totalChallenges }}
                                </span>
                            </td>
                            <td>
                                <span class="badge  bg-danger text-white">
                                    <i class="fas fa-heart me-1"></i>{{ $totalLikes }}
                                </span>
                            </td>
                            <td>
                                <span class="badge  bg-warning text-dark">
                                    <i class="fas fa-star me-1"></i>{{ $avgRating }}
                                </span>
                            </td>
                            <td>
                                <span class="badge  bg-info text-white">
                                    <i class="fas fa-gem me-1"></i>{{ $totalDiamond }}
                                </span>
                            </td>
                            <td>
                                <span class="badge  bg-secondary text-black">
                                    <i class="fas fa-users me-1"></i>{{ $followersCount }}
                                </span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                        id="actionDropdown{{ $student->id }}" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="actionDropdown{{ $student->id }}">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('students.show', $student->id) }}">
                                                <i class="fas fa-eye me-2 text-info"></i> View Details
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('students.edit', $student->id) }}">
                                                <i class="fas fa-edit me-2 text-warning"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-danger" href="#"
                                                onclick="event.preventDefault(); confirmDelete({{ $student->id }})">
                                                <i class="fas fa-trash me-2"></i> Delete
                                            </a>
                                            <form id="delete-form-{{ $student->id }}"
                                                action="{{ route('students.destroy', $student->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
@endpush

@section('scripts')
    <script>
        $("#kt_datatable_dom_positioning").DataTable({
            "language": {
                "lengthMenu": "Show _MENU_",
            },
            "dom": "<'row mb-2'" +
                "<'col-sm-6 d-flex align-items-center justify-content-start dt-toolbar'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end dt-toolbar'f>" +
                ">" +
                "<'table-responsive'tr>" +
                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">"
        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }
    </script>
@endsection

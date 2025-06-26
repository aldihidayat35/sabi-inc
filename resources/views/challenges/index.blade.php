@extends('layouts.app')

@section('title', 'Challenges')

@section('content')
<!--begin::Breadcrumb-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}" class="text-gray-600 text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Challenges</li>
    </ol>
</nav>
<!--end::Breadcrumb-->

<!--begin::Page Header-->
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h1 class="text-gray-800 fw-bold">Challenges</h1>
        <p class="text-gray-800 mb-0">Manage all challenges in the system.</p>
    </div>
    <a href="{{ route('challenges.create') }}" class="btn btn-primary mb-3">Add New Challenge</a>
</div>
<!--end::Page Header-->

<div class="card">
    <div class="card-body">
        <table id="challenges-table" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800 px-7">
                    <th>#</th>
                    <th>Name</th>
                    <th>Reward Points</th>
                    <th>Start Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($challenges as $challenge)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <!--begin::Item-->
                            <div class="d-flex align-items-sm-center">
                                <!--begin::foto cover-->
                                <div class="symbol symbol-60px symbol-2by3 me-4">
                                    <div class="symbol-label" style="background-image: url('{{ asset($challenge->cover_photo) }}')"></div>
                                </div>
                                <!--end::foto cover-->
                                <!--begin::Title-->
                                <div class="d-flex flex-row-fluid flex-wrap align-items-center">
                                    <div class="flex-grow-1 me-2">
                                        <a href="{{ route('challenges.show', $challenge->id) }}" class="text-gray-800 fw-bold text-hover-primary fs-6">{{ $challenge->name }}</a>
                                        <span class="text-muted fw-semibold d-block pt-1">Reward: {{ $challenge->reward_diamond_points }} points</span>
                                    </div>

                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Item-->
                        </td>
                        <td>{{ $challenge->start_time }}</td>
                        <td><span class="badge badge-light-warning fs-8 fw-bold my-2">{{ \Carbon\Carbon::parse($challenge->start_time)->format('d M Y') }} - {{ \Carbon\Carbon::parse($challenge->end_time)->format('d M Y') }}</span></td>
                        <td>
                            <a href="{{ route('challenges.show', $challenge->id) }}" class="btn btn-info btn-sm">Show</a>
                            <a href="{{ route('challenges.edit', $challenge->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('challenges.registrations', $challenge->id) }}" class="btn btn-success btn-sm">Lihat Pendaftar</a>
                            <form action="{{ route('challenges.destroy', $challenge->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#challenges-table').DataTable({
            "language": {
                "lengthMenu": "Show _MENU_",
                "zeroRecords": "No challenges found",
                "info": "Showing _START_ to _END_ of _TOTAL_ challenges",
                "infoEmpty": "No challenges available",
                "infoFiltered": "(filtered from _MAX_ total challenges)",
                "search": "Search:",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                }
            },
            "dom":
                "<'row mb-2'" +
                "<'col-sm-6 d-flex align-items-center justify-content-start dt-toolbar'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end dt-toolbar'f>" +
                ">" +
                "<'table-responsive'tr>" +
                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">"
        });
    });
</script>
@endsection

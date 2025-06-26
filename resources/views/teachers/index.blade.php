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
                        <a href="{{ $breadcrumb['url'] }}" class="text-gray-600 text-hover-primary">{{ $breadcrumb['label'] }}</a>
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
    <a href="{{ route('teachers.create') }}" class="btn btn-primary">Add New Teacher</a>
</div>
<!--end::Page Header-->

<div class="card">
    <div class="card-body">
        <table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800 px-7">
                    <th>#</th>
                    <th>NIP</th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $teacher)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $teacher->nip }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->nama }}</td>
                        <td>{{ ucfirst($teacher->level) }}</td>
                        <td>
                            <a href="{{ route('teachers.show', $teacher->id) }}" class="btn btn-info btn-sm">View Details</a>
                            <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $teacher->id }})">Delete</button>
                            <form id="delete-form-{{ $teacher->id }}" action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
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
    $("#kt_datatable_dom_positioning").DataTable({
        "language": {
            "lengthMenu": "Show _MENU_",
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

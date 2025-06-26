@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <!--begin::Breadcrumb-->
    <nav aria-label="breadcrumb">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}" class="text-gray-600 text-hover-primary">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Categories</li>
            </ol>
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Add New Category</a>
        </div>

    </nav>
    <!--end::Breadcrumb-->

    <!--begin::Page Header-->
    <div class="mb-4">
        <h1 class="text-dark fw-bold">Categories</h1>
        <p class="text-muted">Manage all categories in the system.</p>
    </div>
    <!--end::Page Header-->

    <div class="card">
        <div class="card-body">
            <table id="categories-table" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 px-7">
                        <th>#</th>
                        <th>Name</th>
                        <th>Logo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                @if($category->logo && file_exists(public_path('storage/' . $category->logo)))
                                    <img src="{{ asset('storage/' . $category->logo) }}" alt="Logo" width="40" height="40" style="object-fit:contain;">
                                @else
                                    <span class="text-muted">No Logo</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                    style="display:inline;">
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
        $(document).ready(function() {
            $('#categories-table').DataTable({
                "language": {
                    "lengthMenu": "Show _MENU_",
                    "zeroRecords": "No categories found",
                    "info": "Showing _START_ to _END_ of _TOTAL_ categories",
                    "infoEmpty": "No categories available",
                    "infoFiltered": "(filtered from _MAX_ total categories)",
                    "search": "Search:",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    }
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
        });
    </script>
@endsection

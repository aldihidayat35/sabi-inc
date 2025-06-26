@extends('layouts.app')

@section('title', 'Topics')

@section('content')
    <!--begin::Breadcrumb-->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}" class="text-gray-600 text-hover-primary">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Topics</li>
        </ol>
    </nav>
    <!--end::Breadcrumb-->

    <!--begin::Page Header-->
    <div class="mb-4">
        <h1 class="text-dark fw-bold">Topics</h1>
        <p class="text-muted">Manage all topics in the system.</p>
    </div>
    <!--end::Page Header-->

    <div class="card">
        <div class="card-body">
            <a href="{{ route('topics.create') }}" class="btn btn-primary mb-3">Add New Topic</a>
            <table id="topics-table" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 px-7">
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topics as $topic)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-60px symbol-2by3 me-4">
                                        <div class="symbol-label"
                                            style="background-image: url('{{ $topic->cover_photo ?? asset('assets/media/stock/600x400/img-19.jpg') }}')">
                                        </div>
                                    </div>
                                    <div>
                                        <a href="{{ route('topics.show', $topic->id) }}"
                                            class="text-gray-800 fw-bold text-hover-primary fs-6">{{ $topic->title }}</a>
                                        <div class="text-muted fw-semibold pt-1">
                                            Reward Diamond: {{ $topic->reward_diamond }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $topic->description }}</td>
                            <td>
                                <a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                                <form action="{{ route('topics.destroy', $topic->id) }}" method="POST" style="display:inline;">
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
            $('#topics-table').DataTable({
                "language": {
                    "lengthMenu": "Show _MENU_",
                    "zeroRecords": "No topics found",
                    "info": "Showing _START_ to _END_ of _TOTAL_ topics",
                    "infoEmpty": "No topics available",
                    "infoFiltered": "(filtered from _MAX_ total topics)",
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

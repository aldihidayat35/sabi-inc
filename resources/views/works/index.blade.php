@extends('layouts.app')

@section('title', 'Works')

@section('content')
    <!--begin::Breadcrumb-->
    <nav aria-label="breadcrumb">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}" class="text-gray-600 text-hover-primary">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Works</li>
            </ol>

            @if (auth('teacher')->check() && auth('teacher')->user()->level === 'admin')
                <a href="{{ route('works.create') }}" class="btn btn-primary">Add New Work</a>
            @endif
        </div>
    </nav>
    <!--end::Breadcrumb-->

    <!--begin::Page Header-->
    <div class="mb-4">
        <h1 class="text-dark fw-bold">Works</h1>
        <p class="text-muted">Manage all works in the system.</p>
    </div>
    <!--end::Page Header-->

    <div class="card">
        <div class="card-body">
            <table id="works-table" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 px-7 text-center">
                        <th>#</th>
                        <th style="max-width: 350px;">Title</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Nilai Guru</th>
                        <th>Like</th>
                        <th>Dislike</th>
                        <th>Komentar</th>
                        <th>Views</th>
                        <th>Rating</th>
                        @if (auth('teacher')->check() && auth('teacher')->user()->level === 'admin')
                            <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($works as $work)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <!--begin::Item-->
                                <div class="d-flex align-items-sm-center">
                                    <!--begin::foto cover-->
                                    <div class="symbol symbol-60px symbol-2by3 me-4">
                                        <div class="symbol-label"
                                            style="background-image: url('{{ $work->cover_photo ?? asset('assets/media/stock/600x400/img-19.jpg') }}')">
                                        </div>
                                    </div>
                                    <!--end::foto cover-->
                                    <!--begin::Title-->
                                    <div class="d-flex flex-row-fluid flex-wrap align-items-center">
                                        <div class="flex-grow-1 me-2">
                                            <a href="{{ route('works.show', $work->id) }}"
                                                class="text-gray-800 fw-bold text-hover-primary fs-6">{{ $work->title }}</a>
                                            <span class="text-muted fw-semibold d-block pt-1">
                                                Category:
                                                @foreach ($work->categories as $category)
                                                    {{ $category->name }}{{ !$loop->last ? ', ' : '' }}
                                                @endforeach
                                            </span>
                                        </div>
                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Item-->
                            </td>

                            <td>
                                {{ $work->author ? $work->author->nama : '-' }}
                            </td>
                            <td>
                                <span class="badge badge-light-warning fs-8 fw-bold my-2">{{ $work->status }}</span>
                            </td>
                            <td>
                                <a href="javascript:void(0);" class="show-teacher-scores p-4 "
                                    data-scores='@json(
                                        $work->teacherScores()->with('teacher')->get()->map(function ($score) {
                                                return ['teacher' => $score->teacher->nama ?? '-', 'score' => $score->score];
                                            }))' data-title="{{ $work->title }}">
                                    @php
                                        $avgScore = $work->averageTeacherScore();
                                    @endphp
                                    @if ($avgScore)
                                        <span
                                            class="badge badge-success text-center fs-6 fw-bold">{{ number_format($avgScore, 1) }}</span>
                                    @else
                                        <span class="badge badge-light fs-6 fw-bold">Belum dinilai</span>
                                    @endif
                                </a>
                            </td>
                            <td>
                                <i class="fas fa-thumbs-up text-success me-1"></i>
                                {{ $work->likesCount() }}
                            </td>
                            <td>
                                <i class="fas fa-thumbs-down text-danger me-1"></i>
                                {{ $work->dislikesCount() }}
                            </td>
                            <td>
                                <i class="fas fa-comments text-primary me-1"></i>
                                {{ $work->comments()->count() }}
                            </td>
                            <td>
                                <i class="fas fa-eye text-gray-600 me-1"></i>
                                {{ $work->views ?? 0 }}
                            </td>
                            <td>
                                <i class="fas fa-star text-warning me-1"></i>
                                {{ number_format($work->averageRating(), 2) }}
                            </td>
                            @if (auth('teacher')->check() && auth('teacher')->user()->level === 'admin')
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light-primary dropdown-toggle" type="button"
                                            id="actionsDropdown{{ $work->id }}" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="actionsDropdown{{ $work->id }}">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('works.show', $work->id) }}">
                                                    <i class="fas fa-eye text-info me-2"></i> Show
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('works.edit', $work->id) }}">
                                                    <i class="fas fa-edit text-warning me-2"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('works.destroy', $work->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this work?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="fas fa-trash-alt me-2"></i> Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="teacherScoresModal" tabindex="-1" aria-labelledby="teacherScoresModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="teacherScoresModalLabel">Daftar Nilai Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="teacherScoresContent"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#works-table').DataTable({
                "language": {
                    "lengthMenu": "Show _MENU_",
                    "zeroRecords": "No works found",
                    "info": "Showing _START_ to _END_ of _TOTAL_ works",
                    "infoEmpty": "No works available",
                    "infoFiltered": "(filtered from _MAX_ total works)",
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

            // Modal logic
            $('.show-teacher-scores').on('click', function() {
                var scores = $(this).data('scores');
                var title = $(this).data('title');
                var html = '';
                if (scores.length > 0) {
                    html += '<div class="mb-2 fw-bold">Karya: ' + title + '</div>';
                    html +=
                        '<table class="table table-bordered"><thead><tr><th>Guru</th><th>Nilai</th></tr></thead><tbody>';
                    scores.forEach(function(item) {
                        html += '<tr><td>' + item.teacher + '</td><td>' + item.score + '</td></tr>';
                    });
                    html += '</tbody></table>';
                } else {
                    html = '<div class="text-center text-muted">Belum ada penilaian guru.</div>';
                }
                $('#teacherScoresContent').html(html);
                $('#teacherScoresModal').modal('show');
            });
        });
    </script>
@endsection

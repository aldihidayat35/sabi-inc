@extends('layouts.app')

@section('title', 'Penilaian Karya oleh Guru')

@section('content')
<div class="mb-4">
    <h1 class="text-dark fw-bold">Penilaian Karya oleh Guru</h1>
    <p class="text-muted">Lihat dan berikan penilaian Anda untuk setiap karya.</p>
    <div class="alert alert-info mt-3" role="alert">
        <strong>{{ $unscoredCount }}</strong> karya belum Anda nilai.
    </div>
</div>
<div class="card">
    <div class="card-body">
        <table id="works-score-table" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800 px-7">
                    <th>#</th>
                    <th>Judul Karya</th>
                    <th>Kategori</th>
                    <th>Rata-rata Nilai Guru</th>
                    <th>Nilai Anda</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($works as $work)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-sm-center">
                                <div class="flex-grow-1 me-2">
                                    <span class="fw-bold">{{ $work->title }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            @foreach($work->categories as $cat)
                                <span class="badge badge-outline badge-info m-1">{{ $cat->name }}</span>
                            @endforeach
                        </td>
                        <td class="text-center">
                            @if($work->averageTeacherScore())
                                <span class="badge badge-success text-center fs-6 fw-bold">{{ number_format($work->averageTeacherScore(), 1) }}</span>
                            @else
                                <span class="badge badge-light fs-6 fw-bold">Belum dinilai</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @php
                                $myScore = $work->teacherScores->first() ? $work->teacherScores->first()->score : null;
                            @endphp
                            @if($myScore !== null)
                                <span class="badge badge-primary fs-6 fw-bold">{{ $myScore }}</span>
                            @else
                                <span class="badge badge-light fs-6 fw-bold">Belum dinilai</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('works.score', $work->id) }}" method="POST" class="d-flex align-items-center">
                                @csrf
                                <input type="number" name="score" min="0" max="10" step="0.01" value="{{ $myScore ?? '' }}" class="form-control form-control-sm me-2" style="width:90px;" required>
                                <button type="submit" class="btn btn-sm btn-success">Simpan</button>
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
        $('#works-score-table').DataTable({
            "language": {
                "lengthMenu": "Show _MENU_",
                "zeroRecords": "Tidak ada karya ditemukan",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ karya",
                "infoEmpty": "Tidak ada karya tersedia",
                "infoFiltered": "(disaring dari _MAX_ total karya)",
                "search": "Cari:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Berikutnya",
                    "previous": "Sebelumnya"
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

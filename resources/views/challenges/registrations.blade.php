@extends('layouts.app')

@section('title', 'Pendaftar Challenge: ' . $challenge->name)

@section('content')
    <a href="{{ route('challenges.index') }}" class="btn btn-secondary btn-sm mb-3">Kembali</a>
<div class="mb-4">
    <div class="d-flex align-items-center gap-4 mb-2">
        @if($challenge->cover_photo)
            <img src="{{ asset($challenge->cover_photo) }}" alt="Cover" class="rounded shadow-sm" style="width:90px; height:90px; object-fit:cover;">
        @endif
        <div>
            <h1 class="fw-bold mb-1">{{ $challenge->name }}</h1>
            <div class="text-muted">{{ \Illuminate\Support\Str::limit($challenge->details, 120) }}</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table id="registrations-table" class="table table-striped table-row-bordered gy-5 gs-7 border rounded align-middle">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800 px-7">
                    <th>#</th>
                    <th>Nama Siswa</th>
                    <th>Submission</th>
                    <th class="text-center">Score & Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrations as $reg)
                <tr id="row-{{ $reg->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $reg->student->name ?? '-' }}</td>
                    <td>
                        <a href="{{ $reg->submission }}" target="_blank" class="btn btn-link btn-sm">Lihat Submission</a>
                    </td>
                    <td>
                        <form action="{{ route('challenges.registrations.evaluate', $reg->id) }}" method="POST" class="d-flex align-items-center gap-2">
                            @csrf
                            <input type="number" min="0" max="100" name="score" class="form-control form-control-sm" value="{{ $reg->score }}">
                            <input type="text" name="notes" class="form-control form-control-sm" value="{{ $reg->notes }}">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        timer: 1200,
        showConfirmButton: false
    });
</script>
@endif
<script>
    $(document).ready(function () {
        $('#registrations-table').DataTable({
            "language": {
                "lengthMenu": "Show _MENU_",
                "zeroRecords": "Tidak ada pendaftar ditemukan",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ pendaftar",
                "infoEmpty": "Tidak ada pendaftar",
                "infoFiltered": "(disaring dari _MAX_ total pendaftar)",
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

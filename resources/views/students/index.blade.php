@extends('layouts.template')

@section('content')
<h1>Data Siswa</h1>
<h5><span style="color: blue">Data Mastar/Data Siswa</span></h5>

    <div class="container border py-4 rounded bg-secondary-subtle">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('deleted'))
            <div class="alert alert-warning">{{ session('deleted') }}</div>
        @endif
        @if (Auth::check() && Auth::user()->role == 'admin')
            <div class="d-flex justify-content-end mb-3">
                <a class="btn btn-primary" href="{{ route('students.create') }}">Tambah Data</a>
            </div>
        @endif
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nis</th>
                    <th>Nama</th>
                    <th>Rombel</th>
                    <th>Rayon</th>
                    @if (Auth::check() && Auth::user()->role == 'admin')
                        <th class="text-center">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($student as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item->nis }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->rombels->rombel }}</td>
                        <td>{{ $item->rayons->rayon }}</td>
                        @if (Auth::check() && Auth::user()->role == 'admin')
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('students.edit', $item->id) }}" class="btn btn-primary me-3">Edit</a>
                                <form action="{{ route('students.delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteConfirmationModal">
                                        Hapus
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1"
                                        aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Konfirmasi
                                                        Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Yakin ingin menghapus data ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data siswa.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

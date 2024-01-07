@extends('layouts.template')

@section('content')
<h1>Data User</h1>
<h5><span style="color: blue">Data Mastar/Data User</span></h5>

<div class="container border py-4 rounded bg-secondary-subtle">

    <div id="msg-success"></div>

    @if (Session::get('success'))
        <div class="alert alert-success"> {{ Session::get('success') }}</div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert alert-warning"> {{ Session::get('deleted') }}</div>
    @endif

    <div style="margin-bottom: 15px; justify-content: flex-end; display: flex;">
        <a class="btn btn-primary" href="{{ route('users.create') }}">Tambah Data</a>
    </div>

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th class="text-center">
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($user as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['email'] }}</td>
                    <td>{{ $item['role'] }}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('users.edit', $item['id']) }}" class="btn btn-primary me-3"><i
                                data-feather="edit">Edit</i></a>
                        <button type="submit" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#exampleModal"><i data-feather="trash-2">Hapus</i></button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Yakin ingin menghapus data ini?
                                    </div>
                                    <div class="modal-footer">
                                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}

                                        <form action="{{ route('users.delete', $item['id']) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

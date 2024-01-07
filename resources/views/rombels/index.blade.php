@extends('layouts.template')

@section('content')
<h1>Data Rombel</h1>
<h5><span style="color: blue">Data Mastar/Data Rombel</span></h5>
    <div class="container border py-4 rounded bg-secondary-subtle">
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if (Session::get('deleted'))
            <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
        @endif

        <table class="table table-striped table-bordered table-hover">

            <div class="d-flex justify-content-end mb-3">
                <a class="btn btn-primary" href="{{ route('rombels.create') }}">Tambah Data</a>
            </div>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Rombel</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($rombel as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item['rombel'] }}</td>
                        <td class="d-flex justify-content-center">
                            <a href="{{ route('rombels.edit', $item->id) }}" class="btn btn-primary me-3">Edit</a>
                            <form action="{{ route('rombels.delete', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

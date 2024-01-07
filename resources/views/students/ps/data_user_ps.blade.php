@extends('layouts.template')

@section('content')
    <h2>Data Siswa</h2>
    <p><a href="{{ route('homePs') }}">Dashboard</a> / Data Siswa</p>
    <br>
    <div class="d-md-flex justify-content-between align-items-center mt-3">
        <form action="{{ route('ps.student.indexPs') }}" method="get" class="d-flex mt-3">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari Siswa"
                value="{{ $search }}">
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
            <a href="{{ route('ps.student.indexPs') }}" class="btn btn-secondary"><i class="fas fa-sync"></i></a>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nis</th>
                    <th>Nama</th>
                    <th>Rombel</th>
                    <th>Rayon</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1 @endphp
                @foreach ($students as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item['nis'] }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item->rombels->rombel }}</td>
                        <td>{{ $item->rayons->rayon }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

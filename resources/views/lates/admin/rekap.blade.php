@extends('layouts.template')

@section('content')
@if (Session::get('success'))
<div class="alert alert-success">{{ Session::get('success') }}</div>
@endif

@if (Session::get('deleted'))
<div class="alert">{{ Session::get('deleted') }}</div>
@endif

<div class="text" style="margin-top: 20px; margin-left: 20px;">
    <h3>Data Rekap</h3>
    <p>Data Rekap</p>
</div>

<div class="btn-group" role="group" aria-label="Basic example">
    @if (Auth::check() && Auth::user()->role == "admin")
    <a href="{{ route('admin.lates.data') }}" class="btn btn-outline-primary ms-2">Keseluruhan Data</a>
    <a href="{{ route('admin.lates.rekap') }}" class="btn btn-primary ms-2">Rekapitulasi Data</a>
    @else
    <a href="{{ route('ps.lates.data') }}" class="btn btn-outline-primary ms-2">Keseluruhan Data</a>
    <a href="{{ route('ps.lates.rekapData') }}" class="btn btn-primary ms-2">Rekapitulasi Data</a>
    @endif
</div>

<div class="container">
    <div class="button"
        style="width: 800px; display: flex; margin-top: 50px; margin-left: 20px; justify-content: space-between;">
        <form action="{{ route('admin.lates.search') }}" method="GET" class="input-group flex-nowrap">
            <input type="text" name="query" class="form-control" placeholder="Cari Detail Keterlambatan">
            <button type="submit" class="btn btn-info text-white">Search</button>
        </form>
    </div>

    @if (!isset($searchQuery))
    @isset($grup)
    <table class="table" style="margin-top: 50px; text-align: start;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nis</th>
                <th>Nama</th>
                <th>Jumlah Keterlambatan</th>
                <th>Detail</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1 @endphp
            @php $processedStudentIds = [] @endphp
            @foreach ($lates as $item)
                @if (!in_array($item->student->id, $processedStudentIds))
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->student->nis }}</td>
                        <td>{{ $item->student->name }}</td>
                        <td>{{ $item->student->lates->count() }}</td>
                        <td class="d-flex">
                            <a href="{{ route('admin.lates.detail', $item->student_id) }}"
                                class="btn btn-primary me-2"><i class="fas fa-eye"></i> Lihat</a>
                            @if ($item->student->lates->count() >= 3)
                                <form action="{{ route('terlambatPs.terlambatCetakPdf', $item->student_id) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-success"><i
                                            class="fas fa-file-pdf"></i> Cetak PDF</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @php $processedStudentIds[] = $item->student->id @endphp
                @endif
            @endforeach
        </tbody>
    </table>
    @endisset
    @endif
</div>
@endsection

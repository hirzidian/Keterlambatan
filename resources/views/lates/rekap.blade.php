@extends('layouts.template')

@section('content')
<h1>Rekap Data Keterlambatan</h1>
<h5><span style="color: blue">Data Keterlambatan/Rekap Data</span></h5>
    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    @if (Session::get('deleted'))
        <div class="alert">{{ Session::get('deleted') }}</div>
    @endif

    <div class="btn-group" role="group" aria-label="Basic example">
        @if (Auth::check() && Auth::user()->role == 'admin')
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
                    @php $no = 1; @endphp
                    @foreach ($grup as $nis => $group)
                        @php
                            $total = $group->where('student.nis')->count();
                        @endphp
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>({{ $nis }})</td>
                            <td>{{ $group->first()->student->name }}</td>
                            <td>{{ $total }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    @if (Auth::check() && Auth::user()->role == 'admin')
                                        <a href="{{ route('admin.lates.detail', ['nis' => $nis]) }}"
                                            class="btn btn-info text-white m-2" style="background: purple;">Detail</a>
                                    @else
                                        <a href="{{ route('ps.lates.detailPs', ['nis' => $nis]) }}"
                                            class="btn btn-info text-white m-2" style="background: purple;">Detail</a>
                                    @endif
                                </div>
                            </td>

                            <td>
                                @if ($total >= 3)
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="submit" class="btn btn-info text-white m-2"
                                            style="background: purple; ">
                                            <a href="{{ Auth::user()->role == 'ps' ? route('ps.lates.eksport.pdf', ['nis' => $nis]) : route('admin.lates.eksport.pdf', ['nis' => $nis]) }}"
                                                style="text-decoration: none; color:aliceblue;">Export PDF</a></button>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

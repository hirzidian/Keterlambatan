@extends('layouts.template')

@section('content')
<h1>Detail Data Keterlambatan</h1>
<h5><span style="color: blue">Data Keterlambatan/Detail Data</span></h5>
<ul class="nav nav-tabs">
    <li class="nav-item">
        {{-- <a class="nav-link{{ request()->is('lates') ? ' active' : '' }}"
            href="{{ route('lates.index') }}">Keseluruhan Data</a> --}}
    </li>
    <li class="nav-item">
        {{-- <a class="nav-link{{ request()->is('export') ? ' active' : '' }}"
            href="{{ route('lates.export') }}">Rekapitulasi Data</a> --}}
    </li>
</ul>
<div class="container py-5">
    @foreach ($grup as $nis => $group)
@foreach ($grup as $nis => $group)
    <h4 class="text-start text-muted"><strong>Nis</strong> | {{ $nis }} | {{ $group[0]->student->rombel }} | {{ $group[0]->student->rayon }}</h4>
    {{-- Ambil rombel dari salah satu anggota grup, karena rombel dianggap sama untuk semua anggota --}}
@endforeach

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 py-5">
            @php
                $total = $group->count(); // Menggunakan count() karena sudah dalam kelompok
            @endphp
            {{-- <div class="col">
                <div class="card">
                    <h5 class="card-title">Siswa dengan NIS - {{ $nis }}</h5>
                    <div class="card-body text-start">
                        <p>Total Keterlambatan: {{ $total }}</p>
                        @if ($total > 0)
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('lates.detail', ['nis' => $nis]) }}"
                                    class="btn btn-info text-white m-2" style="background: purple;">Detail</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div> --}}
        @endforeach

        @php $no = 1; @endphp
        @foreach ($lates as $keterlambatan)
            <div class="col">
                <div class="card">
                    <div class="card-body text-start">
                        <h5 class="card-title">Keterlambatan ke - {{ $no++ }}</h5>
                        <strong class="text-muted">{{ $keterlambatan['date_time_late'] }}</strong>
                        <p>{{ $keterlambatan['information'] }}</p>
                    </div>
                    <img src="{{ asset('images/' . $keterlambatan['bukti']) }}"
                         class="card-img-top" alt="">
                </div>
            </div>
        @endforeach
    </div>
</div>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    body {
        background-color: aliceblue;
        font-family: 'Poppins', sans-serif;
        font-size: 0.875rem;
        opacity: 1;
        overflow-y: scroll;
        margin: 0;
    }
    img{
        aspect-ratio: 3/2;
        object-fit: contain;
    }
    .card p {
        color: #0D6EFD;
        font-weight: 600;
    }

    .card-img-top {
        border-radius: 50px;
        padding: 20px;
    }

    .card {
        border-radius: 30px;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
    }

    .card-body {
        padding: 25px;
        margin-top: -15px;
    }

    .btn-primary {
        border-radius: 50px;
        width: 120px;
    }

    .btn-primary:hover {
        background-color: black;
        border: none;
    }

    h3,
    h5 {
        color: rgba(107, 107, 107, 0.845);
    }
</style>

@endsection
@extends('layouts.template')

@section('content')
<h2>Detail Data Keterlambatan</h2>
<p><a href="#">Dashboard</a> / <a href="#">Data Keterlambatan</a> / Detail Data Keterlambatan</p>
<br>
<h5>{{ $student->nis }} | {{ $student->name }} | {{ $student->rombels->rombel }} | {{ $student->rayons->rayon }}</h5>
<div class="row mt-5">
    @foreach ($lates as $index => $late)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body custom-card-body">
                    <h5 class="card-title">Keterlambatan Ke-{{ $index + 1 }}</h5>
                    <div class="p-5">
                        <p class="card-text">{{ $late->date_time_late }}</p>
                        <p class="card-text">{{ $late->information }}</p>
                        <img src="{{ asset('images/' . $late['bukti']) }}"
                         class="card-img-top" alt="">
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection

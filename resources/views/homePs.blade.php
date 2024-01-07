@extends('layouts.template')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Dashboard</h2>
    <p class="text-center">Dashboard</p>

    @if (Session::get('failed'))
        <div class="alert alert-danger">{{ Session::get('failed') }}</div>
    @endif

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Peserta Didik Rayon {{ App\Models\rayons::find($rayonIdLogin)->rayon }}</h4>
                    <div class="text-center">
                        <h4><i class="fas fa-users"></i> {{ $totalStudents }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Jumlah Keterlambatan {{ App\Models\rayons::find($rayonIdLogin)->rayon }}</h4>
                    <div class="text-center">
                        <h4><i class="fas fa-exclamation-circle"></i> Errors</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mt-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Keterlambatan {{ App\Models\rayons::find($rayonIdLogin)->rayon }} Hari ini</h4>
                    <h4 class="card-title">{{ \Carbon\Carbon::now()->format('Y-m-d') }}</h4>
                    <div class="text-center">
                        <h4><i class="fas fa-clock"></i> {{ $todayLates }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

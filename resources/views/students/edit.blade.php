@extends('layouts.template')

@section('content')
<h1>Edit Data Siswa</h1>
<h5><span style="color: blue">Data Mastar/Data Siswa/Edit</span></h5>
    <form action="{{ route('students.update', $students['id']) }}" method="POST" class="card p-5">
        @csrf
        @method('PATCH')

        @if ($errors->any())
            <ul class="alert alert-danger p-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="mb-3 row">
            <label for="nis" class="col-sm-2 col-form-label">NIS:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nis" name="nis" value="{{ $students['nis'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ $students['name'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="rombel_id" class="col-sm-2 col-form-label">Rombel ID:</label>
            <div class="col-sm-10">
                <select class="form-select" name="rombel_id" id="rombel_id">
                    <option selected disabled hidden>Pilih</option>
                    @foreach($rombels as $rom)
                        <option value="{{ $rom->rombel }}">{{ $rom->rombel }}</option>
                    @endforeach
                </select>
                
            </div>
        </div>
        <div class="mb-3 row">
            <label for="rayon_id" class="col-sm-2 col-form-label">Rayon ID:</label>
            <div class="col-sm-10">
                <select class="form-select" name="rayon_id" id="rayon_id">
                    <option selected disabled hidden>Pilih</option>
                    @foreach($rayons as $ray)
                        <option value="{{ $ray->['id'] }}">{{ $ray->['id'] }}</option>
                    @endforeach
                </select>
            </div> 
        </div>
        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
@endsection

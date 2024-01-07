@extends('layouts.template')

@section('content')
<h1>Tambah Data Siswa</h1>
<h5><span style="color: blue">Data Mastar/Data Siswa/Tambah Data</span></h5>
    <form action="{{ route('students.store') }}" method="POST" class="card p-5">
        @csrf

        @if(Session::get('success'))
            <div class="alert alert-success"> {{ Session::get('success') }} </div>
        @endif
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nis :</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="nis" name="nis" placeholder="Nis">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Name :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="rombel" class="col-sm-2 col-form-label">Rombel :</label>
            <div class="col-sm-10">
                <select class="form-select" name="rombel_id" id="rombel">
                    <option selected disabled hidden>---Pilih data Rombel---</option>
                    @foreach($rombel as $rom)
                        <option value="{{ $rom['id'] }}">
                            {{ $rom['rombel'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Rayon :</label>
            <div class="col-sm-10">
               <select class="form-select" name="rayon_id" id="rayon">
                   <option selected disabled hidden>---Pilih Datan Rayon---</option>
                @foreach($rayon as $ray)
                    <option value="{{ $ray['id'] }}">
                        {{ $ray['rayon'] }}
                    </option>
                @endforeach 
               </select>
           </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
    </form>
@endsection
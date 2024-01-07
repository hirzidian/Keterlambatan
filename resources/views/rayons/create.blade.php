@extends('layouts.template')

@section('content')
<h1>Tambah Data Rayon</h1>
<h5><span style="color: blue">Data Mastar/Data Rayon/Tambah Data</span></h5>
    <form action="{{ route('rayons.store') }}" method="POST" class="card p-5">
        @csrf

        @if (Session::get('success'))
            <div class="alert alert-success"> {{ Session::get('success') }} </div>
        @endif
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
            <div>
                <center><h3>Isi Data Rayons</h3></center>
            </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Rayon :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rayon" name="rayon" placeholder="Rayon">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label" >Pembimbing Siswa :</label>
            <div class="col-sm-10">
                <select name="user_id" id="user_id" class="form-control">
                    <option selected disabled>Pilih</option>
                    @foreach ($user as $item)
                        <option selected hidden disabled>Pembingbing Siswa</option>
                        <option value="{{ $item->id }}">{{ $item['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
    </form>
@endsection

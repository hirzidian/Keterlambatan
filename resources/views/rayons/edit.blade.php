@extends('layouts.template')

@section('content')
<h1>Edit Data Rayon</h1>
<h5><span style="color: blue">Data Mastar/Data Rayon/Edit</span></h5>
    <form action="{{ route('rayons.update', $rayons['id']) }}" method="post" class="card p-5">
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
            <label for="name" class="col-sm-2 col-form-label">Rayon :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rayon" name="rayon" value="{{ $rayons['rayon'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Pembimbing Siswa :</label>
            <div class="col-sm-10">
                <select name="user_id" id="user_id" class="form-control">
                    <option selected disabled>Pilih</option>
                    @foreach ($user as $item)
                        <option selected hidden disabled>Pembingbing Siswa</option>
                        <option value="{{ $item['name'] }}">{{ $item['name'] }}</option>
                    @endforeach
                </select>
                
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
@endsection

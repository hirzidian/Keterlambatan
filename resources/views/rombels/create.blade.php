@extends('layouts.template')

@section('content')
<h1>Tambah Data Rombel</h1>
<h5><span style="color: blue">Data Mastar/Data Rombel/Tambah Data</span></h5>
<div class="container border py-4 rounded">
    <form action="{{ route('rombels.store') }}" method="POST" class="card p-5">
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
            <label for="name" class="col-sm-2 col-form-label">Rombel :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rombel" name="rombel"  placeholder="Rombel">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
    </form>
</div>
@endsection
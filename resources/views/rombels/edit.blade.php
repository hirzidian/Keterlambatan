@extends('layouts.template')

@section('content')
<h1>Edit Data Rombel</h1>
<h5><span style="color: blue">Data Mastar/Data Rombel/Edit</span></h5>
<div class="container border py-4 rounded">
    <form action="{{ route('rombels.update', $rombel['id']) }}" method="post" class="card p-5">
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
            <label for="rombel" class="col-sm-2 col-form-label">Rombel :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rombel" name="rombel" value="{{ $rombel['rombel'] }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
</div>
@endsection

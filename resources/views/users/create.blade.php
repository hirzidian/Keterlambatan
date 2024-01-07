@extends('layouts.template')

@section('content')
<h1>Tambah Data User</h1>
<h5><span style="color: blue">Data Mastar/Data User/Tambah Data</span></h5>
    <div class="container mt-5">
        <form action="{{ route('users.daftar') }}" method="post" class="card p-5 shadow-sm">
            @csrf

            @if (Session::get('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Nama : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email : </label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="role" class="col-sm-2 col-form-label">Role : </label>
                <div class="col-sm-10">
                    <select class="form-select" name="role" id="role" required>
                        <option selected disabled hidden>--Pilih Role--</option>
                        <option value="admin">Admin</option>
                        <option value="ps">Pembimbing Siswa</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
        </form>
    </div>
@endsection

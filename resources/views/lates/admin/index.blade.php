@extends('layouts.template')

@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    @if (Session::get('deleted'))
        <div class="alert alert-danger">{{ Session::get('deleted') }}</div>
    @endif

    @if (Session::get('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif

    <div class="text ms-4">
        <h3>Data Keterlambatan</h3>
        <p>Data Terlambat</p>
    </div>
    @if (Auth::check() && Auth::user()->role == "ps")
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{ route('ps.lates.eksport.excel') }}" class="btn btn-info ms-2">Export Data Keterlambatan</a>
    </div>
    @endif


    <div class="btn-group" role="group" aria-label="Basic example">
        @if (Auth::check() && Auth::user()->role == "admin")
            <a href="{{ route('admin.lates.data') }}" class="btn btn-primary ms-2">Keseluruhan Data</a>
            <a href="{{ route('admin.lates.rekap') }}" class="btn btn-outline-primary ms-2">Rekapitulasi Data</a>
        @else
            <a href="{{ route('ps.lates.data') }}" class="btn btn-primary ms-2">Keseluruhan Data</a>
            <a href="{{ route('ps.lates.rekapData') }}" class="btn btn-outline-primary ms-2">Rekapitulasi Data</a>
        @endif
    </div>
    
<style>
.flex-container {
  display: flex;
  align-items: center;
}

.input-group {
  margin-right: 10px; /* Atur margin sesuai kebutuhan Anda */
}

</style>
    <div class="container mt-5">
        <div class="button">
            @if (Auth::check() && Auth::user()->role == "admin")
              <div class="flex-container">
                <form action="{{ route('admin.lates.search') }}" method="GET" class="input-group flex-nowrap">
                  <input type="text" name="query" class="form-control" placeholder="Cari Detail Keterlambatan">
                  <button type="submit" class="btn btn-info text-white">Search</button>
                </form>
                <button type="submit" class="btn btn-danger text-white mx-1"><a href="{{ route('admin.lates.export.excel') }}" style="text-decoration: none; color:aliceblue;">Export</a></button>
                <a href="{{ route('admin.lates.create') }}" class="btn btn-info text-white ">Tambah</a>
              </div>
            @endif
          </div>          
        @if (!isset($searchQuery))
            <!-- Table for displaying all data -->
            <table class="table mt-4" style="text-align:start;">
                <!-- Table headers -->
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Tanggal Terlambat</th>
                        <th>Informasi</th>
                        @if (Auth::check() && Auth::user()->role == "admin")
                        <th>Bukti</th>
                        <th>Aksi</th>
                        @endif
                    </tr>
                </thead>

                <!-- Table body -->
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($lates as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            @php $isUserDisplayed = false; @endphp
                            @foreach ($students as $student)
                                @if ($student['student']['id'] == $item['student_id'])
                                    @if (!$isUserDisplayed)
                                        <td>
                                            {{ $student['student']['name'] }}
                                            <br>
                                            <em>
                                                ({{ $student['student']['nis'] }})
                                            </em>
                                        </td>
                                        @php $isUserDisplayed = true; @endphp
                                    @endif
                                @endif
                            @endforeach
                            <!-- Other table columns -->
                            <td>{{ $item['date_time_late'] }}</td>
                            <td>{{ $item['information'] }}</td>
                            @if (Auth::check() && Auth::user()->role == "admin")
                            <td><img src="{{ asset('images/' . $item['bukti']) }}"
                                    style="width: 100px; height:auto; border-radius:10px;" alt=""></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <form action="{{ route('admin.lates.edit', $item['id']) }}" method="">
                                        <button type="submit" class="btn btn-info text-white m-2" style="background: purple;">Edit</button>
                                    </form>
                                    <form action="{{ route('admin.lates.delete', $item['id']) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-info text-white m-2" style="background: purple">Hapus</button>
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <!-- Table for displaying search results -->
            <p style="margin: 20px;">Search results for: <strong>{{ $searchQuery }}</strong></p>
            <table class="table mt-4" style="text-align:center;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>name Siswa</th>
                        <th>Tanggal Terlambat</th>
                        <th>Informasi</th>
                        <th>Bukti</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($latesearch as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            @php $isUserDisplayed = false; @endphp
                            @foreach ($students as $student)
                                @if ($student['student']['id'] == $item['student_id'])
                                    @if (!$isUserDisplayed)
                                        <td>
                                            {{ $student['student']['nis'] }}
                                            {{ $student['student']['name'] }}
                                        </td>
                                        @php $isUserDisplayed = true; @endphp
                                    @endif
                                @endif
                            @endforeach
                            <td>{{ $item['date_time_late'] }}</td>
                            <td>{{ $item['information'] }}</td>
                            <td><img src="{{ asset('images/' . $item['bukti']) }}"
                                    style="width: 100px; height:auto; border-radius:10px;" alt=""></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <form action="{{ route('admin.lates.edit', $item['id']) }}" method="">
                                        <button type="submit" class="btn btn-info text-white m-2"
                                            style="background: purple;">Edit</button>
                                    </form>
                                    <form action="{{ route('admin.lates.delete', $item['id']) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-info text-white m-2"
                                            style="background: purple">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

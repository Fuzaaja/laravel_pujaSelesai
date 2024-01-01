@extends('template.master')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-primary">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Table Siswa</h3>
        </div>
        <div class="card-body">
            <!-- Tabel data siswa -->
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Foto</th>
                        <th>Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siswa as $data)
                        <tr>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->nis }}</td>
                            <td><img src="{{ Storage::url('siswa/' . $data->foto) }}" style="width:150px" class="img-thumbnail"></td>
                            <td>{{ $data->kelas }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

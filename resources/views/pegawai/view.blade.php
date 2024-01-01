@extends('template/master')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-primary">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">DataTable Pegawai</h3>
        </div>
        <div class="card-body">

            <a href="{{ route('pegawai.create') }}"><button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                    Tambah</button></a>

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Foto</th>
                        <th>Pekerjaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pegawai as $data)
                        <tr>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->nip }}</td>
                            <td><img src="{{ Storage::url('pegawai/' . $data->foto) }}" style="width:150px"
                                    class="img-thumbnail">
                            </td>
                            <td>{{ $data->pekerjaan }}</td>
                            <td>
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                    action="{{ route('pegawai.destroy', $data->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger"><i
                                            class="fa fa-trash"></i></button>
                                <a href="{{ route('pegawai.edit', $data->id) }}" class="btn btn-outline-warning">

                                </form>
                                &nbsp;

                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

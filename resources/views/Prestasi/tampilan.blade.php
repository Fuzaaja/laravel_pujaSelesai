@extends('template.master')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-primary">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data prestasi Man 3 Medan</h3>
        </div>
        <div class="card-body">
            <!-- Tabel data prestasi -->
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>judul</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prestasi as $data)
                        <tr>
                            <td>{{ $data->judul }}</td>
                            <td><img src="{{ Storage::url('prestasi/' . $data->foto) }}" style="width:150px" class="img-thumbnail"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

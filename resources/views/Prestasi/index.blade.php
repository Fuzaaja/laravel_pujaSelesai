@extends('template/master')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-primary">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data prestasi Man 3 medan</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('prestasi.create') }}"><button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>
            <!-- Tabel data siswa -->
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>judul</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prestasi as $data)
                        <tr>
                            <td>{{ $data->judul }}</td>
                            <td><img src="{{ Storage::url('prestasi/' . $data->foto) }}" style="width:150px" class="img-thumbnail"></td>
                            <td>
                                <div class="row">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('prestasi.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"><i class="fa fa-trash"></i> hapus</button>
                                        <a href="{{ route('prestasi.edit', $data->id) }}" class="btn btn-outline-warning"><i class="fa fa-edit">update</i></a> 
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <!-- DataTables JS and Plugins -->
    <script src="{{ url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ url('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ url('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection

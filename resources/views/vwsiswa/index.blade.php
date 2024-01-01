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
        <tr>
            <td>puja</td>
            <td>15</td>
            <td></td>
            <td>2tia</td>
        </tr>
        {{-- @foreach($siswa as $data)
            <tr>
                <td>{{ $data->nama }}</td>
                <td>{{ $data->nis }}</td>
                <td><img src="{{ Storage::url('siswa/' . $data->foto) }}" style="width:150px" class="img-thumbnail"></td>
                <td>{{ $data->kelas }}</td>
                <td>
                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('siswa.destroy', $data->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger"><i class="fa fa-trash"></i></button>
                    </form>
                    <a href="{{ route('siswa.edit', $data->id) }}" class="btn btn-outline-warning"><i class="fa fa-edit"></i></a>
                </td>
            </tr>
        @endforeach --}}
    </tbody>
</table>
<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::latest()->paginate(10);
        return view('siswa.index', compact('siswa'),['siswa' => $siswa] );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswa.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $foto = $request->file('foto');
        $foto->storeAs('public/siswa', $foto->hashName());
        $siswa = Siswa::create([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'foto' => $foto->hashName(),
            'kelas' => $request->kelas
        ]);
        if ($siswa) {
            return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect()->route('siswa.index')->with(['error' => 'Data Gagal Disimpan']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        $siswa = Siswa::latest()->paginate(10);
        return view('siswa.tampilan', compact('siswa'),['siswa' => $siswa] );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $siswa = Siswa::find($id);
        return view('siswa.update', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        if ($request->file('foto') == "") {
            $siswa->update([
                "nama" => $request->nama,
                "nis" => $request->nis,
                "kelas" => $request->kelas
            ]);
        } else {
            Storage::disk("local")->delete("public/siswa" . $siswa->foto);
            $foto = $request->file("foto");
            $foto->storeAs("public/siswa", $foto->hashName());
            $siswa->update([
                'nama' => $request->nama,
                'foto' => $foto->hashName(),
                'nis' => $request->nis,
                'kelas' => $request->kelas
            ]);
        }
        if ($siswa) {
            return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Diubah!']);
        } else {
            return redirect()->route('siswa.index')->with(['error'=> 'Data Gagal Diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        Storage::disk("local")->delete("public/siswa/" . $siswa->gambar);
        $siswa->delete();
        if ($siswa) {
            return redirect()->route("siswa.index")->with(["success" => "Data Berhasil Dihapus"]);
        } else {
            return redirect()->route("siswa.index")->with(["error" => "Data Gagal Dihapus"]);
        }
    }
}

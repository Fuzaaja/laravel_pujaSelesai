<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $pegawai = Pegawai::latest()->paginate(10);
        $data = array(
            'pegawai' => Pegawai::all()
        );
        return view('pegawai.index', $data);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pegawai.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $foto = $request->file('foto');
        $foto->storeAs('public/pegawai', $foto->hashName());
        $pegawai = Pegawai::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'foto' => $foto->hashName(),
            'pekerjaan' => $request->pekerjaan
        ]);
        if ($pegawai) {
            return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect()->route('pegawai.index')->with(['error' => 'Data Gagal Disimpan']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pegawai = Pegawai::find($id);
        return view('pegawai.update', compact('pegawai'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        if ($request->file('foto') == "") {
            $pegawai->update([
                "nama" => $request->nama,
                "nip" => $request->nip,
                "pekerjaan" => $request->pekerjaan
            ]);
        } else {
            Storage::disk("local")->delete("public/pegawai" . $pegawai->foto);
            $foto = $request->file("foto");
            $foto->storeAs("public/pegawai", $foto->hashName());
            $pegawai->update([
                'nama' => $request->nama,
                'foto' => $foto->hashName(),
                'nip' => $request->nip,
                'pekerjaan' => $request->pekerjaan
            ]);
        }
        if ($pegawai) {
            return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Diubah!']);
        } else {
            return redirect()->route('pegawai.index')->with(['error'=> 'Data Gagal Diubah!']);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        Storage::disk("local")->delete("public/pegawai/" . $pegawai->gambar);
        $pegawai->delete();
        if ($pegawai) {
            return redirect()->route("pegawai.index")->with(["success" => "Data Berhasil Dihapus"]);
        } else {
            return redirect()->route("pegawai.index")->with(["error" => "Data Gagal Dihapus"]);
        }
    }
}
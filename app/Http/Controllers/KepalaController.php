<?php

namespace App\Http\Controllers;

use App\Models\Kepala; // Ganti model dari Siswa menjadi Kepala
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KepalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data =array(
            'kepala' => Kepala :: all(),
        );

        return view('kepala.index',$data);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kepala.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $foto = $request->file('foto');
        $foto->storeAs('public/kepala', $foto->hashName()); // Ganti direktori dari siswa ke kepala
        $kepala = Kepala::create([ // Ganti model dari Siswa menjadi Kepala
            'nama' => $request->nama,
            'komen' => $request->komen, // Ganti nis ke komen
            'foto' => $foto->hashName(),
        ]);
        if ($kepala) {
            return redirect()->route('kepala.index')->with(['success' => 'Data Berhasil Disimpan']); // Ganti route dari siswa ke kepala
        } else {
            return redirect()->route('kepala.index')->with(['error' => 'Data Gagal Disimpan']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kepala $kepala) // Ganti model dari Siswa menjadi Kepala
    {
        $kepala = Kepala::latest()->paginate(10); // Ganti model dari Siswa menjadi Kepala
        return view('kepala.tampilan', compact('kepala'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kepala = Kepala::find($id);
        return view('kepala.update', compact('kepala'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kepala = Kepala::findOrFail($id);
        if ($request->file('foto') == "") {
            $kepala->update([
                "nama" => $request->nama,
                "komen" => $request->komen, // Ganti nis ke komen
            ]);
        } else {
            Storage::disk("local")->delete("public/kepala" . $kepala->foto);
            $foto = $request->file("foto");
            $foto->storeAs("public/kepala", $foto->hashName());
            $kepala->update([
                'nama' => $request->nama,
                'foto' => $foto->hashName(),
                'komen' => $request->komen, // Ganti nis ke komen
            ]);
        }
        if ($kepala) {
            return redirect()->route('kepala.index')->with(['success' => 'Data Berhasil Diubah!']); // Ganti route dari siswa ke kepala
        } else {
            return redirect()->route('kepala.index')->with(['error'=> 'Data Gagal Diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kepala = Kepala::findOrFail($id);
        Storage::disk("local")->delete("public/kepala/" . $kepala->foto);
        $kepala->delete();
        if ($kepala) {
            return redirect()->route("kepala.index")->with(["success" => "Data Berhasil Dihapus"]);
        } else {
            return redirect()->route("kepala.index")->with(["error" => "Data Gagal Dihapus"]);
        }
    }
}

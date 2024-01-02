<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = array(
            'prestasi' => Prestasi::all(),
        );

        return view('prestasi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('prestasi.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $foto = $request->file('foto');
        $foto->storeAs('public/prestasi', $foto->hashName());
        $prestasi = Prestasi::create([
            'judul' => $request->judul,
            'foto' => $foto->hashName(),
        ]);

        if ($prestasi) {
            return redirect()->route('prestasi.index')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect()->route('prestasi.index')->with(['error' => 'Data Gagal Disimpan']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestasi $prestasi)
    {
        $prestasi = Prestasi::latest()->paginate(10);
        return view('prestasi.tampilan', compact('prestasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $prestasi = Prestasi::find($id);
        return view('prestasi.update', compact('prestasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $prestasi = Prestasi::findOrFail($id);

        if ($request->file('foto') == "") {
            $prestasi->update([
                "judul" => $request->judul,
            ]);
        } else {
            Storage::disk("local")->delete("public/prestasi" . $prestasi->foto);
            $foto = $request->file("foto");
            $foto->storeAs("public/prestasi", $foto->hashName());
            $prestasi->update([
                'judul' => $request->judul,
                'foto' => $foto->hashName(),
            ]);
        }

        if ($prestasi) {
            return redirect()->route('prestasi.index')->with(['success' => 'Data Berhasil Diubah!']);
        } else {
            return redirect()->route('prestasi.index')->with(['error'=> 'Data Gagal Diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        Storage::disk("local")->delete("public/prestasi/" . $prestasi->foto);
        $prestasi->delete();

        if ($prestasi) {
            return redirect()->route("prestasi.index")->with(["success" => "Data Berhasil Dihapus"]);
        } else {
            return redirect()->route("prestasi.index")->with(["error" => "Data Gagal Dihapus"]);
        }
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rekening;

class RekeningController extends Controller
{
    public function index()
    {

        $rekening = Rekening::all();
        return view('admin.rekening.index', compact('rekening'));
    }

    public function tambah()
    {
        return view('admin.rekening.tambah');
    }

    public function store(Request $request)
    {
        //simpan data ke db
        Rekening::create([
            'bank_name'     => $request->bank_name,
            'atas_nama'     => $request->atas_nama,
            'no_rekening'   => $request->no_rekening,
        ]);

        return redirect()->route('admin.rekening')->with('status', 'Berhasil Menambah Rekening');
    }

    public function update($id, Request $request)
    {
        // update rekening
        Rekening::updateOrCreate([
            'id'    => $id
        ], [
            'bank_name'   => $request->bank_name,
            'atas_nama'   => $request->atas_nama,
            'no_rekening' => $request->no_rekening
        ]);

        return redirect()->route('admin.rekening')->with('status', 'Berhasil Mengubah Rekening');
    }

    public function edit($id)
    {
        $rekening = Rekening::FindOrFail($id);

        return view('admin.rekening.edit', compact('rekening'));
    }

    public function delete(Rekening $id)
    {
        //hapus rekening
        $id->delete();

        return redirect()->route('admin.rekening')->with('status', 'Berhasil Mengahapus Rekening');
    }
}

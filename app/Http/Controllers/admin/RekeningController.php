<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rekening;
class RekeningController extends Controller
{
    public function index()
    {
        //mengambil data no rekening
        $data = array(
            'rekening' => Rekening::all()
        );
        return view('admin.rekening.index',$data);
    }

    public function tambah()
    {
        //menampilkan form tambah data
        return view('admin.rekening.tambah');
    }

    public function store(Request $request)
    {
        //simpan data ke db
        Rekening::create([
            'bank_name' => $request->bank_name,
            'atas_nama' => $request->atas_nama,
            'no_rekening' => $request->no_rekening,
        ]);

        return redirect()->route('admin.rekening')->with('status','Berhasil Menambah Rekening');
    }

    public function update($id,Request $request)
    {
        // update rekening
        $rekening = Rekening::FindOrFail($id);
        $rekening->bank_name = $request->bank_name;
        $rekening->atas_nama = $request->atas_nama;
        $rekening->no_rekening = $request->no_rekening;
        $rekening->save();
        return redirect()->route('admin.rekening')->with('status','Berhasil Mengubah Rekening');
    }

    public function edit($id)
    {
        //tampilkan form edit
        $data = array(
            'rekening' => Rekening::FindOrFail($id)
        );
        return view('admin.rekening.edit',$data);
    }

    public function delete($id)
    {
        //hapus rekening
        Rekening::destroy($id);
        
        return redirect()->route('admin.rekening')->with('status','Berhasil Mengahapus Rekening');
    }
}

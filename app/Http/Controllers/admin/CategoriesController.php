<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Categories;
class CategoriesController extends Controller
{
    public function index()
    {

        //Ambil data kategori dari database
        $data = array(
            'categories' => Categories::all()
        );
        //menampilkan view
        return view('admin.categories.index',$data);
    }

    //function menampilkan view tambah data
    public function tambah()
    {
        return view('admin.categories.tambah');
    }

    public function store(Request $request)
    {
        //Simpan datab ke database    
        Categories::create([
            'name' => $request->name
        ]);
        
        //lalu reireact ke route admin.categories dengan mengirim flashdata(session) berhasil tambah data untuk manampilkan alert succes tambah data
        return redirect()->route('admin.categories')->with('status','Berhasil Menambah Kategori');
    }

    public function update($id,Request $request)
    {
        //ambil data sesuai id dari parameter
        $categorie = Categories::FindOrFail($id);
        //lalu ambil apa aja yang mau diupdate
        $categorie->name = $request->name;

        //lalu simpan perubahan
        $categorie->save();
        return redirect()->route('admin.categories')->with('status','Berhasil Mengubah Kategori');
    }

    //function menampilkan form edit
    public function edit($id)
    {
        $data = array(
            'categorie' => $categorie = Categories::FindOrFail($id)
        );
        return view('admin.categories.edit',$data);
    }

    public function delete($id)
    {
        //hapus data sesuai id dari parameter
        Categories::destroy($id);
        
        return redirect()->route('admin.categories')->with('status','Berhasil Mengahapus Kategori');
    }
}

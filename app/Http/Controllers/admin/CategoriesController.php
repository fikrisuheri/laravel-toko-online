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
        $categories = Categories::all();

        //menampilkan view
        return view('admin.categories.index', compact('categories'));
    }

    //function menampilkan view tambah data
    public function tambah()
    {
        return view('admin.categories.tambah');
    }

    public function store(Request $request)
    {
        //Simpan datab ke database    
        Categories::updateOrCreate([
            'name' => $request->name
        ], []);

        //lalu reireact ke route admin.categories dengan mengirim flashdata(session) berhasil tambah data untuk manampilkan alert succes tambah data
        return redirect()->route('admin.categories')->with('status', 'Berhasil Menambah Kategori');
    }

    public function update(Categories $id, Request $request)
    {
        $id->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.categories')->with('status', 'Berhasil Mengubah Kategori');
    }

    //function menampilkan form edit
    public function edit(Categories $id)
    {
        return view('admin.categories.edit', [
            'categorie' => $id
        ]);
    }

    public function delete($id)
    {
        //hapus data sesuai id dari parameter
        Categories::destroy($id);

        return redirect()->route('admin.categories')->with('status', 'Berhasil Mengahapus Kategori');
    }
}

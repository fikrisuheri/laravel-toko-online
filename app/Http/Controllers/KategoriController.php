<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Categories;
use Illuminate\Support\Facades\DB;
class KategoriController extends Controller
{
    public function produkByKategori($id)
    {
       //menampilkan data sesua kategori yang diminta user
        return view('user.kategori', [
            'produks' => Product::where('categories_id',$id)->paginate(5),
            'categories' => Categories::all()
        ]);
    }
}

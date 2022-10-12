<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Categories;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function index()
    {
        //menampilkan data produk yang dijoin dengan table kategori
        //kemudian dikasih paginasi 9 data per halaman nya
        $kat = Categories::join('products', 'products.categories_id', '=', 'categories.id')
            ->select(DB::raw('count(products.categories_id) as jumlah, categories.*'))
            ->groupBy('categories.id')
            ->get();

        return view('user.produk', [
            'produks' => Product::paginate(9),
            'categories' => $kat
        ]);
    }
    public function detail($id)
    {
        //mengambil detail produk
        return view('user.produkdetail', [
            'produk' => Product::findOrFail($id)
        ]);
    }

    public function cari(Request $request)
    {
        //mencari produk yang dicari user
        $prod  = Product::where('name', 'like', '%' . $request->cari . '%')->paginate(9);
        // $total = Product::where('name', 'like', '%' . $request->cari . '%')->count();

        return view('user.cariproduk', [
            'produks' => $prod,
            'cari' => $request->cari,
            'total' => $prod->total()
        ]);
    }
}

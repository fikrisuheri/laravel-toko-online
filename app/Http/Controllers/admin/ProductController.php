<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Categories;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        //membawa data produk yang di join dengan table kategori
        $products = Product::join('categories', 'categories.id', '=', 'products.categories_id')
            ->select('products.*', 'categories.name as nama_kategori')
            ->get();

        return view('admin.product.index', compact('products'));
    }

    public function tambah()
    {
        //menampilkan form tambah kategori

        $categories = Categories::all();

        return view('admin.product.tambah', compact('categories'));
    }

    public function store(Request $request)
    {
        if ($request->file('image')) {
            //simpan foto produk yang di upload ke direkteri public/storage/imageproduct
            $file = $request->file('image')->store('imageproduct', 'public');

            Product::create([
                'name'          => $request->name,
                'description'   => $request->description,
                'price'         => $request->price,
                'stok'          => $request->stok,
                'weigth'        => $request->weigth,
                'categories_id' => $request->categories_id,
                'image'         => $file

            ]);

            return redirect()->route('admin.product')->with('status', 'Berhasil Menambah Produk Baru');
        }
    }

    public function edit(Product $id)
    {
        //menampilkan form edit
        //dan mengambil data produk sesuai id dari parameter

        return view('admin.product.edit', [
            'product'       => $id,
            'categories'    => Categories::all(),
        ]);
    }

    public function update(Product $id, Request $request)
    {
        $prod = $id;

        if ($request->file('image')) {

            Storage::delete('public/' . $prod->image);
            $file = $request->file('image')->store('imageproduct', 'public');
            $prod->image = $file;
        }

        $prod->name = $request->name;
        $prod->description = $request->description;
        $prod->price = $request->price;
        $prod->weigth = $request->weigth;
        $prod->categories_id = $request->categories_id;
        $prod->stok = $request->stok;


        $prod->save();

        return redirect()->route('admin.product')->with('status', 'Berhasil Mengubah Kategori');
    }

    public function delete(Product $id)
    {
        //mengahapus produk
        Storage::delete('public/' . $id->image);
        $id->delete();

        return redirect()->route('admin.product')->with('status', 'Berhasil Mengahapus Produk');
    }
}

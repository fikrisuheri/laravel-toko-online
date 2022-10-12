<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = DB::table('users')
            ->join('alamat', 'alamat.user_id', '=', 'users.id')
            ->join('cities', 'cities.city_id', '=', 'alamat.cities_id')
            ->join('provinces', 'provinces.province_id', '=', 'cities.province_id')
            ->select('users.*', 'alamat.detail', 'cities.title as kota', 'provinces.title as prov')
            ->where('users.role', '=', 'customer')->get();

        return view('admin.pelanggan.index', compact('pelanggan'));
    }
}

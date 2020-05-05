<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Province;
use App\City;
class PengaturanController extends Controller
{
    public function aturalamat()
    {
        //cek apa alamat toko sudah di set atau belum
        $cek = DB::table('alamat_toko')->count();
        $data['cekalamat'] = $cek;
        //jika belum di setting maka ambil data provinsi untuk di tampilkan di form alamat
        if($cek < 1){
            $data['provinces'] = Province::all();
        }else{
            //jika sudah di setting maka tidak menampilkan form tapi tampilkan data alamat toko
            $data['alamat'] = DB::table('alamat_toko')
                                    ->join('cities','cities.city_id','=','alamat_toko.city_id')
                                    ->join('provinces','provinces.province_id','=','cities.province_id')
                                    ->select('alamat_toko.*','cities.title as kota','provinces.title as prov')->first();
        }
        return view('admin.pengaturan.alamat',$data);
    }
    public function getCity($id)
    {

        //kfunction untuk mengambil data kota sesuia id parameter
        $city = City::where('province_id',$id)->get();
        //lalu return dengan format json
        return response()->json($city); 
    }

    public function ubahalamat($id)
    {
        //function untuk menampilkan form edit alamat
        $data['provinces'] = Province::all();
        $data['id'] = $id;
        return view('admin.pengaturan.ubahalamat',$data);
    }
    
    public function simpanalamat(Request $request)
    {
        //menyimpan alamat baru pada toko

        DB::table('alamat_toko')->insert([
            'city_id' => $request->cities_id,
            'detail'  => $request->detail
        ]);

        return redirect()->route('admin.pengaturan.alamat')->with('status','Berhasil Mengatur Alamat');
    }

    public function updatealamat($id,Request $request)
    {

        //mengupdate alamat toko
        DB::table('alamat_toko')
            ->where('id',$id)
            ->update([
            'city_id' => $request->cities_id,
            'detail'  => $request->detail
        ]);

        return redirect()->route('admin.pengaturan.alamat')->with('status','Berhasil Mengubah Alamat');
    }
}

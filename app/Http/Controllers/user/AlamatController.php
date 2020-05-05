<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Province;
use App\City;
use App\Alamat;
use Illuminate\Support\Facades\DB;
class AlamatController extends Controller
{
    public function index()
    {
        //ambil session id user
        $id_user = \Auth::user()->id;
        //ambil data alamat
        $data['province'] = Province::all();
        $cekAlamat = DB::table('alamat')
                    ->where('user_id',$id_user)
                    ->count();
        //cek jika user sudah mengatur alamat maka jalankan ini
        if($cekAlamat >0){
            $data['alamat'] = DB::table('alamat')
            ->join('cities','cities.city_id','=','alamat.cities_id')
            ->join('provinces','provinces.province_id','=','cities.province_id')
            ->select('provinces.title as prov','cities.title as kota','alamat.*')
            ->where('alamat.user_id',$id_user)
            ->get();
            return view('user.alamatada',$data);               
        }else{
            //jika belum maka tampilkan form untuk mengatur alamat
            return view('user.alamat',$data);            
        }
        
    }

    public function ubah($id)
    {
        //menampilkan form edit alamat
        $data['province'] = Province::all();
        $data['id'] = $id;
        return view('user.ubahalamat',$data); 
    }

    public function update($id,Request $request)
    {
        //mengupdate alamat
        $alamat = Alamat::findOrFail($id);
        $alamat->cities_id = $request->cities_id;
        $alamat->detail = $request->detail;
        $alamat->save();
        return redirect()->route('user.alamat');

    }

    public function getCity($id)
    {
        //mengambil data kota/kab
        $city = City::where('province_id',$id)->get();
        return response()->json($city); 
    }
    public function simpan(Request $request)
    {
        //menyimpan alamat user
        Alamat::create([
            'cities_id' => $request->cities_id,
            'detail'    => $request->detail,
            'user_id'   => \Auth::user()->id
        ]);
        
        return redirect()->route('user.alamat');
    }
}

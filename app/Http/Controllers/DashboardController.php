<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    //
    public function index()
    {
        //ambil data data untuk ditampilkan di card pada dashboard
        $pendapatan = DB::table('order')
                        ->select(DB::raw('SUM(subtotal) as penghasilan'))
                        ->where('status_order_id',5)
                        ->first();
        $transaksi = DB::table('order')
                        ->select(DB::raw('COUNT(id) as total_order'))
                        ->first();
        $pelanggan = DB::table('users')
                        ->select(DB::raw('COUNT(id) as total_user'))
                        ->where('role','=','customer')
                        ->first();
        $order_terbaru = $order = DB::table('order')
                        ->join('status_order','status_order.id','=','order.status_order_id')
                        ->join('users','users.id','=','order.user_id')
                        ->select('order.*','status_order.name','users.name as nama_pemesan')
                        ->limit(10)
                        ->get();
        $data = array(
            'pendapatan' => $pendapatan,
            'transaksi'  => $transaksi,
            'pelanggan'  => $pelanggan,
            'order_baru' => $order_terbaru
        );
        
        return view('admin/dashboard',$data);
    }
}

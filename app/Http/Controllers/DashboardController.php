<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Index dashboard - main app preview
     * @return \Illuminate\View\View
     */
    public function index()
    {
        //ambil data data untuk ditampilkan di card pada dashboard
        $pendapatan = Order::select(DB::raw('SUM(subtotal) as penghasilan'))
            ->where('status_order_id', 5)
            ->first();
        $transaksi = Order::select(DB::raw('COUNT(id) as total_order'))
            ->first();
        $pelanggan = User::select(DB::raw('COUNT(id) as total_user'))
            ->where('role', '=', 'customer')
            ->first();
        $order_terbaru = Order::join('status_order', 'status_order.id', '=', 'order.status_order_id')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->select('order.*', 'status_order.name', 'users.name as nama_pemesan')
            ->limit(10)
            ->get();

        return view('admin/dashboard', [
            'pendapatan' => $pendapatan,
            'transaksi'  => $transaksi,
            'pelanggan'  => $pelanggan,
            'order_baru' => $order_terbaru
        ]);
    }
}

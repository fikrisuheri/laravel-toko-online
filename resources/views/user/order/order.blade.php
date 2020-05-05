@extends('user.app')
@section('content')
<div class="bg-light py-3">
    <div class="container">
    <div class="row">
        <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong></div>
    </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <h2 class="btn btn-warning text-white">Belum Dibayar</h2>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
           <div class="table-responsive">
           <div class="table-responsive">
           <table class="table table-bordered">
            <thead>
                <tr>
                <th class="product-thumbnail">Invoice</th>
                <th class="product-name">Total</th>
                <th class="product-price">Status</th>
                <th class="product-quantity" width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order as $o)
                <tr>
                    <td>{{ $o->invoice }}</td>
                    <td>{{ $o->subtotal + $o->biaya_cod }}</td>
                    <td>{{ $o->name }}</td>
                    <td>
                    <a href="{{ route('user.order.pembayaran',['id' => $o->id]) }}" class="btn btn-success">Bayar</a>
                    <a href="{{ route('user.order.pesanandibatalkan',['id' => $o->id]) }}" onclick="return confirm('Yakin ingin membatalkan pesanan')" class="btn btn-danger">Batalkan</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
            </div>
           </div>
        
    </div>

    </div>

    <div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <h2 class="btn btn-warning text-white">Sedang Dalam Proses</h2>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <table class="table table-bordered">
            <thead>
                <tr>
                <th class="product-thumbnail">Invoice</th>
                <th class="product-name">Total</th>
                <th class="product-price">Status</th>
                <th class="product-quantity" width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dicek as $o)
                <tr>
                    <td>{{ $o->invoice }}</td>
                    <td>{{ $o->subtotal + $o->biaya_cod }}</td>
                    <td>
                        @if($o->name == 'Perlu Di Cek')
                        Sedang Di Cek
                        @else
                        {{ $o->name }}
                        @endif
                    </td>
                    <td>
                    <a href="{{ route('user.order.detail',['id' => $o->id]) }}" class="btn btn-success">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        
    </div>

    <div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <h2 class="btn btn-warning text-white">Riwayat Pesanan Anda</h2>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="table-responsive">
            <table class="table table-bordered">
            <thead>
                <tr>
                <th class="product-thumbnail">Invoice</th>
                <th class="product-name">Total</th>
                <th class="product-price">Status</th>
                <th class="product-quantity" width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($histori as $o)
                <tr>
                    <td>{{ $o->invoice }}</td>
                    <td>{{ $o->subtotal + $o->biaya_cod }}</td>
                    <td>{{ $o->name }}</td>
                    <td>
                    <a href="{{ route('user.order.detail',['id' => $o->id]) }}" class="btn btn-success">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
            </div>
        
    </div>

    </div>
</div>
@endsection
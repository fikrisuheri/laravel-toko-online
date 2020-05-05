@extends('user.app')
@section('content')

<div class="bg-light py-3">
    <div class="container">
    <div class="row">
        <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Order</strong></div>
    </div>
    </div>
</div>  

<div class="site-section">
    <div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
        <span class="icon-check_circle display-3 text-success"></span>
        <h2 class="display-3 text-black">Terimakasih!</h2>
        <p class="lead mb-5">Pesanan Kamu Berhasil Dibuat Dengan No Invoice Silahkan Konfirmasi Pembayaran Lewat Menu Konfirmasi Pembayaran.</p>
        <p><a href="{{ route('user.order') }}" class="btn btn-sm btn-primary">Menu Pembayaran</a></p>
        </div>
    </div>
    </div>
</div>
@endsection
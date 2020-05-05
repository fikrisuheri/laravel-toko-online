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
        <div class="col-md-12 text-center">
            <h2 class="display-5">Silahkan Lakukan Pembayaran Lewat No Rekening Berikut</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row  mb-2 text-center">
                        @foreach($rekening as $key)
                        <div class="col-md-3">
                        <div class="card text-white bg-info mb-3 " style="max-width: 18rem;">
                        <div class="card-header">{{ $key->bank_name }}</div>
                        <div class="card-body">
                        <h5 class="card-title">{{ $key->no_rekening }}</h5>
                        <p class="card-text">Atas Nama {{ $key->atas_nama }}</p>
                        </div>
                        </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row  mb-4">
                        <div class="col-md-12 text-center">
                            Transfer Sebesar Rp {{ number_format($order->subtotal,2,',','.') }} Ke No Rekening Di Atas
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <form action="{{ route('user.order.kirimbukti',['id' => $order->id ]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                            <label for="">Upload Bukti Pembayaran</label>
                            <input type="file" name="bukti_pembayaran" id="" class="form-control" required>
                            </div>
                            <div class="text-right">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    </div>
</div>
@endsection
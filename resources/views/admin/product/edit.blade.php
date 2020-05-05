@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Edit Produk </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="row mb-3">
                      <div class="col">
                      <h4 class="card-title">Edit Produk</h4>
                      </div>
                      <div class="col text-right">
                      <a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-primary">Kembali</a>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('admin.product.update',['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                <label for="exampleInputUsername1">Nama Produk</label>
                                <input required type="text" class="form-control" name="name" value="{{ $product->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Pilih Kategori</label>
                                    <select class="form-control" name="categories_id" id="exampleFormControlSelect2">
                                    @foreach($categories as $categorie)
                                        <option value="{{ $categorie->id }}" <?php if($product->categories_id == $categorie->id){ echo 'selected';} ?>>{{ $categorie->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputUsername1">Berat (gram)</label>
                                <input required type="number" class="form-control" name="weigth" value="{{ $product->weigth}}">
                                </div>
                                <div class="form-group">
                                <label for="exampleInputUsername1">Harga</label>
                                <input required type="number" class="form-control" name="price" value="{{ $product->price}}">
                                </div>
                                <div class="form-group">
                                <label for="exampleInputUsername1">Stok</label>
                                <input required type="number" class="form-control" name="stok" value="{{ $product->stok}}">
                                </div>
                                <div class="form-group">
                                    <label>File upload</label>
                                    <input type="file" name="image" class="form-control">
                                    <small>kosongkan jika tidak mengubah gambar</small>
                                </div>
                                <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control" required>{{ $product->description }}</textarea>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success text-right">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
@endsection

@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Alamat Toko </h3>
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
                   
                    @if($cekalamat < 1)
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('admin.pengaturan.simpanalamat') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                <label>Provinsi</label>
                                <select required name="province_id" id="province_id" class="form-control">
                                    @foreach($provinces as $province)
                                        <option value="{{ $province->province_id }}">{{ $province->title }}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="form-grup">
                                    <label for="">Kota/Kabupaten</label>
                                    <select name="cities_id" id="cities_id" class="form-control" required>
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                <label>Detail Alamat</label>
                                <input type="text" class="form-control" name="detail" required>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success text-right">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <table>
                                <tr>
                                    <th>Alamat Sekarang</th>
                                    <th>:</th>
                                    <td>{{ $alamat->detail }} , {{ $alamat->kota }} , {{ $alamat->prov }}</td>
                                </tr>
                            </table>
                              <small><a href="{{ route('admin.pengaturan.ubahalamat',['id' =>  $alamat->id]) }}">Klik untuk mengubah alamat toko</a></small>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection
@section('js')
<script type="text/javascript">
var toHtml = (tag, value) => {
	$(tag).html(value);
	}
 $(document).ready(function() {
    //  $('#province_id').select2();
    //  $('#cities_id').select2();
     $('#province_id').on('change',function(){
     var id = $('#province_id').val();
     var url = window.location.href;
     $.ajax({
         type:'GET',
         url:url + '/getcity/' + id,
         dataType:'json',
         success:function(data){
            var op = '<option value="">Pilih Kota</option>';
            if(data.length > 0) {
			var i = 0;
			for(i = 0; i < data.length; i++) {
				op += `<option value="${data[i].city_id}">${data[i].title}</option>`
			}
		    }
            toHtml('[name="cities_id"]', op);
         }
     })
     })
 });
</script>
@endsection
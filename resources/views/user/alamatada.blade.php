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
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <label for="">Alamat Sekarang </label><br>
                            {{ $alamat[0]->prov }},{{ $alamat[0]->kota }},{{ $alamat[0]->detail }}
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12 text-right">
                            <a href="{{ route('user.alamat.ubah',['id' => $alamat[0]->id] ) }}" class="btn btn-primary">Ubah Alamat</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
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
     var url = window.location.href + '/getcity/' + id;   
     $.ajax({
         type:'GET',
         url:url,
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
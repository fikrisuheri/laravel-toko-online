<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <form action="/submit" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Provinsi Asal</label>
            <select name="province_origin" class="form-control" id="province_origin">
                @foreach($provinces as $province)
                    <option value="{{ $province->id }}">{{ $province->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Kota Asal</label>
            <select name="city_origin" class="form-control" id="city_origin">
            </select>
        </div>
        <div class="form-group">
            <label for="">Kurir</label>
            <select name="province_origin" class="form-control" id="">
                @foreach($couriers as $courier => $value)
                    <option value="{{ $courier }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </form>

    <script src="http://betechdeveloper.com/apps/kritiksaransmk/assets/adminlte/bower_components/jquery/dist/jquery_latest.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script src="http://betechdeveloper.com/apps/kritiksaransmk/assets/adminlte/bower_components/jquery-ui/jquery-ui.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="http://betechdeveloper.com/apps/kritiksaransmk/assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="http://betechdeveloper.com/apps/kritiksaransmk/assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script>
    var khususMengambil = async (link, data = null) => {
		var hasil = await $.ajax({
			url: link,
			data: data,
			type: "GET",
			dataType: "JSON"
		});
		return hasil;
	}

	var toHtml = (tag, value) => {
	$(tag).html(value);
	}
    $(()=>{
        $('#province_origin').on('change',function(){
            let ProvinceID = $(this).val();
            var getCity = async () => {
            var {
                results
            } = await khususMengambil('/ongkir/province/'+ProvinceID+'/cities');
            var op = '<option value="">Pilih Jenis Krisar</option>';
            if(results.length > 0) {
                var i = 0;
                for(i = 0; i < results.length; i++) {
                    op += `<option value="${results[i].city_id}">${results[i].title}</option>`
                }
            }
            toHtml('[name="city_origin"]', op);
            console.log(ProvinceID);
        }
        })
    })
    </script>
  </body>
</html>
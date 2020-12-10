<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
    <link rel="stylesheet" href=" {{asset('plugins/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
  </head>
  <body style="background-color:#f1f1f1;">
    <div class="fluid-container">
      <div class="row">
        <div class="col-xs-2"></div>
        <div class="col-xs-8">
          <div class="wrap" style="background-color:white; padding:10px; border:1px solid grey; border-radius:10px; margin-top:50px;">
            <div class="header">
              <h3>Step 1: Verifikasi alamat</h3>
            </div>
            <div class="content"><br>
              <form class="" action="{{route('storeAlamat')}}" method="post">
                <div class="form-group">
                  <label for="">Provinsi/kabupaten</label>
                  <select class="form-control" id="provinsi" name="provinsi" onchange="pilihKota()">
                    <option value="">Provinsi..</option>
                    @foreach($provinsi as $row)
                    <option value="{{$row->id}}">{{$row->nama}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="">kota/kabupaten</label>
                  <select class="form-control" name="kota" id="kota" disabled>
                  </select>
                </div>
                <div class="form-group">
                  <label for="">Alamat lengkap</label>
                  <textarea name="alamat_lengkap" rows="8" cols="80" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <label for="">Kode pos</label>
                  <input type="number" name="kode_pos" class="form-control">
                </div>
                <br>
                <div class=" text-right">
                  <input type="submit" name="submit" value="simpan" class="btn e-btn">
                </div>
                @csrf

              </form>
              @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


            </div>

          </div>

        </div>

      </div>

    </div>
    <script type="text/javascript" src=" {{asset('plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
      function pilihKota(){
        var kota = $('#kota');
        var provinsi = $('#provinsi');
        kota.prop('disabled', false);
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
              type:'post',
              url:'{{route("getKota")}}',
              data:{
                provinsi:provinsi.val()
              },
              success:function(data){
                kota.empty();
                $.each(data,function(i){
                  kota.append('<option value='+data[i].id+'>'+data[i].nama+'</option>')
                })
              },
            });


      }


    </script>
  </body>
</html>

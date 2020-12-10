<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
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
              <h3>Step 2: Verifikasi Toko</h3>
            </div>
            <div class="content"><br>
              <form class="" action="{{route('storeToko')}}" method="post">
                <div class="form-group">
                  <label for="">Nama Toko</label>
                  <input type="text" name="nama_toko" class="form-control">
                </div>
                <div class="form-group">
                  <label for="">Deskripsi Toko</label>
                  <textarea name="deskripsi_toko" rows="8" cols="80" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <label for="">Kurir yang tersedia</label><br>
                  @foreach($kurir as $row)
                  <input type="checkbox" name="{{$row->nama}}" value="1"> {{$row->nama}}
                  @endforeach
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
  </body>
</html>

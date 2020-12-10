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
              <h3>Step 3: Verifikasi Identitas</h3>
            </div>
            <div class="content"><br>
              @if(isset($target) && $target =='proses')
                <h5 class="text-danger">Admin sedang meninjau verifikasi anda maksimal 1x24 jam, silahkan kembali lagi nanti</h5>
              @else
                @if(isset($target) && $target == 'tolak')
                <h5 class="text-danger">Permintaan upload KTP ditolak</h5>
                @endif
                <form class="" action="{{route('storeKTP')}}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="">Foto KTP</label>
                  <input type="file" name="foto1" accept="image/*" />
                </div>
                <div class="form-group">
                  <label for="">Foto anda sedang memegang KTP</label>
                  <input type="file" name="foto2" accept="image/*" />

                </div>
                <br>
                <div class=" text-right">
                  <input type="submit" name="submit" value="simpan" class="btn e-btn">
                </div>
                @csrf

              </form>
              @endif
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
                <form class="" action="{{route('logout')}}" method="post">
                  <div class="text-right">
                    @csrf
                    <input type="submit" class="btn e-btn" name="submit" value="Logout">
                  </div>

                </form>
            </div>

          </div>

        </div>

      </div>

    </div>
    <script type="text/javascript" src=" {{asset('plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  </body>
</html>

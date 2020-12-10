@extends('layouts/userApp')
@section('heads')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<main class="ps-main" style="background-color:#f1f1f1">
  <div class="ps-section--features-product ps-section masonry-root pt-20 pb-20">
    <div class="ps-container">
      <div class="row checkout-box" style="padding:10px;">
        @if(Session::has('message'))
              <p class="text-danger">{!! Session::get('message') !!}</p>
        @endif
        <div class=""></div>
          <div class="col-md-6 col-xs-12" style="text-align:center;">
          <div class="container-fluid">
            <div class="row">
              <div class="col-xs-12">
                <img src="{{asset('images/profile/'.auth::User()->profile)}}" alt="" width="300px"><br><br>
              </div>
              <div class="col-xs-12">
                <h1 style="margin-top:-18px;" class="">Rifaldy Elninoru</h1><br>
                <a href="#" class="btn e-btn">Ganti Foto Profile</a>

              </div>

            </div>
          </div>

        </div>.
          <div class="col-md-6 col-xs-12">
            <div class="row">
          <div class="col-md-12 col-xs-12 user-info" >
            <h3 style="margin-top:-50px;" class="ps-section__title">Data Diri</h3>

            <form action="{{route('updateProfile')}}" method="post">
              <div class="form-row" style="margin-left:-10px;">
                <div class="col col-xs-6">
                  <label for="">Nama depan</label>
                  <input type="text" name="first_name" value="{{auth::User()->fname}}" class="form-control">
                </div>
                <div class="col col-xs-6">
                  <label for="">Nama Belakang</label>
                  <input type="text" name="last_name" value="{{auth::User()->lname}}" class="form-control">
                </div>

              </div>
              <div class="form-group">
                <label for="">Username</label>
                <input type="text" name="username" class="form-control" value="{{auth::User()->username}}">

              </div>
              <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" value="{{auth::User()->email}}">

              </div>
              <div class="form-group">
                <label for="">Tanggal lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" value="{{auth::User()->tanggal_lahir}}">
              </div>
              <div class="form-group">
                <label for="">Nomer telp</label>
                <input type="number" name="telp" class="form-control" value="{{auth::User()->telp}}">
              </div>
              @csrf
              <input type="submit" name="submit" value="ubah Profile" class="btn e-btn">

            </form>
          </div>
          <div class="col-xs-12 user-info">
            <h3 class="ps-section__title">Alamat</h3>
            <form class="" action="{{route('updateAlamat')}}" method="post">
              <div class="form-group">
                <label for="">Provinsi atau Kabupaten</label>
                <select class="form-control" id="provinsi" name="provinsi" onchange="pilihKota()">
                  @if(isset(auth::User()->alamat))
                  @foreach($provinsi as $row)
                  @if($row->id == auth::User()->alamat->provinsi_id)
                  <option value="{{$row->id}}" selected>{{$row->nama}}</option>
                  @else
                  <option value="{{$row->id}}">{{$row->nama}}</option>

                  @endif
                  @endforeach
                  @else
                  <option value="">Provinsi..</option>
                  @foreach($provinsi as $row)
                  <option value="{{$row->id}}">{{$row->nama}}</option>
                  @endforeach
                  @endif
                </select>
              </div>
              <div class="form-group">
                <label for="">Kota atau kecamatan</label>
                <select class="form-control" name="kota" id="kota" @if(!isset(auth::User()->alamat)) disabled @endif>
                  @if(isset(auth::User()->alamat))
                  @foreach($kota as $row)
                  @if($row->id == auth::User()->alamat->kota_id)
                  <option value="{{$row->id}}" selected>{{$row->nama}}</option>
                  @else
                  <option value="{{$row->id}}">{{$row->nama}}</option>
                  @endif
                  @endforeach
                  @endif
                </select>
              </div>
              <div class="form-group">
                <label for="">alamat lengkap</label>
                <textarea name="alamat_lengkap"class="form-control" rows="8" cols="80">@if(isset(auth::User()->alamat)){{auth::User()->alamat->alamat_lengkap}}@endif</textarea>
              </div>
              <div class="form-group">
                <label for="">kode pos</label>
                <input type="number" class="form-control" name="kode_pos" value="@if(isset(auth::User()->alamat)){{auth::User()->alamat->kode_pos}}@endif">
              </div>
              @csrf
              <input type="submit" name="submit" value="Ubah alamat" class="btn e-btn">

            </form>

          </div>

        </div>
          </div>
      </div>

    </div>
  </div>


  <div class="ps-footer bg--cover" data-background="">
    <div class="ps-footer__content">
      <!-- content footer disini -->
    </div>
    <div class="ps-footer__copyright">
      <div class="ps-container">
        <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                <ul class="ps-social">
                  <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                  <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                </ul>
              </div>
        </div>
      </div>
    </div>
  </div>
</main>
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
@endsection

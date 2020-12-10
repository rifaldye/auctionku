@extends('layouts/sellerApp')

@section('content')
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
      </div>
      <!-- Card stats -->
    </div>
  </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header border-0">
            <div class="row align-items-center">
            </div>
          </div>
          <div class="row"style="padding-left:10px;">
            <div class="col-xl-12">
              <h2>Profile toko</h2>
            </div>
            <div class="col-xl-12">
              <div class="row">
                <div class="col-md-6">
                  <div class="row"  style="text-align:center;">
                    <div class="col-xl-12">
                      <img src="{{asset('images/profile/'.auth::User()->profile)}}" alt="" width="300px"><br><br>
                    </div>
                    <div class="col-xl-12">
                      <h1 style="margin-top:-18px;" class="">{{auth::User()->toko->nama_toko}}</h1><br>
                      <a href="#" class="btn e-btn">Ganti Profile toko</a>

                    </div>

                  </div>
                  <div class="row">
                    <div class="col-xl-12">
                      <form class="" action="{{route('updateToko')}}" method="post">
                        @csrf
                        <div class="form-group">
                          <label for="">Nama Toko</label>
                          <input type="text" name="nama_toko" class="form-control" value="{{Auth::User()->toko->nama_toko}}">

                        </div>
                        <div class="form-group">
                          <label for="">Deskripsi Toko</label>
                          <textarea name="deskripsi_toko"class="form-control" rows="8" cols="80">{{Auth::User()->toko->deskripsi_toko}}</textarea>
                        </div>
                        <div class="form-group" style="border:1px solid #f1f1f1; border-radius:5px; padding:10px;">
                          <label for="">Kurir</label><br>
                          @foreach($kurir as $row)
                          <div class="form-check form-check-inline">
                            @if(auth::User()->toko[$row->nama] == 1)
                            <input class="form-check-input" name="{{$row->nama}}" type="checkbox" id="{{$row->nama}}" value="1" checked>
                            @else
                            <input class="form-check-input" name="{{$row->nama}}" type="checkbox" id="{{$row->nama}}" value="1">
                            @endif
                            <label class="form-check-label" for="{{$row->nama}}">{{$row->nama}}</label>
                          </div>
                          @endforeach

                        </div>
                        <input type="submit" name="submit" value="Simpan" class="btn e-btn">

                      </form>
                      <br>

                      <form class="" action="{{route('penjualBan')}}" method="post">
                        @csrf
                        <input type="submit"  class="btn btn-danger" name="submit" value="Hapus akun">
                      </form>

                    </div>

                  </div>

                </div>
                <div class="col-md-6">
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
                  <small>Alamat ini akan digunakan untuk alamat toko</small>

                </div>

              </div>


                </div>

              </div>

            </div>


          </div>
        </div>
      </div>
    </div>
  <!-- Footer -->
  <footer class="footer pt-0">
    <div class="row align-items-center justify-content-lg-between">
      <div class="col-lg-6">
        <div class="copyright text-center  text-lg-left  text-muted">
          &copy; 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
        </div>
      </div>
      <div class="col-lg-6">
        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
          <li class="nav-item">
            <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
          </li>
          <li class="nav-item">
            <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
          </li>
          <li class="nav-item">
            <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
          </li>
          <li class="nav-item">
            <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
          </li>
        </ul>
      </div>
    </div>
  </footer>
</div>
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

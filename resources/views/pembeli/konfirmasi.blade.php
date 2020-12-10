@extends('layouts/userApp')
@section('heads')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<main class="ps-main" style="background-color:#f5f5f5;">
  <div class="ps-section--features-product ps-section masonry-root pt-100 pb-100">
    <div class="ps-container">
      <div class="row">
        <div class="col-md-7 col-xs-12">
          <div class="row">
            <div class="col-xs-12 checkout-box">
              <h4 style="margin-top:0px;">Alamat Pengirim</h4>
              <div class="row">
                <div class="col-xs-4">
                  <h5>{{auth::user()->fname}} {{auth::user()->lname}}</h5>
                  <p>{{auth::user()->telp}}</p>

                </div>
                <div class="col-xs-5" style="padding-top:10px;">
                  <p>{{auth::user()->alamat->alamat_lengkap}}</p>

                </div>
                <div class="col-xs-3">

                </div>

              </div>

            </div>
            <div class="col-xs-12 checkout-box">
              <div class="row">
                <div class="col-xs-3" style="padding-top:10px;">
                   kurir
                </div>
                <div class="col-xs-6" style="padding-top:5px;">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td style="border-top:0px;"> <p id="kurir" style="color:black">{{$invoice->kurir}}</p> </td>
                        <td  style="border-top:0px;"> <p class="hargaKurir" style="color:black">Rp {{$invoice->hargakurir}}</p></td>
                      </tr>

                    </tbody>
                  </table>

                </div>
                <div class="col-xs-1" style="padding-top:10px;">

                </div>

              </div>

            </div>
            <div class="col-xs-12 checkout-box">
              <h4>{{$invoice->produk->toko->nama_toko}}</h4>
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Pesanan</th>
                    <th scope="col">Harga</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row"><img src="{{asset('images/gambarproduk/'.$invoice->produk->gambar->first()->gambar)}}" width="40px" height="40px" alt=""></th>
                    <td>{{$invoice->produk->judul}}</td>
                    <td>Rp {{number_format($invoice->produk->bid->where('user_id',auth::user()->id)->where('nominal','=',$invoice->produk->bid->where('tolak','0')->max('nominal'))->first()->nominal)}}</td>
                  </tr>

                </tbody>
              </table>

            </div>
            <div class="col-xs-12 checkout-box">
              <h3>Metode Pembayaran</h3>
                <div class="form-group">
                    <select name="bank" class="form-control" id="exampleFormControlSelect1" disabled>
                      <option>{{$invoice->bank}}</option>
                    </select>
                  </div>

              <div id="checkbox-BCA">
                <h4>Tata Cara Membayar Menggunakan BCA</h4>
                <p>1.Pilih dan checkout</p>
                <p>2.Setelah itu Lakukan transfer bank ke rekening auctionku 01723521 An Auctionku</p>
                <p>3.Foto Struk Pembayaran</p>
                <p>4.Klik Konfirmasi pembayaran pada halaman ... dan upload bukti pembayaran</p>
                <p>5. Pembayaran anda akan dikonfirmasi paling lambat 1x24 jam</p>


              </div>
            </div>

          </div>

        </div>
        <div class="col-md-1 col-xs-0"></div>
        <div class="col-md-4 col-xs-12 checkout-box ">
          <div class="row">
            <div class="col-xs-12">
              <h3>Ringkasan Belanja</h3>
              <table class="table">
                <tbody>
                  <tr>
                    <td style="border-top:0px;">Harga barang</td>
                    <td  style="border-top:0px;">Rp Rp {{number_format($invoice->produk->bid->where('user_id',auth::user()->id)->where('nominal','=',$invoice->produk->bid->where('tolak','0')->max('nominal'))->first()->nominal)}}</td>
                  </tr>
                  <tr>
                    <td style="border-top:0px;">Ongkos Kirim</td>
                    <td  style="border-top:0px;"><p style="color:black">Rp <span class="hargaKurir">{{number_format($invoice->hargakurir)}}</span> </p> </td>
                  </tr>
                  <tr>
                    <td style="border-top:0px;">Total</td>
                    <td  style="border-top:0px;"><p style="color:black">Rp <span id="total">{{number_format($invoice->harga)}}</span> </p> </td>
                  </tr>

                </tbody>
              </table>
              <h5>Upload bukti pembayaran</h5>
              <form class="" action="{{route('konfirmasi')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="invoice" value="{{$invoice->id}}">
                <label for="">Bukti pembayaran</label><br>
                <input type="file" accept="image/*" name="buktipembayaran" value=""><br>
                <label for="">Catatan</label><br>
                <textarea name="detail" rows="4" cols="50"></textarea>
                <input type="submit" name="submit" class="btn e-btn" style="width:100%" id="bayarSekarang" value="Upload">
              </form>

            </div>

          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="ps-section--sale-off ps-section pt-80 pb-40">
    <div class="ps-container">
      <div class="ps-section__header mb-50">
        <h3 class="ps-section__title" data-mask="Sale off">- Hot Deal Today</h3>
      </div>
      <div class="ps-section__content">
        <div class="row">
              <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 ">
                <div class="ps-hot-deal">
                  <h3>Nike DUNK Max 95 OG</h3>
                  <p class="ps-hot-deal__price">Only:  <span>£155</span></p>
                  <ul class="ps-countdown" data-time="December 13, 2017 15:37:25">
                    <li><span class="hours"></span><p>Hours</p></li>
                    <li class="divider">:</li>
                    <li><span class="minutes"></span><p>minutes</p></li>
                    <li class="divider">:</li>
                    <li><span class="seconds"></span><p>Seconds</p></li>
                  </ul><a class="ps-btn" href="#">Order Today<i class="ps-icon-next"></i></a>
                </div>
              </div>
              <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 ">
                <div class="ps-hotspot"><a class="point first active" href="javascript:;"><i class="fa fa-plus"></i>
                    <div class="ps-hotspot__content">
                      <p class="heading">JUMP TO HEADER</p>
                      <p>Dynamic Fit Collar en la zona del tobillo que une la parte inferior de la pierna y el pie sin reducir la libertad de movimiento.</p>
                    </div></a><a class="point second" href="javascript:;"><i class="fa fa-plus"></i>
                    <div class="ps-hotspot__content">
                      <p class="heading">JUMP TO HEADER</p>
                      <p>Dynamic Fit Collar en la zona del tobillo que une la parte inferior de la pierna y el pie sin reducir la libertad de movimiento.</p>
                    </div></a><a class="point third" href="javascript:;"><i class="fa fa-plus"></i>
                    <div class="ps-hotspot__content">
                      <p class="heading">JUMP TO HEADER</p>
                      <p>Dynamic Fit Collar en la zona del tobillo que une la parte inferior de la pierna y el pie sin reducir la libertad de movimiento.</p>
                    </div></a><img src="images/hot-deal.png" alt=""></div>
              </div>
        </div>
      </div>
    </div>
  </div>
  <!--modalbox start-->
  <!-- Modalbox kurir -->

  <!--modalbox end-->

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
<a href="#" onclick="ongkir()">test</a>
@endsection

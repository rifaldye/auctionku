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
                  <a href="{{route('profile')}}" class="btn e-btn">Ubah</a>

                </div>

              </div>

            </div>
            <div class="col-xs-12 checkout-box">
              <div class="row">
                <div class="col-xs-3" style="padding-top:10px;">
                  Pilih kurir
                </div>
                <div class="col-xs-6" style="padding-top:5px;">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td style="border-top:0px;"> <p id="kurir"></p> </td>
                        <td  style="border-top:0px;">Rp <p class="hargaKurir"></p></td>
                      </tr>

                    </tbody>
                  </table>

                </div>
                <div class="col-xs-1" style="padding-top:10px;">
                  <a href="#" class="btn e-btn " data-toggle="modal" data-target="#modal-kurir">Polih</a>

                </div>

              </div>

            </div>
            <div class="col-xs-12 checkout-box">
              <h4>{{$produk->toko->nama_toko}}</h4>
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
                    <th scope="row"><img src="{{asset('images/gambarproduk/'.$produk->gambar->first()->gambar)}}" width="40px" height="40px" alt=""></th>
                    <td>{{$produk->judul}}</td>
                    <td>Rp {{number_format($produk->bid->where('user_id',auth::user()->id)->where('nominal','=',$produk->bid->where('tolak','0')->max('nominal'))->first()->nominal)}}</td>
                  </tr>

                </tbody>
              </table>

            </div>
            <div class="col-xs-12 checkout-box">
              <h3>Pilih Metode Pembayaran</h3>
              <form class="" action="{{route('createInvoice')}}" method="post">
                @csrf
                <div class="form-group">
                    <select name="bank" class="form-control" id="exampleFormControlSelect1">
                      <option value="BCA">BCA</option>
                      <option value="Mandiri">Mandiri</option>
                      <option value="BNI">BNI</option>
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
                    <td  style="border-top:0px;">Rp Rp {{number_format($produk->bid->where('user_id',auth::user()->id)->where('nominal','=',$produk->bid->where('tolak','0')->max('nominal'))->first()->nominal)}}</td>
                  </tr>
                  <tr>
                    <td style="border-top:0px;">Ongkos Kirim</td>
                    <td  style="border-top:0px;"><p style="color:black">Rp <span class="hargaKurir"></span> </p> </td>
                  </tr>
                  <tr>
                    <td style="border-top:0px;">Total</td>
                    <td  style="border-top:0px;"><p style="color:black">Rp <span id="total"></span> </p> </td>
                  </tr>

                </tbody>
              </table>
                <input type="hidden" name="harga" id="inputHarga" value="">
                <input type="hidden" name="produk" id="inputProduk" value="{{$produk->id}}">
                <input type="hidden" name="kurir" id="inputKurir" value="">
                <input type="hidden" name="hargakurir" id="inputHargaKurir" value="">
                <input type="submit" name="submit" class="btn e-btn" id="bayarSekarang" value="bayar sekarang" disabled>
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
  <div class="modal fade" id="modal-kurir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <table style="width:100%">
            @foreach($ongkir as $row)
              @foreach($row['costs'] as $rows)
              <?php $nama = $row['code'].' '.$rows['service']; $harga =  $rows['cost'][0]['value'];?>
              <tr style="border: 1px solid grey">
                <td>{{$row['code'].' '.$rows['service']}}</td>
                <td>{{$rows['cost'][0]['etd']}}</td>
                <td> Rp {{number_format($rows['cost'][0]['value'])}}</td>
                <td> <a href="#" class="btn e-btn" onclick="ongkir({!!"'".$nama."'"!!},{!!"'".$harga."'"!!})" data-dismiss="modal">Pilih</a> </td>
              </tr>
              @endforeach
            @endforeach
          </table>
        </div><br><br><br><br>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
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

<script type="text/javascript">
function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}
 function ongkir(nama,harga){
   var hargaBarang ={{$produk->bid->where('user_id',auth::user()->id)->where('nominal','=',$produk->bid->where('tolak','0')->max('nominal'))->first()->nominal}};
   $('#kurir').empty().text(nama);
   $('.hargaKurir').empty().text(formatNumber(harga));
   $('#total').empty().text(formatNumber(parseInt(harga)+parseInt(hargaBarang)));
   $('#inputHarga').val(parseInt(harga)+parseInt(hargaBarang));
   $('#inputKurir').val(nama);
   $('#inputHargaKurir').val(harga);
   document.getElementById('bayarSekarang').disabled = false;

 }

</script>
@endsection

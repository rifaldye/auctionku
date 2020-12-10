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
              <h2>Pesanan baru</h2>
            </div>
            <!--@foreach($produk as $row)
            @if($row->end_at < $now)
            <div class="col-xl-12 admin-list">
                <div class="row">
                  <div class="col-xl-2">
                    <img src="../images/user/1.jpg" width="100px" alt="">
                  </div>
                  <div class="col-xl-3">
                    <h4>Kulkas Seri x</h4>
                    <p>Terjual : Rp.200.000</p>
                    <p>Berat :15Kg</p>
                  </div>
                  <div class="col-xl-3">
                    <h5>Pemenang</h5>
                    <p class="penjualan-nama">Rifaldy Elninoru</p>

                    </p>

                  </div>
                  <div class="col-xl-2">
                    <h5>Hasil bid</h5>
                    <p class="total-harga-penjual">Rp.500.000</p>

                  </div>
                  <div class="col-xl-2">
                    <h5>Status</h5>
                    <p>menunggu konfirmasi</p>

                  </div>


                  </div>
                  <div class="row">
                    <div class="col-xl-9">
                      <a href="#" class="tanya-Pembeli"><i class="ni ni-chat-round text-primary"></i> Tanya Pembeli</a>
                    </div>
                    <div class="col-xl-3">

                      <a href="#" class="btn e-btn">Terima Pesanan</a>

                    </div>

                  </div>

            </div>
          @endif
          @endforeach
        -->
            <div class="col-xl-12">
              <h2>Update resi</h2>
            </div>
            @foreach($invoice as $row)
            @if($row->produk->toko->id == auth::User()->toko->id)
            <div class="col-xl-12 admin-list">
                <div class="row">
                  <div class="col-xl-2">
                    <img src="{{asset('images/gambarproduk/'.$row->produk->gambar->first()->gambar)}}" width="100px" alt="">
                  </div>
                  <div class="col-xl-3">
                    <h4>{{$row->produk->judul}}</h4>
                    <p>Terjual : Rp {{number_format($row->harga)}}</p>
                    <p>Berat : {{$row->produk->berat}}G</p>
                  </div>
                  <div class="col-xl-3">
                    <h5>Alamat</h5>
                    <p class="penjualan-nama">{{$row->user->fname.' '.$row->user->lname}}</p>
                    <p class="penjualan-desc">
                        {{$row->user->alamat->alamat_lengkap}}
                    </p>

                  </div>
                  <div class="col-xl-2">
                    <h5>Kurir</h5>
                    <p class="penjualan-nama-kurir">{{$row->kurir}}</p>
                    <p class="penjualan-harga">Rp {{number_format($row->hargakurir)}}</p>

                  </div>
                  <div class="col-xl-2">
                    <h5>Total Harga</h5>
                    <p class="total-harga-penjual">Rp {{number_format($row->hargakurir + $row->harga)}}</p>

                  </div>


                  </div>
                  <div class="row">
                    <div class="col-xl-7">
                      <a href="#" class="tanya-Pembeli"><i class="ni ni-chat-round text-primary"></i> Tanya Pembeli</a>
                    </div>
                    <div class="col-xl-5">
                      <form class="" action="{{route('verifResi')}}" method="post">
                        @csrf
                        <div class="form-row">
                          <input type="hidden" name="kurir" value="{{$row->kurir}}">
                          <input type="hidden" name="id" value="{{$row->id}}">
                          <input type="text" name="resi" class="form-control resi-form"placeholder="Masukan resi">
                          <input type="submit" name="" class="btn btn-sm btn-warning btn-resi" value="Verifikasi Resi">
                        </div>
                      </form>

                    </div>

                  </div>

            </div>
            @endif
            @endforeach
            </div>


          </div>
        </div>
      </div>
    </div>
@endsection

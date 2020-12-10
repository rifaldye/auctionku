@extends('layouts/adminApp')

@section('content')
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
      </div>
      <!-- Card stats -->
      <div class="row">


      </div>
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
          <h2>Verifikasi Pembayaran</h2>
        </div>
        @foreach($invoice as $row)
        <div class="col-xl-12 admin-list">
            <div class="row">
              <div class="col-xl-2">
                <img src="{{asset('images/gambarProduk/'.$row->produk->gambar->sortByDesc('id')->first()->gambar)}}" width="100px" alt="">
              </div>
              <div class="col-xl-3">
                <h4>{{$row->produk->judul}}</h4>
                <h5>Pembeli</h5>
                <p>{{$row->user->fname.' '.$row->user->lname}}</p>
                <h5>Penjual</h5>
                <p>{{$row->produk->toko->nama_toko}}</p>

              </div>
              <div class="col-xl-4">
                <h4>Bukti Transfer</h4>
                <img src="{{asset('images/buktipembayaran/'.$row->pembayaran->sortByDesc('id')->first()->gambar)}}" width="200px">

              </div>
              <div class="col-xl-3">
                <h5>Total Transfer</h5>
                <p class="total-harga-penjual">Rp {{number_format($row->harga+$row->hargakurir)}}</p>
                <h5>Invoice</h5>
                <p>{{$row->id}}</p>

              </div>


            </div>
            <br>
            <div class="row">
              <div class="col-xl-9"><small>*Harap perhatikan Bukti transfer secara seksama sebelum Menekan tombol</small></div>
              <div class="col-xl-3">
                <a href="{{route('terimaPembayaran',['id'=>$row->id])}}" class="btn btn-danger">Tolak</a>
                <a href="{{route('terimaPembayaran',['id'=>$row->id])}}" class="btn e-btn">Terima</a>


              </div>

            </div>
        </div>
        @endforeach

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
@endsection

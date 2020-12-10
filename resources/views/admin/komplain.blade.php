@extends('layouts/adminApp')

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
              <h2>Komplain</h2><br><br>
            </div>
            @foreach($komplain as $row)
              <div class="col-xl-12 admin-list">
                <div class="row">
                  <div class="col-xl-2">
                    <img src="{{asset('images/gambarProduk/'.$row->invoice->produk->gambar->sortByDesc('id')->first()->gambar)}}" width="100px" alt="">
                  </div>
                  <div class="col-xl-3">
                    <h4>{{$row->invoice->produk->judul}}</h4>
                    <h5>{{$row->invoice->user->fname." ".$row->invoice->user->lname}}</h5>
                    <p class="total-harga-penjual">Rp.{{number_format($row->invoice->harga)}}</p>

                  </div>
                  <div class="col-xl-7">
                    <h4>Deskripsi</h4>
                    <p class="text-black">{{$row->deskripsi}} </p>

                  </div>
                  <div class="col-xl-9">
                    <a href="{{asset('images/komplain/'.$row->bukti)}}">Bukti Video</a>
                  </div>
                  <div class="col-xl-3">
                    <a href="{{route('accKomplain',['id'=>$row->id])}}" class="btn e-btn">Setujui</a>
                    <a href="#"class="btn btn-danger">Batalkan</a>
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

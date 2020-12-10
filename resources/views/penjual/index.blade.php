@extends('layouts/sellerApp')

@section('content')
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
      </div>
      <!-- Card stats -->
      <div class="row">
        <div class="col-xl-2 col-md-6 ">
          <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Lelang</h5>
                  <span class="h2 font-weight-bold mb-0">{{auth::User()->toko->produk->where('end_at','>',$nows)->count()}}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-md-6 ">
          <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Siap dikirim</h5>
                  <span class="h2 font-weight-bold mb-0">{{$kirim}}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-md-6 ">
          <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Komplain</h5>
                  <span class="h2 font-weight-bold mb-0">{{$komplain}}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-md-6 ">
          <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Chat baru</h5>
                  <span class="h2 font-weight-bold mb-0">{{auth::User()->toko->chat->count()}}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-md-6 ">
          <div class="card card-stats">
            <!-- Card body -->

          </div>
        </div>
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
            <div class="row">
              <div class="col-xl-1"></div>
              <div class="col-xl-4">
                <img src="{{asset('images/profile/'.auth::User()->profile)}}" style="margin-right:10px;" class="seller-img" width="100px" alt="">
                <br>
                <h3>{{auth::User()->toko->nama_toko}}</h3>
                <p style="margin-top:-10px;"> Bandung</p>
              </div>
              <div class="col-xl-4" style="text-align:center;" >
                <p>Produk terjual</p>
                <h1 style="margin-top:-20px;">{{$terjual}}</h1>

              </div>
              <!--
              <div class="col-xl-3" style="text-align:center;" >
                <p>Rating toko</p>
                <span class="fa fa-star profile-star star-checked"></span>
                <span class="fa fa-star profile-star star-checked"></span>
                <span class="fa fa-star profile-star star-checked"></span>
                <span class="fa fa-star profile-star "></span>
                <span class="fa fa-star profile-star "></span>

              </div>
            -->
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header border-0">
            <div class="row">
              <div class="col-xl-8">
                <h2>Ulasan terbaru</h2>

              </div>


            </div>
          </div>
          <div class="table-responsive">
            <div class="col-xl-12 admin-list">
                <div class="row">
                  <div class="col-xl-2">
                    <img src="../images/user/1.jpg" width="100px" alt="">
                  </div>
                  <div class="col-xl-6">
                    <h4>Kulkas Seri x</h4>
                    <h5>Rifaldy Elninoru</h5>
                    <p class="total-harga-penjual">Rp.500.000</p>
                  </div>

                  <div class="col-xl-3">
                    <h4>Rating</h4>
                    <span class="fa fa-star profile-star star-checked"></span>
                    <span class="fa fa-star profile-star star-checked"></span>
                    <span class="fa fa-star profile-star star-checked"></span>
                    <span class="fa fa-star profile-star "></span>
                    <span class="fa fa-star profile-star "></span>

                  </div>

                </div>
            </div>
            <div class="col-xl-12 admin-list">
                <div class="row">
                  <div class="col-xl-2">
                    <img src="../images/user/1.jpg" width="100px" alt="">
                  </div>
                  <div class="col-xl-6">
                    <h4>Kulkas Seri x</h4>
                    <h5>Rifaldy Elninoru</h5>
                    <p class="total-harga-penjual">Rp.500.000</p>
                  </div>

                  <div class="col-xl-3">
                    <h4>Rating</h4>
                    <span class="fa fa-star profile-star star-checked"></span>
                    <span class="fa fa-star profile-star star-checked"></span>
                    <span class="fa fa-star profile-star star-checked"></span>
                    <span class="fa fa-star profile-star "></span>
                    <span class="fa fa-star profile-star "></span>

                  </div>

                </div>
            </div>
            <div class="col-xl-12 admin-list">
                <div class="row">
                  <div class="col-xl-2">
                    <img src="../images/user/1.jpg" width="100px" alt="">
                  </div>
                  <div class="col-xl-6">
                    <h4>Kulkas Seri x</h4>
                    <h5>Rifaldy Elninoru</h5>
                    <p class="total-harga-penjual">Rp.500.000</p>
                  </div>

                  <div class="col-xl-3">
                    <h4>Rating</h4>
                    <span class="fa fa-star profile-star star-checked"></span>
                    <span class="fa fa-star profile-star star-checked"></span>
                    <span class="fa fa-star profile-star star-checked"></span>
                    <span class="fa fa-star profile-star "></span>
                    <span class="fa fa-star profile-star "></span>

                  </div>

                </div>
            </div>
            <div class="col-xl-12 admin-list">
                <div class="row">
                  <div class="col-xl-2">
                    <img src="../images/user/1.jpg" width="100px" alt="">
                  </div>
                  <div class="col-xl-6">
                    <h4>Kulkas Seri x</h4>
                    <h5>Rifaldy Elninoru</h5>
                    <p class="total-harga-penjual">Rp.500.000</p>
                  </div>

                  <div class="col-xl-3">
                    <h4>Rating</h4>
                    <span class="fa fa-star profile-star star-checked"></span>
                    <span class="fa fa-star profile-star star-checked"></span>
                    <span class="fa fa-star profile-star star-checked"></span>
                    <span class="fa fa-star profile-star "></span>
                    <span class="fa fa-star profile-star "></span>

                  </div>

                </div>
            </div>
            <div class="col-xl-12 admin-list">
                <div class="row">
                  <div class="col-xl-2">
                    <img src="../images/user/1.jpg" width="100px" alt="">
                  </div>
                  <div class="col-xl-6">
                    <h4>Kulkas Seri x</h4>
                    <h5>Rifaldy Elninoru</h5>
                    <p class="total-harga-penjual">Rp.500.000</p>
                  </div>

                  <div class="col-xl-3">
                    <h4>Rating</h4>
                    <span class="fa fa-star profile-star star-checked"></span>
                    <span class="fa fa-star profile-star star-checked"></span>
                    <span class="fa fa-star profile-star star-checked"></span>
                    <span class="fa fa-star profile-star "></span>
                    <span class="fa fa-star profile-star "></span>

                  </div>

                </div>
            </div>
            <div class="col-xl-3">
              <a href="ulasan.html" class="btn e-btn">Selengkapnya</a>

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
@endsection

<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com
=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  @yield('heads')
  <title>Argon Dashboard - Free Dashboard for Bootstrap 4</title>
  <!-- Favicon -->
  <link rel="icon" href=" {{asset('assets/img/brand/favicon.png')}}" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href=" {{asset('assets/vendor/nucleo/css/nucleo.css')}} " type="text/css">
  <link rel="stylesheet" href=" {{asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}} " type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href=" {{asset('assets/css/argon.css?v=1.2.0')}} " type="text/css">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">


</head>

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">

      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <br><br>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="{{route('penjualSaldo')}}">
                <span class="nav-link-text">Saldo <span class="total-harga-penjual">Rp {{number_format(auth::User()->saldo)}}</span></span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{route('penjualHome')}}">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{route('penjualChat')}}">
                <i class="ni ni-chat-round text-primary"></i>
                <span class="nav-link-text">Chat</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{route('penjualProduk')}}">
                <i class="ni ni-bag-17 text-primary"></i>
                <span class="nav-link-text">Produk</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{route('penjualPenjualan')}}">
                <i class="ni ni-shop text-primary"></i>
                <span class="nav-link-text">Penjualan</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{route('penjualUlasan')}}">
                <i class="ni ni-like-2 text-primary"></i>
                <span class="nav-link-text">Ulasan</span>
              </a>
            </li>


          </ul>
          <!-- Divider -->
          <hr class="my-3">

        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-e border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            <li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="{{asset('images/profile/'.auth::User()->profile)}}">
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold">{{Auth::User()->name}}</span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                <a href="{{route('penjualProfile')}}" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>My profile</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-support-16"></i>
                  <span>Support</span>
                </a>
                <div class="dropdown-divider"></div>
                <form class="" action="{{route('logout')}}" method="post">
                  <a href="#" onclick="this.closest('form').submit();return false;" class="dropdown-item">
                    <i class="ni ni-user-run"></i>
                    <span>Logout</span>
                  </a>
                  @csrf
                </form>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    @yield('content')

  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src=" {{asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src=" {{asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}} "></script>
  <script src=" {{asset('assets/vendor/js-cookie/js.cookie.js')}}"></script>
  <script src=" {{asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}} "></script>
  <script src=" {{asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
  <!-- Optional JS -->
  <script src=" {{asset('assets/vendor/chart.js/dist/Chart.min.js')}} "></script>
  <script src=" {{asset('assets/vendor/chart.js/dist/Chart.extension.js')}} "></script>
  <!-- Argon JS -->
  <script src=" {{asset('assets/js/argon.js?v=1.2.0')}}"></script>
</body>

</html>

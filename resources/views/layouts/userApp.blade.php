<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7"><![endif]-->
<!--[if IE 8]><html class="ie ie8"><![endif]-->
<!--[if IE 9]><html class="ie ie9"><![endif]-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="apple-touch-icon.png" rel="apple-touch-icon">
    <link href="favicon.png" rel="icon">
    <meta name="author" content="Nghia Minh Luong">
    <meta name="keywords" content="Default Description">
    <meta name="description" content="Default keyword">
    <title>Sky - Homepage</title>
    <!-- Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Archivo+Narrow:300,400,700%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}} ">
    <link rel="stylesheet" href="{{asset('plugins/ps-icon/style.css')}}">
    <!-- CSS Library-->
    <link rel="stylesheet" href="{{asset('plugins/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/owl-carousel/assets/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/slick/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap-select/dist/css/bootstrap-select.min.css')}}plugins/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{asset('plugins/Magnific-Popup/dist/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/jquery-ui/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/revolution/css/settings.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/revolution/css/layers.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/revolution/css/navigation.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @yield('heads')
    <!-- Custom-->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!--HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--WARNING: Respond.js doesn't work if you view the page via file://-->
    <!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <!--[if IE 7]><body class="ie7 lt-ie8 lt-ie9 lt-ie10"><![endif]-->
  <!--[if IE 8]><body class="ie8 lt-ie9 lt-ie10"><![endif]-->
  <!--[if IE 9]><body class="ie9 lt-ie10"><![endif]-->
  <body class="ps-loading">
    <div class="header--sidebar"></div>
    <header class="header">
      <div class="header__top">
        <div class="container-fluid">
          <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-6 col-xs-12 ">

                </div>

          </div>
        </div>
      </div>
      <nav class="navigation">
        <div class="container-fluid">
          <div class="navigation__column left">
            <div class="header__logo"><a class="ps-logo" href="{{route('pembeliHome')}}"><img src="{{asset('images/logo.png')}}" alt=""></a></div>
          </div>
          <div class="navigation__column center">
                <ul class="main-menu menu">
                  <li class="menu-item menu-item-has-children dropdown"><a href="\">Elektronik</a></li>
                  <li class="menu-item menu-item-has-children dropdown"><a href="\">Pakaian</a></li>
                  <li class="menu-item menu-item-has-children dropdown"><a href="\">Otomotif</a></li>
                </ul>
          </div>
          <div class="navigation__column right">
            <form class="ps-search--header" action="do_action" method="post">
              <input class="form-control" type="text" placeholder="Search Product…">
              <button><i class="ps-icon-search"></i></button>
            </form>
            @if(Auth::User())
            <div class="ps-cart"><a class="ps-cart__toggle" href="#"><span><i>0</i></span><img src="{{asset('images/profile/'.auth::User()->profile)}}" alt="" class="seller-img img-small"></a>
              <div class="ps-cart__listing">
                <div class="ps-cart__content">
                    <div class="ps-cart-item__content"><a class="ps-cart-item__title" href=""><i class="fa fa-user profile-icon"></i>Profile</a>
                    </div>
                    <div class="ps-cart-item__content"><a class="ps-cart-item__title" href="{{route('bayar')}}"><i class="fa fa-shopping-cart profile-icon"></i>Pesanan</a>
                    </div>
                    <div class="ps-cart-item__content"><a class="ps-cart-item__title" href="{{route('chart')}}"><i class="fa fa-money profile-icon"></i>Daftar Bid</a>
                    </div>
                    <div class="ps-cart-item__content"><a class="ps-cart-item__title" href="{{route('chat')}}"><i class="fa fa-comment profile-icon"></i>Chat</a>
                    </div>
                    <div class="ps-cart-item__content"> <form class="" action="{{ route('logout') }}" method="post">
                      <input type="submit" class="btn btn-danger" name="submit" value="logout">
                      @csrf
                    </form>
                    </div>
                </div>
                </div>

              </div>
              <div class="menu-toggle"><span></span></div>
            </div>
            @elseif(Auth::User() == False)
            <a href="/login" class="btn e-btn" style="margin-top:25px;">Login</a>

            @endif
          </div>
        </div>
      </nav>
    </header>
    @yield('content')

    <!-- JS Library-->
    <script type="text/javascript" src="{{asset('plugins/jquery/dist/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/jquery-bar-rating/dist/jquery.barrating.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/owl-carousel/owl.carousel.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/gmap3.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/imagesloaded.pkgd.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/isotope.pkgd.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/jquery.matchHeight-min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/slick/slick/slick.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/elevatezoom/jquery.elevatezoom.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/Magnific-Popup/dist/jquery.magnific-popup.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAx39JFH5nhxze1ZydH-Kl8xXM3OK4fvcg&amp;region=GB"></script><script type="text/javascript" src="plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/extensions/revolution.extension.video.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
    <!-- Custom scripts-->
    <script type="text/javascript" src="{{asset('js/main.js')}}"></script>
  </body>
</html>

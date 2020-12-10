@extends('layouts/userApp')

@section('content')
<main class="ps-main">
  <div class="ps-section--features-product ps-section masonry-root pt-100 pb-100">
    <div class="ps-container">
      <div class="row">
        <div class="col-md-9 col-xs-12">
          <div class="row chat-box" style="padding:10px;">
            <div class="col-xs-12 chart-head">
              <h2>Highest Bid</h2>
            </div><br><br><br>
            @foreach($produk as $row)
            @if($row->bid->sortByDesc('id')->first()->user_id == Auth::User()->id)
            <div class="col-xs-12 chart-list">
                <div class="row">
                  <div class="col-xs-2">
                    <img src="{{asset('images/gambarproduk/'.$row->gambar->first()->gambar)}}" width="100px" alt="">
                  </div>
                  <div class="col-xs-5">
                    <h4>{{$row->judul}}</h4>
                    <p>Bid : Rp {{number_format($row->bid->sortByDesc('id')->first()->nominal)}} </p>
                    @if( $nows->diffInDays($row->end_at) == 0)
                    <p>Waktu Tersisa <span>{{$nows->diffInHours($row->end_at)}} Jam lagi</span> </p>
                    @else
                    <p>Waktu Tersisa <span>{{$nows->diffInDays($row->end_at)}} Hari lagi</span> </p>
                    @endif
                    <div class="progress" style="height:5px; background-color:#e0e0e0;">
                      @if( $nows->diffInDays($row->end_at) == 0)
                      <div class="progress-bar bg-danger" role="progressbar" style="width:{{100 - ($nows->diffInHours($row->end_at)/24*10)}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                      @else
                      <div class="progress-bar bg-info" role="progressbar" style="width: {{10-$nows->diffInDays($row->end_at)}}0%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                      @endif
                    </div>
                  </div>
                  <div class="col-xs-5">
                    <div class="chart-more">
                      <a href="{{route('produk',['toko'=>$row->toko->id,'slug'=>$row->slug])}}" class="btn e-btn"> Detail</a>
                    </div>

                  </div>

                </div>
            </div>
            @endif
            @endforeach
            <div class="col-xs-12 chart-head">
              <h2>Lose Bid</h2>
            </div><br><br><br>
            @foreach($lose as $row)
            @if($row->produk->end_at >= $nows && $row->produk->bid->sortByDesc('id')->first()->user_id != Auth::User()->id)
            <div class="col-xs-12 chart-list">
                <div class="row">
                  <div class="col-xs-2">
                    <img src="{{asset('images/gambarproduk/'.$row->produk->gambar->first()->gambar)}}" width="100px"alt="">
                  </div>
                  <div class="col-xs-5">
                    <h4>{{$row->produk->judul}}</h4>
                    <p>Bid Anda:Rp {{number_format($row->nominal)}}</p>
                    <p>Bid Tertinggi:Rp {{number_format($row->produk->bid->sortByDesc('id')->first()->nominal)}}</p>
                    <p>Waktu Tersisa <span>2 Hari lagi</span> </p>
                    <div class="progress" style="height:5px; background-color:#e0e0e0;">
                      <div class="progress-bar bg-info" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="col-xs-5">
                    <div class="chart-more">
                      <a href="{{route('produk',['toko'=>$row->produk->toko->id,'slug'=>$row->produk->slug])}}" class="btn e-btn"> Detail</a>
                    </div>

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
@endsection

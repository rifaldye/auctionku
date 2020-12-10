@extends('layouts/userApp')

@section('content')
<main class="ps-main">
  <div class="test">
    <div class="container">
      <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
            </div>
      </div>
    </div>
  </div>
  <div class="ps-product--detail pt-60">
    <div class="ps-container">
      <div class="row">
        <div class="col-lg-10 col-md-12 col-lg-offset-1">
          <div class="ps-product__thumbnail">
            <div class="ps-product__preview">
              <div class="ps-product__variants">
                @foreach($produk->gambar as $row)
                <div class="item"><img src="{{asset('images/gambarproduk/'.$row->gambar)}}" alt=""></div>
                @endforeach
              </div>
            </div>
            <div class="ps-product__image">
              @foreach($produk->gambar as $row)
              <div class="item"><img class="" src="{{asset('images/gambarproduk/'.$row->gambar)}}" alt="" ></div>
              @endforeach
            </div>
          </div>
          <div class="ps-product__thumbnail--mobile">
            <div class="ps-product__main-img"><img src=" {{asset('images/gambarproduk/'.$produk->gambar->first()->gambar)}} " alt=""></div>
            <div class="ps-product__preview owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="20" data-owl-nav="true" data-owl-dots="false" data-owl-item="3" data-owl-item-xs="3" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="3" data-owl-duration="1000" data-owl-mousedrag="on">
              @foreach($produk->gambar as $row)
              <img src="{{asset('images/gambarproduk/'.$row->gambar)}}" alt="">
              @endforeach
            </div>
          </div>
          <div class="ps-product__info">
            <h1>Product x</h1>
            <p class="ps-product__category"><a href="#"> Elektronik</a></p><br>
            <!-- redesign here -->
            <div class="fluid-container">
              <div class="row">
                <div class="col-xs-5">
                  <span><p>Bid awal</p> <h3 class="ps-product__price">Rp {{number_format($produk->bin)}}</h3> </span>
                </div>
                <div class="col-xs-5">
                  <span><p>Bid saat ini</p> <h3 class="ps-product__price">Rp {{number_format($produk->bid->sortByDesc('id')->first()->nominal)}}</h3> </span>
                </div>
                <div class="col-xs-12">
                  @if( $nows->diffInDays($produk->end_at) == 0)
                  <p>Waktu Tersisa <span>{{$nows->diffInHours($produk->end_at)}} Jam lagi</span> </p>
                  @else
                  <p>Waktu Tersisa <span>{{$nows->diffInDays($produk->end_at)}} Hari lagi</span> </p>
                  @endif
                  <div class="progress" style="height:5px; background-color:#e0e0e0;">
                    @if( $nows->diffInDays($produk->end_at) == 0)
                    <div class="progress-bar bg-danger" role="progressbar" style="width:{{100 - ($nows->diffInHours($produk->end_at)/24*10)}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    @else
                    <div class="progress-bar bg-info" role="progressbar" style="width: {{10-$nows->diffInDays($produk->end_at)}}0%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    @endif
                  </div>
                </div>
              </div>
              <br><br>
            </div>
            <div class="ps-product__shopping">
              @if(Auth::check())
              <a class="ps-btn mb-10" href="#"  data-toggle="modal" data-target="#bidmodal" >Offer Bid<i class="ps-icon-next"></i></a>
              @else
              <a href="{{route('login')}}" class="btn btn-lg e-btn">Login untuk mengikuti lelang</a>
              @endif
            </div>
          </div>
          @if($produk->bid->sortByDesc('nominal')->first()->nominal > 0)
          <p>Highest bid by : {{$produk->bid->sortByDesc('id')->first()->user->fname." ".$produk->bid->sortByDesc('id')->first()->user->lname}}</p>
          @endif
          <div class="clearfix"></div><br><br>
          <h3 class="ps-section__title">Product Detail</h3>
          <div class="tab-content mb-60">
            <div class="tab-pane active" role="tabpanel" id="tab_01">
              {!! $produk->deskripsi !!}
              <br>
              kategori: <a href="{{route('kategori',['param'=>$produk->kategori->slug])}}" class="text-primary">{{$produk->kategori->nama}}</a><br>
              Tag : @foreach($produk->tag as $row) <a class="text-primary" href="{{route('tag',['param'=>$row->nama])}}">{{str_replace("-"," ",$row->nama)}}</a>, @endforeach
            </div>
            <div class="">
              <div class="row">
                <div class="col-xs-2">
                  <img src="{{asset('images/profile/'.$produk->toko->user->profile)}}" class="image-pd" alt="">
                </div>
                <div class="col-xs-5" style="margin-left:-70px;">
                  <h4 class="judul-tokopd">Tokserba</h4><br>
                  <p>Bandung</p>

                </div><br>
                <div class="col-xs-4 text-right">
                  <br>
                  <form class="" action="{{route('chat')}}" method="get">
                    @csrf
                    <input type="hidden" name="produk" value="{{$produk->id}}">
                    <input type="submit" name="submit" class="btn e-btn" value="Kirim pesan ke penjual">

                  </form>
                </div>

              </div>


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ps-section ps-section--top-sales ps-owl-root pt-40 pb-80">
    <div class="ps-container">
      <div class="ps-section__header mb-50">
        <div class="row">
              <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
                <h3 class="ps-section__title" data-mask="Related item">- YOU MIGHT ALSO LIKE</h3>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                <div class="ps-owl-actions"><a class="ps-prev" href="#"><i class="ps-icon-arrow-right"></i>Prev</a><a class="ps-next" href="#">Next<i class="ps-icon-arrow-left"></i></a></div>
              </div>
        </div>
      </div>
      <div class="ps-section__content">
        <div class="ps-owl--colection owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="false" data-owl-item="4" data-owl-item-xs="1" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on">
          @foreach($produk->kategori->produk->where('end_at','>',$nows) as $row)
          <div class="ps-shoes--carousel">
            <div class="ps-shoe">
              <div class="ps-shoe__thumbnail">
                <img src="{{asset('images/gambarproduk/'.$row->gambar->first()->gambar)}}" width="300px" height="200px" alt=""><a class="ps-shoe__overlay" href="{{route('produk',['toko'=>$row->toko->id,'slug'=>$row->slug])}}"></a>
              </div>
              <div class="ps-shoe__content">
                <div class="ps-shoe__detail"><a class="ps-shoe__name" href="{{route('produk',['toko'=>$row->toko->id,'slug'=>$row->slug])}}"> {{$produk->judul}} </a>
                  <p class="ps-shoe__categories"><a href="#">{{$produk->kategori->nama}}</a></p><span class="ps-shoe__price"> Rp {{number_format($row->bid->sortByDesc('id')->first()->nominal)}}</span>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <!--modal start-->
  <div class="modal fade" id="bidmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <form class=""method="post" action="{{route('placeBid',['id'=>$produk->id])}}">
            @csrf
              <div class="form-group">
                <label for="bid">Masukan Jumlah uang</label>
                <input type="number" id="bid" onkeyup="offerBid(this)" name="nominal" class="form-control">
                <small id="passwordHelpBlock" class="form-text text-muted">
                  *Uang anda harus melebihi Bid Sebelumnya dalam kelipatan Rp.10.000.-
                </small>
              </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" name="submit" id="kirim" class="btn btn-primary" disabled>Place bid</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--modal end-->
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

<script type="text/javascript">
  var high = {{$produk->bid->sortByDesc('nominal')->first()->nominal}};
  var inputs = document.getElementById('bid');
  function offerBid(){
    var bid = inputs.value;
    console.log(bid);
    if(bid <= high || bid<= {{$produk->bin}} || bid%10000 > 0){
      inputs.classList.add('is_invalid')
      document.getElementById('kirim').disabled = true;
    }else{
      document.getElementById('kirim').disabled = false;
    }
  }
  @if (Session::has('success'))
    alert('bid berhasil');
@endif
</script>
@endsection

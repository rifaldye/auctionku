@extends('layouts/userApp')
@section('heads')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<main class="ps-main">
  <div class="ps-section--features-product ps-section masonry-root pt-100 pb-100">
    <div class="ps-container">
      <div class="row">
        <div class="col-md-9 col-xs-12">
          <div class="row chat-box" style="padding:10px;">
            <div class="col-xs-12 chart-head">
              <h2>Menunggu Pembayaran</h2>
            </div><br><br><br>
            @foreach($produk as $row)
            @if($row->bid->where('tolak','0')->sortByDesc('id')->first()->user_id == Auth::User()->id && !isset($row->invoice))
            <div class="col-xs-12 chart-list">
                <div class="row">
                  <div class="col-xs-2">
                    <img src="{{asset('images/gambarproduk/'.$row->gambar->first()->gambar)}}" width="100px" alt="">
                  </div>
                  <div class="col-xs-5">
                    <h4>{{$row->judul}}</h4>
                    <p> Rp {{number_format($row->bid->where('user_id',auth::user()->id)->where('nominal','=',$row->bid->where('tolak','0')->max('nominal'))->first()->nominal)}}</p>
                    <p class="text-danger">Anda diberikan waktu 3x24 jam untuk membayar</p>
                  </div>
                  <div class="col-xs-5">
                    <div class="chart-more">
                      <form class="" action="{{route('checkout')}}" method="get">
                        <input type="hidden" name="id" value="{{$row->id}}">
                        <input type="submit" name="submit" class="btn e-btn" value="bayar">
                      </form>
                    </div>

                  </div>

                </div>
            </div>
            @endif
            @endforeach
            <div class="col-xs-12 chart-head">
              <h2>On Process</h2>
            </div><br><br><br>
            @foreach($produk as $row)
              @if(isset($row->invoice) && $row->invoice->user_id == auth::User()->id)
              <div class="col-xs-12 chart-list">
                  <div class="row">
                    <div class="col-xs-2">
                      <img src="{{asset('images/gambarproduk/'.$row->gambar->first()->gambar)}}" width="100px"alt="">
                    </div>
                    <div class="col-xs-5">
                      <h4>{{$row->judul}}</h4>
                      <p>Rp {{number_format($row->bid->where('user_id',auth::user()->id)->where('nominal','=',$row->bid->where('tolak','0')->max('nominal'))->first()->nominal)}}</p>
                      @if($row->invoice->status == 0)
                        <p>Status: <span class="text-warning">Menunggu Pembayaran</span></p>
                      @elseif($row->invoice->status == 1)
                        <p>Status: <span class="text-warning">Menunggu persetujuan admin (max 1x24 jam)</span></p>
                      @elseif($row->invoice->status == 2)
                        <p>Status: <span class="text-warning">Pembayaran dikonfirmasi, Tunggu penjual mengirim barang</span></p>
                      @elseif($row->invoice->status == 3)
                          <p>Status: <span class="text-warning">Barang dikirim</span></p>
                      @elseif($row->invoice->status == 4)
                          <p>Status: <span class="text-success">Barang sudah diterima</span></p>
                      @elseif($row->invoice->status == 6)
                          <p>Status: <span class="text-warning">Permintaan Komplain sedang diajukan</span></p>
                      @elseif($row->invoice->status == 7)
                          <p>Status: <span class="text-success">Permintaan komplain diterima</span></p>
                      @elseif($row->invoice->status == 8)
                          <p>Status: <span class="text-danger">Permintaan Komplain ditolak</span></p>
                      @endif

                    </div>
                    <div class="col-xs-5">
                      @if($row->invoice->status == 0 || $row->invoice->status == 5)
                      <div class="chart-more">
                        <a href="{{route('invoice',['id'=>$row->invoice->id])}}" class="btn e-btn"> Konfirmasi pembayaran</a>
                      </div>
                      @elseif($row->invoice->status == 1)
                      <div class="chart-more">
                        <a href="#" class="btn e-btn"> Detail</a>
                      </div>
                      @elseif($row->invoice->status == 2)
                      <div class="chart-more">
                        <a href="#" class="btn e-btn"> Detail</a>
                      </div>
                      @elseif($row->invoice->status == 3)

                      <div class="chart-more">
                        <a href="#" class="btn btn-info"> Detail </a>
                        <a href="#" class="btn btn-warning" onclick="lacak('{{$row->invoice->resi}}',' <?php $kurir = explode(' ',$row->invoice->kurir); echo($kurir[0]); ?>')"> Lacak </a>
                        <a href="#" data-toggle="modal" onclick="oper({{$row->invoice->id}})" data-target="#exampleModalCenter" class="btn btn-danger"> Komplain </a>
                        <a href="{{route('accBarang',['id'=>$row->id])}}" class="btn e-btn"> Selesaikan </a>
                      </div>
                      @endif
                    </div>
                    @if($row->invoice->status == 3)
                    <div class="col-xs-12">
                      <small class="text-danger">*Jangan lupa untuk melakukan video unboxing saat menerima barang </small>

                    </div>
                    @endif

                  </div>
              </div>
              @endif

            @endforeach

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

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="" action="{{route('komplain')}}" enctype="multipart/form-data" method="post">
          @csrf
          <input type="hidden" name="id" id="invoice_id" value="">
          <label for="">Bukti video</label><br>
          <input type="file" name="bukti" accept="video/*"><br>
          <label for="">Deskripsi</label><br>
          <textarea name="deskripsi" rows="8" cols="80"></textarea><br>
          <input type="submit" name="submit" value="submit">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="lacakModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Lacak Paket</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>status : <span id="status"></span> </p>
        <table class="table table-hover">
          <tr>
            <td>tanggal</td>
            <td>status</td>
            <td>deskripsi</td>
          </tr>
          <tbody id="manifest">
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function oper(param){
    console.log(param);
    document.getElementById('invoice_id').value = param;
  }
  function lacak(resi,nama){
    var manifest = $('#manifest:last-child');
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
    $.ajax({
      type:'POST',
      url:'{{route("lacakKurir")}}',
      data:{
        kurir:nama,
        resi:resi
      },
      success:function(data){
        manifest.empty();
        if(data['status'] == false){
          $('#status').text('dalam perjalanan');
          $('#status').addClass('text-warning');
        }else if(data['status'] == true){
          $('#status').text('Sudah Sampai');
          $('#status').addClass('text-success');
        }
        console.log(data['responses']);
        $.each(data['responses'],function(i){
            manifest.append('<tr><th scope="row">'+data['responses'][i]['manifest_date']+'</th><td>'+data['responses'][i]['manifest_code']+'</td><td>'+data['responses'][i]['manifest_description']+'</td></tr>')

        })
        $('#lacakModal').modal('show');
      },
    });
  }
</script>
@endsection

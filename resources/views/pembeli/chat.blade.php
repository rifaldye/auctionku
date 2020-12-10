@extends('layouts/userApp')
@section('heads')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<main class="ps-main" style="background-color:#f1f1f1">
  <!--chat start-->
  <div class="ps-container">
    <br>
  <div class="chat-box">
  <div class="row">
    <div class="col-xs-4 chat-row">
      @foreach($chat as $row)
      <div class="chat-list" onclick="startChat({{$row->id}})">
        <img src="{{asset('images/profile/'.$row->toko->user->profile)}}" alt="" class="seller-img img-small">
        <a href="#"class="chat-title ps-shoe__name" >{{$row->toko->nama_toko}}</a>
        <p style="display:none" id="idToko{{$row->id}}">{{$row->toko->id}}</p>
        <p class="chat-spoiler">{{$row->isi->first()->isi}}</p>
      </div>
      @endforeach
    </div>
    <div class="col-xs-8">
      <div class="chat-wrap">
        <div class="chat-head" id="chatHead" @if(!isset($produk)) style="display:none;" @endif>
          <img id="profile_toko" src="images/user/1.jpg" alt="" class="seller-img img-med" style="margin-top:-5px;">
          <h3><a href="x"class="chat-title ps-shoe__name" id="nama_toko" >Toko xx</a></h3>
          <p id="lokasi_toko">Toko serba ada</p>
        </div>
        <div class="chat-row2" id="chatBody" @if(!isset($produk)) style="display:none;" @endif>
          <ul id="chatList">

          </ul>

        </div>
      </div>

      <div class="ketik">
        <form class="" action="" method="post">
          <table>
            <tr>
            </tr>
          </table>
          @csrf
          <input type="text" id="isiPesan" name="isiPesan" value="" class="ketik-input">
          <a href="#" class="chat-send" onclick="kirimPesan()"><i class="fa fa-arrow-circle-right"></i></a>
          <input type="hidden" id="idChat" name="id">
          <input type="hidden" id="makeChat" name="idToko" @if(isset($produk)) value="1" @endif>
        </form>
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

<script type="text/javascript">
  function startChat(chat_id){
    var chatHead = $('#chatHead');
    var chatBody = $('#chatBody');
    $('#idChat').val(chat_id);
    $('#chatList').empty();
    chatHead.css('display','block');
    chatBody.css('display','block');
    loadToko($('#idToko'+ $('#idChat').val()).text());
    loadChat(chat_id);
    $('#makeChat').val('');

  }

  function loadChat(chat_id){
    var chat = $('#chatList');
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
    var ids = 0;
    $.ajax({
      type:'POST',
      url:'{{route("getChat")}}',
      data:{
        chat_id:chat_id
      },
      success:function(data){
        $.each(data,function(i){
          ids = data[i].id;
          if(data[i].pengirim == 0){
            chat.append("<li><div class='isi-chat chat-left'><p>"+data[i].isi+"</p></div></li>");
          }else{
            chat.append("<li><div class='isi-chat chat-right'><p>"+data[i].isi+"</p></div></li>");
          }
        })

      },
    });

    setInterval(function(){
      $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
              }
          });
      $.ajax({
        type:'POST',
        url:'{{route("getChat")}}',
        data:{
          chat_id:chat_id,
          id:ids
        },
        success:function(data){
            if(data.isi == "unknow"){

            }else{
              ids = data.id;
              if(data.pengirim == 0){
                chat.append("<li><div class='isi-chat chat-right'><p>"+data.isi+"</p></div></li>");
              }else{
                chat.append("<li><div class='isi-chat chat-left'><p>"+data.isi+"</p></div></li>");
              }
            }

        },
      });
    },3000)

  }
  function kirimPesan(){
    var makeChat = $('#makeChat');
    @if(isset($produk->toko_id))
    if(makeChat.val() == 1){
      buatChat({{$produk->toko_id}});
    }else{
    @endif
    var pesan = $('#isiPesan');
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
    $.ajax({
      type:'POST',
      url:'{{route("storeChat")}}',
      data:{
        isiPesan:pesan.val(),
        pengirim:0,
        id:$('#idChat').val(),
      },
      success:function(data){
        pesan.val('');
        console.log('terkirim');
      },
    });

  }
  @if(isset($produk->toko_id))
}
  function buatChat(tokoID){
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
          type:'POST',
          url:'{{route("storeChat")}}',
          data:{
            idToko:tokoID,
          },
          success:function(data){
            $('#idChat').val(data.idChat);
            $('#makeChat').val('');
            kirimPesan();
            loadChat(data.idChat);

          },
        });

  }
@endif
  function loadToko(id){
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
    $.ajax({
      type:'POST',
      url:'{{route("getToko")}}',
      data:{
        id:id,
      },
      success:function(data){
        $('#nama_toko').text(data['nama_toko']);
        $('#lokasi_toko').text(data['nama']);
        $('#profile_toko').attr('src', "images/profile/"+ data['profile']);
        console.log(data);

      },
    });
  }

</script>

@endsection

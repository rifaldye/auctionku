@extends('layouts/sellerApp')
@section('heads')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

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
        <div class="card" style="padding:5px;">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">Chat</h3>
              </div>

            </div>
          </div>
          <div class="row">
            <div class="col-xl-4 chat-row">
              @foreach($chat as $row)
              <div class="chat-list" onclick="startChat({{$row->id}})">
                <img src="{{asset('images/profile/'.$row->user->profile)}}" alt="" class="seller-img img-small">
                <h5>{{$row->user->username}}</h5>
                <p class="chat-spoiler">{{substr($row->isi->first()->isi,10)}}</p>
                <input type="hidden" id="setNama{{$row->id}}" value="{{$row->user->username}}">
              </div>
              @endforeach
            </div>
            <div class="col-xl-8">
              <div class="chat-wrap">
              <div class="chat-head"  id="chatHead" style="display:none;">
                <img src="../images/user/1.jpg" alt="" class="seller-img img-med" style="margin-top:-5px;">
                <h3 id="namaOrg"></h3>
                <br>
              </div>
              <div class="chat-row2" id="chatBody" style="display:none;">
                <ul id="chatList">
                  <li>
                    <div class="isi-chat chat-left"><p>halo apakah barang ready? </p></div>
                  </li>
                  <li>
                    <div class="isi-chat chat-right"><p>ready </p></div>
                  </li>
                  <li>
                    <div class="isi-chat chat-left"><p>ready berapa unit </p></div>
                  </li>
                  <li>
                    <div class="isi-chat chat-right"><p>3</p></div>
                  </li>
                </ul>

              </div>
            </div>
              <div class="ketik">
                <form class="" action="" method="post">
                  <table>
                    <tr>
                    </tr>
                  </table>
                  <input type="text" id="isiPesan" name="" value="" class="ketik-input">
                  <a href="#" class="chat-send" onclick="kirimPesan()"><i class="fa fa-arrow-circle-right"></i></a>
                  <input type="hidden" id="idChat">
                </form>
              </div>

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
<script type="text/javascript">
function startChat(chat_id){
  var chatHead = $('#chatHead');
  var chatBody = $('#chatBody');
  var setNama = $('#setNama'+chat_id);
  var namaOrg = $('#namaOrg');
  $('#idChat').val(chat_id);
  $('#chatList').empty();
  namaOrg.text('');
  namaOrg.append(setNama.val())
  chatHead.css('display','block');
  chatBody.css('display','block');
  loadChat(chat_id);

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
              chat.append("<li><div class='isi-chat chat-left'><p>"+data.isi+"</p></div></li>");
            }else{
              chat.append("<li><div class='isi-chat chat-right'><p>"+data.isi+"</p></div></li>");
            }
          }

      },
    });
  },3000)
}

function kirimPesan(){
  var pesan = $('#isiPesan');
  $.ajax({
    type:'POST',
    url:'{{route("storeChat")}}',
    data:{
      isiPesan:pesan.val(),
      pengirim:1,
      id:$('#idChat').val(),
    },
    success:function(data){
      pesan.val('');
      console.log('terkirim');
    },
  });

}
</script>

@endsection

@extends('layouts/sellerApp')

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
          <div class="row" style="padding-left:10px;">
            <div class="col-xl-12">
              <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="exampleFormControlFile1">Gambar</label>
                  <input type="file" name="gambar1" class="form-control-file col-xl-12" id="exampleFormControlFile1" accept="image/x-png,image/gif,image/jpeg">
                  <div id="uploadImages">

                  </div>

                  <a href="#" id="tambahGambar" onclick="addImage()">Tambah Gambar</a>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlFile1">Judul</label>
                  <input type="text" name="judul" class="form-control"placeholder="Judul Produk">
                </div>
                <div class="form-group">
                  <label for="inputState">Kategori</label>
                  <select id="inputState" name="kategori" class="form-control">
                    <option selected>Pilih</option>
                    @foreach($kategori as $kategoris)
                    <option value="{{$kategoris->id}}">{{$kategoris->nama}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlFile1">Tag</label>
                  <input type="text" name="tag" class="form-control"placeholder="Tag tambahan">
                  <small>*Pisahkan dengan tanda "," misal peliharaan,kucing</small>
                </div>
                <div class="form-group">
                  <label for="">Deskripsi Produk</label>
                  <textarea name="deskripsi" id="mytextarea">Hello, World!</textarea>

                </div>
                <div class="form-row">
                  <div class="form-group col-xl-6">
                    <label for="">Berat barang</label>
                    <input type="number" name="berat" class="form-control" placeholder="Berat barang">
                    <small id="emailHelp" class="form-text text-muted">berat dalam jumlam gram, 1000 = 1kg</small>

                  </div>
                  <div class="form-group col-xl-6">
                    <label for="">Bid awal</label>
                    <input type="number" name="bin" class="form-control" placeholder="Bid awal">
                    <small id="emailHelp" class="form-text text-muted">Masukan tanpa titik, misal 50000 = Rp50.000</small>

                  </div>
                </div>
                <input type="submit" name="submit" value="Upload" class="btn e-btn">



              </form>
              @if ($errors->any())
                <div class="alert alert-danger">
                  <strong>Whoops!</strong> There were some problems with your input.<br><br>
                  <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                @endif

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
  var count=1;
  var gambar = "gambar";
    function addImage(){
      var points = Math.floor((Math.random() * 1000) + 1)
      var input = document.createElement("input");
      input.setAttribute("type", "file");
      input.setAttribute("accept", "image/x-png,image/gif,image/jpeg");
      input.setAttribute("name", gambar.concat(count+1));
      input.className="col-xl-12";
      document.getElementById("uploadImages").appendChild(input);
      count++;
      if(count >=5){
        document.getElementById("tambahGambar").style.display="none";
      }


    }


</script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>
    tinymce.init({
      selector:'#mytextarea',
      width: 900,
      height: 300
  });
</script>
@endsection

@extends('layouts/adminApp')

@section('content')
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
      </div>
      <!-- Card stats -->
      <div class="row">


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
        <div class="row align-items-center">
        </div>
      </div>
      <div class="row"style="padding-left:10px;">
        <div class="col-xl-12">
          <h2>Penarikan Saldo</h2><br>
          <br>
        </div>
        <div class="col-xl-12">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">User</th>
                <th scope="col">Bank</th>
                <th scope="col">Nomer rekening</th>
                <th scope="col">Nama</th>
                <th scope="col">Nominal</th>
                <th scope="col">action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($tarik as $row)
              <tr>
                <th scope="row">
                  {{$row->user->fname." ".$row->user->lname}}
                </th>
                <td>
                  {{$row->bank}}
                </td>
                <td>
                  {{$row->norek}}
                </td>
                <td>
                  {{$row->nama}}
                </td>
                <td>
                  Rp.{{number_format($row->nominal)}}
                </td>
                <td>
                  <a href="{{route('adminAccTarik',['id'=>$row->id])}}" class="btn e-btn">Selesai</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

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

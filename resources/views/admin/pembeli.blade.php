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
          <h2>User</h2><br>
          <!--
          <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
            <div class="form-group mb-0">
              <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend" style="background-color:#f1f1f1;">
                  <span class="input-group-text" ><i class="fas fa-search"></i></span>
                </div>
                <input class="form-control" style="background-color:#f1f1f1;" placeholder="Search" type="text">
                <input type="submit" class="btn e-btn" value="Cari">
              </div>
            </div>
            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </form>
        -->
          <br>
        </div>
        <div class="col-xl-12">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Join since</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($pembeli as $row)
              <tr>
                <th scope="row">
                  {{$row->id}}
                </th>
                <td>
                  {{$row->username}}
                </td>
                <td>
                  {{$row->email}}
                </td>
                <td>
                  {{$row->created_at}}
                </td>
                <td>
                  <a href="{{route('userBan',['id'=>$row->id])}}" class="btn btn-danger">Non aktifkan</a>
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

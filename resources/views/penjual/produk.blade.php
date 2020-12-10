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
          <div class="row"style="padding-left:10px;">
            <div class="col-xl-12">
              <h2>Masih berlangsung</h2>
            </div>
            @foreach($produk->where('end_at','>',$nows) as $row)
            <div class="col-xl-12 admin-list">
                <div class="row">
                  <div class="col-xl-2">
                    <img src="{{asset('images/gambarproduk/'.$row->gambar->first()->gambar)}}" width="100px" alt="">
                  </div>
                  <div class="col-xl-5">
                    <h4>{{$row->judul}}</h4>
                    <p>Bid : Rp
                      {{number_format($row->bid->sortByDesc('id')->first()->nominal)}}
                    </p>
                    @if( $nows->diffInDays($row->end_at) == 0)
                    <p>Waktu Tersisa <span>{{$nows->diffInHours($row->end_at)}} Jam lagi</span> </p>
                    @else
                    <p>Waktu Tersisa <span>{{$nows->diffInDays($row->end_at)}} Hari lagi</span> </p>
                    @endif
                    <div class="progress" style="height:5px; background-color:#e0e0e0;">
                      @if( $nows->diffInDays($row->end_at) == 0)
                      <div class="progress-bar bg-danger" role="progressbar" style="width:{{100- ($nows->diffInHours($row->end_at)/24*10)}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                      @else
                      <div class="progress-bar bg-info" role="progressbar" style="width: {{10-$nows->diffInDays($row->end_at)}}0%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                      @endif
                    </div>
                  </div>
                  <div class="col-xl-5">
                    <div class="chart-more">
                      <a href="#" class="btn e-btn"> Detail</a>
                    </div>

                  </div>

                </div>
            </div>
            @endforeach
            
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

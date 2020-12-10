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
            <div class="row">
              <div class="col-xl-1"></div>
              <div class="col-xl-3">
                <img src="../images/user/1.jpg" class="seller-img" width="100px" alt="">
                <h2>Toko xx</h2>
                <p >Bandung</p>
              </div>
              <div class="col-xl-4" style="text-align:center;" >
                <h3>Saldo</h3>
                <p class="total-harga-penjual">Rp {{number_format(auth::User()->saldo)}}</p>

              </div>
              <div class="col-xl-4" style="text-align:center;" >
                @if($cek == 0)
                <a href="#" class="btn e-btn" data-toggle="modal" data-target="#tarikModal">Tarik Saldo</a>
                @elseif($cek == 1)
                <button class="btn e-btn" data-toggle="modal" data-target="#tarikModal" disabled>Tarik Saldo</button><br>
                <small class="text-danger">*permintaan penarikan saldo sedang diproses</small>
                @endif

              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header border-0">
            <div class="row align-items-center">
            </div>
          </div>
          <div class="row"style="padding-left:10px;">
            <div class="col-xl-12">
              <h2>History Saldo</h2>
            </div>
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Invoice</th>
                  <th scope="col">Aksi</th>
                  <th scope="col">Detail</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Saldo</th>
                </tr>
              </thead>
              <tbody>
                @if(isset($mutasi))
                @foreach($mutasi as $row)
                <tr>
                  <th scope="row">
                    {{$row->id}}
                  </th>
                  <td>
                    @if($row->jenis == 1)
                    penarikan dana
                    @elseif($row->jenis == 0)
                    penjualan
                    @endif
                  </td>
                  <td>
                    @if(isset($row->invoice_id))
                    {{$row->invoice->produk->judul}}
                    @else
                    penarikan dana
                    @endif
                  </td>
                  <td>
                    {{$row->created_at}}
                  </td>
                  <td>
                    @if($row->jenis == 1)
                    <p class="total-harga-penjual">- Rp{{number_format($row->nominal)}}</p>
                    @elseif($row->jenis == 0)
                    <p class="total-harga-penjual">+ Rp{{number_format($row->nominal)}}</p>
                    @endif
                  </td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
            </div>


          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="tarikModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tarik saldo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('penjualTarikSaldo')}}" method="post">
          @csrf
          <table>
            <tr>
              <td>Atm</td>
              <td>:</td>
              <td>
                <select name="bank" class="form-control">
                  <option value="bca">BCA</option>
                  <option value="bca">BNI</option>
                  <option value="bca">BRI</option>
                  <option value="bca">MANDIRI</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Nomer Rekening</td>
              <td>:</td>
              <td> <input type="number" name="norek" class="form-control" value=""> </td>
            </tr>
            <tr>
              <td>Atas Nama</td>
              <td>:</td>
              <td> <input type="text" name="nama" class="form-control" value=""> </td>
            </tr>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Kirim Permintaan">
      </form>
      </div>
    </div>
  </div>
</div>
@endsection

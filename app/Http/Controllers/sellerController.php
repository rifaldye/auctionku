<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alamat;
use App\Models\Toko;
use App\Models\Ktp;
use App\Models\User;
use App\Models\Gambar;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kurir;
use App\Models\Bid;
use App\Models\Invoice;
use App\Models\Mutasi;
use App\Models\Tarik;
use App\Models\Komplain;
use App\Models\Tag;
use Carbon\Carbon;
use Auth;
class sellerController extends Controller
{
  public function __construct() {
      $this->middleware('checkSeller', ['except' => [
          'verifAlamat','storeAlamat','verifToko','storeToko','verifKTP','storeKTP'
      ]]);
      $this->middleware('isBan');
  }
  public function index(){
    $tokos = auth::User()->toko->id;
    $invoice = Invoice::select('id')->whereIn('produk_id',function($query) use ($tokos){
      $query->select('id')
      ->from('produks')
      ->whereRaw('toko_id',$tokos);
    });
    $kirim = $invoice->where('status','2')->count();
    $komplain = Komplain::whereIn('invoice_id',$invoice->get())->where('status','0')->count();
    $terjual = $invoice->where('status','4')->count();
    $nows = Carbon::now();
    return view('penjual/index',compact('nows','kirim','komplain','terjual'));
  }
  public function chat(){
    $chat = Auth::User()->toko->chat;
    return view('penjual.chat',compact('chat'));
  }
  public function penjualan(){
    $invoice = Invoice::where('status','2')->get();
    $produk = Produk::where('id',Auth::User()->toko->id);
    $now = Carbon::now();
    return view('penjual/penjualan',compact('invoice','produk','now'));
  }
  public function getChat(request $request){
    $id = $request->id;
    $chat_id = $request->chat_id;
    if(isset($id)){
      $data = Chat::where('id',$chat_id)->first()->isi->where('id','>',$id)->first();
      if(isset($data)){
        return response()->json($data,200);
      }else{
        return response()->json(['isi'=>'unknow'],200);

      }
    }else{
      $data = Chat::where('id',$chat_id)->first()->isi;
      return response()->json($data,200);
    }
  }
  public function storeChat(request $request){
    Isichat::create([
      'chat_id'=>$request->id,
      'isi'=>$request->isiPesan,
      'pengirim'=>$request->pengirim,
    ]);
    return response()->json(['status'=>'terkirim'],200);
  }
  public function produk(){
    $produk = Auth::User()->toko->produk;
    $nows = Carbon::now();
    return view('penjual/produk',compact('produk','nows'));
  }
  public function tambahProduk(){
    $kategori = Kategori::all();
    return view('penjual/uploadProduk',compact('kategori'));
  }
  public function storeProduk(request $request){
    $request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'bin' => 'required',
            'berat' => 'required',
            'gambar1' => 'required'
        ]);
    $end_at = Carbon::now()->addDays(10);
     $produk = Produk::create([
       'slug' => \Str::slug($request['judul']),
       'judul' => $request['judul'],
       'kategori_id' => $request['kategori'],
       'deskripsi' => $request['deskripsi'],
       'bin' => $request['bin'],
       'berat' => $request['berat'],
       'early' => 60000,
       'toko_id' => Auth::User()->toko->id,
       'end_at' => $end_at,
     ]);
     Bid::create([
       'produk_id' => $produk->id,
       'nominal' => 0,
     ]);
     $tag = explode(",",$request->tag);
     foreach ($tag as $row) {
       Tag::create([
         'produk_id' => $produk->id,
         'nama' => str_slug($row,"-"),
       ]);
     }

     for($i=1;$i<=5;$i++){
       $gambar = $request->file('gambar'.$i);
       if(isset($gambar)){
         $gambarName = Auth::User()->toko->id.'-'.rand(0,1000).'-'.$gambar->getClientOriginalName();
         Gambar::create([
           'produk_id' => $produk->id,
           'gambar' => $gambarName,
         ]);
         $gambar->move(public_path('images/gambarproduk'), $gambarName);
       }
     }


    return redirect(route('penjualHome'));
  }
  public function profile(){
    $provinsi = Provinsi::get();
    $kota = Kota::where('provinsi_id',Auth::User()->alamat->provinsi_id)->get();
    $kurir = Kurir::get();
    return view('penjual/profileToko',compact('provinsi','kota','kurir'));
  }
  public function saldo(){
    $cekTarik = Auth::User()->tarik->where('status','0')->first();
    $cek = 0;
    if (isset($cekTarik)) {
      $cek = 1;
    }

    if(isset(Auth::User()->toko->mutasi)){
      $mutasi = Auth::User()->toko->mutasi->sortByDesc('id');
      return view('penjual/saldo',compact('mutasi','cek'));
    }else{
      return view('penjual/saldo',compact('cek'));
    }
  }
  public function ulasan(){
    return view('penjual/ulasan');
  }
  public function upload(){
    return view('penjual/uploadProduk');
  }

  public function verifAlamat(){
    if (isset(Auth::User()->alamat->kota)) {
      return redirect(route('penjualVerifToko'));
    }else{
      $provinsi = Provinsi::get();
    return view('penjual/verifAlamat',compact('provinsi'));
  }
  }
  public function storeAlamat(request $request){
    if (isset(Auth::User()->alamat->kota)) {
      return redirect(route('penjualVerifToko'));
    }else{
    $request->validate([
            'provinsi' => 'required',
            'kota' => 'required',
            'alamat_lengkap' => 'required',
            'kode_pos' => 'required'
        ]);
        Alamat::create([
          'provinsi_id' => $request['provinsi'],
          'kota_id' => $request['kota'],
          'alamat_lengkap' => $request['alamat_lengkap'],
          'kode_pos' => $request['kode_pos'],
          'user_id' => Auth::User()->id,
        ]);

      return redirect(route('penjualHome'));
    }

  }
  public function verifToko(){
    if (isset(Auth::User()->toko->id)) {
      return redirect(route('penjualVerifKTP'));
    }else{
      $kurir = Kurir::get();
    return view('penjual.verifToko',compact('kurir'));
  }
  }
  public function storeToko(request $request){
    if (isset(Auth::User()->toko->id)) {
      return redirect(route('penjualVerifKTP'));
    }else{
    $request->validate([
            'nama_toko' => 'required',
            'deskripsi_toko' => 'required',
        ]);
        $kurir = Kurir::get();
        foreach ($kurir as $row) {
          if($request[$row->nama] == null){
            $request[$row->nama] = 0;
          }
        }
        Toko::create([
          'nama_toko' => $request['nama_toko'],
          'deskripsi_toko' => $request['deskripsi_toko'],
          'verif' => 0,
          'jne' => $request['jne'],
          'pos' => $request['pos'],
          'tiki' => $request['tiki'],
          'wahana' => $request['wahana'],
          'jnt' => $request['jnt'],
          'sicepat' => $request['sicepat'],
          'user_id' => Auth::User()->id,
        ]);

      return redirect(route('penjualHome'));
    }

  }
  public function verifKTP(){
    if (Auth::User()->toko->verif == 1) {
      return redirect(route('penjualHome'));
    }elseif(isset(Auth::User()->toko->ktp)){
      $cek = Ktp::where('tolak',0)->where('toko_id',Auth::User()->toko->id)->first();
      $cek2 = Ktp::where('tolak',1)->where('toko_id',Auth::User()->toko->id)->first();
      if(isset($cek)){
        return view('penjual.verifKTP')->with('target','proses');
      }elseif(isset($cek2)){
        return view('penjual.verifKTP')->with('target','tolak');
      }
    }else{
      return view('penjual.verifKTP');

  }
  }
  public function storeKTP(request $request){
    if (Auth::User()->toko->verif == 1) {
      return redirect(route('penjualHome'));
    }else{
    $request->validate([
            'foto1' => 'required',
            'foto2' => 'required',
        ]);
    $foto1 = $request->file('foto1');
    $foto1Name = Auth::User()->id.'-'.rand(0,1000).'-'.$foto1->getClientOriginalName();
    $foto2 = $request->file('foto2');
    $foto2Name = Auth::User()->id.'-'.rand(0,1000).'-'.$foto2->getClientOriginalName();
    $request->foto1->move(public_path('images/ktp'), $foto1Name);
    $request->foto2->move(public_path('images/ktp'), $foto2Name);
    KTP::create([
      'foto1' => $foto1Name,
      'foto2' => $foto2Name,
      'toko_id' => Auth::User()->toko->id,
    ]);
    return redirect(route('penjualHome'));

  }
  }
  public function updateToko(request $request){
    $this->validate($request, [
      'nama_toko' => 'required',
      'deskripsi_toko' => 'required',
  ]);
  $kurir = Kurir::get();
  foreach ($kurir as $row) {
    if($request[$row->nama] == null){
      $request[$row->nama] = 0;
    }
  }
    Toko::where('user_id',Auth::User()->id)->update([
      'nama_toko'=> $request->nama_toko,
      'deskripsi_toko'=> $request->deskripsi_toko,
      'jne' => $request['jne'],
      'pos' => $request['pos'],
      'tiki' => $request['tiki'],
      'wahana' => $request['wahana'],
      'jnt' => $request['jnt'],
      'sicepat' => $request['sicepat'],
    ]);
    return redirect(route('penjualProfile'));
  }

  public function verifResi(request $request){
    $kurir = $request->kurir;
    $kurir = explode(' ',$kurir);

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://pro.rajaongkir.com/api/waybill",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "waybill=".$request->resi."&courier=".$kurir[0],
      CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: 003035be71bda1f1c19c95d5c3d88af3"
      ),
    ));

    $response = json_decode(curl_exec($curl),true);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {

    }
    if($response['rajaongkir']['status']['code'] == 200){
      Invoice::find($request->id)->update(['status'=>'3','resi'=>$request->resi]);
      return redirect(route('penjualPenjualan'));
    }else{
      return redirect()->back();
    }
  }
  public function tarikSaldo(request $request){
    Tarik::create([
      'user_id' => Auth::User()->id,
      'bank' => $request->bank,
      'norek' => $request->norek,
      'nama' => $request->nama,
      'nominal' => Auth::User()->saldo,
    ]);
    return redirect()->back();
  }
  public function ban(request $request){
    auth::User()->update(['ban'=>1]);
    return redirect()->back();
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Toko;
use App\Models\Bid;
use App\Models\Chat;
use App\Models\Isichat;
use App\Models\Provinsi;
use App\Models\Buktipembayaran;
use App\Models\Kurir;
use App\Models\Komplain;
use App\Models\Kota;
use App\Models\Invoice;
use App\Models\Mutasi;
use App\Models\Kategori;
use App\Models\Tag;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Crypt;


class userController extends Controller
{
  public function __construct() {
      $this->middleware('checkBuyer', ['except' => [
          'profile'
      ]]);
      $this->middleware('isBan');
  }
    public function index(){
      $produk = Produk::where('end_at','>=',Carbon::now())->orderByDesc('created_at')->get();
      $nows = Carbon::now();
      return view('pembeli.index',compact('produk','nows'));
    }
    public function kategori(request $request){
      $slug = $request->param;
      $produk = Produk::where('end_at','>=',Carbon::now())->where('kategori_id',function($query) use($slug){
        $query->select('id')
        ->from('kategoris')
        ->where('slug',$slug);
      })->orderByDesc('created_at')->get();
      $nows = Carbon::now();
      return view('pembeli.index',compact('produk','nows'));
    }
    public function tag(request $request){
      $slug = $request->param;
      $produk = Tag::where('nama',$slug)->get();
      $nows = Carbon::now();
      return view('pembeli.tag',compact('produk','nows'));
    }
    public function detailProduk($toko,$slug){
      $produk = Produk::where('slug',$slug)->where('toko_id',$toko)->first();
      $nows = Carbon::now();
      return view('pembeli.productDetail',compact('produk','nows'));
    }
    public function placeBid(request $request,$id){
      Bid::create([
        'produk_id'=>$id,
        'nominal'=>$request['nominal'],
        'user_id'=>Auth::User()->id
      ]);
      return redirect()->back()->with('success','Biding berhasil');
    }
    public function getToko(request $request){
      $toko = \DB::table('tokos')->where('tokos.id','=',$request->id)->join('users','tokos.user_id','=','users.id')->join('alamats','users.id','=','alamats.user_id')->join('kotas','alamats.kota_id','=','kotas.id')->select('tokos.nama_toko','kotas.nama','users.profile')->first();
      return response()->json($toko,200);
    }
    public function chat (request $request){
      if(isset($request->produk)){
        $chat = Auth::User()->chat;
        $produk = Produk::find($request->produk);
        return view('pembeli.chat',compact('chat','produk'));
      }else{
      $chat = Auth::User()->chat;
      return view('pembeli.chat',compact('chat'));
    }
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
      if(isset($request->idToko)){
        $chat = Chat::create([
          'toko_id'=>$request->idToko,
          'user_id'=>Auth::User()->id,
        ]);
        return response()->json(['idChat'=>$chat->id],200);
      }else{
      Isichat::create([
        'chat_id'=>$request->id,
        'isi'=>$request->isiPesan,
        'pengirim'=>$request->pengirim,
      ]);
      return response()->json(['status'=>'terkirim'],200);
    }
  }

    public function bayar(){
      $produk = Produk::where('end_at','<',Carbon::now())->get();
      return view('pembeli.bayar',compact('produk'));
    }
    public function chart(){
      $produk = Produk::where('end_at','>',Carbon::now())->get();
      $nows = Carbon::now();
      $lose = Bid::where('user_id',Auth::User()->id)->orderByDesc('id');
      return view('pembeli.chart',compact('produk','nows','lose'));
    }
    public function profile(){
      $provinsi = Provinsi::get();
      if(isset(Auth::User()->alamat)){
        $kota = Kota::where('provinsi_id',Auth::User()->alamat->provinsi_id)->get();
        return view('pembeli.profile',compact('provinsi','kota'));
      }else{
      return view('pembeli.profile',compact('provinsi'));
    }
    }
    public function checkout(request $request){
      $kurir = Kurir::get();
      $ongkir = [];
      $produk = Produk::find($request->id);
      foreach ($kurir as $row) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "origin=".$produk->toko->user->alamat->kota_id."&originType=city&destination=".auth::user()->alamat->kota_id."&destinationType=city&weight=".$produk->berat."&courier=".$row->nama,
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
          if($produk->toko[$row->nama] == 1){
          $ongkir = array_merge($ongkir,$response['rajaongkir']['results']);
        }
        }
      }
      return view('pembeli.checkout',compact('ongkir','produk'));
    }

    public function createInvoice(request $request){
      $request->validate([
              'bank' => 'required',
              'harga' => 'required',
              'produk' => 'required',
              'kurir' => 'required',
              'hargakurir' => 'required',
          ]);

          Invoice::create([
            'kurir'=>$request->kurir,
            'harga'=>$request->harga,
            'hargakurir'=>$request->hargakurir,
            'bank'=>$request->bank,
            'produk_id'=>$request->produk,
            'user_id'=>auth::User()->id,
          ]);
          return redirect(route('bayar'));

    }

    public function invoice($id){
      $invoice = Invoice::find($id);

      return view('pembeli.konfirmasi',compact('invoice'));
    }
    public function konfirmasi(request $request){
      $request->validate([
              'invoice' => 'required',
              'buktipembayaran' => 'required',
          ]);
      $foto1 = $request->file('buktipembayaran');
      $foto1Name =Auth::User()->id.'-'.rand(0,1000).'-'.$foto1->getClientOriginalName();
      $request->buktipembayaran->move(public_path('images/buktipembayaran'), $foto1Name);
      $detail = '';
      if (isset($request->detail)) {
        $detail = $request->detail;
      }
      Buktipembayaran::create([
        'gambar' => $foto1Name,
        'detail' => $detail,
        'invoice_id' => $request->invoice,
      ]);
      Invoice::find($request->invoice)->update([
        'status'=>1,
      ]);
      return redirect(route('bayar'));
    }
    public function komplain(request $request){
      $foto1 = $request->file('bukti');
      $foto1Name =Auth::User()->id.'-'.rand(0,1000).'-'.$foto1->getClientOriginalName();
      $request->bukti->move(public_path('images/komplain'), $foto1Name);
      Komplain::create([
        'invoice_id'=>$request->id,
        'bukti'=>$foto1Name,
        'deskripsi'=>$request->deskripsi
      ]);
      Invoice::find($request->id)->update(['status'=>'6']);
      return redirect(route('bayar'));
    }
    public function accBarang(request $request){
      $invoice = Invoice::find($request->id);
      $invoice->update(['status'=>'4']);
      $nominal = $invoice->harga + Invoice::find($request->id)->hargakurir;
      $saldo = $invoice->produk->toko->saldo +$nominal;
      $invoice->produk->toko->user->update(['saldo'=>$saldo]);
      Mutasi::create([
        'jenis'=>0,
        'user_id'=>$invoice->user_id,
        'toko_id'=>$invoice->produk->toko_id,
        'invoice_id'=>$invoice->id,
        'nominal'=>$invoice->harga,
      ]);
      return redirect(route('bayar'));
    }
    public function lacakKurir(request $request){
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/waybill",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "waybill=".$request->resi."&courier=".$request->kurir,
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
        $responses = array_reverse($response['rajaongkir']['result']['manifest']);
        $status =$response['rajaongkir']['result']['delivered'];

      }
      return compact('responses','status');

    }
}

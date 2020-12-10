<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alamat;
use App\Models\Toko;
use App\Models\Ktp;
use App\Models\User;
use App\Models\Komplain;
use App\Models\Invoice;
use App\Models\Tarik;
use App\Models\Mutasi;

class adminController extends Controller
{
  public function __construct() {
      $this->middleware('isBan');
  }
  public function index(){
    return view('admin/index');
  }
  public function komplain(){
    $komplain = Komplain::where('status','0')->get();
    return view('admin/komplain',compact('komplain'));
  }
  public function pembayaran(){
    $invoice = Invoice::where('status','1')->get();
    return view('admin/pembayaran',compact('invoice'));
  }
  public function pembeli(){
    $pembeli = User::where('role_id','1')->get();
    return view('admin/pembeli',compact('pembeli'));
  }
  public function tarik(){
    $tarik = Tarik::where('status','0')->get();
    return view('admin/tarik',compact('tarik'));
  }
  public function toko(){
    $toko = Toko::get();
    return view('admin/toko',compact('toko'));
  }
  public function ktp(){
    $data = Ktp::where('status',0)->get();
    return view('admin/ktp',compact('data'));
  }
  public function tolakKTP(request $request){
    Ktp::where('id',$request->id)->update(['status'=>1]);
    return redirect(route('adminKTP'));
  }
  public function terimaKTP(request $request){
    $ktp = Ktp::find($request->id);
    $ktp->update(['status'=>2]);
    $ktp->toko->update(['verif'=>1]);
    return redirect(route('adminKTP'));
  }
  public function terimaPembayaran(request $request){
    Invoice::find($request->id)->update(['status'=>'2']);
    return redirect(route('adminPembayaran'));
  }
  public function tolakPembayaran(request $request){
    Invoice::find($request->id)->update(['status'=>'5']);
    return redirect(route('adminPembayaran'));
  }
  public function accKomplain(request $request){
    Komplain::find($request->id)->update(['status'=>'1']);
    Komplain::find($request->id)->invoice->update(['status'=>'7']);
    $saldo = Komplain::find($request->id)->invoice->user->saldo + Komplain::find($request->id)->invoice->harga;
    Komplain::find($request->id)->invoice->user->update(['saldo'=>$saldo]);
    return redirect(route('adminKomplain'));


  }
  public function tolakKomplain(request $request){
    Komplain::find($request->id)->update('status','2');
    Komplain::find($request->id)->invoice->update(['status'=>'8']);
    $saldo = Komplain::find($request->id)->invoice->toko->user->saldo + Komplain::find($request->id)->invoice->harga;
    Komplain::find($request->id)->invoice->toko->user->update(['saldo'=>$saldo]);
    return redirect(route('adminKomplain'));
  }
  public function accTarik(request $request){
    $tarik = Tarik::find($request->id);
    $tarik->update([
      'status'=>1
    ]);
    $saldo = $tarik->user->saldo - $tarik->nominal;
    $tarik->user->update(['saldo'=>$saldo]);

    Mutasi::create([
      'jenis'=>1,
      'user_id'=>$tarik->user_id,
      'toko_id'=>$tarik->user->toko->id,
      'nominal'=>$tarik->nominal
    ]);
    return redirect()->back();
  }
}

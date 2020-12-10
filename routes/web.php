<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\userController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\sellerController;
use App\Models\Provinsi;

Route::get('/checkrole',[RoleController::class,'checkRole'])->name('checkrole');
Route::post('/getProvinsi',[RoleController::class,'getProvinsi'])->name('getProvinsi');
Route::post('/alamat',[RoleController::class,'updateAlamat'])->name('updateAlamat');
Route::post('/profile',[RoleController::class,'updateProfile'])->name('updateProfile');
Route::post('/getKota',[RoleController::class,'getKota'])->name('getKota');
Route::post('/checkout',[UserController::class,'checkOngkir'])->name('checkOngkir');
Route::group([],function(){
Route::get('/',[userController::class,'index'])->name('pembeliHome');
Route::get('/produk/{toko}/{slug}',[userController::class,'detailProduk'] )->name('produk');
Route::get('/kategori/{param}', [userController::class, 'kategori'])->name('kategori');
Route::get('/tag/{param}', [userController::class, 'tag'])->name('tag');
Route::get('/ban/{id}', [roleController::class, 'ban'])->name('userBan');
Route::get('/ban',function () {
    return view('banned');
})->name('ban');


Route::post('/chats',[userController::class,'getChat'])->name('getChat');
Route::post('/chat',[userController::class,'storeChat'])->name('storeChat');
});

Route::middleware('isPembeli')->group(function(){
  Route::post('/produk/placeBid/{id}',[userController::class,'placeBid'] )->name('placeBid');
  Route::post('/invoice',[userController::class,'createInvoice'] )->name('createInvoice');
  Route::post('/konfirmasi',[userController::class,'konfirmasi'] )->name('konfirmasi');
  Route::post('/komplain',[userController::class,'komplain'] )->name('komplain');
  Route::post('/lacak', [userController::class,'lacakKurir'])->name('lacakKurir');
  Route::get('/acc',[userController::class,'accBarang'] )->name('accBarang');
  Route::get('/bayar', [userController::class,'bayar'])->name('bayar');
  Route::get('/chart', [userController::class,'chart'])->name('chart');
  Route::get('/chat',[userController::class,'chat'])->name('chat');
  Route::post('/gettoko',[userController::class,'getToko'])->name('getToko');
  Route::get('/checkout', [userController::class, 'checkout'])->name('checkout');
  Route::get('/invoice/{id}', [userController::class, 'invoice'])->name('invoice');
  Route::get('/toko', function () {
      return view('pembeli.profileToko');
  })->name('ProfileToko');
  Route::get('/profile', [userController::class,'profile'])->name('profile');
});

Route::get('/seller/register', function () {
    return view('auth.register')->with('target', 'seller');
})->name('sellerReg');

Route::middleware('isPenjual')->group(function(){
  Route::post('/seller/chats',[sellerController::class,'getChat'])->name('getSellerChat');
  Route::post('/seller/chat',[sellerController::class,'storeChat'])->name('storeSellerChat');
  Route::post('/resi',[sellerController::class,'verifResi'] )->name('verifResi');
  Route::get('/seller',[sellerController::class,'index'])->name('penjualHome');
  Route::get('/verif/alamat',[sellerController::class,'verifAlamat'])->name('penjualVerifAlamat');
  Route::get('/verif/toko',[sellerController::class,'verifToko'])->name('penjualVerifToko');
  Route::get('/verif/ktp',[sellerController::class,'verifKTP'])->name('penjualVerifKTP');
  Route::post('/verif/alamat',[sellerController::class,'storeAlamat'])->name('storeAlamat');
  Route::post('/verif/toko',[sellerController::class,'storeToko'])->name('storeToko');
  Route::post('/verif/ktp',[sellerController::class,'storeKTP'])->name('storeKTP');
  Route::post('/seller/toko',[sellerController::class,'updateToko'])->name('updateToko');
  Route::get('/seller/chat',[sellerController::class,'chat'])->name('penjualChat');
  Route::get('/seller/penjualan', [sellerController::class,'penjualan'])->name('penjualPenjualan');
  Route::get('/seller/produk', [sellerController::class,'produk'])->name('penjualProduk');
  Route::get('/seller/produk/tambah', [sellerController::class,'tambahProduk'])->name('penjualTambahProduk');
  Route::post('/seller/produk/tambah', [sellerController::class,'storeProduk'])->name('penjualStoreProduk');
  Route::get('/seller/profile', [sellerController::class,'profile'])->name('penjualProfile');
  Route::get('/seller/saldo', [sellerController::class,'saldo'])->name('penjualSaldo');
  Route::post('/tarik', [sellerController::class,'tarikSaldo'])->name('penjualTarikSaldo');
  Route::get('/seller/ulasan', [sellerController::class,'ulasan'])->name('penjualUlasan');
  Route::get('/seller/upload', [sellerController::class,'upload'])->name('penjualUpload');
  Route::post('/seller/ban', [sellerController::class,'ban'])->name('penjualBan');
});

Route::middleware('isAdmin')->group(function(){
  Route::get('/admin', [adminController::class, 'index'])->name('adminHome');
  Route::get('/admin/komplain', [adminController::class, 'komplain'])->name('adminKomplain');
  Route::get('/admin/pembayaran', [adminController::class, 'pembayaran'])->name('adminPembayaran');
  Route::get('/admin/pembayaran/terima/{id}', [adminController::class, 'terimaPembayaran'])->name('terimaPembayaran');
  Route::get('/admin/pembayaran/tolak/{id}', [adminController::class, 'tolakPembayaran'])->name('tolakPembayaran');
  Route::get('/admin/pembeli', [adminController::class, 'pembeli'])->name('adminPembeli');
  Route::get('/admin/tarik-saldo/', [adminController::class, 'tarik'])->name('adminTarik');
  Route::get('/admin/tarik-saldo/{id}', [adminController::class, 'accTarik'])->name('adminAccTarik');
  Route::get('/admin/toko', [adminController::class, 'toko'])->name('adminToko');
  Route::get('/admin/ktp', [adminController::class, 'ktp'])->name('adminKTP');
  Route::get('/admin/ktp/tolak/{id}', [adminController::class, 'tolakKTP'])->name('tolakKTP');
  Route::get('/admin/ktp/terima/{id}', [adminController::class, 'terimaKTP'])->name('terimaKTP');
  Route::get('/komplain/{id}',[adminController::class,'accKomplain'] )->name('accKomplain');


});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

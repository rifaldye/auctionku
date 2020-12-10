<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Alamat;
use App\Models\User;
use Auth;

class RoleController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

    public function checkRole(){
      if(Auth::User()->role->role_name == 'pembeli'){
        return redirect(route('pembeliHome'));
      }elseif(Auth::User()->role->role_name == 'penjual'){
        return redirect(route('penjualHome'));
      }elseif(Auth::User()->role->role_name == 'admin'){
        return redirect(route('adminHome'));
      }
    }
    public function cheker(){
      $json = file_get_contents(asset('test.json'));
      $objs = json_decode($json,true);
      dd($objs);
    }
    public function getProvinsi(){
      $provinsi = Provinsi::get();
      return response()->json($provinsi,200);

    }
    public function getKota(request $request){
      $kota = Kota::where('provinsi_id',$request['provinsi'])->get();
      return response()->json($kota,200);

    }
    public function updateAlamat(request $request){
      $this->validate($request, [
        'provinsi' => 'required',
        'kota' => 'required',
        'alamat_lengkap' => 'required',
        'kode_pos' => 'required',
    ]);
      if(isset(Auth::User()->alamat)){
        Alamat::where('user_id',Auth::User()->id)->update([
          'provinsi_id'=>$request->provinsi,
          'kota_id'=>$request->kota,
          'alamat_lengkap'=>$request->alamat_lengkap,
          'kode_pos'=>$request->kode_pos
        ]);
        return redirect(route('profile'))->with('message','Alamat berhasil diupdate');
      }else{
        Alamat::create([
          'user_id' => Auth::User()->id,
          'provinsi_id'=>$request->provinsi,
          'kota_id'=>$request->kota,
          'alamat_lengkap'=>$request->alamat_lengkap,
          'kode_pos'=>$request->kode_pos
        ]);
        return redirect(route('profile'))->with('message','Alamat berhasil diupdate');

      }
    }

    public function updateProfile(request $request){
      $this->validate($request, [
        'first_name' => 'required',
        'last_name' => 'required',
        'username' => 'required',
        'email' => 'required',
        'tgl_lahir' => 'required',
        'telp' => 'required',
    ]);
        User::where('id',Auth::User()->id)->update([
          'fname'=> $request->first_name,
          'lname'=> $request->last_name,
          'username'=> $request->username,
          'email'=> $request->email,
          'tanggal_lahir'=> $request->tgl_lahir,
          'telp'=> $request->telp,
        ]);
        return redirect(route('profile'))->with('message','Profile berhasil diupdate');
    }
    public function ban(request $request){
      User::find($request->id)->update(['ban'=>1]);
      return redirect()->back();
    }

}

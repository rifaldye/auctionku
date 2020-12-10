<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => ['required'],
            'lname' => ['required'],
            'username' => ['required'],
            'tanggal_lahir' => ['required'],
            'telp' => ['required'],
            'email' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'target' => ['integer'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
      if(!isset($data['target']) || $data['target'] == 1 ){
        $target = 1;
        if(isset($data['target'])){
          $target =2;
        }
        return User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'username' => $data['username'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'telp' => $data['telp'],
            'email' => $data['email'],
            'role_id' => $target,
            'password' => Hash::make($data['password']),
        ]);
      }else{
        abort(403);
      }
    }
}

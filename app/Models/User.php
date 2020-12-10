<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname',
        'lname',
        'username',
        'tanggal_lahir',
        'telp',
        'email',
        'password',
        'role_id',
        'profile',
        'saldo',
        'ban'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role()
    {
        return $this->belongsTo('App\Models\Role','role_id');
    }
    public function alamat()
    {
        return $this->hasOne('App\Models\Alamat');
    }
    public function toko()
    {
        return $this->hasOne('App\Models\Toko');
    }
    public function chat()
    {
        return $this->hasMany('App\Models\Chat');
    }
    public function Tarik()
    {
        return $this->hasMany('App\Models\Tarik');
    }
}

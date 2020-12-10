<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
  protected $fillable = [
    'nama_toko',
    'deskripsi_toko',
    'verif',
    'user_id',
    'jne',
    'pos',
    'tiki',
    'wahana',
    'jnt',
    'sicepat',
  ];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function ktp()
    {
        return $this->hasOne('App\Models\Ktp');
    }
    public function produk()
    {
        return $this->hasMany('App\Models\Produk');
    }
    public function Chat()
    {
        return $this->hasMany('App\Models\Chat');
    }
    public function mutasi()
    {
        return $this->hasMany('App\Models\Mutasi');
    }
}

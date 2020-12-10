<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
      'kurir',
      'harga',
      'hargakurir',
      'bank',
      'produk_id',
      'status',
      'user_id',
      'resi',
    ];
    use HasFactory;

    public function produk(){
      return $this->belongsTo('App\Models\Produk');
    }
    public function user(){
      return $this->belongsTo('App\Models\User');
    }
    public function pembayaran(){
      return $this->hasMany('App\Models\Buktipembayaran');
    }
    public function komplain(){
      return $this->hasOne('App\Models\Komplain');
    }
    public function Mutasi()
    {
        return $this->hasMany('App\Models\Mutasi');
    }
}

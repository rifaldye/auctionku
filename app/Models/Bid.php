<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable = [
      'nominal',
      'produk_id',
      'user_id',
    ];
    use HasFactory;

    public function produk(){
      return $this->belongsTo('App\Models\Produk');
    }
    public function user(){
      return $this->belongsTo('App\Models\User');
    }
}

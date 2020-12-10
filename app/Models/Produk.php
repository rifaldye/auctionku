<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
  protected $fillable = [
    'toko_id',
    'slug',
    'judul',
    'kategori_id',
    'deskripsi',
    'early',
    'bin',
    'berat',
    'end_at',
  ];
    use HasFactory;
    public function kategori(){
      return $this->belongsTo('App\Models\Kategori');
    }
    public function toko(){
      return $this->belongsTo('App\Models\Toko');
    }
    public function gambar(){
      return $this->hasMany('App\Models\Gambar');
    }
    public function bid(){
      return $this->hasMany('App\Models\Bid');
    }
    public function tag(){
      return $this->hasMany('App\Models\Tag');
    }
    public function invoice(){
      return $this->hasone('App\Models\Invoice');
    }
}

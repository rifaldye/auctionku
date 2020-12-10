<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
  protected $fillable = [
      'nama',
  ];
    use HasFactory;

    public function alamat()
    {
        return $this->hasMany('App\Models\Alamat');
    }
    public function kota()
    {
        return $this->hasMany('App\Models\Kota');
    }
}

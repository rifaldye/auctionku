<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
   protected $fillable = [
     'provinsi_id',
     'tipe',
     'nama',
     'pos'
   ];
    use HasFactory;
    public function provinsi()
    {
        return $this->belongsTo('App\Models\Provinsi');
    }
}

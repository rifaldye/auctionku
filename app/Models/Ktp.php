<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ktp extends Model
{
  protected $fillable = [
      'foto1',
      'foto2',
      'tolak',
      'status',
      'toko_id',
  ];
    use HasFactory;

    public function toko()
    {
        return $this->belongsTo('App\Models\Toko');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alamat extends Model
{
  protected $fillable = [
    'provinsi_id',
    'kota_id',
    'alamat_lengkap',
    'kode_pos',
    'user_id',
  ];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function kota()
    {
        return $this->belongsTo('App\Models\Kota');
    }
    public function provinsi()
    {
        return $this->belongsTo('App\Models\Provinsi');
    }
}

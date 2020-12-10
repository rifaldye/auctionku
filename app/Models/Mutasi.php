<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    protected  $fillable = [
      'user_id',
      'toko_id',
      'invoice_id',
      'jenis',
      'nominal'
    ];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function toko()
    {
        return $this->belongsTo('App\Models\Toko');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Models\Invoice');
    }
}

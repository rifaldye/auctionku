<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buktipembayaran extends Model
{
    protected $fillable = [
      'gambar',
      'invoice_id',
      'detail'
    ];
    use HasFactory;

    public function invoice(){
      return $this->belongsTo('App\Models\Invoice');
    }
}

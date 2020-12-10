<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
      'nama',
      'produk_id'
    ];
    use HasFactory;

    public function produk(){
      return $this->BelongsTo('App\Models\Produk');
    }
}

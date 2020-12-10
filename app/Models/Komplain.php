<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komplain extends Model
{
    protected $fillable = [
      'invoice_id',
      'bukti',
      'deskripsi',
      'status',
    ];
    use HasFactory;
    public function invoice(){
      return $this->belongsTo('App\Models\Invoice');
    }
}

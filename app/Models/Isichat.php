<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Isichat extends Model
{
    protected $fillable = [
      'chat_id',
      'pengirim',
      'isi'
    ];
    use HasFactory;

    public function isi()
    {
        return $this->belongsTo('App\Models\Chat');
    }
}

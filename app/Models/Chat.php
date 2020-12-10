<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
      'user_id',
      'toko_id'
    ];
    use HasFactory;

    public function isi()
    {
        return $this->hasMany('App\Models\Isichat');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function toko()
    {
        return $this->belongsTo('App\Models\Toko');
    }
}

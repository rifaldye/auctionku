<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarik extends Model
{
    protected $fillable = [
      'user_id',
      'bank',
      'norek',
      'nama',
      'nominal',
      'status'
    ];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}

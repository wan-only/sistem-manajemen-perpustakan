<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $fillable = [
        'name',
    ];
     public function buku()
    {
        return $this->hasMany(Buku::class);
    }
}

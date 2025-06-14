<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_penerbit',
        'stok',
        'kategori_id',
    ];
     public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pengembalian extends Model
{
    protected $fillable = [
        'peminjaman_id',
        'tanggal_kembali',
        'denda',
    
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function buku()
    {

        return $this->belongsTo(buku::class);
        
    }
}

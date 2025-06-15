<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    protected $fillable = [
        'buku_id',
        'user_id',
        'tanggal_peminjaman',
        'tanggal_kembali',
        'status',
    ];
    public function user()
{
    return $this->belongsTo(User::class);
}
 public function buku()
{
    return $this->belongsTo(buku::class);
}
}

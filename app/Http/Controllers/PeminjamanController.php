<?php

namespace App\Http\Controllers;

use App\Models\peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller

{
    // CREATE
    public function create(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:bukus,id',
            'tanggal_peminjaman' => 'required|string|min:3|max:50',
            'tanggal_kembali' => 'required|string|min:3|max:50',
            'status' => 'required|string|min:3|max:50'
        ]);

        $peminjaman = peminjaman::create($validated);

        return response()->json([
            "status" => "success",
            "message" => "Kategori berhasil dibuat",
            "data" => [
                'id' => $peminjaman->id,
                'buku_id' => $peminjaman->buku_id,
                'user_id' => $peminjaman->user_id,
                'user_name' => $peminjaman->user ? $peminjaman->user->name : null,
                'judul_buku' => $peminjaman->buku ? $peminjaman->buku->judul : null,
                'tanggal_peminjaman' => $peminjaman->tanggal_peminjaman,
                'tanggal_kembali' => $peminjaman->tanggal_kembali, // huruf kecil sesuai kolom
                'status' => $peminjaman->status,
            ]
        ], 201);
    }

    // READ ALL
   public function getAll()
{
    $data = peminjaman::all();

    if ($data->isEmpty()) {
        return response()->json([
            "status" => "error",
            "message" => "Data tidak ditemukan",
            "data" => null
        ], 404);
    }

    return response()->json([
        "status" => "success",
        "message" => "Data berhasil diambil",
        "data" => $data
    ], 200);
}


    // READ BY ID
    public function getId($id)
    {
        $data = peminjaman::find($id);

        if (!$data) {
            return response()->json([
                "status" => "error",
                'message' => 'Kategori tidak ditemukan',
                "data" => null
            ], 404);
        }

        return response()->json([
            "status" => "success",
            'message' => 'Kategori berhasil ditemukan',
            "data" => $data
        ], 200);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $peminjaman = peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json([
                "status" => "error",
                'message' => 'Kategori tidak ditemukan',
                "data" => null
            ], 404);
        }

            $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:bukus,id',
            'tanggal_peminjaman' => 'required|string|min:3|max:50',
            'tanggal_kembali' => 'required|string|min:3|max:50',
            'status' => 'required|string|min:3|max:50'
        ]);

        $peminjaman->update($validated);

        return response()->json([
            "status" => "success",
            'message' => 'Kategori berhasil diupdate',
            "data" => $peminjaman
        ], 200);
    }

    // DELETE
    public function delete($id)
    {
        $peminjaman = peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json([
                "status" => "error",
                'message' => 'Kategori tidak ditemukan',
                "data" => null
            ], 404);
        }

        $peminjaman->delete();

        return response()->json([
            "status" => "success",
            'message' => 'Kategori berhasil dihapus',
            "data" => null
        ], 205);
    }
}

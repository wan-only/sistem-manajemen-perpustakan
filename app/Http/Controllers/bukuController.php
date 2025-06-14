<?php

namespace App\Http\Controllers;

use App\Models\buku;
use Illuminate\Http\Request;

class bukuController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|min:3|max:50',
            'penulis' => 'required|string|min:3|max:50',
            'penerbit' => 'required|string|min:3|max:50',
            'tahun_penerbit' => 'required|digits:4|integer',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $kategori = buku::create($validated);

        return response()->json([
            "status" => "success",
            'message' => 'buku berhasil ditambahkan',
            "data" => $kategori
        ], 201);
    }

    // READ ALL
    public function getAll()
    {
        $data = buku::all();

        return response()->json([
            "status" => "success",
            'message' => 'Data buku berhasil diambil',
            "data" => $data
        ], 200);
    }

    // READ BY ID
    public function getId($id)
    {
        $data = buku::find($id);

        if (!$data) {
            return response()->json([
                "status" => "error",
                'message' => 'buku tidak ditemukan',
                "data" => null
            ], 404);
        }

        return response()->json([
            "status" => "success",
            'message' => 'buku berhasil ditemukan',
            "data" => $data
        ], 200);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $kategori = buku::find($id);

        if (!$kategori) {
            return response()->json([
                "status" => "error",
                'message' => 'buku tidak ditemukan',
                "data" => null
            ], 404);
        }

        $validated = $request->validate([
            'judul' => 'string|min:3|max:50',
            'penulis' => 'string|min:3|max:50',
            'penerbit' => 'string|min:3|max:50',
            'tahun_penerbit' => 'digits:4|integer',
            'stok' => 'integer|min:0',
            'kategori_id' => 'exists:kategoris,id',
        ]);

        $kategori->update($validated);

        return response()->json([
            "status" => "success",
            'message' => 'daftar buku berhasil diupdate',
            "data" => $kategori
        ], 200);
    }

    // DELETE
    public function delete($id)
    {
        $kategori = buku::find($id);

        if (!$kategori) {
            return response()->json([
                "status" => "error",
                'message' => 'buku tidak ditemukan',
                "data" => null
            ], 404);
        }

        $kategori->delete();

        return response()->json([
            "status" => "success",
            'message' => 'buku berhasil dihapus',
            "data" => null
        ], 200);
    }
}

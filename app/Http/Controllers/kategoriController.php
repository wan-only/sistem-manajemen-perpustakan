<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;

class kategoriController extends Controller
{
    // CREATE
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:50',
        ]);

        $kategori = kategori::create($validated);

        return response()->json([
            "status" => "successs",
            'message' => 'Kategori berhasil dibuat',
            "data" => $kategori
        ], 201);
    }

    // READ ALL
    public function getAll()
    {
        $data = kategori::all();

        return response()->json([
            "status" => "success",
            'message' => 'Data kategori berhasil diambil',
            "data" => $data
        ], 200);
    }

    // READ BY ID
    public function getId($id)
    {
        $data = kategori::find($id);

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
        $kategori = kategori::find($id);

        if (!$kategori) {
            return response()->json([
                "status" => "error",
                'message' => 'Kategori tidak ditemukan',
                "data" => null
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|min:3|max:50',
        ]);

        $kategori->update($validated);

        return response()->json([
            "status" => "success",
            'message' => 'Kategori berhasil diupdate',
            "data" => $kategori
        ], 200);
    }

    // DELETE
    public function delete($id)
    {
        $kategori = kategori::find($id);

        if (!$kategori) {
            return response()->json([
                "status" => "error",
                'message' => 'Kategori tidak ditemukan',
                "data" => null
            ], 404);
        }

        $kategori->delete();

        return response()->json([
            "status" => "success",
            'message' => 'Kategori berhasil dihapus',
            "data" => null
        ], 200);
    }
}

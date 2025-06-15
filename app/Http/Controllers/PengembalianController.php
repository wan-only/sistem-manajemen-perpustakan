<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    // CREATE
    public function create(Request $request)
    {
        $validated = $request->validate([
            
            'peminjaman_id' => 'required|exists:peminjamen,id',
            'tanggal_kembali' => 'required|date',
            'denda' => 'required|integer'
        ]);

        $pengembalian = Pengembalian::create($validated);

        return response()->json([
            "status" => "success",
            "message" => "Pengembalian berhasil disimpan",
            "data" => [
                'id' => $pengembalian->id,
                'peminjaman_id' => $pengembalian->peminjaman_id,
                'tanggal_kembali' => $pengembalian->tanggal_kembali,
                'denda' => $pengembalian->denda,
              
            ]
        ], 201);
    }

    // READ ALL
    public function getAll()
    {
        $data = Pengembalian::with(['peminjaman.user', 'peminjaman.buku'])->get();

        return response()->json([
            "status" => "success",
            "message" => "Daftar Pengembalian",
            "data" => $data
        ], 200);
    }

    // READ BY ID
    public function getId($id)
    {
        $pengembalian = Pengembalian::with(['peminjaman.user', 'peminjaman.buku'])->find($id);

        if (!$pengembalian) {
            return response()->json([
                "status" => "error",
                "message" => "Pengembalian tidak ditemukan",
                "data" => null
            ], 404);
        }

        return response()->json([
            "status" => "success",
            "message" => "Pengembalian ditemukan",
            "data" => $pengembalian
        ], 200);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $pengembalian = Pengembalian::find($id);

        if (!$pengembalian) {
            return response()->json([
                "status" => "error",
                "message" => "Pengembalian tidak ditemukan",
                "data" => null
            ], 404);
        }

        $validated = $request->validate([
            'peminjaman_id' => 'sometimes|exists:peminjamen,id',
            'tanggal_kembali' => 'sometimes|date',
            'denda' => 'sometimes|integer'
        ]);

        $pengembalian->update($validated);

        return response()->json([
            "status" => "success",
            "message" => "Pengembalian berhasil diupdate",
            "data" => $pengembalian
        ], 200);
    }

    // DELETE
    public function delete($id)
    {
        $pengembalian = Pengembalian::find($id);

        if (!$pengembalian) {
            return response()->json([
                "status" => "error",
                "message" => "Pengembalian tidak ditemukan",
                "data" => null
            ], 404);
        }

        $pengembalian->delete();

        return response()->json([
            "status" => "success",
            "message" => "Pengembalian berhasil dihapus",
            "data" => null
        ], 200);
    }
}

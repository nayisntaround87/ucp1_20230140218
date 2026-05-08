<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::withCount('products')->get();

        return response()->json([
            'message' => 'Data category berhasil diambil',
            'data' => $kategoris
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = Kategori::create($validated);

        return response()->json([
            'message' => 'Category berhasil ditambahkan',
            'data' => $kategori
        ], 201);
    }

    public function show($id)
    {
        $kategori = Kategori::with('products')->find($id);

        if (!$kategori) {
            return response()->json([
                'message' => 'Category tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Detail category berhasil diambil',
            'data' => $kategori
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json([
                'message' => 'Category tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori->update($validated);

        return response()->json([
            'message' => 'Category berhasil diperbarui',
            'data' => $kategori
        ], 200);
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json([
                'message' => 'Category tidak ditemukan'
            ], 404);
        }

        $kategori->delete();

        return response()->json([
            'message' => 'Category berhasil dihapus'
        ], 200);
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function index()
    {
        $products = Product::with('kategori')->get();

        return response()->json([
            'message' => 'Data product berhasil diambil',
            'data' => $products
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_product' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $product = Product::create($validated);

        return response()->json([
            'message' => 'Product berhasil ditambahkan',
            'data' => $product
        ], 201);
    }

    public function show($id)
    {
        $product = Product::with('kategori')->find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Detail product berhasil diambil',
            'data' => $product
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'nama_product' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $product->update($validated);

        return response()->json([
            'message' => 'Product berhasil diperbarui',
            'data' => $product
        ], 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product tidak ditemukan'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product berhasil dihapus'
        ], 200);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScanController extends Controller
{
    /**
     * Menampilkan halaman scanner barcode/QR code.
     */
    public function scanKode()
    {
        return view('scankode'); // Pastikan ada file resources/views/scankode.blade.php
    }

    /**
     * Memproses data hasil pemindaian yang dikirim melalui POST.
     */
    public function processScanProduk(Request $request)
{
    // Validasi input
    $request->validate([
        'code' => 'required|string',
    ]);

    // Ambil input kode
    $code = $request->input('code');

    // Cari produk berdasarkan SKU
    $product = Product::where('sku', $code)->first();

    if ($product) {
        return response()->json([
            'success' => true,
            'code' => $code,
            'product' => [
                'name' => $product->name,
                'sku' => $product->sku,
                'price' => $product->price,
                'description' => $product->description,
                'image' => $product->image,
            ],
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Produk tidak ditemukan.',
        'code' => $code,
    ]);
}


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ScanController extends Controller
{
    public function scanKode()
    {
        return view('scankode');
    }

    public function processScan(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $scanData = $request->input('code');
        $product = Product::where('sku', $scanData)->first();

        if ($product) {
            return response()->json([
                'success' => true,
                'code' => $scanData,
                'product' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'sku' => $product->sku,
                    'price' => $product->price,
                    'description' => $product->description,
                    'image' => $product->image_url
                ]
            ]);
        } else {
            return response()->json([
                'success' => false,
                'code' => $scanData,
                'message' => 'Produk tidak ditemukan.'
            ], 404);
        }
    }

    public function scanDataProduk()
    {
        return view('scandataproduk');
    }

    public function processScanProduk(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $code = $request->input('code');
        $product = Product::where('sku', $code)->orWhere('id', $code)->first();

        if ($product) {
            return response()->json([
                'success' => true,
                'code' => $code,
                'product' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'sku' => $product->sku,
                    'price' => $product->price,
                    'description' => $product->description,
                    'image' => $product->image_url,
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Produk tidak ditemukan.',
            'code' => $code
        ], 404);
    }

    // New method to get camera permissions status
    public function checkCameraPermission()
    {
        return response()->json([
            'hasPermission' => $this->checkBrowserCameraSupport()
        ]);
    }

    private function checkBrowserCameraSupport()
    {
        return !!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia);
    }
}
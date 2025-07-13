<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Product API Routes
Route::apiResource('products', ProductController::class);

// Additional API routes for QR functionality
Route::post('/scan-qr', function(Request $request) {
    $code = $request->input('code');
    $product = \App\Models\Product::where('sku', $code)->first();
    
    if ($product) {
        return response()->json([
            'success' => true,
            'product' => $product
        ]);
    }
    
    return response()->json([
        'success' => false,
        'message' => 'Product not found'
    ], 404);
});
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Makanan;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        // Validate required parameters
        $request->validate([
            'name' => 'required|string',
            'stock' => 'required|integer|min:1',
            'buyPrice' => 'required|numeric|min:0',
            'sellPrice' => 'required|numeric|min:0',
            'expiry' => 'required|string',
        ]);

        return view('checkout', [
            'itemData' => [
                'name' => $request->name,
                'stock' => $request->stock,
                'buyPrice' => $request->buyPrice,
                'sellPrice' => $request->sellPrice,
                'expiry' => $request->expiry,
            ]
        ]);
    }

    public function processOrder(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'item_name' => 'required|string',
                'quantity' => 'required|integer|min:1',
                'payment_method' => 'required|string',
                'total_price' => 'required|numeric|min:0',
            ]);            // Find the item in database
            $makanan = Makanan::where('nama_barang', $request->item_name)->first();

            if (!$makanan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Makanan tidak ditemukan'
                ], 404);
            }

            // Check if stock is sufficient
            if ($makanan->stok < $request->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok tidak mencukupi. Stok tersedia: ' . $makanan->stok
                ], 400);
            }

            // Use transaction to ensure data consistency
            DB::beginTransaction();

            try {
                // Update stock
                $makanan->stok -= $request->quantity;
                $makanan->save();

                // Here you could also create an order record if you have an orders table
                // For now, we'll just update the stock

                DB::commit();                return response()->json([
                    'success' => true,
                    'message' => 'Pesanan berhasil diproses',
                    'data' => [
                        'item_name' => $makanan->nama_barang,
                        'quantity' => $request->quantity,
                        'total_price' => $request->total_price,
                        'payment_method' => $request->payment_method,
                        'remaining_stock' => $makanan->stok,
                        'order_date' => now()->format('l, d M Y'),
                    ]
                ]);

            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getItemStock(Request $request)
    {
        try {
            $request->validate([
                'item_name' => 'required|string'
            ]);

            $makanan = Makanan::where('nama_barang', $request->item_name)->first();

            if (!$makanan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Makanan tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'current_stock' => $makanan->stok
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}

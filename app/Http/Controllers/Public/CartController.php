<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'metode_bayar' => 'required|in:cash,transfer,qris',
            'items' => 'required|array|min:1',
            'items.*.produk_id' => 'required|exists:products,id',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $total = 0;
            $items = [];

            foreach ($validated['items'] as $item) {
                $product = Product::findOrFail($item['produk_id']);
                
                if ($product->stock < $item['jumlah']) {
                    return back()->withErrors(['items' => "Stok {$product->nama} tidak cukup. Stok tersedia: {$product->stock}"])->withInput();
                }

                $subtotal = $product->harga * $item['jumlah'];
                $total += $subtotal;

                $items[] = [
                    'produk_id' => $product->id,
                    'jumlah' => $item['jumlah'],
                    'harga' => $product->harga,
                    'subtotal' => $subtotal,
                ];
            }

            // Create transaction without user_id (guest transaction)
            $transaction = Transaction::create([
                'user_id' => null, // Guest transaction
                'nama_pelanggan' => $validated['nama_pelanggan'],
                'total' => $total,
                'metode_bayar' => $validated['metode_bayar'],
            ]);

            foreach ($items as $item) {
                TransactionDetail::create([
                    'transaksi_id' => $transaction->id,
                    'produk_id' => $item['produk_id'],
                    'jumlah' => $item['jumlah'],
                    'harga' => $item['harga'],
                ]);

                // Update stock
                $product = Product::find($item['produk_id']);
                $product->decrement('stock', $item['jumlah']);
            }

            DB::commit();

            return redirect()->route('public.products.index')
                ->with('success', 'Pesanan berhasil dibuat! ID Transaksi: #' . $transaction->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }
}


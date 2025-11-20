<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::latest()->paginate(10);
        return view('kasir.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::with('category')->where('stock', '>', 0)->get();
        return view('kasir.transactions.create', compact('products'));
    }

    public function store(Request $request)
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

            $transaction = Transaction::create([
                'user_id' => auth()->id(),
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

            return redirect()->route('kasir.transactions.show', $transaction)
                ->with('success', 'Transaksi berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['user', 'details.product']);
        return view('kasir.transactions.show', compact('transaction'));
    }

    public function print(Transaction $transaction)
    {
        $transaction->load(['user', 'details.product']);

        $pdf = Pdf::loadView('pdf.kasir-transaction', [
            'transaction' => $transaction,
            'kasir' => auth()->user(),
            'generatedAt' => now(),
        ])->setPaper('a5');

        return $pdf->download("transaksi-{$transaction->id}.pdf");
    }
}


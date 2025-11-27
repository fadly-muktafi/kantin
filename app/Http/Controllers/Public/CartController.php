<?php

namespace App\Http\Controllers\Public;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    private function getCartDetails()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        $item_count = 0;
        $menu_count = count($cart);

        foreach ($cart as $id => $details) {
            $total += $details['harga'] * $details['quantity'];
            $item_count += $details['quantity'];
        }

        return [
            'cart' => $cart,
            'total' => $total,
            'item_count' => $item_count,
            'menu_count' => $menu_count,
        ];
    }

    private function jsonResponse($message, $isSuccess = true)
    {
        $cartDetails = $this->getCartDetails();
        $cartHtml = view('public.products._cart-section', $cartDetails)->render();
        
        return response()->json([
            'success' => $isSuccess,
            'message' => $message,
            'cart_html' => $cartHtml,
            'item_count' => $cartDetails['item_count'],
            'menu_count' => $cartDetails['menu_count'],
        ]);
    }

    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        $errorMessage = 'Stok produk tidak mencukupi!';

        if(isset($cart[$product->id])) {
            if($cart[$product->id]['quantity'] < $product->stock) {
                $cart[$product->id]['quantity']++;
            } else {
                if ($request->ajax()) {
                    return response()->json(['success' => false, 'message' => $errorMessage], 422);
                }
                return redirect()->back()->with('error', $errorMessage);
            }
        } else {
            if($product->stock > 0) {
                $cart[$product->id] = [
                    "nama" => $product->nama,
                    "quantity" => 1,
                    "harga" => $product->harga,
                    "image_url" => $product->image_url
                ];
            } else {
                if ($request->ajax()) {
                    return response()->json(['success' => false, 'message' => $errorMessage], 422);
                }
                return redirect()->back()->with('error', $errorMessage);
            }
        }

        session()->put('cart', $cart);

        if ($request->ajax()) {
            return $this->jsonResponse('Produk berhasil ditambahkan ke keranjang!');
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity');

        if(isset($cart[$product->id]) && $quantity > 0) {
            if($product->stock >= $quantity) {
                $cart[$product->id]['quantity'] = $quantity;
                session()->put('cart', $cart);

                if($request->ajax()) {
                    return $this->jsonResponse('Jumlah produk berhasil diubah.');
                }
                return redirect()->back()->with('success', 'Jumlah produk berhasil diubah.');
            } else {
                if ($request->ajax()) {
                    return response()->json(['success' => false, 'message' => 'Stok produk tidak mencukupi.'], 422);
                }
                return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
            }
        }
        
        if ($request->ajax()) {
            return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan di keranjang.'], 404);
        }
        return redirect()->back()->with('error', 'Produk tidak ditemukan di keranjang.');
    }

    public function remove(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);

            if($request->ajax()) {
                return $this->jsonResponse('Produk berhasil dihapus dari keranjang.');
            }
            return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
        }

        if ($request->ajax()) {
            return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan di keranjang.'], 404);
        }
        return redirect()->back()->with('error', 'Produk tidak ditemukan di keranjang.');
    }

    public function clear(Request $request)
    {
        session()->forget('cart');
        
        if($request->ajax()) {
            return $this->jsonResponse('Keranjang berhasil dikosongkan.');
        }
        return redirect()->back()->with('success', 'Keranjang berhasil dikosongkan!');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'metode_bayar' => 'required|string|in:cash,qris',
        ]);

        $cart = session()->get('cart');

        if (!$cart) {
            return redirect()->route('public.products.index')->with('error', 'Keranjang Anda kosong.');
        }

        try {
            DB::beginTransaction();

            $total = 0;
            foreach ($cart as $id => $details) {
                $total += $details['harga'] * $details['quantity'];
            }

            $transaction = Transaction::create([
                'user_id' => auth()->check() ? auth()->id() : null,
                'nama_pelanggan' => $request->customer_name,
                'total' => $total,
                'metode_bayar' => $request->metode_bayar,
            ]);

            foreach ($cart as $id => $details) {
                $product = Product::find($id);
                if ($product->stock < $details['quantity']) {
                    throw new \Exception('Stok produk ' . $product->nama . ' tidak mencukupi.');
                }

                TransactionDetail::create([
                    'transaksi_id' => $transaction->id,
                    'produk_id' => $id,
                    'jumlah' => $details['quantity'],
                    'harga' => $details['harga'],
                ]);

                $product->decrement('stock', $details['quantity']);
            }

            DB::commit();

            session()->forget('cart');

            // Redirect to a success page
            return redirect()->route('public.checkout.success', $transaction->id)->with('success', 'Checkout berhasil! Terima kasih telah berbelanja.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat checkout: ' . $e->getMessage())->withInput();
        }
    }

    public function success(Transaction $transaction)
    {
        return view('public.checkout.success', compact('transaction'));
    }
}
<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'ulasan' => 'required|integer|min:1|max:5',
            'komen' => 'required|string|max:1000',
        ]);

        ProductReview::create([
            'produk_id' => $product->id,
            'nama_pelanggan' => $validated['nama_pelanggan'],
            'ulasan' => $validated['ulasan'],
            'komen' => $validated['komen'],
        ]);

        return redirect()->route('public.products.show', $product)
            ->with('success', 'Ulasan berhasil ditambahkan. Terima kasih!');
    }
}


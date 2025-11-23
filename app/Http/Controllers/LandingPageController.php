<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Category;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Ambil 8 produk terbaru untuk ditampilkan
        $products = Product::with(['category', 'reviews'])->latest()->take(9)->get();

        // Ambil semua kategori untuk filter menu
        $categories = Category::all();

        // Ambil 5 ulasan terbaru dengan rating tinggi
        $reviews = ProductReview::with('product')->where('ulasan', '>=', 4)->latest()->take(5)->get();

        return view('landing', compact('products', 'reviews', 'categories'));
    }
}
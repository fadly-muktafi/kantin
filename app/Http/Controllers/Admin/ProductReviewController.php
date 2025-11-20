<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function index()
    {
        $reviews = ProductReview::with('product')
            ->latest()
            ->paginate(10);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function show(ProductReview $review)
    {
        $review->load('product');
        return view('admin.reviews.show', compact('review'));
    }

    public function destroy(ProductReview $review)
    {
        $review->delete();

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review berhasil dihapus.');
    }
}


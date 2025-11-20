<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = Transaction::sum('total');
        
        $stats = [
            'total_users' => User::count(),
            'total_categories' => Category::count(),
            'total_products' => Product::count(),
            'total_transactions' => Transaction::count(),
            'total_revenue' => $totalRevenue ? $totalRevenue : 0,
            'low_stock_products' => Product::where('stock', '<', 10)->count(),
        ];

        $recent_transactions = Transaction::with('user')
            ->latest()
            ->take(5)
            ->get();

        $top_products = Product::with('category')
            ->where('stock', '<', 10)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_transactions', 'top_products'));
    }
}


<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KasirDashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();
        
        $stats = [
            'transaksi_hari_ini' => Transaction::whereDate('created_at', $today)->count(),
            'pendapatan_hari_ini' => Transaction::whereDate('created_at', $today)->sum('total') ?? 0,
            'transaksi_bulan_ini' => Transaction::where('created_at', '>=', $thisMonth)->count(),
            'pendapatan_bulan_ini' => Transaction::where('created_at', '>=', $thisMonth)->sum('total') ?? 0,
        ];

        $recent_transactions = Transaction::latest()
            ->take(5)
            ->get();

        return view('kasir.dashboard', compact('stats', 'recent_transactions'));
    }
}


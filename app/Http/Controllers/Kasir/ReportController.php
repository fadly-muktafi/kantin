<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $reportData = $this->generateReportData($request);

        return view('kasir.reports.index', $reportData);
    }

    public function exportPdf(Request $request)
    {
        $reportData = $this->generateReportData($request);

        $pdf = Pdf::loadView('pdf.kasir-report', array_merge($reportData, [
            'kasir' => auth()->user(),
            'generatedAt' => now(),
        ]))->setPaper('a4');

        $filename = "laporan-{$reportData['startDate']}-{$reportData['endDate']}.pdf";

        return $pdf->download($filename);
    }

    protected function generateReportData(Request $request): array
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));

        $transactions = Transaction::whereBetween('created_at', [
            Carbon::parse($startDate)->startOfDay(),
            Carbon::parse($endDate)->endOfDay()
        ])->latest()->get();

        $summary = [
            'total_transaksi' => $transactions->count(),
            'total_pendapatan' => $transactions->sum('total'),
            'total_produk_terjual' => TransactionDetail::whereIn('transaksi_id', $transactions->pluck('id'))
                ->sum('jumlah'),
        ];

        $metode_bayar = $transactions->groupBy('metode_bayar')->map(function ($group) {
            return [
                'count' => $group->count(),
                'total' => $group->sum('total'),
            ];
        });

        $topProducts = TransactionDetail::whereIn('transaksi_id', $transactions->pluck('id'))
            ->select('produk_id', DB::raw('sum(jumlah) as total_terjual'), DB::raw('sum(jumlah * harga) as total_pendapatan'))
            ->groupBy('produk_id')
            ->with('product')
            ->orderBy('total_terjual', 'desc')
            ->take(10)
            ->get();

        return compact(
            'transactions',
            'summary',
            'metode_bayar',
            'topProducts',
            'startDate',
            'endDate'
        );
    }
}


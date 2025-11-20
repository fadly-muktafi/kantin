<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan {{ $startDate }} - {{ $endDate }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 11px; color: #111827; }
        h1, h2 { margin: 0 0 8px 0; }
        .section { margin-bottom: 16px; }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th, td { border: 1px solid #d1d5db; padding: 6px; text-align: left; }
        th { background-color: #f3f4f6; text-transform: uppercase; font-size: 10px; }
        .summary-grid { width: 100%; margin-top: 8px; }
        .summary-grid td { width: 33%; padding: 6px; border: 1px solid #e5e7eb; background: #f9fafb; }
    </style>
</head>
<body>
    <div style="text-align: center; margin-bottom: 12px;">
        <h1>Laporan Penjualan Kantin Sekolah</h1>
        <p>Periode: {{ Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
        <p>Kasir: {{ $kasir->name }} | Dicetak: {{ $generatedAt->format('d M Y H:i') }}</p>
    </div>

    <div class="section">
        <h2>Ringkasan</h2>
        <table class="summary-grid">
            <tr>
                <td>
                    <strong>Total Transaksi</strong><br>
                    {{ $summary['total_transaksi'] }}
                </td>
                <td>
                    <strong>Total Pendapatan</strong><br>
                    Rp {{ number_format($summary['total_pendapatan'], 0, ',', '.') }}
                </td>
                <td>
                    <strong>Total Produk Terjual</strong><br>
                    {{ $summary['total_produk_terjual'] }}
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Metode Pembayaran</h2>
        <table>
            <thead>
                <tr>
                    <th>Metode</th>
                    <th>Jumlah Transaksi</th>
                    <th>Total Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($metode_bayar as $metode => $data)
                    <tr>
                        <td>{{ ucfirst($metode) }}</td>
                        <td>{{ $data['count'] }}</td>
                        <td>Rp {{ number_format($data['total'], 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align:center;">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>Produk Terlaris</h2>
        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Total Terjual</th>
                    <th>Total Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($topProducts as $item)
                    <tr>
                        <td>{{ $item->product->nama ?? '-' }}</td>
                        <td>{{ $item->total_terjual }}</td>
                        <td>Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align:center;">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>Daftar Transaksi</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                    <th>Metode</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                    <tr>
                        <td>#{{ $transaction->id }}</td>
                        <td>{{ $transaction->nama_pelanggan }}</td>
                        <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($transaction->metode_bayar) }}</td>
                        <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center;">Tidak ada transaksi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>


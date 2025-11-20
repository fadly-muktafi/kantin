<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Transaksi #{{ $transaction->id }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; color: #111827; }
        .header { text-align: center; margin-bottom: 16px; }
        .header h1 { font-size: 18px; margin: 0; }
        .meta { width: 100%; margin-bottom: 12px; }
        .meta td { padding: 4px 0; font-size: 12px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        .table th, .table td { border: 1px solid #d1d5db; padding: 6px; text-align: left; }
        .table th { background: #f3f4f6; font-size: 11px; text-transform: uppercase; }
        .table tfoot td { font-weight: bold; }
        .footer { margin-top: 20px; font-size: 11px; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Kantin Sekolah</h1>
        <p>Nota Transaksi #{{ $transaction->id }}</p>
    </div>

    <table class="meta">
        <tr>
            <td><strong>Tanggal</strong></td>
            <td>: {{ $transaction->created_at->format('d M Y H:i') }}</td>
        </tr>
        <tr>
            <td><strong>Kasir</strong></td>
            <td>: {{ $kasir->name }}</td>
        </tr>
        <tr>
            <td><strong>Pelanggan</strong></td>
            <td>: {{ $transaction->nama_pelanggan }}</td>
        </tr>
        <tr>
            <td><strong>Metode Bayar</strong></td>
            <td>: {{ strtoupper($transaction->metode_bayar) }}</td>
        </tr>
    </table>

    <table class="table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->details as $detail)
                <tr>
                    <td>{{ $detail->product->nama ?? '-' }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($detail->jumlah * $detail->harga, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="text-align:right;">Total</td>
                <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Dicetak pada {{ $generatedAt->format('d M Y H:i') }}</p>
        <p>Terima kasih telah berbelanja di Kantin Sekolah</p>
    </div>
</body>
</html>


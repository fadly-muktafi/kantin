@extends('layouts.public')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow-sm rounded-3xl p-8 border border-gray-200">
                <div class="text-center">
                    <svg class="w-16 h-16 text-emerald-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h1 class="mt-4 text-2xl sm:text-3xl font-bold text-gray-900">Checkout Berhasil!</h1>
                    <p class="mt-2 text-gray-600">Terima kasih telah berbelanja di Kantin kami. Pesanan Anda sedang diproses.</p>
                </div>

                <div class="mt-8 border-t border-gray-200 pt-8">
                    <h2 class="text-lg font-semibold text-gray-900">Detail Transaksi</h2>
                    <div class="mt-4 space-y-4">
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-700">ID Transaksi:</span>
                            <span class="text-gray-900 font-mono">#{{ $transaction->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-700">Nama Pelanggan:</span>
                            <span class="text-gray-900">{{ $transaction->nama_pelanggan }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-700">Tanggal Transaksi:</span>
                            <span class="text-gray-900">{{ $transaction->created_at->format('d F Y, H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-700">Metode Pembayaran:</span>
                            <span class="text-gray-900 font-semibold">{{ strtoupper($transaction->metode_bayar) }}</span>
                        </div>

                        @if ($transaction->metode_bayar == 'qris')
                        <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-xl text-center">
                            <p class="font-bold text-yellow-800 mb-2">Scan QR Code di bawah untuk Pembayaran</p>
                            <img src="{{ asset('images/QRIS.jpg') }}" alt="QRIS Code" class="mx-auto w-48 h-48 border border-gray-200 rounded-lg shadow-sm">
                            <p class="text-sm text-yellow-700 mt-2">Pastikan jumlah pembayaran sesuai dengan total.</p>
                            <p class="text-xs text-gray-500 mt-1">Silakan ganti placeholder ini dengan QRIS code asli Anda.</p>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="mt-8 border-t border-gray-200 pt-8">
                    <h3 class="text-lg font-semibold text-gray-900">Ringkasan Pesanan</h3>
                    <ul class="mt-4 space-y-3">
                        @foreach($transaction->details as $detail)
                        <li class="flex justify-between items-center">
                            <div>
                                <p class="font-medium text-gray-800">{{ $detail->product->nama }}</p>
                                <p class="text-sm text-gray-500">Qty: {{ $detail->jumlah }} x Rp {{ number_format($detail->harga, 0, ',', '.') }}</p>
                            </div>
                            <p class="font-semibold text-gray-800">Rp {{ number_format($detail->jumlah * $detail->harga, 0, ',', '.') }}</p>
                        </li>
                        @endforeach
                    </ul>
                    <div class="mt-6 border-t border-gray-200 pt-6 flex justify-between items-center">
                        <span class="text-lg font-bold text-gray-900">Total</span>
                        <span class="text-xl font-bold text-primary-600">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="mt-10 text-center">
                    <a href="{{ route('public.products.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-primary-600 text-white text-sm font-bold hover:bg-primary-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                        Kembali ke Halaman Produk
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

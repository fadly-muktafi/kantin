<x-kasir-layout>
    <x-slot name="header">Detail Transaksi</x-slot>

    <div class="bg-white rounded-lg shadow p-6 max-w-3xl">
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Transaksi</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <span class="text-sm font-medium text-gray-500">ID Transaksi:</span>
                    <span class="text-sm text-gray-900 ml-2">#{{ $transaction->id }}</span>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-500">Pelanggan:</span>
                    <span class="text-sm text-gray-900 ml-2">{{ $transaction->nama_pelanggan }}</span>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-500">Metode Bayar:</span>
                    <span class="text-sm text-gray-900 ml-2">{{ $transaction->metode_bayar }}</span>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-500">Tanggal:</span>
                    <span class="text-sm text-gray-900 ml-2">{{ $transaction->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Produk</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($transaction->details as $detail)
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $detail->product->nama ?? 'Produk tidak ditemukan' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $detail->jumlah }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-sm font-semibold text-gray-900">Rp {{ number_format($detail->jumlah * $detail->harga, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-3 text-center text-gray-500">Tidak ada detail</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="3" class="px-4 py-3 text-right text-sm font-semibold text-gray-900">Total:</td>
                            <td class="px-4 py-3 text-sm font-bold text-gray-900">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="flex justify-end flex-wrap gap-3">
            <a href="{{ route('kasir.transactions.print', $transaction) }}" class="px-4 py-2 bg-gradient-to-r from-primary-600 to-amber-500 text-white rounded-md hover:from-primary-700 hover:to-amber-600">
                Cetak PDF
            </a>
            <a href="{{ route('kasir.transactions.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                Kembali
            </a>
            <a href="{{ route('kasir.transactions.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Transaksi Baru
            </a>
        </div>
    </div>
</x-kasir-layout>


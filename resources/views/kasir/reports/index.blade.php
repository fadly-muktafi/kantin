<x-kasir-layout>
    <x-slot name="header">Laporan Penjualan</x-slot>

    <div class="mb-6 bg-white rounded-lg shadow p-6">
        <form method="GET" action="{{ route('kasir.reports.index') }}" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[220px]">
                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                <input type="date" name="start_date" id="start_date" value="{{ $startDate }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex-1 min-w-[220px]">
                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Akhir</label>
                <input type="date" name="end_date" id="end_date" value="{{ $endDate }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex items-center gap-3">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Filter
                </button>
                <a href="{{ route('kasir.reports.pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
                   class="px-4 py-2 bg-gradient-to-r from-primary-600 to-amber-500 text-white rounded-md hover:from-primary-700 hover:to-amber-600">
                    Cetak PDF
                </a>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-sm font-medium text-gray-600">Total Transaksi</p>
            <p class="text-2xl font-semibold text-gray-900">{{ $summary['total_transaksi'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-sm font-medium text-gray-600">Total Pendapatan</p>
            <p class="text-2xl font-semibold text-gray-900">Rp {{ number_format($summary['total_pendapatan'], 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-sm font-medium text-gray-600">Total Produk Terjual</p>
            <p class="text-2xl font-semibold text-gray-900">{{ $summary['total_produk_terjual'] }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Metode Pembayaran -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Metode Pembayaran</h3>
            </div>
            <div class="p-6">
                @if($metode_bayar->count() > 0)
                    <div class="space-y-3">
                        @foreach($metode_bayar as $metode => $data)
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700 capitalize">{{ $metode }}</span>
                                <div class="text-right">
                                    <p class="text-sm font-semibold text-gray-900">{{ $data['count'] }} transaksi</p>
                                    <p class="text-sm text-gray-500">Rp {{ number_format($data['total'], 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">Tidak ada data</p>
                @endif
            </div>
        </div>

        <!-- Top Products -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Produk Terlaris</h3>
            </div>
            <div class="p-6">
                @if($topProducts->count() > 0)
                    <div class="space-y-3">
                        @foreach($topProducts as $item)
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $item->product->nama ?? 'Produk tidak ditemukan' }}</p>
                                    <p class="text-xs text-gray-500">Terjual: {{ $item->total_terjual }}</p>
                                </div>
                                <p class="text-sm font-semibold text-gray-900">Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">Tidak ada data</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Daftar Transaksi -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Daftar Transaksi</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Metode Bayar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($transactions as $transaction)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $transaction->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $transaction->nama_pelanggan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">{{ $transaction->metode_bayar }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada transaksi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-kasir-layout>


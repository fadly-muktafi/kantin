<x-kasir-layout>
    <x-slot name="header">Dashboard Kasir</x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Transaksi Hari Ini -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl transition-shadow p-6 border border-gray-100 dark:border-slate-700">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-blue-900/40 dark:to-indigo-900/40 text-blue-600 dark:text-blue-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Transaksi Hari Ini</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $stats['transaksi_hari_ini'] }}</p>
                </div>
            </div>
        </div>

        <!-- Pendapatan Hari Ini -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl transition-shadow p-6 border border-gray-100 dark:border-slate-700">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900/40 dark:to-emerald-900/40 text-green-600 dark:text-green-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Pendapatan Hari Ini</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">Rp {{ number_format($stats['pendapatan_hari_ini'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- Transaksi Bulan Ini -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl transition-shadow p-6 border border-gray-100 dark:border-slate-700">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-gradient-to-br from-purple-100 to-pink-100 dark:from-purple-900/40 dark:to-pink-900/40 text-purple-600 dark:text-purple-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Transaksi Bulan Ini</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $stats['transaksi_bulan_ini'] }}</p>
                </div>
            </div>
        </div>

        <!-- Pendapatan Bulan Ini -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl transition-shadow p-6 border border-gray-100 dark:border-slate-700">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-gradient-to-br from-yellow-100 to-amber-100 dark:from-yellow-900/40 dark:to-amber-900/40 text-yellow-600 dark:text-yellow-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Pendapatan Bulan Ini</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">Rp {{ number_format($stats['pendapatan_bulan_ini'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Transactions -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-slate-700 bg-gradient-to-r from-primary-50 to-amber-50 dark:from-slate-800 dark:to-slate-800 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Transaksi Terbaru</h3>
                <a href="{{ route('kasir.transactions.create') }}" class="bg-gradient-to-r from-primary-600 to-amber-500 hover:from-primary-700 hover:to-amber-600 text-white px-4 py-2 rounded-xl text-sm font-medium shadow-sm transition-all">
                    + Transaksi Baru
                </a>
            </div>
            <div class="p-6">
                @if($recent_transactions->count() > 0)
                    <div class="space-y-4">
                        @foreach($recent_transactions as $transaction)
                            <div class="flex items-center justify-between pb-4 border-b border-gray-200 dark:border-slate-700 last:border-0 last:pb-0">
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $transaction->nama_pelanggan }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $transaction->created_at->format('d M Y, H:i') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-gray-900 dark:text-white">Rp {{ number_format($transaction->total, 0, ',', '.') }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 capitalize">{{ $transaction->metode_bayar }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 dark:text-gray-400 text-center py-4">Tidak ada transaksi</p>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-slate-700 bg-gradient-to-r from-primary-50 to-amber-50 dark:from-slate-800 dark:to-slate-800">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Quick Actions</h3>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    <a href="{{ route('kasir.transactions.create') }}" class="block w-full bg-gradient-to-r from-primary-600 to-amber-500 hover:from-primary-700 hover:to-amber-600 text-white px-4 py-3 rounded-xl text-center font-medium shadow-sm transition-all">
                        Buat Transaksi Baru
                    </a>
                    <a href="{{ route('kasir.transactions.index') }}" class="block w-full bg-gray-100 dark:bg-slate-700 hover:bg-gray-200 dark:hover:bg-slate-600 text-gray-800 dark:text-gray-200 px-4 py-3 rounded-xl text-center font-medium transition-all">
                        Lihat Semua Transaksi
                    </a>
                    <a href="{{ route('kasir.reports.index') }}" class="block w-full bg-gray-100 dark:bg-slate-700 hover:bg-gray-200 dark:hover:bg-slate-600 text-gray-800 dark:text-gray-200 px-4 py-3 rounded-xl text-center font-medium transition-all">
                        Lihat Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-kasir-layout>

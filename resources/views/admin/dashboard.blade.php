<x-admin-layout>
    <x-slot name="header">Dashboard</x-slot>

    @if($stats['total_categories'] == 0 || $stats['total_products'] == 0)
        <div class="mb-6 bg-gradient-to-r from-primary-50 to-amber-50 dark:from-primary-900/20 dark:to-amber-900/20 border border-primary-200 dark:border-primary-800 rounded-2xl p-6 shadow-sm">
            <div class="flex items-start justify-between">
                <div class="flex items-start">
                    <div class="p-2 rounded-xl bg-gradient-to-br from-primary-100 to-amber-100 dark:from-primary-800 dark:to-amber-800 mr-3 mt-1">
                        <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Selamat Datang di Admin Panel!</h3>
                        <p class="text-gray-700 dark:text-gray-300 mt-1">Mulai dengan menambahkan kategori dan produk untuk memulai.</p>
                    </div>
                </div>
                <div class="flex space-x-2">
                    @if($stats['total_categories'] == 0)
                        <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 bg-gradient-to-r from-primary-600 to-amber-500 text-white rounded-xl hover:from-primary-700 hover:to-amber-600 text-sm font-medium shadow-sm transition-all">
                            + Tambah Kategori
                        </a>
                    @endif
                    @if($stats['total_products'] == 0)
                        <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-gradient-to-r from-primary-600 to-amber-500 text-white rounded-xl hover:from-primary-700 hover:to-amber-600 text-sm font-medium shadow-sm transition-all">
                            + Tambah Produk
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Total Users -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl transition-shadow p-6 border border-gray-100 dark:border-slate-700">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-gradient-to-br from-primary-100 to-amber-100 dark:from-primary-900/40 dark:to-amber-900/40 text-primary-600 dark:text-primary-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Users</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $stats['total_users'] }}</p>
                </div>
            </div>
        </div>

        <!-- Total Categories -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl transition-shadow p-6 border border-gray-100 dark:border-slate-700">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900/40 dark:to-emerald-900/40 text-green-600 dark:text-green-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Kategori</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $stats['total_categories'] }}</p>
                </div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl transition-shadow p-6 border border-gray-100 dark:border-slate-700">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-gradient-to-br from-purple-100 to-pink-100 dark:from-purple-900/40 dark:to-pink-900/40 text-purple-600 dark:text-purple-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Produk</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $stats['total_products'] }}</p>
                </div>
            </div>
        </div>

        <!-- Total Transactions -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl transition-shadow p-6 border border-gray-100 dark:border-slate-700">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-gradient-to-br from-yellow-100 to-amber-100 dark:from-yellow-900/40 dark:to-amber-900/40 text-yellow-600 dark:text-yellow-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Transaksi</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $stats['total_transactions'] }}</p>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl transition-shadow p-6 border border-gray-100 dark:border-slate-700">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-gradient-to-br from-indigo-100 to-blue-100 dark:from-indigo-900/40 dark:to-blue-900/40 text-indigo-600 dark:text-indigo-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Pendapatan</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- Low Stock Products -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl transition-shadow p-6 border border-gray-100 dark:border-slate-700">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-gradient-to-br from-red-100 to-rose-100 dark:from-red-900/40 dark:to-rose-900/40 text-red-600 dark:text-red-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Produk Stok Rendah</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $stats['low_stock_products'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Transactions -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-slate-700 bg-gradient-to-r from-primary-50 to-amber-50 dark:from-slate-800 dark:to-slate-800">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Transaksi Terbaru</h3>
            </div>
            <div class="p-6">
                @if($recent_transactions->count() > 0)
                    <div class="space-y-4">
                        @foreach($recent_transactions as $transaction)
                            <div class="flex items-center justify-between pb-4 border-b border-gray-200 dark:border-slate-700 last:border-0 last:pb-0">
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $transaction->nama_pelanggan ?? ($transaction->user->name ?? 'Guest') }}</p>
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

        <!-- Low Stock Products -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-slate-700 bg-gradient-to-r from-primary-50 to-amber-50 dark:from-slate-800 dark:to-slate-800">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Produk Stok Rendah</h3>
            </div>
            <div class="p-6">
                @if($top_products->count() > 0)
                    <div class="space-y-4">
                        @foreach($top_products as $product)
                            <div class="flex items-center justify-between pb-4 border-b border-gray-200 dark:border-slate-700 last:border-0 last:pb-0">
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $product->nama }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $product->category->nama ?? 'Tidak ada kategori' }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->stock < 5 ? 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300' : 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300' }}">
                                        Stok: {{ $product->stock }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 dark:text-gray-400 text-center py-4">Semua produk memiliki stok cukup</p>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>


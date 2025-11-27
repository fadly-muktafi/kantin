<x-kasir-layout>
    <x-slot name="header">Daftar Transaksi</x-slot>

    <div class="mb-4 flex flex-col sm:flex-row justify-between sm:items-center gap-4">
        <div>
            <div class="sm:hidden">
                <label for="tabs" class="sr-only">Select a tab</label>
                <select id="tabs" name="tabs" onchange="window.location = this.value;" class="block w-full rounded-md border-gray-300 focus:border-primary-500 focus:ring-primary-500">
                    <option value="{{ route('kasir.transactions.index') }}" {{ $active_status == 'all' ? 'selected' : '' }}>Semua</option>
                    <option value="{{ route('kasir.transactions.index', ['status' => 'pending']) }}" {{ $active_status == 'pending' ? 'selected' : '' }}>Tertunda</option>
                    <option value="{{ route('kasir.transactions.index', ['status' => 'paid']) }}" {{ $active_status == 'paid' ? 'selected' : '' }}>Lunas</option>
                </select>
            </div>
            <div class="hidden sm:block">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <a href="{{ route('kasir.transactions.index') }}" class="{{ $active_status == 'all' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Semua
                        </a>
                        <a href="{{ route('kasir.transactions.index', ['status' => 'pending']) }}" class="{{ $active_status == 'pending' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Tertunda
                            @php
                                $pending_count = \App\Models\Transaction::where('status', 'pending')->count();
                            @endphp
                            @if ($pending_count > 0)
                                <span class="ml-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    {{ $pending_count }}
                                </span>
                            @endif
                        </a>
                        <a href="{{ route('kasir.transactions.index', ['status' => 'paid']) }}" class="{{ $active_status == 'paid' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Lunas
                        </a>
                    </nav>
                </div>
            </div>
        </div>
        <a href="{{ route('kasir.transactions.create') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg shadow-sm font-medium">
            + Transaksi Baru
        </a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm overflow-hidden border border-gray-100 dark:border-slate-700">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700">
                <thead class="bg-gray-50 dark:bg-slate-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Metode Bayar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal</th>
                        <th class="relative px-6 py-3">
                            <span class="sr-only">Aksi</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-slate-600">
                    @forelse($transactions as $transaction)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">#{{ $transaction->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $transaction->nama_pelanggan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-white">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 capitalize">{{ $transaction->metode_bayar }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($transaction->status == 'pending')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Tertunda
                                    </span>
                                @elseif($transaction->status == 'paid')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Lunas
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Dibatalkan
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                @if($transaction->status == 'pending')
                                <form action="{{ route('kasir.transactions.confirm', $transaction) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-900 font-semibold">Konfirmasi</button>
                                </form>
                                <span class="mx-1 text-gray-300">|</span>
                                @endif
                                <a href="{{ route('kasir.transactions.show', $transaction) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                Tidak ada transaksi yang cocok dengan filter ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $transactions->links() }}
    </div>
</x-kasir-layout>


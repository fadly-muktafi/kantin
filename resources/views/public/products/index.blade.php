@extends('layouts.public')

@section('content')
<div class="bg-gray-50">
    <!-- Hero / Filters -->
    <section class="relative bg-slate-950 overflow-hidden">
        <div class="absolute inset-0 opacity-30" style="background-image: url('https://images.unsplash.com/photo-1466978913421-dad2ebd01d17?w=1600&q=80&auto=format&fit=crop'); background-size: cover;"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-900/90 to-slate-900"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-10">
            <div class="max-w-3xl text-white space-y-4">
                <p class="inline-flex items-center gap-2 text-xs font-semibold tracking-[0.3em] text-white/60 uppercase">
                    Menu kantin
                    <span class="h-1 w-1 rounded-full bg-emerald-400"></span>
                </p>
                <h1 class="text-3xl sm:text-4xl font-semibold leading-tight">Cari dan pesan menu favoritmu tanpa ribet</h1>
                <p class="text-white/80 text-sm sm:text-base">Gunakan kolom pencarian atau cukup tap salah satu kategori di bawah. Kami tunjukkan stok dan harga secara realtime supaya kamu bisa memutuskan lebih cepat.</p>
            </div>

            <div class="bg-white/10 border border-white/15 rounded-3xl p-6 backdrop-blur">
                <form method="GET" action="{{ route('public.products.index') }}" class="flex flex-col gap-4 sm:flex-row">
                    <div class="flex-1">
                        <label class="text-xs font-semibold text-white/70 uppercase tracking-wide mb-2 block">Cari menu</label>
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Contoh: mie ayam, jus, bakso"
                                class="w-full px-4 py-3 rounded-2xl bg-white/90 border border-white/30 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-slate-900 placeholder:text-slate-500">
                            <button type="submit" class="absolute inset-y-1 right-1 px-4 rounded-xl bg-primary-500 text-white text-sm font-semibold">Cari</button>
                        </div>
                    </div>
                    <div class="sm:w-64">
                        <label class="text-xs font-semibold text-white/70 uppercase tracking-wide mb-2 block">Kategori terpilih</label>
                        <select name="category" class="w-full px-4 py-3 rounded-2xl bg-white/90 border border-white/30 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 text-slate-900">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>

                <!-- Quick categories -->
                <div class="mt-5">
                    <p class="text-xs uppercase tracking-[0.3em] text-white/60 mb-3">Quick filter</p>
                    <div class="flex flex-wrap gap-2">
                        @php
                            $search = request('search');
                            $activeCategory = request('category');
                            $categoryParams = function ($catId = null) use ($search) {
                                return array_filter([
                                    'category' => $catId,
                                    'search' => $search,
                                ], fn ($value) => filled($value));
                            };
                        @endphp
                        <a href="{{ route('public.products.index', $categoryParams()) }}"
                           class="px-3 py-1.5 rounded-full text-xs font-medium {{ !$activeCategory ? 'bg-white text-slate-900' : 'bg-white/10 text-white hover:bg-white/20' }}">
                            Semua menu
                        </a>
                        @foreach($categories as $category)
                            <a href="{{ route('public.products.index', $categoryParams($category->id)) }}"
                               class="px-3 py-1.5 rounded-full text-xs font-medium {{ (int)$activeCategory === $category->id ? 'bg-white text-slate-900' : 'bg-white/10 text-white hover:bg-white/20' }}">
                                {{ $category->nama }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
        <div class="grid sm:grid-cols-3 gap-4">
            <div class="rounded-2xl border border-gray-200 bg-white p-4">
                <p class="text-xs uppercase tracking-widest text-gray-500">Menu aktif</p>
                <p class="text-2xl font-semibold text-gray-900 mt-1">{{ $products->total() }}</p>
            </div>
            <div class="rounded-2xl border border-gray-200 bg-white p-4">
                <p class="text-xs uppercase tracking-widest text-gray-500">Kategori</p>
                <p class="text-2xl font-semibold text-gray-900 mt-1">{{ $categories->count() }}</p>
            </div>
            <div class="rounded-2xl border border-gray-200 bg-white p-4">
                <p class="text-xs uppercase tracking-widest text-gray-500">Filter aktif</p>
                <p class="text-sm text-gray-700 mt-1">
                    {{ $activeCategory ? $categories->firstWhere('id', $activeCategory)->nama ?? 'Semua' : 'Semua kategori' }}
                    {{ $search ? '• Kata kunci: "' . $search . '"' : '' }}
                </p>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($products as $product)
                <div class="group bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all overflow-hidden flex flex-col">
                    <div class="relative h-48 w-full overflow-hidden bg-slate-100">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->nama }}" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="h-full w-full flex items-center justify-center text-gray-400 text-sm">Tidak ada gambar</div>
                        @endif
                        @if(optional($product->category)->nama)
                            <span class="absolute top-3 left-3 inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-medium bg-white/90 text-slate-900 border border-gray-200">
                                {{ $product->category->nama }}
                            </span>
                        @endif
                        <span class="absolute top-3 right-3 px-2 py-1 rounded-full text-[11px] font-medium {{ $product->stock > 10 ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                            Stok {{ $product->stock }}
                        </span>
                    </div>
                    <div class="p-4 flex-1 flex flex-col gap-3">
                        <div>
                            <h3 class="text-base font-semibold text-gray-900 line-clamp-2">{{ $product->nama }}</h3>
                            <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $product->deskripsi ?? 'Tanpa deskripsi' }}</p>
                        </div>
                        <div class="flex items-center justify-between mt-auto">
                            <div>
                                <p class="text-xs text-gray-500">Harga</p>
                                <p class="text-lg font-semibold text-primary-600">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                            </div>
                            <a href="{{ route('public.products.show', $product) }}" class="inline-flex items-center gap-2 text-sm font-medium text-primary-600 hover:text-primary-700">
                                Detail
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M5 12h14M12 5l7 7-7 7" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 rounded-3xl border border-dashed border-gray-300 bg-white">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Produk tidak ditemukan</h3>
                    <p class="text-gray-500 text-sm">Coba ganti kata kunci atau pilih kategori lain.</p>
                    <a href="{{ route('public.products.index') }}" class="inline-flex items-center gap-2 mt-4 px-4 py-2 rounded-full bg-gray-900 text-white text-sm font-medium">
                        Reset filter
                    </a>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $products->withQueryString()->links() }}
        </div>
    </section>
</div>
@endsection


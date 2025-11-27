@extends('layouts.public')

@section('content')
<div class="bg-gray-50 min-h-screen">
    
    <!-- Hero / Filters -->
    <section class="relative bg-slate-950 overflow-hidden shadow-lg">
        <div class="absolute inset-0 opacity-40" style="background-image: url('https://images.unsplash.com/photo-1543353071-873f17a7a088?w=1600&q=80&auto=format&fit=crop'); background-size: cover; background-position: center;"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/80 to-slate-900/40"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20 space-y-8">
            <div class="max-w-3xl text-white space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/10 text-xs font-bold tracking-widest text-emerald-300 uppercase">
                    <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Menu Kantin
                </div>
                <h1 class="text-3xl sm:text-5xl font-bold leading-tight tracking-tight">
                    Lapar? <span class="text-primary-400">Pesan Sekarang.</span>
                </h1>
                <p class="text-gray-300 text-sm sm:text-lg max-w-2xl leading-relaxed">
                    Cek stok real-time, pilih menu favoritmu, dan ambil pesanan tanpa antri panjang.
                </p>
            </div>

            <!-- Search & Filter Box -->
            <div class="bg-white/10 border border-white/20 rounded-3xl p-4 sm:p-6 backdrop-blur-md shadow-2xl">
                <form method="GET" action="{{ route('public.products.index') }}" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1 relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-300 group-focus-within:text-primary-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Mau makan apa hari ini?"
                            class="w-full pl-11 pr-4 py-3.5 rounded-xl bg-white/90 border-0 focus:ring-2 focus:ring-primary-500 text-gray-900 placeholder-gray-500 font-medium transition-all">
                    </div>
                    
                    <div class="w-full md:w-64 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                        </div>
                        <select name="category" onchange="this.form.submit()" class="w-full pl-11 pr-10 py-3.5 rounded-xl bg-white/90 border-0 focus:ring-2 focus:ring-primary-500 text-gray-900 font-medium appearance-none cursor-pointer hover:bg-white transition-colors">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="w-full md:w-auto px-8 py-3.5 rounded-xl bg-primary-600 hover:bg-primary-500 text-white font-bold shadow-lg shadow-primary-600/30 transition-all transform hover:-translate-y-0.5">
                        Cari
                    </button>
                </form>

                <!-- Quick Tags -->
                <div class="mt-4 flex flex-wrap gap-2 items-center">
                    <span class="text-xs font-semibold text-white/50 uppercase tracking-wider mr-1">Cepat:</span>
                    @php
                        $search = request('search');
                        $activeCategory = request('category');
                        $categoryParams = function ($catId = null) use ($search) {
                            return array_filter(['category' => $catId, 'search' => $search], fn ($value) => filled($value));
                        };
                    @endphp
                    <a href="{{ route('public.products.index', $categoryParams()) }}"
                       class="px-3 py-1 rounded-lg text-xs font-medium transition-all {{ !$activeCategory ? 'bg-white text-primary-700 shadow-sm' : 'bg-white/10 text-white hover:bg-white/20' }}">
                        Semua
                    </a>
                    @foreach($categories->take(5) as $category)
                        <a href="{{ route('public.products.index', $categoryParams($category->id)) }}"
                           class="px-3 py-1 rounded-lg text-xs font-medium transition-all {{ (int)$activeCategory === $category->id ? 'bg-white text-primary-700 shadow-sm' : 'bg-white/10 text-white hover:bg-white/20' }}">
                            {{ $category->nama }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
        
        <!-- Alerts -->
        <div id="cart-notification" class="mb-4"></div>

        <div id="cart-section">
            @include('public.products._cart-section')
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Menu Tersedia</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $products->total() }}</p>
                </div>
            </div>
            <!-- ... (Sisa stats grid disederhanakan/dirapikan sesuai kebutuhan) ... -->
             <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
                <div class="p-3 bg-purple-50 text-purple-600 rounded-xl">
                     <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Kategori</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $categories->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($products as $product)
                <div class="group flex flex-col h-full bg-white dark:bg-slate-900 border border-gray-200 dark:border-gray-800 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 rounded-2xl overflow-hidden">
                    
                    <!-- Image Section -->
                    <div class="relative h-48 w-full overflow-hidden bg-slate-100">
                        <img class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500"
                            src="{{ $product->image_url ?? 'https://via.placeholder.com/300x200.png?text=No+Image' }}"
                            alt="{{ $product->nama }}">
                        <!-- Overlay Gradient for text readability if needed -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>

                    <!-- Content Section -->
                    <div class="p-4 flex flex-col flex-1 justify-between">
                        <div class="flex flex-row justify-between items-start gap-3 h-full">
                            
                            <!-- LEFT: Info -->
                            <div class="flex flex-col gap-1 w-full pr-1">
                                <h3 class="text-base font-bold text-gray-900 dark:text-gray-100 line-clamp-2 leading-tight group-hover:text-primary-600 transition-colors" title="{{ $product->nama }}">
                                    {{ $product->nama }}
                                </h3>
                                @if($product->deskripsi)
                                    <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2 leading-relaxed">
                                        {{ Str::limit($product->deskripsi, 40) }}
                                    </p>
                                @endif
                                
                                <!-- Rating -->
                                <div class="mt-auto pt-2 flex items-center gap-1.5">
                                    @if($product->reviews->avg('ulasan'))
                                        <div class="flex items-center bg-amber-50 px-2 py-0.5 rounded-md border border-amber-100">
                                            <svg class="w-3 h-3 text-amber-400" fill="currentColor" viewBox="0 0 16 16"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
                                            <span class="text-xs font-bold text-gray-700 ml-1">{{ number_format($product->reviews->avg('ulasan'), 1) }}</span>
                                        </div>
                                        <span class="text-[10px] text-gray-400">({{ $product->reviews->count() }})</span>
                                    @else
                                        <span class="text-[10px] text-gray-400 italic flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                            Baru
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- RIGHT: Meta -->
                            <div class="flex flex-col items-end gap-1 min-w-[85px] shrink-0">
                                @if(optional($product->category)->nama)
                                    <span class="text-[10px] uppercase tracking-wider font-bold text-gray-400 text-right">
                                        {{ $product->category->nama }}
                                    </span>
                                @endif

                                @if ($product->stock > 0)
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                        Stok {{ $product->stock }}
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-red-50 text-red-600 border border-red-100">
                                        Habis
                                    </span>
                                @endif

                                <p class="text-primary-600 font-bold text-sm mt-auto text-right">
                                    Rp {{ number_format($product->harga, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-auto border-t border-gray-100 dark:border-gray-800 flex divide-x divide-gray-100">
                        @if ($product->stock > 0)
                            <a href="{{ route('public.products.show', $product) }}" class="flex-1 py-3 px-2 inline-flex justify-center items-center gap-2 text-xs font-medium text-gray-600 hover:bg-gray-50 hover:text-primary-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                Detail
                            </a>
                            <form action="{{ route('public.cart.add', $product->id) }}" method="POST" class="add-to-cart-form flex-1">
                                @csrf
                                <button type="submit" class="w-full h-full py-3 px-2 inline-flex justify-center items-center gap-2 text-xs font-bold text-primary-600 hover:bg-primary-50 hover:text-primary-700 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                    Keranjang
                                </button>
                            </form>
                        @else
                            <button disabled class="w-full py-3 px-4 flex justify-center items-center gap-2 font-medium bg-gray-50 text-gray-400 text-xs cursor-not-allowed">
                                Stok Habis
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="col-span-full py-16 text-center">
                    <div class="bg-white rounded-full h-24 w-24 flex items-center justify-center mx-auto mb-4 shadow-sm border border-gray-100">
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Menu tidak ditemukan</h3>
                    <p class="text-gray-500 text-sm mt-1 max-w-sm mx-auto">Kami tidak menemukan menu dengan kata kunci atau kategori tersebut.</p>
                    <a href="{{ route('public.products.index') }}" class="inline-flex mt-6 px-5 py-2.5 rounded-full bg-gray-900 text-white text-sm font-semibold hover:bg-gray-800 transition shadow-lg">
                        Lihat Semua Menu
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-10 border-t border-gray-200 pt-6">
            {{ $products->withQueryString()->links() }}
        </div>
    </section>
</div>
@endsection
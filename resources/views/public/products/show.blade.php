@extends('layouts.public')

@section('content')
<div class="bg-gray-50 min-h-screen pb-12">
    <!-- Breadcrumb -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center gap-2 text-sm text-gray-500">
                <a href="{{ route('public.products.index') }}" class="hover:text-primary-600 transition-colors">Menu</a>
                <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span class="text-gray-900 font-medium truncate">Detail Produk</span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- LEFT COLUMN: Image, Details, Reviews (Wider) -->
            <div class="lg:col-span-12 space-y-8">
                
                <!-- Product Header & Image -->
                <div class="bg-white rounded-2xl p-2 shadow-sm border border-gray-100">
                    <div class="relative rounded-xl overflow-hidden bg-slate-100 aspect-video group">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->nama }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <span class="text-sm">Gambar tidak tersedia</span>
                            </div>
                        @endif

                        <!-- Badges Overlay -->
                        <div class="absolute top-4 left-4 flex gap-2">
                            @if(optional($product->category)->nama)
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-white/90 text-gray-800 backdrop-blur-sm shadow-sm">
                                    {{ $product->category->nama }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Product Info & Description -->
                <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-gray-100">
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-6">
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">#{{ $product->id }}</span>
                                @if ($product->stock > 0)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Stok {{ $product->stock }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-red-50 text-red-600 border border-red-100">
                                        Habis
                                    </span>
                                @endif
                            </div>
                            <h1 class="text-3xl font-bold text-gray-900 leading-tight">{{ $product->nama }}</h1>
                        </div>
                        <div class="text-left md:text-right">
                            <p class="text-3xl font-bold text-primary-600">
                                Rp {{ number_format($product->harga, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Info Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                        <!-- Card 1 -->
                        <div class="flex items-center gap-3 p-4 rounded-xl bg-gray-50 border border-gray-100">
                            <div class="p-2 bg-white rounded-lg shadow-sm text-primary-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Kategori</p>
                                <p class="text-sm font-semibold text-gray-900">{{ $product->category->nama ?? '-' }}</p>
                            </div>
                        </div>
                        <!-- Card 2 -->
                        <div class="flex items-center gap-3 p-4 rounded-xl bg-gray-50 border border-gray-100">
                            <div class="p-2 bg-white rounded-lg shadow-sm text-blue-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Pembayaran</p>
                                <p class="text-sm font-semibold text-gray-900">Cash / QRIS</p>
                            </div>
                        </div>
                        <!-- Card 3 -->
                        <div class="flex items-center gap-3 p-4 rounded-xl bg-gray-50 border border-gray-100">
                            <div class="p-2 bg-white rounded-lg shadow-sm text-orange-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Estimasi</p>
                                <p class="text-sm font-semibold text-gray-900">5-10 Menit</p>
                            </div>
                        </div>
                    </div>

                    <div class="prose prose-sm max-w-none text-gray-600">
                        <h3 class="text-gray-900 font-semibold mb-2">Deskripsi Menu</h3>
                        <p class="leading-relaxed">{{ $product->deskripsi ?? 'Belum ada deskripsi untuk menu ini.' }}</p>
                    </div>
                </div>

                <!-- Review Section -->
                <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-gray-100">
                    <div class="flex items-center gap-3 mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Ulasan & Rating</h2>
                        <span class="px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-700 text-xs font-bold">
                            {{ $product->reviews->count() }}
                        </span>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Form Review -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 mb-3">Bagikan pengalamanmu</h3>
                            <form action="{{ route('public.products.review', $product) }}" method="POST" class="space-y-4 bg-gray-50 p-5 rounded-xl border border-gray-200">
                                @csrf
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Nama Kamu</label>
                                    <input type="text" name="nama_pelanggan" required class="w-full text-sm rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500" placeholder="Contoh: Budi Siswa">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Berikan Bintang</label>
                                    <select name="ulasan" required class="w-full text-sm rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500">
                                        <option value="5">⭐⭐⭐⭐⭐ (Sangat Enak)</option>
                                        <option value="4">⭐⭐⭐⭐ (Enak)</option>
                                        <option value="3">⭐⭐⭐ (Biasa Aja)</option>
                                        <option value="2">⭐⭐ (Kurang)</option>
                                        <option value="1">⭐ (Tidak Rekomen)</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Komentar</label>
                                    <textarea name="komen" rows="2" required class="w-full text-sm rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500" placeholder="Tulis pendapatmu disini..."></textarea>
                                </div>
                                <button type="submit" class="w-full bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:text-primary-600 font-medium py-2 rounded-lg text-sm transition-colors">
                                    Kirim Ulasan
                                </button>
                            </form>
                        </div>

                        <!-- List Reviews -->
                        <div class="space-y-4 max-h-[300px] overflow-y-auto pr-2 hide-scrollbar">
                            @forelse($product->reviews as $review)
                                <div class="pb-4 border-b border-gray-100 last:border-0">
                                    <div class="flex justify-between items-start mb-1">
                                        <p class="font-semibold text-sm text-gray-900">{{ $review->nama_pelanggan }}</p>
                                        <div class="flex text-amber-400">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-3 h-3 {{ $i <= $review->ulasan ? 'fill-current' : 'text-gray-200' }}" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L.488 6.91l6.561-.955L10 0l2.951 5.955 6.561.955-4.756 4.635 1.122 6.545z"/></svg>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600 leading-snug">"{{ $review->komen }}"</p>
                                    <p class="text-xs text-gray-400 mt-1">{{ $review->created_at->diffForHumans() }}</p>
                                </div>
                            @empty
                                <div class="text-center py-8 text-gray-400">
                                    <p class="text-sm">Belum ada ulasan.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Related Products (Optional) -->
        @if($relatedProducts->count() > 0)
            <div class="mt-16 pt-10 border-t border-gray-200">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Mungkin kamu juga suka</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                        <a href="{{ route('public.products.show', $related) }}" class="group block bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition">
                            <div class="aspect-[4/3] bg-gray-100 overflow-hidden">
                                <img src="{{ $related->image_url ?? 'https://via.placeholder.com/300' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-900 truncate">{{ $related->nama }}</h3>
                                <p class="text-primary-600 font-bold text-sm mt-1">Rp {{ number_format($related->harga, 0, ',', '.') }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
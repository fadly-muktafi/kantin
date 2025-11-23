@extends('layouts.public')

@section('content')
<!-- Hero -->
<div class="relative overflow-hidden bg-slate-950">
    <div class="absolute inset-0 opacity-30" style="background-image: url('https://images.unsplash.com/photo-1525054098605-8e762c017741?w=1600&q=80&auto=format&fit=crop'); background-size: cover;"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-900/90 to-slate-900"></div>

    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
        <div class="grid lg:grid-cols-[1.1fr,0.9fr] gap-10 items-center">
            <div class="space-y-8 text-white">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/20 text-xs font-medium tracking-wide uppercase">
                    <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Kantin online siap melayani
                </div>
                <div class="space-y-4">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-semibold leading-tight">
                        Jajan di sekolah jadi lebih cepat &amp; tertib
                    </h1>
                    <p class="text-base sm:text-lg text-white/80 max-w-xl">
                        Lihat menu, pesan tanpa antre, bayar aman, dan tinggal ambil saat makanan siap. Semua dari satu halaman.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-3">
                    <a href="{{ route('public.products.index') }}" class="inline-flex items-center justify-center gap-2 px-8 py-3 rounded-full text-sm font-semibold text-white bg-gradient-to-r from-primary-500 to-amber-400 hover:to-amber-500 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 focus:ring-offset-slate-900 shadow-lg shadow-primary-500/30">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                        Pesan Menu Sekarang
                    </a>
                    <a href="#steps" class="inline-flex items-center gap-2 text-white/80 text-sm hover:text-white">
                        Cara kerjanya
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M5 12h14M13 6l6 6-6 6" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 pt-4">
                    <div class="rounded-2xl border border-white/15 bg-white/5 px-4 py-3">
                        <p class="text-2xl font-semibold">{{ $products->count() ?? 0 }}+</p>
                        <p class="text-xs uppercase tracking-wide text-white/70">Menu aktif</p>
                    </div>
                    <div class="rounded-2xl border border-white/15 bg-white/5 px-4 py-3">
                        <p class="text-2xl font-semibold">{{ $reviews->count() ?? 0 }}+</p>
                        <p class="text-xs uppercase tracking-wide text-white/70">Ulasan siswa</p>
                    </div>
                    <div class="rounded-2xl border border-white/15 bg-white/5 px-4 py-3">
                        <p class="text-2xl font-semibold">5 Menit</p>
                        <p class="text-xs uppercase tracking-wide text-white/70">Rata-rata proses</p>
                    </div>
                </div>
            </div>

            <div class="bg-white/10 border border-white/15 rounded-3xl p-6 backdrop-blur shadow-2xl">
                <div class="space-y-4">
                    <p class="text-sm font-semibold text-white/70 uppercase tracking-wide">Menu cepat</p>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between rounded-2xl bg-slate-900/40 border border-white/10 p-4">
                            <div>
                                <p class="text-white font-semibold text-sm">Makanan Favorit</p>
                                <p class="text-xs text-white/60">Pesan &amp; ambil diumumkan lewat aplikasi</p>
                            </div>
                            <span class="text-xs px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300">Ready</span>
                        </div>
                        <div class="flex items-center justify-between rounded-2xl bg-slate-900/30 border border-white/5 p-4">
                            <div>
                                <p class="text-white font-semibold text-sm">Minuman Segar</p>
                                <p class="text-xs text-white/60">Bisa pilih es, panas, atau botol</p>
                            </div>
                            <span class="text-xs px-3 py-1 rounded-full bg-amber-500/20 text-amber-200">Baru Masuk</span>
                        </div>
                        <div class="flex items-center justify-between rounded-2xl bg-slate-900/30 border border-white/5 p-4">
                            <div>
                                <p class="text-white font-semibold text-sm">Promo Spesial</p>
                                <p class="text-xs text-white/60">Setiap Senin &amp; Kamis</p>
                            </div>
                            <span class="text-xs px-3 py-1 rounded-full bg-primary-500/30 text-white">Promo</span>
                        </div>
                    </div>
                    <a href="{{ route('public.products.index') }}" class="block text-center text-sm font-medium text-slate-900 bg-white rounded-2xl py-3 hover:bg-slate-100">
                        Lihat semua menu
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hero -->

<!-- Divider -->
<div class="w-full border-t border-gray-100 dark:border-slate-800"></div>

<!-- Hero Highlights -->
<section id="features" class="bg-white dark:bg-slate-950">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-14 lg:py-16">
        <div class="grid gap-8 lg:grid-cols-2">
            <div class="space-y-5">
                <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full bg-primary-50 text-primary-700 dark:bg-primary-900/40 dark:text-primary-200">
                    Semua kebutuhan kantin di satu klik
                </span>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                    Pilih menu, bayar, dan ambil — semuanya terarah tanpa bingung.
                </h2>
                <p class="text-gray-600 dark:text-gray-400 text-sm sm:text-base">
                    Tampilan dibuat sederhana, ikon mudah dikenali, dan CTA selalu terlihat. Kami juga menyiapkan langkah-langkah jelas agar siswa baru bisa langsung menggunakannya.
                </p>
                <div class="grid grid-cols-2 gap-3">
                    <div class="rounded-2xl border border-gray-200 dark:border-gray-800 p-4 bg-white dark:bg-slate-900">
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">Jam Operasional</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Senin - Jumat</p>
                        <p class="text-base font-bold text-primary-600 mt-1">09.00 - 15.00</p>
                    </div>
                    <div class="rounded-2xl border border-gray-200 dark:border-gray-800 p-4 bg-white dark:bg-slate-900">
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">Lokasi</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Gedung A • Lantai dasar</p>
                        <p class="text-base font-bold text-primary-600 mt-1">Dekat UKS</p>
                    </div>
                </div>
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                @php
                    $featureCards = [
                        ['title' => 'Tanpa Antre', 'desc' => 'Pesanan langsung diproses, statusnya terlihat dari dasbor.', 'icon' => 'M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.864l-6 6a.5.5 0 0 1-.864-.364L4.323 9.5H1a.5.5 0 0 1-.364-.864l6-6a.5.5 0 0 1 .615-.068zM6.5 1h-1.882L2.648 6.5H4.5L6.5 1z'],
                        ['title' => 'Notifikasi Siap', 'desc' => 'Kami kirim pemberitahuan ketika makanan bisa diambil.', 'icon' => 'M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z'],
                        ['title' => 'Pembayaran Fleksibel', 'desc' => 'Cash, transfer, hingga QRIS semuanya sudah tersedia.', 'icon' => 'M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6z'],
                        ['title' => 'Menu Terpilih', 'desc' => 'Setiap kategori punya ikon &amp; deskripsi singkat agar mudah dibaca.', 'icon' => 'M4 4h8l4 4v6a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2z'],
                    ];
                @endphp
                @foreach($featureCards as $card)
                    <div class="flex flex-col h-full rounded-3xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-slate-900 p-5 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all">
                        <div class="inline-flex justify-center items-center w-12 h-12 rounded-xl bg-gradient-to-br from-primary-50 to-amber-50 text-primary-600 mb-4">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                <path d="{{ $card['icon'] }}" />
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-1">{{ $card['title'] }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $card['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- End Hero Highlights -->

<!-- Steps -->
<section id="steps" class="bg-gray-50 dark:bg-slate-900">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 py-14 space-y-10">
        <div class="text-center space-y-3">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">3 langkah mudah untuk memesan</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400">Kami menaruh instruksi ringkas supaya pengguna baru tidak bingung ketika pertama kali membuka halaman.</p>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            @php
                $steps = [
                    ['title' => 'Pilih menu', 'desc' => 'Gunakan filter kategori & pencarian agar hasil lebih relevan.', 'badge' => '01'],
                    ['title' => 'Masukkan pesanan', 'desc' => 'Isi jumlah & pilih metode bayar yang nyaman buatmu.', 'badge' => '02'],
                    ['title' => 'Ambil di konter', 'desc' => 'Tunjukkan kode pesanan, petugas akan serahkan pesananmu.', 'badge' => '03'],
                ];
            @endphp
            @foreach($steps as $step)
                <div class="relative rounded-3xl border border-dashed border-gray-300 dark:border-gray-700 bg-white dark:bg-slate-800 p-6 shadow-sm hover:shadow-lg transition">
                    <span class="absolute -top-3 left-6 text-xs font-bold tracking-widest text-primary-600">STEP</span>
                    <div class="text-3xl font-black text-gray-200 dark:text-slate-700 mb-4">{{ $step['badge'] }}</div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $step['title'] }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">{{ $step['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- End Steps -->

<!-- Products Section -->
<section id="menu" class="py-14 bg-gray-50 dark:bg-slate-900">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold md:text-3xl text-gray-900 dark:text-white">
                    Menu Populer
                </h2>
                <p class="mt-1.5 text-sm sm:text-base text-gray-600 dark:text-gray-400">
                    Jelajahi beberapa menu favorit yang paling banyak dipesan oleh siswa.
                </p>
            </div>
            <div class="flex items-center gap-2 text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-white dark:bg-slate-800 border border-gray-200 dark:border-gray-700">
                    {{ $products->count() ?? 0 }} menu tersedia
                </span>
            </div>
        </div>

        <!-- Products Grid -->
        @if($products->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <div class="group flex flex-col h-full bg-white dark:bg-slate-900 border border-gray-200 dark:border-gray-800 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all rounded-2xl overflow-hidden">
                        <!-- Image Section -->
                        <div class="relative h-44 sm:h-48 w-full overflow-hidden bg-slate-100">
                            <img
                                class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300"
                                src="{{ $product->image_url ?? 'https://via.placeholder.com/300x200.png?text=No+Image' }}"
                                alt="{{ $product->nama }}">
                        </div>

                        <!-- Content Section: Split Left/Right -->
                        <div class="p-4 md:p-5 flex flex-col flex-1 justify-between">
                            <div class="flex flex-row justify-between items-start gap-3 h-full">
                                
                                <!-- KIRI: Judul, Deskripsi, Ulasan -->
                                <div class="flex flex-col gap-2 w-full pr-2">
                                    <div>
                                        <h3 class="text-sm sm:text-base font-bold text-gray-900 dark:text-gray-100 line-clamp-2 leading-tight" title="{{ $product->nama }}">
                                            {{ $product->nama }}
                                        </h3>
                                        @if($product->deskripsi)
                                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 line-clamp-2">
                                                {{ Str::limit($product->deskripsi, 45) }}
                                            </p>
                                        @endif
                                    </div>

                                    <!-- Rating (Moved to Left) -->
                                    <div class="mt-auto pt-1">
                                        @if($product->reviews->avg('ulasan'))
                                            <div class="flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5 text-amber-400" fill="currentColor" viewBox="0 0 16 16"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
                                                <span class="text-xs font-bold text-gray-700 dark:text-gray-200">{{ number_format($product->reviews->avg('ulasan'), 1) }}</span>
                                                <span class="text-[10px] text-gray-400 dark:text-gray-500">({{ $product->reviews->count() }})</span>
                                            </div>
                                        @else
                                            <span class="text-[10px] text-gray-400 italic">Belum ada ulasan</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- KANAN: Kategori, Stok, Harga -->
                                <div class="flex flex-col items-end gap-2 min-w-[80px] shrink-0">
                                    <!-- Category -->
                                    @if(optional($product->category)->nama)
                                        <a href="#" class="text-[10px] uppercase tracking-wider font-semibold text-gray-400 dark:text-gray-500 hover:text-primary-600 transition-colors text-right">
                                            {{ $product->category->nama }}
                                        </a>
                                    @endif

                                    <!-- Stock Badge -->
                                    @if ($product->stock > 0)
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-800 whitespace-nowrap">
                                            Stok {{ $product->stock }}
                                        </span>
                                    @else
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-red-50 text-red-600 dark:bg-red-900/30 dark:text-red-400 border border-red-100 dark:border-red-800 whitespace-nowrap">
                                            Habis
                                        </span>
                                    @endif

                                    <!-- Price -->
                                    <p class="text-primary-600 dark:text-primary-400 font-bold text-sm mt-auto text-right">
                                        Rp {{ number_format($product->harga, 0, ',', '.') }}
                                    </p>
                                </div>

                            </div>
                        </div>

                        <!-- Button Section -->
                        <div class="mt-auto border-t border-gray-100 dark:border-gray-800">
                            @if ($product->stock > 0)
                                <a href="{{ route('public.products.show', $product) }}"
                                class="w-full py-3 px-4 inline-flex justify-center items-center gap-2 font-medium bg-white dark:bg-slate-900 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-slate-800 hover:text-primary-600 transition-colors focus:outline-none text-xs sm:text-sm">
                                    Lihat Detail
                                </a>
                            @else
                                <span
                                    class="w-full py-3 px-4 inline-flex justify-center items-center gap-2 font-medium bg-gray-50 dark:bg-slate-800/50 text-gray-400 dark:text-gray-500 text-xs sm:text-sm cursor-not-allowed">
                                    Stok Habis
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="rounded-2xl border border-dashed border-gray-300 dark:border-gray-700 bg-white/60 dark:bg-slate-900/60 p-8 text-center">
                <p class="text-base text-gray-700 dark:text-gray-200 font-medium mb-1">
                    Belum ada menu yang terdaftar.
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Admin dapat menambahkan menu lewat halaman dashboard untuk mulai menampilkan produk di sini.
                </p>
            </div>
        @endif
        <!-- End Products Grid -->
    </div>
</section>
<!-- End Products Section -->

<!-- Reviews Section -->
<section id="reviews" class="py-14 bg-white dark:bg-slate-950">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="max-w-2xl text-center mx-auto mb-10 lg:mb-12">
            <h2 class="text-2xl font-bold md:text-3xl text-gray-900 dark:text-white">
                Kata Mereka Tentang Kami
            </h2>
            <p class="mt-2 text-sm sm:text-base text-gray-600 dark:text-gray-400">
                Ratusan pesanan setiap hari dengan pengalaman yang menyenangkan.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($reviews as $review)
                <div class="flex flex-col h-full bg-white/95 dark:bg-slate-900 border border-gray-200 dark:border-gray-800 shadow-sm hover:shadow-xl hover:-translate-y-0.5 transition-all rounded-2xl">
                    <div class="flex-auto p-5 md:p-6">
                        <div class="mb-2">
                            <svg class="w-6 h-6 text-primary-400/80" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M6.854 3.146a.5.5 0 0 1 .11.54A7.97 7.97 0 0 0 6 8c0 1.612.48 3.106 1.354 4.354a.5.5 0 0 1-.416.792H4a.5.5 0 0 1-.416-.777A7.028 7.028 0 0 0 4.5 8c0-1.76.64-3.373 1.854-4.854a.5.5 0 0 1 .5-.146zM12.854 3.146a.5.5 0 0 1 .11.54A7.97 7.97 0 0 0 12 8c0 1.612.48 3.106 1.354 4.354a.5.5 0 0 1-.416.792H10a.5.5 0 0 1-.416-.777A7.028 7.028 0 0 0 10.5 8c0-1.76.64-3.373 1.854-4.854a.5.5 0 0 1 .5-.146z"/>
                            </svg>
                        </div>
                        <p class="text-sm sm:text-base text-gray-800 dark:text-gray-100 leading-relaxed">
                            “{{ $review->komen }}”
                        </p>
                    </div>

                    <div class="p-5 bg-gray-50 dark:bg-slate-800 rounded-b-2xl border-t border-gray-100 dark:border-gray-700">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-800 sm:text-base dark:text-gray-100">
                                    {{ $review->nama_pelanggan }}
                                </h3>
                                <p class="text-xs sm:text-xs text-gray-500 dark:text-gray-400">
                                    Pesan: {{ optional($review->product)->nama ?? '-' }}
                                </p>
                            </div>
                            <div class="flex items-center gap-0.5 text-yellow-400">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $review->ulasan ? 'fill-current' : 'text-gray-300 dark:text-gray-600' }}"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center">
                    <p class="text-base text-gray-700 dark:text-gray-200 font-medium mb-1">
                        Belum ada ulasan.
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Jadi orang pertama yang memberikan pengalaman jajan di kantin online ini.
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</section>
<!-- End Reviews Section -->

<!-- CTA -->
<section class="bg-slate-950 text-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 py-14 text-center space-y-5">
        <p class="text-xs uppercase tracking-[0.3em] text-white/60">Mulai sekarang</p>
        <h2 class="text-3xl font-semibold">Saatnya jajan tanpa antre &amp; tanpa bingung</h2>
        <p class="text-sm text-white/70 max-w-2xl mx-auto">Halaman menu kami sudah dirancang ringan untuk dibuka dari handphone. Pesan sebelum jam istirahat, lalu tinggal ambil ketika guru mengizinkan.</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
            <a href="{{ route('public.products.index') }}" class="inline-flex items-center gap-2 px-8 py-3 rounded-full bg-white text-slate-900 font-semibold text-sm shadow-lg hover:bg-gray-100">
                Lihat Menu Hari Ini
            </a>
            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full border border-white/30 text-white text-sm font-medium hover:bg-white/10">
                Login petugas
            </a>
        </div>
    </div>
</section>
<!-- End CTA -->
@endsection

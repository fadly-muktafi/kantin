@extends('layouts.public')

@section('content')
<div class="bg-gray-50">
    <section class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex items-center gap-3 text-sm text-gray-500 mb-6">
                <a href="{{ route('public.products.index') }}" class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Kembali ke daftar menu
                </a>
                <span>/</span>
                <span>Detail Produk</span>
            </div>

            <div class="grid lg:grid-cols-[1.3fr,0.7fr] gap-10">
                <div class="space-y-5">
                    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                        <div class="relative rounded-3xl overflow-hidden bg-slate-100 mb-5">
                            @if($product->image_url)
                                <img src="{{ $product->image_url }}" alt="{{ $product->nama }}" class="w-full h-80 object-cover">
                            @else
                                <div class="h-80 w-full flex items-center justify-center text-gray-400">Tidak ada gambar</div>
                            @endif
                            @if(optional($product->category)->nama)
                                <span class="absolute top-4 left-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/90 text-slate-900 border border-gray-200">
                                    {{ $product->category->nama }}
                                </span>
                            @endif
                            <span class="absolute top-4 right-4 px-3 py-1 rounded-full text-xs font-semibold {{ $product->stock > 10 ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                Stok {{ $product->stock }}
                            </span>
                        </div>

                        <div class="space-y-4">
                            <div class="flex flex-wrap items-start justify-between gap-3">
                                <div>
                                    <h1 class="text-3xl font-semibold text-gray-900">{{ $product->nama }}</h1>
                                    <p class="text-sm text-gray-500 mt-1">Kode produk: #{{ $product->id }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Harga</p>
                                    <p class="text-3xl font-semibold text-primary-600">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <p class="text-gray-600 leading-relaxed">{{ $product->deskripsi ?? 'Belum ada deskripsi ditambahkan.' }}</p>

                            <div class="grid sm:grid-cols-3 gap-3">
                                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-3">
                                    <p class="text-xs uppercase tracking-widest text-gray-500">Kategori</p>
                                    <p class="text-base font-semibold text-gray-900 mt-1">{{ $product->category->nama ?? 'Tidak ada' }}</p>
                                </div>
                                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-3">
                                    <p class="text-xs uppercase tracking-widest text-gray-500">Metode bayar</p>
                                    <p class="text-sm text-gray-800 mt-1">Cash / Transfer / QRIS</p>
                                </div>
                                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-3">
                                    <p class="text-xs uppercase tracking-widest text-gray-500">Estimasi siap</p>
                                    <p class="text-base font-semibold text-gray-900 mt-1">5-10 menit</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-semibold text-gray-900">Ulasan siswa</h2>
                            <span class="text-sm text-gray-500">{{ $product->reviews->count() }} ulasan</span>
                        </div>

                        <div class="grid lg:grid-cols-[0.7fr,1.3fr] gap-6">
                            <div class="bg-gray-50 rounded-2xl p-4">
                                <h3 class="font-semibold text-gray-900 mb-3">Tulis ulasan</h3>
                                <form action="{{ route('public.products.review', $product) }}" method="POST" class="space-y-3">
                                    @csrf
                                    <div>
                                        <label for="review_nama" class="text-xs uppercase tracking-wide text-gray-500">Nama</label>
                                        <input type="text" id="review_nama" name="nama_pelanggan" required class="mt-1 w-full px-3 py-2 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200">
                                    </div>
                                    <div>
                                        <label for="review_rating" class="text-xs uppercase tracking-wide text-gray-500">Rating</label>
                                        <select id="review_rating" name="ulasan" required class="mt-1 w-full px-3 py-2 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200">
                                            <option value="5">5 - Sangat Baik</option>
                                            <option value="4">4 - Baik</option>
                                            <option value="3">3 - Cukup</option>
                                            <option value="2">2 - Kurang</option>
                                            <option value="1">1 - Sangat Kurang</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="review_comment" class="text-xs uppercase tracking-wide text-gray-500">Komentar</label>
                                        <textarea id="review_comment" name="komen" rows="3" required class="mt-1 w-full px-3 py-2 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200"></textarea>
                                    </div>
                                    <button type="submit" class="w-full rounded-xl bg-emerald-600 text-white py-2.5 text-sm font-semibold hover:bg-emerald-700">Kirim ulasan</button>
                                </form>
                            </div>
                            <div class="space-y-4 max-h-[26rem] overflow-y-auto pr-1">
                                @forelse($product->reviews as $review)
                                    <div class="rounded-2xl border border-gray-200 p-4 bg-white">
                                        <div class="flex items-center justify-between mb-2">
                                            <p class="font-semibold text-gray-900">{{ $review->nama_pelanggan }}</p>
                                            <div class="flex items-center gap-0.5 text-yellow-400">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <svg class="w-4 h-4 {{ $i <= $review->ulasan ? 'fill-current' : 'text-gray-200' }}" viewBox="0 0 20 20">
                                                        <path d="M10 15l-5.878 3.09 1.122-6.545L.488 6.91l6.561-.955L10 0l2.951 5.955 6.561.955-4.756 4.635 1.122 6.545z"/>
                                                    </svg>
                                                @endfor
                                            </div>
                                        </div>
                                        <p class="text-sm text-gray-600 leading-relaxed">“{{ $review->komen }}”</p>
                                        <p class="text-xs text-gray-400 mt-2">{{ $review->created_at->format('d M Y') }}</p>
                                    </div>
                                @empty
                                    <div class="rounded-2xl border border-dashed border-gray-300 p-6 text-center text-gray-500">
                                        Belum ada ulasan untuk produk ini.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="rounded-3xl border border-gray-200 bg-white shadow-xl p-6 sticky top-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-1">Pesan menu ini</h2>
                        <p class="text-sm text-gray-500 mb-4">Isi data di bawah. Kami akan menyiapkan pesananmu dan mengirim info ketika siap diambil.</p>

                        @if($product->stock > 0)
                            <form action="{{ route('public.cart.checkout') }}" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="items[0][produk_id]" value="{{ $product->id }}">

                                <div>
                                    <label for="jumlah" class="text-xs uppercase tracking-wide text-gray-500">Jumlah</label>
                                    <input type="number" name="items[0][jumlah]" id="jumlah" min="1" max="{{ $product->stock }}" value="1" required class="mt-1 w-full px-3 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200">
                                </div>
                                <div>
                                    <label for="nama_pelanggan" class="text-xs uppercase tracking-wide text-gray-500">Nama pelanggan</label>
                                    <input type="text" name="nama_pelanggan" id="nama_pelanggan" required class="mt-1 w-full px-3 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200">
                                    @error('nama_pelanggan')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="metode_bayar" class="text-xs uppercase tracking-wide text-gray-500">Metode pembayaran</label>
                                    <select name="metode_bayar" id="metode_bayar" required class="mt-1 w-full px-3 py-2.5 rounded-xl border border-gray-200 focus:border-primary-400 focus:ring-2 focus:ring-primary-200">
                                        <option value="cash">Cash</option>
                                        <option value="transfer">Transfer</option>
                                        <option value="qris">QRIS</option>
                                    </select>
                                    @error('metode_bayar')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit" class="w-full rounded-2xl bg-gradient-to-r from-primary-500 to-amber-400 text-white py-3 text-sm font-semibold shadow-lg hover:to-amber-500">
                                    Pesan Sekarang
                                </button>
                            </form>
                            <p class="text-xs text-gray-500 mt-3">Dengan memesan kamu menyetujui aturan kantin. Pesanan dapat diambil di konter utama.</p>
                        @else
                            <div class="rounded-2xl border border-red-200 bg-red-50 text-red-700 p-4">
                                Produk sedang tidak tersedia.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($relatedProducts->count() > 0)
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Rekomendasi lain</p>
                    <h2 class="text-2xl font-semibold text-gray-900">Menu serupa yang mungkin kamu suka</h2>
                </div>
                <a href="{{ route('public.products.index') }}" class="text-sm font-medium text-primary-600 hover:text-primary-700">Lihat semua menu</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($relatedProducts as $related)
                    <div class="group rounded-2xl border border-gray-200 bg-white shadow-sm hover:shadow-lg transition overflow-hidden">
                        @if($related->image_url)
                            <img src="{{ $related->image_url }}" class="w-full h-36 object-cover group-hover:scale-105 transition-transform duration-300" alt="{{ $related->nama }}">
                        @endif
                        <div class="p-4 space-y-2">
                            <p class="text-sm text-gray-500">{{ $related->category->nama ?? 'Kategori lain' }}</p>
                            <h3 class="font-semibold text-gray-900">{{ $related->nama }}</h3>
                            <p class="text-primary-600 font-semibold">Rp {{ number_format($related->harga, 0, ',', '.') }}</p>
                            <a href="{{ route('public.products.show', $related) }}" class="inline-flex items-center gap-2 text-sm text-primary-600 hover:text-primary-700">
                                Lihat detail
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection


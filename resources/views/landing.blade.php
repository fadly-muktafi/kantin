@extends('layouts.public')

@section('content')
    <!-- Hero Section -->
    <header class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Selamat Datang di Kantin Sekolah</h1>
            <p class="lead">Pesan makanan dan minuman favoritmu dengan mudah dan cepat.</p>
            <a href="#products" class="btn btn-primary btn-lg">Lihat Menu</a>
        </div>
    </header>

    <!-- Products Section -->
    <section id="products" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Menu Kami</h2>
            
            <!-- Category Filter -->
            <div class="text-center mb-4">
                <button class="btn btn-outline-primary mx-1 active" data-category="all">Semua</button>
                @foreach($categories as $category)
                    <button class="btn btn-outline-secondary mx-1" data-category="{{ $category->id }}">{{ $category->nama }}</button>
                @endforeach
            </div>

            <!-- Products Grid -->
            <div class="row" id="products-container">
                @forelse ($products as $product)
                    <div class="col-md-4 col-lg-3 mb-4 product-card" data-category-id="{{ $product->kategori_id }}">
                        <div class="card h-100 shadow-sm border-0">
                            <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://via.placeholder.com/300x200.png?text=No+Image' }}" class="card-img-top product-image" alt="{{ $product->nama }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $product->nama }}</h5>
                                <p class="card-text text-muted">{{ optional($product->category)->nama }}</p>
                                <p class="card-text fw-bold text-primary">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                                <p class="card-text text-muted small">{{ Str::limit($product->deskripsi, 60) }}</p>
                                <div class="mt-auto">
                                    <a href="#" class="btn btn-success w-100 mt-2">Pesan Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="lead">Belum ada menu yang tersedia saat ini.</p>
                        <a href="{{ route('login') }}" class="btn btn-primary">Login untuk Menambahkan Menu</a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Add JavaScript for Category Filtering -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('[data-category]');
            const productCards = document.querySelectorAll('.product-card');
            
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Update active button
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    
                    const selectedCategory = this.getAttribute('data-category');
                    
                    productCards.forEach(card => {
                        const cardCategory = card.getAttribute('data-category-id');
                        
                        if (selectedCategory === 'all' || cardCategory === selectedCategory) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>

    <!-- Reviews Section -->
    <section id="reviews" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">Ulasan Pelanggan</h2>
            <div class="row">
                @forelse ($reviews as $review)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title">{{ optional($review->product)->nama }}</h5>
                                <p class="card-text">"{{ $review->komen }}"</p>
                                <footer class="blockquote-footer mt-2">{{ $review->nama_pelanggan }}</footer>
                                <div class="text-warning">
                                    @for ($i = 0; $i < 5; $i++)
                                        <i class="fa{{ $i < $review->ulasan ? 's' : 'r' }} fa-star"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col text-center">
                        <p>Belum ada ulasan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
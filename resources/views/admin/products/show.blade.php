<x-admin-layout>
    <x-slot name="header">Detail Produk</x-slot>

    <div class="bg-white rounded-lg shadow p-6 max-w-3xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                @if($product->image_url)
                    <img src="{{ $product->image_url }}" alt="{{ $product->nama }}" class="w-full rounded-lg">
                @else
                    <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                        <span class="text-gray-400">Tidak ada gambar</span>
                    </div>
                @endif
            </div>
            <div>
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">{{ $product->nama }}</h3>
                <p class="text-gray-600 mb-4">{{ $product->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                
                <div class="space-y-2 mb-4">
                    <div>
                        <span class="text-sm font-medium text-gray-500">Kategori:</span>
                        <span class="text-sm text-gray-900 ml-2">{{ $product->category->nama ?? 'Tidak ada kategori' }}</span>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Harga:</span>
                        <span class="text-sm text-gray-900 ml-2">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Stok:</span>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $product->stock < 10 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                            {{ $product->stock }}
                        </span>
                    </div>
                </div>

                @if($product->reviews->count() > 0)
                    <div class="mt-4">
                        <h4 class="text-md font-medium text-gray-900 mb-2">Reviews ({{ $product->reviews->count() }})</h4>
                        <div class="space-y-2 max-h-40 overflow-y-auto">
                            @foreach($product->reviews->take(5) as $review)
                                <div class="p-2 bg-gray-50 rounded">
                                    <p class="text-sm text-gray-900">{{ $review->nama_pelanggan }}</p>
                                    <p class="text-xs text-gray-500">{{ $review->komen }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('admin.products.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                Kembali
            </a>
            <a href="{{ route('admin.products.edit', $product) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Edit
            </a>
        </div>
    </div>
</x-admin-layout>


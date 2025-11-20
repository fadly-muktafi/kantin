<x-admin-layout>
    <x-slot name="header">Detail Kategori</x-slot>

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $category->nama }}</h3>
            <p class="text-gray-600">{{ $category->deskripsi ?? 'Tidak ada deskripsi' }}</p>
        </div>

        <div class="mb-4">
            <h4 class="text-md font-medium text-gray-900 mb-2">Produk dalam kategori ini ({{ $category->products->count() }})</h4>
            @if($category->products->count() > 0)
                <div class="space-y-2">
                    @foreach($category->products as $product)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                            <span class="text-sm text-gray-900">{{ $product->nama }}</span>
                            <span class="text-sm text-gray-500">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">Tidak ada produk dalam kategori ini</p>
            @endif
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                Kembali
            </a>
            <a href="{{ route('admin.categories.edit', $category) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Edit
            </a>
        </div>
    </div>
</x-admin-layout>


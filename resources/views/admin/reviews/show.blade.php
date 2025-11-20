<x-admin-layout>
    <x-slot name="header">Detail Review</x-slot>

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <div class="space-y-4">
            <div>
                <span class="text-sm font-medium text-gray-500">Produk:</span>
                <span class="text-sm text-gray-900 ml-2">{{ $review->product->nama ?? 'Produk tidak ditemukan' }}</span>
            </div>
            <div>
                <span class="text-sm font-medium text-gray-500">Nama Pelanggan:</span>
                <span class="text-sm text-gray-900 ml-2">{{ $review->nama_pelanggan }}</span>
            </div>
            <div>
                <span class="text-sm font-medium text-gray-500">Ulasan:</span>
                <div class="flex items-center mt-1">
                    @for($i = 1; $i <= 5; $i++)
                        <svg class="w-5 h-5 {{ $i <= $review->ulasan ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    @endfor
                    <span class="ml-2 text-sm text-gray-600">({{ $review->ulasan }}/5)</span>
                </div>
            </div>
            <div>
                <span class="text-sm font-medium text-gray-500">Komentar:</span>
                <p class="text-sm text-gray-900 mt-1">{{ $review->komen }}</p>
            </div>
            <div>
                <span class="text-sm font-medium text-gray-500">Tanggal:</span>
                <span class="text-sm text-gray-900 ml-2">{{ $review->created_at->format('d M Y, H:i') }}</span>
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('admin.reviews.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                Kembali
            </a>
            <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700" onclick="return confirm('Apakah Anda yakin ingin menghapus review ini?')">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</x-admin-layout>


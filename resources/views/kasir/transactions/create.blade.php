<x-kasir-layout>
    <x-slot name="header">Buat Transaksi Baru</x-slot>

    <div class="bg-white rounded-lg shadow p-6">
        <form id="transactionForm" action="{{ route('kasir.transactions.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700 mb-2">Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" id="nama_pelanggan" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('nama_pelanggan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="metode_bayar" class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
                    <select name="metode_bayar" id="metode_bayar" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                        <option value="qris">QRIS</option>
                    </select>
                    @error('metode_bayar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pilih Produk</h3>
                <div class="border border-gray-300 rounded-lg p-4 max-h-96 overflow-y-auto">
                    @foreach($products as $product)
                        <div class="flex items-center justify-between p-3 border-b border-gray-200 last:border-0">
                            <div class="flex-1">
                                <p class="font-medium text-gray-900">{{ $product->nama }}</p>
                                <p class="text-sm text-gray-500">{{ $product->category->nama ?? 'Tidak ada kategori' }}</p>
                                <p class="text-sm font-semibold text-gray-900">Rp {{ number_format($product->harga, 0, ',', '.') }} | Stok: {{ $product->stock }}</p>
                            </div>
                            <div class="ml-4 flex items-center space-x-2">
                                <input type="number" 
                                    name="items[{{ $product->id }}][jumlah]" 
                                    id="qty_{{ $product->id }}"
                                    min="0" 
                                    max="{{ $product->stock }}"
                                    value="0"
                                    class="w-20 px-2 py-1 border border-gray-300 rounded-md text-center product-qty"
                                    data-product-id="{{ $product->id }}"
                                    data-price="{{ $product->harga }}"
                                    onchange="updateTotal()">
                                <input type="hidden" name="items[{{ $product->id }}][produk_id]" value="{{ $product->id }}">
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('items')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="border-t border-gray-200 pt-4">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-lg font-semibold text-gray-900">Total:</span>
                    <span id="totalAmount" class="text-2xl font-bold text-blue-600">Rp 0</span>
                </div>
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('kasir.transactions.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Simpan Transaksi
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.product-qty').forEach(input => {
                const qty = parseInt(input.value) || 0;
                const price = parseFloat(input.dataset.price) || 0;
                total += qty * price;
            });
            document.getElementById('totalAmount').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        // Filter out items with qty 0 before submit
        document.getElementById('transactionForm').addEventListener('submit', function(e) {
            const formData = new FormData(this);
            const items = {};
            
            document.querySelectorAll('.product-qty').forEach(input => {
                const qty = parseInt(input.value) || 0;
                if (qty > 0) {
                    const productId = input.dataset.productId;
                    items[productId] = {
                        produk_id: productId,
                        jumlah: qty
                    };
                }
            });

            // Remove all items inputs
            document.querySelectorAll('[name^="items"]').forEach(input => input.remove());
            
            // Add filtered items
            Object.keys(items).forEach(key => {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = `items[${key}][produk_id]`;
                hiddenInput.value = items[key].produk_id;
                this.appendChild(hiddenInput);
                
                const qtyInput = document.createElement('input');
                qtyInput.type = 'hidden';
                qtyInput.name = `items[${key}][jumlah]`;
                qtyInput.value = items[key].jumlah;
                this.appendChild(qtyInput);
            });
        });
    </script>
</x-kasir-layout>


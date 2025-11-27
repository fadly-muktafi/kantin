@if(session('cart') && count(session('cart')) > 0)
<div class="bg-white border border-primary-100 rounded-2xl shadow-lg shadow-primary-900/5 overflow-hidden">
    <div class="bg-primary-50/50 border-b border-primary-100 px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="bg-primary-100 p-2 rounded-lg text-primary-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            </div>
            <h2 class="text-lg font-bold text-gray-900">Pesanan Aktif</h2>
        </div>
        <span class="cart-menu-count text-sm font-medium text-primary-700 bg-primary-100 px-3 py-1 rounded-full">{{ count(session('cart')) }} Menu</span>
    </div>
    
    <div class="p-6">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Cart Items List -->
            <div class="flex-1 space-y-4">
                @php $total = 0; @endphp
                @foreach(session('cart') as $id => $details)
                    @php $total += $details['harga'] * $details['quantity']; @endphp
                    <div class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 border border-gray-100 transition-colors">
                        <div class="flex items-center gap-4">
                            @if(isset($details['image_url']))
                                <img src="{{ $details['image_url'] }}" class="w-12 h-12 rounded-lg object-cover bg-gray-200">
                            @else
                                <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-xs text-gray-400">IMG</div>
                            @endif
                            <div>
                                <h4 class="font-semibold text-gray-900">{{ $details['nama'] }}</h4>
                                <p class="text-xs text-gray-500">Rp {{ number_format($details['harga'], 0, ',', '.') }} / item</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <form action="{{ route('public.cart.update', $id) }}" method="POST" class="ajax-cart-form flex items-center border border-gray-300 rounded-lg overflow-hidden h-8">
                                @csrf
                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="w-12 text-center border-none text-sm p-0 focus:ring-0 text-gray-700 font-medium h-full">
                                <button type="submit" class="bg-gray-50 px-2 h-full border-l border-gray-300 text-gray-500 hover:text-primary-600 hover:bg-gray-100 transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                </button>
                            </form>
                            <div class="text-right min-w-[80px]">
                                <p class="font-bold text-gray-900 text-sm">Rp {{ number_format($details['harga'] * $details['quantity'], 0, ',', '.') }}</p>
                                <form action="{{ route('public.cart.remove', $id) }}" method="POST" class="ajax-cart-form">
                                    @csrf
                                    <button type="submit" class="text-[10px] text-red-500 hover:text-red-700 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Checkout Summary -->
            <div class="lg:w-80 bg-gray-50 rounded-xl p-5 border border-gray-200 h-fit">
                <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-200">
                    <span class="text-gray-600 font-medium">Total Pembayaran</span>
                    <span class="text-xl font-bold text-primary-700">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                
                                            <form action="{{ route('public.cart.checkout') }}" method="POST" class="space-y-4">
                                                @csrf
                                                <div>
                                                    <label class="text-xs font-semibold text-gray-500 uppercase">Nama Pemesan</label>
                                                    <input type="text" name="customer_name" placeholder="Isi nama kamu..." required class="w-full mt-1 px-3 py-2 text-sm rounded-lg border-gray-300 focus:ring-primary-500 focus:border-primary-500">
                                                </div>
                
                                                <div>
                                                    <label class="text-xs font-semibold text-gray-500 uppercase mb-2 block">Metode Bayar</label>
                                                    <div class="grid grid-cols-2 gap-2 text-sm">
                                                        <div>
                                                            <input type="radio" name="metode_bayar" value="cash" id="pay_cash" class="hidden peer" checked>
                                                            <label for="pay_cash" class="block p-2 text-center rounded-lg border-2 border-gray-200 peer-checked:border-primary-600 peer-checked:bg-primary-50 peer-checked:text-primary-700 font-semibold cursor-pointer hover:bg-gray-100 transition">
                                                                💵 Cash
                                                            </label>
                                                        </div>
                                                        <div>
                                                            <input type="radio" name="metode_bayar" value="qris" id="pay_qris" class="hidden peer">
                                                            <label for="pay_qris" class="block p-2 text-center rounded-lg border-2 border-gray-200 peer-checked:border-primary-600 peer-checked:bg-primary-50 peer-checked:text-primary-700 font-semibold cursor-pointer hover:bg-gray-100 transition">
                                                                📱 QRIS
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                
                                                <button type="submit" class="w-full py-2.5 rounded-lg bg-primary-600 text-white font-bold shadow-md hover:bg-primary-700 transition-all text-sm">
                                                    Checkout Sekarang
                                                </button>
                                            </form>                <form action="{{ route('public.cart.clear') }}" method="POST" class="ajax-cart-form mt-3 text-center">
                    @csrf
                    <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-medium">Kosongkan Keranjang</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
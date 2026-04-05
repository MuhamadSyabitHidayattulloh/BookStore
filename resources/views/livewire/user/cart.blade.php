<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-black mb-8">Keranjang Belanja</h1>

    @if($this->items->count() > 0)
        <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
            <table class="w-full text-left">
                <tbody class="divide-y">
                    @foreach($this->items as $item)
                        <tr class="p-4">
                            <td class="p-4 w-20">
                                <img src="{{ asset('storage/'.$item->book->cover) }}" class="h-20 w-14 rounded object-cover">
                            </td>
                            <td class="p-4">
                                <p class="font-bold">{{ $item->book->title }}</p>
                                <p class="text-blue-600 font-bold">${{ number_format($item->book->price, 2) }}</p>
                            </td>
                            <td class="p-4 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <button wire:click="decrement({{ $item->id }})" class="w-8 h-8 bg-gray-100 rounded-full">-</button>
                                    <span class="font-bold">{{ $item->quantity }}</span>
                                    <button wire:click="increment({{ $item->id }})" class="w-8 h-8 bg-gray-100 rounded-full">+</button>
                                </div>
                            </td>
                            <td class="p-4 text-right">
                                <button wire:click="removeItem({{ $item->id }})" class="text-red-500 font-bold text-xs uppercase">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-6 bg-gray-50 flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-xs uppercase font-bold">Total Estimasi</p>
                    <p class="text-2xl font-black">${{ number_format($this->items->sum(fn($i) => $i->book->price * $i->quantity), 2) }}</p>
                </div>
                <button wire:click="checkout" class="bg-blue-600 text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-blue-200">
                    Checkout Sekarang
                </button>
            </div>
        </div>
    @else
        <div class="text-center py-20 bg-gray-50 rounded-2xl border-2 border-dashed">
            <p class="text-gray-400 font-medium">Keranjangmu masih kosong.</p>
            <a href="{{ route('user.explore') }}" class="text-blue-600 font-bold mt-2 inline-block">Mulai Belanja →</a>
        </div>
    @endif
</div>

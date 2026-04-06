<div class="p-6">
    <div class="flex justify-between items-center mb-4 gap-4">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari No. Pesanan atau Nama User..." 
            class="w-full max-w-sm border rounded-lg px-4 py-2 focus:ring-2 focus:ring-orange-500 outline-none shadow-sm">
    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
            <thead class="bg-gray-50 text-gray-900 font-bold uppercase text-[11px]">
                <tr>
                    <th class="px-4 py-3">Order ID</th>
                    <th class="px-4 py-3">Pelanggan</th>
                    <th class="px-4 py-3">Total</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($this->orders as $order)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 font-mono font-bold text-orange-600">{{ $order->order_number }}</td>
                        <td class="px-4 py-3">
                            <p class="font-medium">{{ $order->user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
                        </td>
                        <td class="px-4 py-3 font-semibold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-xs">
                            <select wire:change="updateStatus({{ $order->id }}, $event.target.value)" 
                                class="rounded-full px-3 py-1 font-bold border-none ring-1 ring-gray-200 shadow-sm
                                {{ $order->status == 'proccess' ? 'bg-blue-50 text-blue-700' : '' }}
                                {{ $order->status == 'shipped' ? 'bg-orange-50 text-orange-700' : '' }}
                                {{ $order->status == 'completed' ? 'bg-green-50 text-green-700' : '' }}
                                {{ $order->status == 'cancelled' ? 'bg-red-50 text-red-700' : '' }}">
                                <option value="proccess" {{ $order->status == 'proccess' ? 'selected' : '' }}>DI PROSES</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>DI KIRIM</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>SELESAI</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>BATAL</option>
                            </select>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <button wire:click="showDetail({{ $order->id }})" class="bg-gray-100 px-3 py-1 rounded hover:bg-gray-200 text-gray-700">Detail</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4 bg-gray-50">{{ $this->orders->links() }}</div>
    </div>

    <!-- Modal Detail Pesanan -->
    @if($selectedOrder)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-transparent">
        <div class="fixed inset-0" wire:click="$set('selectedOrder', null)"></div>
        <div class="relative bg-white rounded-xl shadow-2xl border w-full max-w-lg p-6 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h2 class="font-bold text-lg">Detail Pesanan: {{ $selectedOrder->order_number }}</h2>
                <button wire:click="$set('selectedOrder', null)" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            
            <div class="space-y-4">
                <div class="bg-gray-50 p-3 rounded text-sm italic text-gray-600">
                    Alamat Pengiriman: {{ $selectedOrder->shipping_address }}
                </div>

                <div class="space-y-3">
                    @foreach($selectedOrder->items as $item)
                        <div class="flex items-center gap-4 border-b pb-2">
                            <img src="{{ asset('storage/'.$item->book->cover) }}" class="w-10 h-14 rounded object-cover">
                            <div class="flex-1">
                                <p class="font-bold text-sm">{{ $item->book->title }}</p>
                                <p class="text-xs text-gray-500">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <p class="font-bold">Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-between font-bold text-lg border-t pt-3">
                    <span>Total Bayar</span>
                    <span class="text-orange-600">Rp {{ number_format($selectedOrder->total_price, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<div class="space-y-6">
    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.3em] text-orange-600">Orders Management</p>
                <h1 class="mt-2 text-2xl font-black text-slate-900">Kelola Pesanan</h1>
                <p class="mt-1 text-sm text-slate-500">Pantau status, lihat detail item, dan proses pesanan pelanggan dengan cepat.</p>
            </div>

            <div class="relative w-full max-w-sm text-slate-400 focus-within:text-slate-600">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari no. pesanan atau nama user..."
                    class="w-full rounded-xl border border-slate-200 py-2 pl-10 pr-4 text-sm outline-none transition focus:border-orange-300 focus:ring-4 focus:ring-orange-100">
            </div>
        </div>

        <p wire:loading wire:target="search,updateStatus,showDetail" class="mt-4 text-xs font-bold uppercase tracking-[0.2em] text-orange-500">
            Memuat data pesanan...
        </p>
    </section>

    <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm text-left">
            <thead class="bg-slate-50 text-slate-600">
                <tr>
                    <th class="px-4 py-3">Order ID</th>
                    <th class="px-4 py-3">Pelanggan</th>
                    <th class="px-4 py-3">Total</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse ($this->orders as $order)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-4 py-3 font-mono font-bold text-orange-600">{{ $order->order_number }}</td>
                        <td class="px-4 py-3">
                            <p class="font-medium text-slate-900">{{ $order->user->name }}</p>
                            <p class="text-xs text-slate-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
                        </td>
                        <td class="px-4 py-3 font-semibold text-slate-800">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-xs">
                            <select wire:change="updateStatus({{ $order->id }}, $event.target.value)" wire:loading.attr="disabled" wire:target="updateStatus"
                                class="rounded-full border-none px-3 py-1 font-bold ring-1 ring-slate-200 shadow-sm
                                {{ $order->status == 'proccess' ? 'bg-blue-50 text-blue-700' : '' }}
                                {{ $order->status == 'shipped' ? 'bg-orange-50 text-orange-700' : '' }}
                                {{ $order->status == 'completed' ? 'bg-emerald-50 text-emerald-700' : '' }}
                                {{ $order->status == 'cancelled' ? 'bg-red-50 text-red-700' : '' }}">
                                <option value="proccess" {{ $order->status == 'proccess' ? 'selected' : '' }}>DI PROSES</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>DI KIRIM</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>SELESAI</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>BATAL</option>
                            </select>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <button wire:click="showDetail({{ $order->id }})" wire:loading.attr="disabled" wire:target="showDetail({{ $order->id }})" class="rounded-xl bg-slate-100 px-3 py-1 text-slate-700 transition hover:bg-slate-200 disabled:opacity-60">Detail</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-12 text-center text-slate-500">Belum ada pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="border-t bg-slate-50 p-4">{{ $this->orders->links() }}</div>
    </section>

    @if($selectedOrder)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/35 px-4" wire:click.self="closeModal">
            <div class="relative max-h-[90vh] w-full max-w-xl overflow-y-auto rounded-2xl border border-slate-200 bg-white p-6 shadow-2xl">
                <div class="mb-4 flex items-center justify-between border-b pb-3">
                    <h2 class="text-lg font-black text-slate-900">Detail Pesanan: {{ $selectedOrder->order_number }}</h2>
                    <button type="button" wire:click="closeModal" class="text-2xl text-slate-400 transition hover:text-slate-600">&times;</button>
                </div>

                <div class="space-y-4">
                    <div class="rounded-xl bg-slate-50 p-3 text-sm text-slate-600">
                        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Alamat Pengiriman</p>
                        <p class="mt-1">{{ $selectedOrder->shipping_address }}</p>
                    </div>

                    <div class="space-y-3">
                        @foreach($selectedOrder->items as $item)
                            <div class="flex items-center gap-4 border-b border-slate-100 pb-3">
                                <img src="{{ asset('storage/'.$item->book->cover) }}" class="h-14 w-10 rounded-lg object-cover">
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-slate-900">{{ $item->book->title }}</p>
                                    <p class="text-xs text-slate-500">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                                <p class="font-bold text-slate-800">Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex items-center justify-between border-t pt-3 text-lg font-black">
                        <span class="text-slate-700">Total Bayar</span>
                        <span class="text-orange-600">Rp {{ number_format($selectedOrder->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
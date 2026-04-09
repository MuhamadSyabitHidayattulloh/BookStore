<div class="mx-auto max-w-5xl space-y-6 p-4 sm:p-6 lg:py-12">
    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.3em] text-blue-600">Order History</p>
                <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-900">Pesanan Saya</h1>
                <p class="mt-1 text-sm text-slate-500">Pantau status pembelian dan lihat detail item di setiap pesanan Anda.</p>
            </div>
            <span class="rounded-full bg-slate-100 px-4 py-1 text-xs font-bold uppercase text-slate-500">{{ $this->myOrders->total() }} Total Pesanan</span>
        </div>
    </section>

    <p wire:loading class="text-xs font-bold uppercase tracking-[0.2em] text-blue-500">Memuat daftar pesanan...</p>

    <section class="space-y-5">
        @forelse($this->myOrders as $order)
            <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md">
                <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 p-6">
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Nomor Pesanan</p>
                        <p class="font-mono font-bold text-blue-600">{{ $order->order_number }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Tanggal</p>
                        <p class="text-sm font-bold text-slate-700">{{ $order->created_at->format('d M Y') }}</p>
                    </div>
                    <span class="rounded-full px-4 py-1.5 text-[10px] font-black uppercase tracking-[0.2em]
                        {{ $order->status == 'process' ? 'bg-blue-50 text-blue-600' : '' }}
                        {{ $order->status == 'shipped' ? 'bg-amber-50 text-amber-600' : '' }}
                        {{ $order->status == 'completed' ? 'bg-emerald-50 text-emerald-600' : '' }}
                        {{ $order->status == 'cancelled' ? 'bg-red-50 text-red-600' : '' }}">
                        {{ $order->status }}
                    </span>
                </div>

                <div class="space-y-3 bg-slate-50/60 p-6">
                    @foreach($order->items as $item)
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('storage/' . $item->book->cover) }}" class="h-16 w-12 rounded-lg border border-white object-cover shadow-sm">
                            <div class="flex-1">
                                <p class="line-clamp-1 text-sm font-bold text-slate-900">{{ $item->book->title }}</p>
                                <p class="text-xs text-slate-500">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <p class="text-sm font-black text-slate-900">Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="flex items-center justify-between border-t border-slate-100 bg-white p-6">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Metode Pembayaran</p>
                        <p class="mt-1 text-sm font-black text-slate-800">{{ $order->payment_method === 'bank_transfer' ? 'Transfer Bank' : 'COD' }}</p>
                        @if ($order->payment_method === 'bank_transfer')
                            @if ($order->transfer_proof)
                                <a href="{{ asset('storage/'.$order->transfer_proof) }}" target="_blank" class="mt-2 inline-block text-xs font-bold text-blue-600 transition hover:text-blue-700">
                                    Klik untuk melihat bukti transfer
                                </a>
                            @endif
                        @endif
                    </div>
                    <div class="text-right">
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Total Pembayaran</p>
                        <span class="text-xl font-black text-slate-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>

                        @if ($order->status === 'shipped')
                            <button wire:click="completeOrder({{ $order->id }})" wire:loading.attr="disabled" wire:target="completeOrder({{ $order->id }})" class="mt-3 inline-flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-2 text-[11px] font-black uppercase tracking-[0.16em] text-white transition hover:bg-emerald-700 disabled:cursor-not-allowed disabled:bg-slate-300">
                                <span wire:loading.remove wire:target="completeOrder({{ $order->id }})">Pesanan Diterima</span>
                                <span wire:loading wire:target="completeOrder({{ $order->id }})">Memproses...</span>
                            </button>
                        @endif
                    </div>
                </div>
            </article>
        @empty
            <div class="rounded-3xl border-2 border-dashed border-slate-200 bg-slate-50 py-20 text-center">
                <p class="font-medium italic text-slate-500">Anda belum pernah melakukan pemesanan.</p>
                <a href="{{ route('user.explore') }}" class="mt-4 inline-block rounded-xl bg-blue-600 px-6 py-2 text-sm font-bold text-white transition hover:bg-blue-700">Mulai Belanja</a>
            </div>
        @endforelse
    </section>

    <div>
        {{ $this->myOrders->links() }}
    </div>
</div>
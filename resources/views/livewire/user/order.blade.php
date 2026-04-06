<div class="max-w-4xl mx-auto p-6 lg:py-12">
    <div class="flex items-center justify-between mb-10">
        <h1 class="text-3xl font-black text-slate-900 tracking-tighter uppercase">Pesanan Saya</h1>
        <span class="bg-slate-100 px-4 py-1 rounded-full text-xs font-bold text-slate-500 uppercase">{{ $this->myOrders->total() }} Total Pesanan</span>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-emerald-500 text-white rounded-2xl font-bold shadow-lg shadow-emerald-100">
            {{ session('message') }}
        </div>
    @endif

    <div class="space-y-6">
        @forelse($this->myOrders as $order)
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden transition hover:shadow-md">
                <!-- Header Card -->
                <div class="p-6 border-b border-slate-50 flex flex-wrap justify-between items-center gap-4">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Nomor Pesanan</p>
                        <p class="font-bold text-blue-600 font-mono">{{ $order->order_number }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal</p>
                        <p class="text-sm font-bold text-slate-700">{{ $order->created_at->format('d M Y') }}</p>
                    </div>
                    <div class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest
                        {{ $order->status == 'proccess' ? 'bg-blue-50 text-blue-600' : '' }}
                        {{ $order->status == 'shipped' ? 'bg-amber-50 text-amber-600' : '' }}
                        {{ $order->status == 'completed' ? 'bg-emerald-50 text-emerald-600' : '' }}
                        {{ $order->status == 'cancelled' ? 'bg-red-50 text-red-600' : '' }}">
                        {{ $order->status }}
                    </div>
                </div>

                <!-- Items List -->
                <div class="p-6 space-y-4 bg-slate-50/30">
                    @foreach($order->items as $item)
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('storage/' . $item->book->cover) }}" class="h-16 w-12 rounded-lg object-cover shadow-sm border border-white">
                            <div class="flex-1">
                                <p class="text-sm font-bold text-slate-900 line-clamp-1">{{ $item->book->title }}</p>
                                <p class="text-xs text-slate-500">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <p class="text-sm font-black text-slate-900">Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Footer Card -->
                <div class="p-6 bg-white border-t border-slate-50 flex justify-between items-center">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Pembayaran</span>
                    <span class="text-xl font-black text-slate-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>
        @empty
            <div class="text-center py-20 bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200">
                <p class="text-slate-400 italic font-medium">Anda belum pernah melakukan pemesanan.</p>
                <a href="{{ route('user.explore') }}" class="inline-block mt-4 bg-blue-600 text-white px-6 py-2 rounded-xl font-bold text-sm">Mulai Belanja</a>
            </div>
        @endforelse
    </div>

    <div class="mt-10">
        {{ $this->myOrders->links() }}
    </div>
</div>

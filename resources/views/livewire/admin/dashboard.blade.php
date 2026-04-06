<div class="space-y-6">
    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <p class="text-xs font-black uppercase tracking-[0.3em] text-blue-600">Admin Dashboard</p>
        <h1 class="mt-2 text-2xl font-black text-slate-900">Ringkasan Kinerja BookStore</h1>
        <p class="mt-1 text-sm text-slate-500">Pantau performa toko, pesanan terbaru, dan aktivitas pengguna dari satu halaman.</p>
    </section>

    <section class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
        <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Total Pendapatan</p>
            <p class="mt-3 text-3xl font-black text-slate-900">Rp {{ number_format($this->stats['total_revenue'], 0, ',', '.') }}</p>
            <p class="mt-2 text-xs text-slate-500">Akumulasi dari pesanan berstatus completed.</p>
        </article>

        <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Pesanan Baru</p>
            <p class="mt-3 text-3xl font-black text-slate-900">{{ $this->stats['pending_orders'] }}</p>
            <p class="mt-2 text-xs text-slate-500">Pesanan yang masih dalam proses.</p>
        </article>

        <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Koleksi Buku</p>
            <p class="mt-3 text-3xl font-black text-slate-900">{{ $this->stats['total_books'] }}</p>
            <p class="mt-2 text-xs text-slate-500">Jumlah total buku aktif di katalog.</p>
        </article>

        <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Total User</p>
            <p class="mt-3 text-3xl font-black text-slate-900">{{ $this->stats['total_users'] }}</p>
            <p class="mt-2 text-xs text-slate-500">Akun user terdaftar (role user).</p>
        </article>
    </section>

    <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Recent Orders</p>
                <h2 class="mt-1 text-lg font-black text-slate-900">Pesanan Terbaru</h2>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="rounded-full border border-slate-200 px-4 py-2 text-xs font-black uppercase tracking-[0.2em] text-slate-600 transition hover:border-blue-200 hover:text-blue-700">
                Lihat Semua
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-slate-600">
                    <tr>
                        <th class="px-6 py-3">Order ID</th>
                        <th class="px-6 py-3">Pelanggan</th>
                        <th class="px-6 py-3">Total</th>
                        <th class="px-6 py-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($this->recentOrders as $order)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 font-mono font-bold text-orange-600">{{ $order->order_number }}</td>
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $order->user->name }}</td>
                            <td class="px-6 py-4 font-bold text-slate-700">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="rounded-full px-3 py-1 text-[10px] font-black uppercase tracking-[0.2em]
                                    {{ $order->status == 'proccess' ? 'bg-blue-50 text-blue-700' : '' }}
                                    {{ $order->status == 'shipped' ? 'bg-orange-50 text-orange-700' : '' }}
                                    {{ $order->status == 'completed' ? 'bg-emerald-50 text-emerald-700' : '' }}
                                    {{ $order->status == 'cancelled' ? 'bg-red-50 text-red-700' : '' }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-500">Belum ada pesanan masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
<div class="p-6 space-y-8">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
        <p class="text-sm text-gray-500">Selamat datang kembali, {{ auth()->user()->name }}!</p>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Revenue -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                <svg xmlns="http://w3.org" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Total Pendapatan</p>
                <p class="text-2xl font-black text-gray-900">${{ number_format($this->stats['total_revenue'], 2) }}</p>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-3 bg-orange-50 text-orange-600 rounded-xl">
                <svg xmlns="http://w3.org" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Pesanan Baru</p>
                <p class="text-2xl font-black text-gray-900">{{ $this->stats['pending_orders'] }}</p>
            </div>
        </div>

        <!-- Total Books -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                <svg xmlns="http://w3.org" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Koleksi Buku</p>
                <p class="text-2xl font-black text-gray-900">{{ $this->stats['total_books'] }}</p>
            </div>
        </div>

        <!-- Total Users -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="p-3 bg-purple-50 text-purple-600 rounded-xl">
                <svg xmlns="http://w3.org" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Total User</p>
                <p class="text-2xl font-black text-gray-900">{{ $this->stats['total_users'] }}</p>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex justify-between items-center">
            <h2 class="font-bold text-gray-800 text-lg">Pesanan Terbaru</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-blue-600 text-sm font-semibold hover:underline">Lihat Semua →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50/50 text-gray-400 font-bold uppercase text-[10px] tracking-widest">
                    <tr>
                        <th class="px-6 py-4">Order ID</th>
                        <th class="px-6 py-4">User</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($this->recentOrders as $order)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-bold text-orange-600 font-mono">{{ $order->order_number }}</td>
                            <td class="px-6 py-4 text-gray-900 font-medium">{{ $order->user->name }}</td>
                            <td class="px-6 py-4 font-bold text-gray-700">${{ number_format($order->total_price, 2) }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase
                                    {{ $order->status == 'proccess' ? 'bg-blue-50 text-blue-700' : '' }}
                                    {{ $order->status == 'shipped' ? 'bg-orange-50 text-orange-700' : '' }}
                                    {{ $order->status == 'completed' ? 'bg-green-50 text-green-700' : '' }}
                                    {{ $order->status == 'cancelled' ? 'bg-red-50 text-red-700' : '' }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic">Belum ada pesanan masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

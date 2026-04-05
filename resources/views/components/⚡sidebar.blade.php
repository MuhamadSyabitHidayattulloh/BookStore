<?php
use Livewire\Component;
new class extends Component {
    public function logout() {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }
}; ?>

<aside class="w-72 bg-slate-950 text-slate-100 flex-shrink-0 min-h-screen border-r border-slate-800 flex flex-col">
    <!-- Header Logo -->
    <div class="px-6 py-8 border-b border-slate-900">
        <div class="flex items-center gap-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600 text-white text-xl font-black shadow-lg shadow-blue-900">B</div>
            <div>
                <div class="text-lg font-black tracking-tight text-white uppercase">BookStore</div>
                <div class="text-[10px] font-black text-blue-500 uppercase tracking-[0.2em]">Administrator</div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="flex-1 px-4 py-8 space-y-8 overflow-y-auto">
        <!-- Dashboard Section -->
        <div>
            <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-600 mb-4">Ringkasan</p>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-bold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-xl shadow-blue-950' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                <span>🏠</span> Dashboard
            </a>
        </div>

        <!-- Management Section -->
        <div>
            <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-600 mb-4">Manajemen Data</p>
            <div class="space-y-2">
                <a href="{{ route('admin.books.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition {{ request()->routeIs('admin.books.*') ? 'bg-slate-800 text-white' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                    <span>📚</span> Koleksi Buku
                </a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition {{ request()->routeIs('admin.categories.*') ? 'bg-slate-800 text-white' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                    <span>🗂️</span> Kategori
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition {{ request()->routeIs('admin.users.*') ? 'bg-slate-800 text-white' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                    <span>👥</span> Kelola User
                </a>
            </div>
        </div>

        <!-- Transaction Section -->
        <div>
            <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-600 mb-4">Penjualan & Inbox</p>
            <div class="space-y-2">
                <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition {{ request()->routeIs('admin.orders.*') ? 'bg-slate-800 text-white' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                    <span>🛒</span> Pesanan
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition {{ request()->routeIs('admin.contacts.*') ? 'bg-slate-800 text-white' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                    <span>📩</span> Inbox Pesan
                </a>
            </div>
        </div>
    </nav>

    <!-- Logout Section -->
    <div class="p-4 border-t border-slate-900 bg-slate-950/50">
        <button wire:click="logout" class="flex w-full items-center justify-center gap-2 rounded-2xl bg-red-950/30 px-4 py-4 text-xs font-black text-red-500 transition hover:bg-red-600 hover:text-white uppercase tracking-widest">
            Logout ↩
        </button>
    </div>
</aside>

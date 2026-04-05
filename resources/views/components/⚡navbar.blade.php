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

<header class="sticky top-0 z-30 border-b border-slate-200 bg-white/95 backdrop-blur-md shadow-sm">
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
        <!-- Logo -->
        <a href="{{ route('user.explore') }}" class="flex items-center gap-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600 text-white text-lg font-bold shadow-blue-200 shadow-lg">B</div>
            <div>
                <p class="text-sm font-bold text-slate-900 uppercase tracking-tight">BookStore</p>
                <p class="text-xs text-slate-500 font-medium">Platform Literasi Anda</p>
            </div>
        </a>

        <!-- Navigation Links -->
        <nav class="hidden md:flex items-center gap-8 text-sm font-bold">
            <a href="{{ route('user.explore') }}" class="{{ request()->routeIs('user.explore') ? 'text-blue-600' : 'text-slate-500 hover:text-slate-900' }}">EXPLORE</a>
            <a href="{{ route('user.cart') }}" class="{{ request()->routeIs('user.cart') ? 'text-blue-600' : 'text-slate-500 hover:text-slate-900' }}">KERANJANG</a>
            <a href="{{ route('user.orders') }}" class="{{ request()->routeIs('user.orders') ? 'text-blue-600' : 'text-slate-500 hover:text-slate-900' }}">PESANAN</a>
            <a href="{{ route('user.contact') }}" class="{{ request()->routeIs('user.contact') ? 'text-blue-600' : 'text-slate-500 hover:text-slate-900' }}">CONTACT</a>
        </nav>

        <!-- User Info & Logout -->
        <div class="flex items-center gap-4">
            <div class="hidden sm:flex flex-col text-right">
                <span class="text-xs font-bold text-slate-900">{{ auth()->user()->name }}</span>
                <span class="text-[10px] text-slate-400 uppercase font-black tracking-widest">{{ auth()->user()->role }}</span>
            </div>
            <button wire:click="logout" class="rounded-xl bg-red-50 px-4 py-2 text-xs font-black text-red-600 transition hover:bg-red-600 hover:text-white uppercase tracking-wider">
                Logout
            </button>
        </div>
    </div>
</header>

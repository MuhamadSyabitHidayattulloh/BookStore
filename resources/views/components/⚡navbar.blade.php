<?php

use Livewire\Component;

new class extends Component
{
    public function logout()
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login');
    }
}; ?>

<header class="sticky top-0 z-30 border-b border-slate-200 bg-white/95 backdrop-blur-xl shadow-sm">
    <div class="mx-auto flex max-w-7xl flex-col gap-4 px-4 py-4 sm:px-6 lg:px-8 md:flex-row md:items-center md:justify-between">
        <a href="{{ route('user.explore') }}" class="flex items-center gap-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600 text-lg font-black text-white shadow-lg shadow-blue-200">
                B
            </div>
            <div>
                <p class="text-sm font-black uppercase tracking-tight text-slate-900">BookStore</p>
                <p class="text-xs font-medium text-slate-500">Platform Literasi Anda</p>
            </div>
        </a>

        <nav class="flex flex-wrap items-center gap-2 text-sm font-bold sm:gap-4 md:gap-6">
            <a href="{{ route('user.explore') }}" class="rounded-full px-4 py-2 transition {{ request()->routeIs('user.explore') ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">Explore</a>
            <a href="{{ route('user.cart') }}" class="rounded-full px-4 py-2 transition {{ request()->routeIs('user.cart') ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">Keranjang</a>
            <a href="{{ route('user.orders') }}" class="rounded-full px-4 py-2 transition {{ request()->routeIs('user.orders') ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">Pesanan</a>
            <a href="{{ route('user.contact') }}" class="rounded-full px-4 py-2 transition {{ request()->routeIs('user.contact') ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">Contact</a>
        </nav>

        <div class="flex items-center justify-between gap-4 md:justify-end">
            <div class="hidden sm:flex flex-col text-right">
                <span class="text-xs font-bold text-slate-900">{{ auth()->user()->name }}</span>
                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">{{ auth()->user()->role }}</span>
            </div>
            <button wire:click="logout" class="rounded-full bg-red-50 px-4 py-2 text-xs font-black uppercase tracking-wider text-red-600 transition hover:bg-red-600 hover:text-white">
                Logout
            </button>
        </div>
    </div>
</header>

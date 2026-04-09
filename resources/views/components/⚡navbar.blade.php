<?php

use Livewire\Component;

new class extends Component
{
    // Navigation only; logout is handled by the shared POST route.
}; ?>

<header class="js-auto-hide-header auto-hide-transition sticky top-0 z-30 border-b border-slate-200 bg-white/95 backdrop-blur-xl shadow-sm">
    <div class="mx-auto flex max-w-7xl flex-row items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
        <a href="{{ route('user.explore') }}" class="flex items-center gap-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600 text-lg font-black text-white shadow-lg shadow-blue-200">
                B
            </div>
            <div>
                <p class="text-sm font-black uppercase tracking-tight text-slate-900">BookStore</p>
                <p class="text-xs font-medium text-slate-500">Platform Literasi Anda</p>
            </div>
        </a>

        <nav class="hidden flex-wrap items-center gap-2 text-sm font-bold lg:flex lg:gap-6">
            <a href="{{ route('user.explore') }}" class="rounded-full px-4 py-2 transition {{ request()->routeIs('user.explore') ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">Explore</a>
            <a href="{{ route('user.cart') }}" class="rounded-full px-4 py-2 transition {{ request()->routeIs('user.cart') ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">Keranjang</a>
            <a href="{{ route('user.orders') }}" class="rounded-full px-4 py-2 transition {{ request()->routeIs('user.orders') ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">Pesanan</a>
            <a href="{{ route('user.contact') }}" class="rounded-full px-4 py-2 transition {{ request()->routeIs('user.contact') ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">Contact</a>
        </nav>

        <div class="flex items-center gap-3">
            <div x-data="{ open: false }" class="relative">
                <button
                    type="button"
                    @click="open = !open"
                    @keydown.escape.window="open = false"
                    class="flex h-11 w-11 items-center justify-center overflow-hidden rounded-full border border-slate-200 bg-slate-100 text-sm font-black uppercase tracking-wider text-slate-700 shadow-sm transition hover:border-blue-200 hover:ring-4 hover:ring-blue-50 focus:outline-none focus:ring-4 focus:ring-blue-100"
                >
                    <span class="sr-only">Open profile menu</span>
                    @if (auth()->user()->avatar)
                        <img src="{{ asset('storage/'.auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}" class="h-full w-full object-cover">
                    @else
                        <span>{{ substr(auth()->user()->name, 0, 1) }}</span>
                    @endif
                </button>

                <div
                    x-cloak
                    x-show="open"
                    x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-120"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                    @click.outside="open = false"
                    class="absolute end-0 top-full z-50 mt-3 w-56 rounded-2xl border border-slate-200 bg-white p-2 shadow-2xl shadow-slate-200"
                >
                    <div class="border-b border-slate-100 px-3 py-2">
                        <p class="text-sm font-bold text-slate-900">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-500">{{ auth()->user()->email }}</p>
                    </div>

                    <form action="{{ route('logout') }}" method="POST" class="p-1">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-2 rounded-xl px-3 py-2 text-sm font-bold text-red-600 transition hover:bg-red-50">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-4 w-4 stroke-[2.2]">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H3m0 0 4-4m-4 4 4 4m6-9v1.5a2.5 2.5 0 0 1-2.5 2.5H9" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <livewire:hamburger-menu>
                <nav class="space-y-2 p-4">
                    <a href="{{ route('user.explore') }}" @click="menuOpen = false" class="block rounded-2xl px-4 py-3 text-sm font-bold transition {{ request()->routeIs('user.explore') ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">Explore</a>
                    <a href="{{ route('user.cart') }}" @click="menuOpen = false" class="block rounded-2xl px-4 py-3 text-sm font-bold transition {{ request()->routeIs('user.cart') ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">Keranjang</a>
                    <a href="{{ route('user.orders') }}" @click="menuOpen = false" class="block rounded-2xl px-4 py-3 text-sm font-bold transition {{ request()->routeIs('user.orders') ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">Pesanan</a>
                    <a href="{{ route('user.contact') }}" @click="menuOpen = false" class="block rounded-2xl px-4 py-3 text-sm font-bold transition {{ request()->routeIs('user.contact') ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">Contact</a>
                </nav>
            </livewire:hamburger-menu>
        </div>
    </div>
</header>

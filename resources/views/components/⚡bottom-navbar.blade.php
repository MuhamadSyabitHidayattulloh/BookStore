<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div class="js-auto-hide-bottom auto-hide-transition fixed inset-x-4 bottom-4 z-[85] sm:hidden">
    @auth
        @if (auth()->user()->role === 'admin')
            <nav class="grid grid-cols-5 gap-1 rounded-[1.75rem] border border-slate-200 bg-white/95 p-2 shadow-[0_20px_60px_rgba(15,23,42,0.16)] backdrop-blur-xl">
                <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="text-base">🏠</span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.books.index') }}" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black transition {{ request()->routeIs('admin.books.*') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="text-base">📚</span>
                    <span>Buku</span>
                </a>
                <a href="{{ route('admin.categories.index') }}" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black transition {{ request()->routeIs('admin.categories.*') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="text-base">🗂️</span>
                    <span>Kategori</span>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black transition {{ request()->routeIs('admin.orders.*') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="text-base">🛒</span>
                    <span>Order</span>
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black transition {{ request()->routeIs('admin.contacts.*') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="text-base">📩</span>
                    <span>Inbox</span>
                </a>
            </nav>
        @elseif (auth()->user()->role === 'user')
            <nav class="grid grid-cols-5 gap-1 rounded-[1.75rem] border border-slate-200 bg-white/95 p-2 shadow-[0_20px_60px_rgba(15,23,42,0.16)] backdrop-blur-xl">
                <a href="{{ route('home') }}" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black transition {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="text-base">🏠</span>
                    <span>Home</span>
                </a>
                <a href="{{ route('user.explore') }}" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black transition {{ request()->routeIs('user.explore') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="text-base">📚</span>
                    <span>Explore</span>
                </a>
                <a href="{{ route('user.cart') }}" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black transition {{ request()->routeIs('user.cart') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="text-base">🛍️</span>
                    <span>Cart</span>
                </a>
                <a href="{{ route('user.orders') }}" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black transition {{ request()->routeIs('user.orders') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="text-base">📦</span>
                    <span>Orders</span>
                </a>
                <a href="{{ route('user.contact') }}" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black transition {{ request()->routeIs('user.contact') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="text-base">📩</span>
                    <span>Contact</span>
                </a>
            </nav>
        @else
            <nav class="grid grid-cols-5 gap-1 rounded-[1.75rem] border border-slate-200 bg-white/95 p-2 shadow-[0_20px_60px_rgba(15,23,42,0.16)] backdrop-blur-xl">
                <a href="{{ route('home') }}" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black transition {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="text-base">🏠</span>
                    <span>Home</span>
                </a>
                <a href="{{ route('home') }}#about" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black text-slate-500 transition hover:bg-slate-100 hover:text-slate-900">
                    <span class="text-base">ℹ️</span>
                    <span>About</span>
                </a>
                <a href="{{ route('home') }}#popular" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black text-slate-500 transition hover:bg-slate-100 hover:text-slate-900">
                    <span class="text-base">⭐</span>
                    <span>Popular</span>
                </a>
                <a href="{{ route('home') }}#contact" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black text-slate-500 transition hover:bg-slate-100 hover:text-slate-900">
                    <span class="text-base">📩</span>
                    <span>Contact</span>
                </a>
                <a href="{{ route('login') }}" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black transition {{ request()->routeIs('login') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="text-base">🔐</span>
                    <span>Login</span>
                </a>
            </nav>
        @endif
    @endauth
</div>
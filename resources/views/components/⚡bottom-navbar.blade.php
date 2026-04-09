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
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-4 w-4 stroke-[2.2]"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5 12 3l9 7.5M5.25 9.75V21h13.5V9.75"/></svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.books.index') }}" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black transition {{ request()->routeIs('admin.books.*') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-4 w-4 stroke-[2.2]"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 5.25A2.25 2.25 0 0 1 6.75 3h10.5A2.25 2.25 0 0 1 19.5 5.25v13.5A2.25 2.25 0 0 1 17.25 21H6.75A2.25 2.25 0 0 1 4.5 18.75V5.25Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5h7.5M8.25 11.25h7.5M8.25 15h4.5"/></svg>
                    <span>Buku</span>
                </a>
                <a href="{{ route('admin.categories.index') }}" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black transition {{ request()->routeIs('admin.categories.*') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-4 w-4 stroke-[2.2]"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75A2.25 2.25 0 0 1 6 4.5h3l1.5 1.5H18A2.25 2.25 0 0 1 20.25 8.25v9A2.25 2.25 0 0 1 18 19.5H6a2.25 2.25 0 0 1-2.25-2.25v-10.5Z"/></svg>
                    <span>Kategori</span>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black transition {{ request()->routeIs('admin.orders.*') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-4 w-4 stroke-[2.2]"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3.75h1.5l1.5 10.5h12.75l2.25-7.5H6.75"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 19.5a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm8.25 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/></svg>
                    <span>Order</span>
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black transition {{ request()->routeIs('admin.contacts.*') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-4 w-4 stroke-[2.2]"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 7.5A2.25 2.25 0 0 1 6 5.25h12A2.25 2.25 0 0 1 20.25 7.5v9A2.25 2.25 0 0 1 18 18.75H6A2.25 2.25 0 0 1 3.75 16.5v-9Z"/><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 7.5 7.5 5.25 7.5-5.25"/></svg>
                    <span>Inbox</span>
                </a>
            </nav>
        @elseif (auth()->user()->role === 'user')
            <nav class="grid grid-cols-5 gap-1 rounded-[1.75rem] border border-slate-200 bg-white/95 p-2 shadow-[0_20px_60px_rgba(15,23,42,0.16)] backdrop-blur-xl">
                <a href="{{ route('home') }}" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black transition {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-4 w-4 stroke-[2.2]"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5 12 3l9 7.5M5.25 9.75V21h13.5V9.75"/></svg>
                    <span>Home</span>
                </a>
                <a href="{{ route('user.explore') }}" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black transition {{ request()->routeIs('user.explore') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-4 w-4 stroke-[2.2]"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 5.25A2.25 2.25 0 0 1 6.75 3h10.5A2.25 2.25 0 0 1 19.5 5.25v13.5A2.25 2.25 0 0 1 17.25 21H6.75A2.25 2.25 0 0 1 4.5 18.75V5.25Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5h7.5M8.25 11.25h7.5M8.25 15h4.5"/></svg>
                    <span>Explore</span>
                </a>
                <a href="{{ route('user.cart') }}" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black transition {{ request()->routeIs('user.cart') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-4 w-4 stroke-[2.2]"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3.75h1.5l1.5 10.5h12.75l2.25-7.5H6.75"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 19.5a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm8.25 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/></svg>
                    <span>Cart</span>
                </a>
                <a href="{{ route('user.orders') }}" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black transition {{ request()->routeIs('user.orders') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-4 w-4 stroke-[2.2]"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 7.5 12 3l8.25 4.5M3.75 7.5V16.5L12 21l8.25-4.5V7.5M12 21V12"/></svg>
                    <span>Orders</span>
                </a>
                <a href="{{ route('user.contact') }}" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black transition {{ request()->routeIs('user.contact') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-4 w-4 stroke-[2.2]"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 7.5A2.25 2.25 0 0 1 6 5.25h12A2.25 2.25 0 0 1 20.25 7.5v9A2.25 2.25 0 0 1 18 18.75H6A2.25 2.25 0 0 1 3.75 16.5v-9Z"/><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 7.5 7.5 5.25 7.5-5.25"/></svg>
                    <span>Contact</span>
                </a>
            </nav>
        @else
            <nav class="grid grid-cols-5 gap-1 rounded-[1.75rem] border border-slate-200 bg-white/95 p-2 shadow-[0_20px_60px_rgba(15,23,42,0.16)] backdrop-blur-xl">
                <a href="{{ route('home') }}" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black transition {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-4 w-4 stroke-[2.2]"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5 12 3l9 7.5M5.25 9.75V21h13.5V9.75"/></svg>
                    <span>Home</span>
                </a>
                <a href="{{ route('home') }}#about" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black text-slate-500 transition hover:bg-slate-100 hover:text-slate-900">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-4 w-4 stroke-[2.2]"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5v-5.25M12 7.5h.008M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                    <span>About</span>
                </a>
                <a href="{{ route('home') }}#popular" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black text-slate-500 transition hover:bg-slate-100 hover:text-slate-900">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-4 w-4 stroke-[2.2]"><path stroke-linecap="round" stroke-linejoin="round" d="m11.48 3.499 2.056 4.166 4.598.668-3.327 3.243.786 4.58L11.48 13.99 7.369 16.156l.786-4.58L4.828 8.333l4.598-.668 2.054-4.166Z"/></svg>
                    <span>Popular</span>
                </a>
                <a href="{{ route('home') }}#contact" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black text-slate-500 transition hover:bg-slate-100 hover:text-slate-900">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-4 w-4 stroke-[2.2]"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 7.5A2.25 2.25 0 0 1 6 5.25h12A2.25 2.25 0 0 1 20.25 7.5v9A2.25 2.25 0 0 1 18 18.75H6A2.25 2.25 0 0 1 3.75 16.5v-9Z"/><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 7.5 7.5 5.25 7.5-5.25"/></svg>
                    <span>Contact</span>
                </a>
                <a href="{{ route('login') }}" class="flex flex-col items-center justify-center gap-1 rounded-[1.25rem] px-2 py-2 text-[10px] font-black transition {{ request()->routeIs('login') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-4 w-4 stroke-[2.2]"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V7.875a4.5 4.5 0 1 0-9 0V10.5M6 10.5h12A1.5 1.5 0 0 1 19.5 12v7.5A1.5 1.5 0 0 1 18 21H6a1.5 1.5 0 0 1-1.5-1.5V12A1.5 1.5 0 0 1 6 10.5Z"/></svg>
                    <span>Login</span>
                </a>
            </nav>
        @endif
    @endauth
</div>
<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<header class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/90 backdrop-blur-xl shadow-sm">
    <div class="mx-auto flex max-w-7xl flex-col gap-4 px-4 py-4 sm:px-6 lg:px-8 md:flex-row md:items-center md:justify-between">
        <a href="{{ route('home') }}" class="group flex items-center gap-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600 text-lg font-black text-white shadow-lg shadow-blue-200 transition group-hover:scale-105">
                B
            </div>
            <div>
                <p class="text-sm font-black uppercase tracking-tight text-slate-900">BookStore</p>
                <p class="text-xs font-medium text-slate-500">Platform literasi dan katalog buku</p>
            </div>
        </a>

        <nav class="flex flex-wrap items-center gap-2 text-sm font-bold sm:gap-4 md:gap-8">
            <a href="{{ route('home') }}" class="rounded-full px-4 py-2 transition {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                Home
            </a>
            <a href="{{ route('home') }}#about" class="rounded-full px-4 py-2 text-slate-500 transition hover:bg-slate-100 hover:text-slate-900">
                About
            </a>
            <a href="{{ route('home') }}#popular" class="rounded-full px-4 py-2 text-slate-500 transition hover:bg-slate-100 hover:text-slate-900">
                Popular
            </a>
            <a href="{{ route('home') }}#contact" class="rounded-full px-4 py-2 text-slate-500 transition hover:bg-slate-100 hover:text-slate-900">
                Contacts
            </a>
            <a href="{{ route('login') }}" class="rounded-full bg-slate-900 px-5 py-2.5 text-white transition hover:bg-blue-600">
                Login
            </a>
        </nav>
    </div>
</header>
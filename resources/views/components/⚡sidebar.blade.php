<?php

use Livewire\Component;

new class extends Component
{
    // Navigation only; logout is handled by the shared POST route.
}; ?>

<aside class="hidden min-h-screen w-72 flex-shrink-0 flex-col border-r border-slate-200 bg-white text-slate-900 shadow-sm md:flex">
    <div class="border-b border-slate-200 px-6 py-8">
        <div class="flex items-center gap-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600 text-xl font-black text-white shadow-lg shadow-blue-200">B</div>
            <div>
                <div class="text-lg font-black tracking-tight text-slate-900 uppercase">BookStore</div>
                <div class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-600">Administrator</div>
            </div>
        </div>
    </div>

    <nav class="flex-1 space-y-8 overflow-y-auto px-4 py-8">
        <div>
            <p class="mb-4 px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Ringkasan</p>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-bold transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-4 w-4 stroke-[2.2]"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5 12 3l9 7.5M5.25 9.75V21h13.5V9.75"/></svg> Dashboard
            </a>
        </div>

        <div>
            <p class="mb-4 px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Manajemen Data</p>
            <div class="space-y-2">
                <a href="{{ route('admin.books.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition {{ request()->routeIs('admin.books.*') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-4 w-4 stroke-[2.2]"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 5.25A2.25 2.25 0 0 1 6.75 3h10.5A2.25 2.25 0 0 1 19.5 5.25v13.5A2.25 2.25 0 0 1 17.25 21H6.75A2.25 2.25 0 0 1 4.5 18.75V5.25Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5h7.5M8.25 11.25h7.5M8.25 15h4.5"/></svg> Koleksi Buku
                </a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition {{ request()->routeIs('admin.categories.*') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-4 w-4 stroke-[2.2]"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75A2.25 2.25 0 0 1 6 4.5h3l1.5 1.5H18A2.25 2.25 0 0 1 20.25 8.25v9A2.25 2.25 0 0 1 18 19.5H6a2.25 2.25 0 0 1-2.25-2.25v-10.5Z"/></svg> Kategori
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition {{ request()->routeIs('admin.users.*') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-4 w-4 stroke-[2.2]"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.5a6.75 6.75 0 1 0-6 0M18 21a6 6 0 0 0-12 0"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/></svg> Kelola User
                </a>
            </div>
        </div>

        <div>
            <p class="mb-4 px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Penjualan & Inbox</p>
            <div class="space-y-2">
                <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition {{ request()->routeIs('admin.orders.*') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-4 w-4 stroke-[2.2]"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3.75h1.5l1.5 10.5h12.75l2.25-7.5H6.75"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 19.5a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm8.25 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/></svg> Pesanan
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition {{ request()->routeIs('admin.contacts.*') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-4 w-4 stroke-[2.2]"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 7.5A2.25 2.25 0 0 1 6 5.25h12A2.25 2.25 0 0 1 20.25 7.5v9A2.25 2.25 0 0 1 18 18.75H6A2.25 2.25 0 0 1 3.75 16.5v-9Z"/><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 7.5 7.5 5.25 7.5-5.25"/></svg> Inbox Pesan
                </a>
            </div>
        </div>
    </nav>

    <div class="border-t border-slate-200 bg-slate-50 p-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-2xl bg-red-50 px-4 py-4 text-xs font-black uppercase tracking-widest text-red-600 transition hover:bg-red-600 hover:text-white disabled:cursor-not-allowed disabled:opacity-70">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-4 w-4 stroke-[2.2]"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12H3m0 0 4-4m-4 4 4 4m6-9v1.5a2.5 2.5 0 0 1-2.5 2.5H9"/></svg>
                Logout
            </button>
        </form>
    </div>
</aside>

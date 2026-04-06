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

<aside class="flex min-h-screen w-72 flex-shrink-0 flex-col border-r border-slate-200 bg-white text-slate-900 shadow-sm">
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
                <span>🏠</span> Dashboard
            </a>
        </div>

        <div>
            <p class="mb-4 px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Manajemen Data</p>
            <div class="space-y-2">
                <a href="{{ route('admin.books.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition {{ request()->routeIs('admin.books.*') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span>📚</span> Koleksi Buku
                </a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition {{ request()->routeIs('admin.categories.*') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span>🗂️</span> Kategori
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition {{ request()->routeIs('admin.users.*') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span>👥</span> Kelola User
                </a>
            </div>
        </div>

        <div>
            <p class="mb-4 px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Penjualan & Inbox</p>
            <div class="space-y-2">
                <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition {{ request()->routeIs('admin.orders.*') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span>🛒</span> Pesanan
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition {{ request()->routeIs('admin.contacts.*') ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-100' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span>📩</span> Inbox Pesan
                </a>
            </div>
        </div>
    </nav>

    <div class="border-t border-slate-200 bg-slate-50 p-4">
        <button wire:click="logout" wire:loading.attr="disabled" wire:target="logout" class="flex w-full items-center justify-center gap-2 rounded-2xl bg-red-50 px-4 py-4 text-xs font-black uppercase tracking-widest text-red-600 transition hover:bg-red-600 hover:text-white disabled:cursor-not-allowed disabled:opacity-70">
            <span wire:loading.remove wire:target="logout">Logout ↩</span>
            <span wire:loading wire:target="logout">Keluar...</span>
        </button>
    </div>
</aside>

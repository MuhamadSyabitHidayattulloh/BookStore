<?php

use Livewire\Component;

new class extends Component
{
    // Tablet-only hamburger navigation wrapper.
};
?>

<div x-data="{ menuOpen: false }" class="relative hidden sm:block lg:hidden">
    <button
        type="button"
        @click="menuOpen = !menuOpen"
        :aria-expanded="menuOpen.toString()"
        aria-label="Toggle navigation menu"
        class="rounded-full border border-slate-200 bg-slate-50 p-2.5 text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"
    >
        <svg x-cloak x-show="!menuOpen" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-5 w-5 stroke-[2.2]">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M3 12h18M3 18h18" />
        </svg>
        <svg x-cloak x-show="menuOpen" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-5 w-5 stroke-[2.2]">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6 6 18" />
        </svg>
    </button>

    <div
        x-cloak
        x-show="menuOpen"
        @click.outside="menuOpen = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-x-2"
        x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-0 translate-x-2"
        class="absolute right-0 top-full z-50 mt-2 w-48 origin-top-right rounded-[1.5rem] border border-slate-200 bg-white shadow-[0_20px_60px_rgba(15,23,42,0.16)]"
    >
        {{ $slot }}
    </div>
</div>

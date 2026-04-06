<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
    <body class="bg-slate-50 font-sans antialiased text-slate-900">
    <div class="pointer-events-none fixed right-4 top-4 z-[100] flex w-full max-w-sm flex-col gap-3">
        @if (session()->has('message'))
            <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.300ms x-init="setTimeout(() => show = false, 3200)" class="pointer-events-auto rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-bold text-emerald-700 shadow-lg shadow-emerald-100">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('warning'))
            <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.300ms x-init="setTimeout(() => show = false, 3600)" class="pointer-events-auto rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm font-bold text-amber-700 shadow-lg shadow-amber-100">
                {{ session('warning') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.300ms x-init="setTimeout(() => show = false, 3800)" class="pointer-events-auto rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-bold text-red-700 shadow-lg shadow-red-100">
                {{ session('error') }}
            </div>
        @endif
    </div>

    @auth
        @if(auth()->user()->role === 'admin')
            <!-- Layout KHUSUS ADMIN (Sidebar + Header) -->
            <div class="flex min-h-screen bg-slate-50">
                <!-- Sidebar Component -->
                <livewire:sidebar />

                <div class="flex-1 flex flex-col">
                    <!-- Top Navbar Admin -->
                    <header class="border-b border-slate-200 bg-white/95 px-6 py-4 shadow-sm backdrop-blur">
                        <div class="flex flex-wrap items-end justify-between gap-4">
                            <div>
                                <p class="text-sm font-semibold text-slate-900">Selamat datang, {{ auth()->user()->name }}</p>
                                <p class="text-xs text-slate-500">Kelola data buku dan pengguna di panel admin</p>
                            </div>
                            <div class="flex flex-wrap items-center gap-3 sm:justify-end">
                                <div class="rounded-full bg-blue-50 px-4 py-2 text-xs font-black uppercase tracking-[0.2em] text-blue-700">Admin</div>
                                <span class="text-sm font-medium text-slate-600">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </header>

                    <!-- Konten Admin -->
                    <main class="page-enter flex-1 p-4 sm:p-6 lg:p-8">
                        {{ $slot }}
                    </main>
                </div>
            </div>
        @else
            <!-- Layout KHUSUS USER (Navbar di Atas) -->
            <livewire:navbar />
            <main class="page-enter mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </main>
        @endif
    @else
        <!-- Layout GUEST (Login/Register + Landing Page) -->
        <livewire:guest />
        <main class="page-enter bg-slate-50">
            {{ $slot }}
        </main>
    @endauth

    @livewireScripts
</body>
</html>

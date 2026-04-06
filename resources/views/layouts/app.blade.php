<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
    <body class="bg-slate-50 font-sans antialiased text-slate-900">

    @auth
        @if(auth()->user()->role === 'admin')
            <!-- Layout KHUSUS ADMIN (Sidebar + Header) -->
            <div class="flex min-h-screen bg-slate-50">
                <!-- Sidebar Component -->
                <livewire:sidebar />

                <div class="flex-1 flex flex-col">
                    <!-- Top Navbar Admin -->
                    <header class="border-b border-slate-200 bg-white/95 px-6 py-4 shadow-sm backdrop-blur">
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Selamat datang, {{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-500">Kelola data buku dan pengguna di panel admin</p>
                        </div>
                        <div class="mt-4 flex flex-wrap items-center gap-3 sm:mt-0 sm:justify-end">
                            <div class="rounded-full bg-blue-50 px-4 py-2 text-xs font-black uppercase tracking-[0.2em] text-blue-700">Admin</div>
                            <span class="text-sm font-medium text-slate-600">{{ auth()->user()->email }}</span>
                        </div>
                    </header>

                    <!-- Konten Admin -->
                    <main class="flex-1 p-4 sm:p-6 lg:p-8">
                        {{ $slot }}
                    </main>
                </div>
            </div>
        @else
            <!-- Layout KHUSUS USER (Navbar di Atas) -->
            <livewire:navbar />
            <main class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </main>
        @endif
    @else
        <!-- Layout GUEST (Login/Register + Landing Page) -->
        <livewire:guest />
        <main class="bg-slate-50">
            {{ $slot }}
        </main>
    @endauth

    @livewireScripts
</body>
</html>

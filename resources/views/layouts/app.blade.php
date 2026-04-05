<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-50 font-sans antialiased">

    @auth
        @if(auth()->user()->role === 'admin')
            <!-- Layout KHUSUS ADMIN (Sidebar + Header) -->
            <div class="flex min-h-screen bg-slate-100">
                <!-- Sidebar Component -->
                <livewire:sidebar />

                <div class="flex-1 flex flex-col">
                    <!-- Top Navbar Admin -->
                    <header class="flex h-20 items-center justify-between border-b border-slate-200 bg-white px-6 shadow-sm">
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Selamat datang, {{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-500">Kelola data buku dan pengguna di panel admin</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="rounded-2xl bg-slate-100 px-4 py-2 text-sm text-slate-600">Admin</div>
                            <span class="text-sm font-medium text-slate-600">{{ auth()->user()->email }}</span>
                        </div>
                    </header>

                    <!-- Konten Admin -->
                    <main class="p-6">
                        {{ $slot }}
                    </main>
                </div>
            </div>
        @else
            <!-- Layout KHUSUS USER (Navbar di Atas) -->
            <livewire:navbar />
            <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </main>
        @endif
    @else
        <!-- Layout GUEST (Login/Register) -->
        <main>
            {{ $slot }}
        </main>
    @endauth

    @livewireScripts
</body>
</html>

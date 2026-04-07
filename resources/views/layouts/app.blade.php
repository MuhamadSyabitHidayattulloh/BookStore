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
    <div id="global-toast-container" class="pointer-events-none fixed right-4 top-4 z-[100] flex w-full max-w-sm flex-col gap-3">
        @if (session()->has('message'))
            <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.300ms x-init="setTimeout(() => show = false, 3200)" class="toast-base toast-success pointer-events-auto">
                <p>{{ session('message') }}</p>
                <div class="toast-progress toast-progress-success" style="animation-duration: 3200ms;"></div>
            </div>
        @endif

        @if (session()->has('warning'))
            <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.300ms x-init="setTimeout(() => show = false, 3600)" class="toast-base toast-warning pointer-events-auto">
                <p>{{ session('warning') }}</p>
                <div class="toast-progress toast-progress-warning" style="animation-duration: 3600ms;"></div>
            </div>
        @endif

        @if (session()->has('error'))
            <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.300ms x-init="setTimeout(() => show = false, 3800)" class="toast-base toast-error pointer-events-auto">
                <p>{{ session('error') }}</p>
                <div class="toast-progress toast-progress-error" style="animation-duration: 3800ms;"></div>
            </div>
        @endif
    </div>

    @auth
        @if(auth()->user()->role === 'admin')
            <!-- Layout KHUSUS ADMIN (Sidebar + Header) -->
            <div class="flex min-h-screen bg-slate-50 md:flex">
                <!-- Sidebar Component -->
                <livewire:sidebar />

                <div class="flex flex-1 flex-col">
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
                                <form action="{{ route('logout') }}" method="POST" class="sm:hidden">
                                    @csrf
                                    <button type="submit" class="rounded-full bg-red-50 px-4 py-2 text-xs font-black uppercase tracking-wider text-red-600 transition hover:bg-red-600 hover:text-white">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </header>

                    <!-- Konten Admin -->
                    <main class="page-enter flex-1 px-4 pb-4 pt-4 sm:p-6 lg:p-8">
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

    <livewire:bottom-navbar />

    <div x-data="{ chatOpen: false }" class="fixed bottom-20 right-4 z-[90] sm:bottom-4">
        <button
            type="button"
            @click="chatOpen = !chatOpen"
            :aria-expanded="chatOpen.toString()"
            aria-label="Buka live chat"
            class="group flex h-14 w-14 items-center justify-center rounded-full border border-slate-200 bg-white/95 shadow-[0_20px_60px_rgba(15,23,42,0.14)] backdrop-blur transition hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-[0_24px_70px_rgba(37,99,235,0.18)]"
        >
            <span class="relative flex h-11 w-11 items-center justify-center rounded-full bg-gradient-to-br from-blue-600 to-sky-400 text-white shadow-lg shadow-blue-200">
                <span class="absolute inset-0 animate-ping rounded-full bg-blue-400/30"></span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="relative h-5 w-5 stroke-[2.2]">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 10.5h8M8 14h5m-9 7l2.8-2.1A9 9 0 1 1 21 12a8.96 8.96 0 0 1-1.9 5.5" />
                </svg>
            </span>
        </button>

        <div
            x-cloak
            x-show="chatOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-3 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-3 scale-95"
            class="absolute bottom-16 right-0 w-[calc(100vw-2rem)] max-w-sm overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_28px_90px_rgba(15,23,42,0.18)]"
        >
            <div class="flex items-center justify-end border-b border-slate-100 bg-white px-3 py-3">
                <button type="button" @click="chatOpen = false" aria-label="Tutup live chat" class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 bg-slate-50 text-slate-500 transition hover:border-slate-300 hover:bg-slate-100 hover:text-slate-800">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-4 w-4 stroke-[2.2]">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6 6 18" />
                    </svg>
                </button>
            </div>

            <div class="overflow-hidden bg-white">
                <script src="https://minnit.chat/js/embed.js?c=1772345192" defer></script>
                <span style="display: none;" class="minnit-chat-sembed" data-chatname="https://organizations.minnit.chat/696855003439478/c/Main?embed" data-style="width:90%; height:500px; max-height:90vh;" data-version="1.55">Chat</span>
                <p class="powered-by-minnit border-t border-slate-100 px-4 py-3 text-center text-xs font-semibold text-slate-500">
                    <a href="https://minnit.chat" target="_blank" class="text-blue-600 transition hover:text-blue-700">Get your own free chatroom with Minnit Chat</a>
                </p>
            </div>
        </div>
    </div>

    @livewireScripts
</body>
</html>

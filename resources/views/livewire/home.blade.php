<?php
$featuredHighlights = [
    [
        'label' => 'Koleksi Curated',
        'value' => '1.200+',
        'description' => 'Buku pilihan untuk pembaca umum, pelajar, dan pecinta literasi.',
    ],
    [
        'label' => 'Kategori Aktif',
        'value' => '18',
        'description' => 'Dari novel, pengembangan diri, sampai referensi akademik.',
    ],
    [
        'label' => 'Pengalaman Belanja',
        'value' => 'Satu Klik',
        'description' => 'Cari, simpan ke keranjang, dan checkout dengan alur yang sederhana.',
    ],
];

$popularBooks = [
    [
        'title' => 'Laravel untuk Aplikasi Nyata',
        'category' => 'Programming',
        'price' => 'Rp 89.000',
        'rating' => '4.9',
        'notes' => 'Panduan populer untuk membangun aplikasi web modern dengan cepat.',
    ],
    [
        'title' => 'Strategi Membaca 20 Menit',
        'category' => 'Self Development',
        'price' => 'Rp 64.000',
        'rating' => '4.8',
        'notes' => 'Buku ringan untuk membangun kebiasaan membaca yang konsisten.',
    ],
    [
        'title' => 'Bisnis Kecil, Impact Besar',
        'category' => 'Business',
        'price' => 'Rp 75.000',
        'rating' => '4.7',
        'notes' => 'Cocok untuk pembaca yang ingin memahami langkah awal membangun bisnis.',
    ],
];

$workflowSteps = [
    'Jelajahi koleksi berdasarkan kategori.',
    'Simpan buku pilihan ke keranjang.',
    'Kelola pesanan dengan halaman user yang terpusat.',
];

$contactChannels = [
    'support@bookstore.com',
    '+62 812-3456-7890',
    'Jakarta, Indonesia',
];
?>

<div class="bg-slate-50 text-slate-900">
    <section class="relative overflow-hidden border-b border-slate-200 bg-white">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(59,130,246,0.12),_transparent_38%),radial-gradient(circle_at_top_right,_rgba(14,165,233,0.1),_transparent_30%)]"></div>

        <div class="relative mx-auto grid max-w-7xl gap-14 px-4 py-20 sm:px-6 lg:grid-cols-[1.12fr_0.88fr] lg:px-8 lg:py-28">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-[11px] font-bold uppercase tracking-[0.28em] text-blue-700">
                    BookStore Project
                </div>

                <h1 class="mt-8 text-4xl font-black leading-tight text-slate-950 sm:text-5xl lg:text-7xl">
                    Platform toko buku digital yang sederhana, cepat, dan terkurasi.
                </h1>

                <p class="mt-6 max-w-2xl text-base leading-8 text-slate-600 sm:text-lg">
                    BookStore dibangun untuk membantu pembaca menemukan buku populer, menyusun keranjang belanja, dan mengelola pesanan dalam satu pengalaman yang rapi. Landing page ini menampilkan fokus project, alur penggunaan, data statis buku populer, dan kontak UI-only sebagai gambaran awal isi platform.
                </p>

                <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-4 text-sm font-black uppercase tracking-[0.18em] text-white shadow-lg shadow-blue-200 transition hover:bg-blue-700">
                        Masuk Sekarang
                    </a>
                    <a href="#about" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-6 py-4 text-sm font-black uppercase tracking-[0.18em] text-slate-700 transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700">
                        Pelajari Project
                    </a>
                </div>

                <div class="mt-12 grid gap-4 sm:grid-cols-3">
                    @foreach ($featuredHighlights as $highlight)
                        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-blue-600">{{ $highlight['label'] }}</p>
                            <p class="mt-3 text-2xl font-black text-slate-950">{{ $highlight['value'] }}</p>
                            <p class="mt-2 text-sm leading-6 text-slate-600">{{ $highlight['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="relative">
                <div class="absolute -left-8 top-12 h-32 w-32 rounded-full bg-blue-200/40 blur-3xl"></div>
                <div class="absolute right-2 bottom-6 h-24 w-24 rounded-full bg-cyan-200/50 blur-3xl"></div>

                <div class="relative rounded-[2rem] border border-slate-200 bg-white p-6 shadow-2xl shadow-slate-200/60">
                    <div class="flex items-center justify-between border-b border-slate-200 pb-5">
                        <div>
                            <p class="text-xs font-black uppercase tracking-[0.3em] text-blue-600">Overview</p>
                            <p class="mt-2 text-2xl font-black text-slate-950">Data Project</p>
                        </div>
                        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-2 text-xs font-bold uppercase tracking-[0.25em] text-emerald-700">
                            Static Demo
                        </div>
                    </div>

                    <div class="grid gap-4 py-6">
                        <div class="rounded-3xl bg-slate-50 p-5 ring-1 ring-slate-200">
                            <p class="text-xs font-black uppercase tracking-[0.25em] text-slate-400">Tujuan Project</p>
                            <p class="mt-3 text-sm leading-7 text-slate-600">
                                Membangun platform katalog buku yang nyaman untuk melihat koleksi, membaca detail, dan menyelesaikan transaksi dengan navigasi yang jelas.
                            </p>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="rounded-3xl bg-slate-50 p-5 ring-1 ring-slate-200">
                                <p class="text-xs font-black uppercase tracking-[0.25em] text-slate-400">Fitur Utama</p>
                                <ul class="mt-3 space-y-2 text-sm text-slate-600">
                                    <li>• Katalog buku dan kategori</li>
                                    <li>• Keranjang dan riwayat pesanan</li>
                                    <li>• Halaman kontak dan panel admin</li>
                                </ul>
                            </div>

                            <div class="rounded-3xl bg-slate-50 p-5 ring-1 ring-slate-200">
                                <p class="text-xs font-black uppercase tracking-[0.25em] text-slate-400">Alur Pengguna</p>
                                <div class="mt-3 space-y-3 text-sm text-slate-600">
                                    @foreach ($workflowSteps as $step)
                                        <div class="flex items-start gap-3">
                                            <span class="mt-1 h-2.5 w-2.5 rounded-full bg-blue-500"></span>
                                            <span>{{ $step }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-[0.9fr_1.1fr]">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.35em] text-blue-600">About Project</p>
                <h2 class="mt-4 text-3xl font-black text-slate-950 sm:text-4xl">
                    BookStore dirancang untuk pengalaman katalog buku yang fokus pada keterbacaan dan kecepatan.
                </h2>
                <p class="mt-6 max-w-xl text-base leading-8 text-slate-600">
                    Landing page ini menyoroti tujuan project, bukan sekadar tampilan promosi. Pengguna bisa memahami fitur inti sejak awal, lalu masuk ke halaman login untuk mulai menjelajah koleksi dan mengakses fitur personal.
                </p>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-black uppercase tracking-[0.2em] text-blue-600">Fokus UX</p>
                    <p class="mt-3 text-sm leading-7 text-slate-600">Navigasi jelas, CTA singkat, dan kartu informasi yang mudah dipindai.</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-black uppercase tracking-[0.2em] text-blue-600">Fokus Sistem</p>
                    <p class="mt-3 text-sm leading-7 text-slate-600">Mendukung user flow katalog, keranjang, pesanan, kontak, dan admin dashboard.</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-black uppercase tracking-[0.2em] text-blue-600">Target Pengguna</p>
                    <p class="mt-3 text-sm leading-7 text-slate-600">Pembaca umum, admin toko, dan tim yang mengelola data buku.</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-black uppercase tracking-[0.2em] text-blue-600">Hasil Utama</p>
                    <p class="mt-3 text-sm leading-7 text-slate-600">Satu platform yang memadukan katalog, transaksi, dan pengelolaan data.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="border-y border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.35em] text-blue-600">Popular Data</p>
                    <h2 class="mt-4 text-3xl font-black text-slate-950 sm:text-4xl">Buku populer statis untuk demo tampilan project</h2>
                </div>
                <p class="max-w-2xl text-sm leading-7 text-slate-600">
                    Data di bawah ini bersifat statis sebagai showcase konten populer yang bisa ditampilkan di landing page sebelum integrasi data dinamis dari database.
                </p>
            </div>

            <div class="mt-10 grid gap-6 lg:grid-cols-3">
                @foreach ($popularBooks as $book)
                    <article class="group rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:shadow-lg">
                        <div class="flex items-center justify-between gap-4">
                            <span class="rounded-full border border-blue-200 bg-blue-50 px-3 py-1 text-[10px] font-black uppercase tracking-[0.25em] text-blue-700">{{ $book['category'] }}</span>
                            <span class="text-sm font-black text-amber-500">★ {{ $book['rating'] }}</span>
                        </div>
                        <h3 class="mt-5 text-2xl font-black text-slate-950">{{ $book['title'] }}</h3>
                        <p class="mt-4 text-sm leading-7 text-slate-600">{{ $book['notes'] }}</p>
                        <div class="mt-6 flex items-center justify-between border-t border-slate-200 pt-5">
                            <span class="text-sm font-bold uppercase tracking-[0.2em] text-slate-500">{{ $book['price'] }}</span>
                            <span class="text-xs font-black uppercase tracking-[0.25em] text-blue-600">Popular</span>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="contact" class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[0.95fr_1.05fr]">
            <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                <p class="text-xs font-black uppercase tracking-[0.35em] text-blue-600">Contacts</p>
                <h2 class="mt-4 text-3xl font-black text-slate-950 sm:text-4xl">Kontak UI-only untuk landing page BookStore.</h2>
                <p class="mt-4 text-sm leading-7 text-slate-600">
                    Bagian ini hanya antarmuka. Form belum terhubung ke backend, sehingga cocok untuk demonstrasi layout dan pengenalan fitur kontak pada landing page.
                </p>

                <div class="mt-8 space-y-4">
                    @foreach ($contactChannels as $channel)
                        <div class="flex items-center gap-3 rounded-2xl bg-slate-50 px-4 py-3 text-sm font-medium text-slate-700 ring-1 ring-slate-200">
                            <span class="h-2.5 w-2.5 rounded-full bg-blue-500"></span>
                            <span>{{ $channel }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                <div class="flex items-center justify-between border-b border-slate-200 pb-5">
                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.3em] text-blue-600">Contact Form</p>
                        <p class="mt-2 text-xl font-black text-slate-950">Kirim pesan ke BookStore</p>
                    </div>
                    <div class="rounded-full bg-blue-50 px-4 py-2 text-[10px] font-black uppercase tracking-[0.25em] text-blue-700">
                        UI Only
                    </div>
                </div>

                <form class="mt-6 space-y-5">
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.25em] text-slate-400">Name</label>
                            <input type="text" placeholder="Nama Anda" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-300 focus:bg-white focus:ring-4 focus:ring-blue-100">
                        </div>
                        <div>
                            <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.25em] text-slate-400">Email</label>
                            <input type="email" placeholder="email@domain.com" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-300 focus:bg-white focus:ring-4 focus:ring-blue-100">
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.25em] text-slate-400">Subject</label>
                        <input type="text" placeholder="Contoh: Pertanyaan kerja sama" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-300 focus:bg-white focus:ring-4 focus:ring-blue-100">
                    </div>

                    <div>
                        <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.25em] text-slate-400">Message</label>
                        <textarea rows="6" placeholder="Tuliskan pesan Anda di sini..." class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-300 focus:bg-white focus:ring-4 focus:ring-blue-100"></textarea>
                    </div>

                    <button type="button" class="inline-flex w-full items-center justify-center rounded-2xl bg-slate-900 px-6 py-4 text-sm font-black uppercase tracking-[0.18em] text-white transition hover:bg-blue-600">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="rounded-[2rem] border border-blue-200 bg-blue-50 p-8 sm:p-12">
            <div class="grid gap-8 lg:grid-cols-[1fr_auto] lg:items-center">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.35em] text-blue-600">Get Started</p>
                    <h2 class="mt-4 text-3xl font-black text-slate-950 sm:text-4xl">Masuk untuk menjelajahi katalog dan fitur personal BookStore.</h2>
                    <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-600">
                        Landing page ini disiapkan sebagai pintu masuk project. Setelah login, user bisa berpindah ke halaman explore, keranjang, pesanan, dan kontak tanpa kehilangan konteks navigasi.
                    </p>
                </div>

                <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-2xl bg-white px-6 py-4 text-sm font-black uppercase tracking-[0.18em] text-slate-950 shadow-lg shadow-blue-100 transition hover:bg-slate-50">
                    Login ke BookStore
                </a>
            </div>
        </div>
    </section>
</div>
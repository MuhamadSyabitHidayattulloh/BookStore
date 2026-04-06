<div class="bg-slate-50 text-slate-900">
    <section class="relative overflow-hidden border-b border-slate-200 bg-white">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(59,130,246,0.12),_transparent_38%),radial-gradient(circle_at_top_right,_rgba(14,165,233,0.08),_transparent_30%)]"></div>

        <div class="relative mx-auto grid max-w-7xl gap-14 px-4 py-20 sm:px-6 lg:grid-cols-[1.1fr_0.9fr] lg:px-8 lg:py-28">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-[11px] font-bold uppercase tracking-[0.28em] text-blue-700">
                    BookStore
                </div>

                <h1 class="mt-8 text-4xl font-black leading-tight text-slate-950 sm:text-5xl lg:text-7xl">
                    Temukan buku terbaik dengan pengalaman belanja yang rapi dan nyaman.
                </h1>

                <p class="mt-6 max-w-2xl text-base leading-8 text-slate-600 sm:text-lg">
                    BookStore membantu pembaca menjelajahi koleksi buku, mengelola keranjang, dan menyelesaikan pesanan dengan antarmuka yang modern dan terstruktur.
                </p>

                <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-4 text-sm font-black uppercase tracking-[0.18em] text-white shadow-lg shadow-blue-200 transition hover:bg-blue-700">
                        Masuk Sekarang
                    </a>
                    <a href="#popular" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-6 py-4 text-sm font-black uppercase tracking-[0.18em] text-slate-700 transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700">
                        Lihat Buku Populer
                    </a>
                </div>

                <div class="mt-12 grid gap-4 sm:grid-cols-3">
                    @foreach ($this->featuredHighlights as $highlight)
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
                            <p class="mt-2 text-2xl font-black text-slate-950">Cara Kerja</p>
                        </div>
                        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-2 text-xs font-bold uppercase tracking-[0.25em] text-emerald-700">
                            Live Platform
                        </div>
                    </div>

                    <div class="grid gap-4 py-6">
                        <div class="rounded-3xl bg-slate-50 p-5 ring-1 ring-slate-200">
                            <p class="text-xs font-black uppercase tracking-[0.25em] text-slate-400">Fokus Platform</p>
                            <p class="mt-3 text-sm leading-7 text-slate-600">
                                Menyediakan katalog buku berkualitas dengan alur dari eksplorasi hingga checkout yang cepat dan konsisten.
                            </p>
                        </div>

                        <div class="rounded-3xl bg-slate-50 p-5 ring-1 ring-slate-200">
                            <p class="text-xs font-black uppercase tracking-[0.25em] text-slate-400">Alur Pengguna</p>
                            <div class="mt-3 space-y-3 text-sm text-slate-600">
                                @foreach ($this->workflowSteps as $step)
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
    </section>

    <section id="about" class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-[0.9fr_1.1fr]">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.35em] text-blue-600">About Project</p>
                <h2 class="mt-4 text-3xl font-black text-slate-950 sm:text-4xl">
                    Platform yang menghubungkan koleksi buku, transaksi, dan pengelolaan data dalam satu alur.
                </h2>
                <p class="mt-6 max-w-xl text-base leading-8 text-slate-600">
                    Desain halaman difokuskan pada keterbacaan, struktur konten yang jelas, dan transisi interaksi yang halus agar pengguna cepat memahami dan memakai fitur utama.
                </p>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-black uppercase tracking-[0.2em] text-blue-600">Eksplorasi Buku</p>
                    <p class="mt-3 text-sm leading-7 text-slate-600">Pencarian judul, filter kategori, dan detail buku dalam tampilan yang bersih.</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-black uppercase tracking-[0.2em] text-blue-600">Checkout Terarah</p>
                    <p class="mt-3 text-sm leading-7 text-slate-600">Keranjang dengan validasi data pengiriman dan ringkasan total yang jelas.</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-black uppercase tracking-[0.2em] text-blue-600">Manajemen Admin</p>
                    <p class="mt-3 text-sm leading-7 text-slate-600">Kelola buku, kategori, user, pesanan, dan pesan masuk dari satu dashboard.</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-black uppercase tracking-[0.2em] text-blue-600">UI Feedback</p>
                    <p class="mt-3 text-sm leading-7 text-slate-600">Toast message, loading state, dan smooth scroll untuk pengalaman yang profesional.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="popular" class="border-y border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
            <div class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.35em] text-blue-600">Popular Books</p>
                    <h2 class="mt-4 text-3xl font-black text-slate-950 sm:text-4xl">Buku dengan pembelian terbanyak</h2>
                </div>
                <p class="max-w-2xl text-sm leading-7 text-slate-600">
                    Koleksi berikut diurutkan berdasarkan jumlah pembelian tertinggi untuk membantu Anda melihat buku yang paling diminati.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-6 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6">
                @forelse ($this->popularBooks as $book)
                    <article class="group cursor-pointer rounded-2xl border border-slate-200 bg-white p-3 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="relative mb-3 aspect-[3/4] overflow-hidden rounded-xl bg-slate-100">
                            <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            <span class="absolute left-2 top-2 rounded-full bg-blue-600 px-2.5 py-1 text-[10px] font-black uppercase tracking-[0.2em] text-white">
                                {{ (int) ($book->total_sold ?? 0) }} Terjual
                            </span>
                        </div>

                        <p class="line-clamp-1 text-sm font-black text-slate-900">{{ $book->title }}</p>
                        <p class="mt-1 text-xs text-slate-500">{{ $book->author }}</p>
                        <p class="mt-2 text-sm font-black text-blue-600">Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                    </article>
                @empty
                    <div class="col-span-full rounded-3xl border border-dashed border-slate-300 bg-slate-50 py-16 text-center">
                        <p class="text-slate-500">Belum ada data pembelian untuk menampilkan buku populer.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="contact" class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[0.95fr_1.05fr]">
            <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                <p class="text-xs font-black uppercase tracking-[0.35em] text-blue-600">Contacts</p>
                <h2 class="mt-4 text-3xl font-black text-slate-950 sm:text-4xl">Hubungi tim BookStore.</h2>
                <p class="mt-4 text-sm leading-7 text-slate-600">
                    Isi form kontak di samping. Untuk mengirim pesan, Anda perlu login terlebih dahulu.
                </p>

                <div class="mt-8 space-y-4">
                    @foreach ($this->contactChannels as $channel)
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
                        Guest Form
                    </div>
                </div>

                <form wire:submit.prevent="sendContact" class="mt-6 space-y-5">
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.25em] text-slate-400">Name</label>
                            <input type="text" wire:model.live="name" placeholder="Nama Anda" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-300 focus:bg-white focus:ring-4 focus:ring-blue-100">
                            @error('name') <span class="mt-1 block text-xs font-bold text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.25em] text-slate-400">Email</label>
                            <input type="email" wire:model.live="email" placeholder="email@domain.com" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-300 focus:bg-white focus:ring-4 focus:ring-blue-100">
                            @error('email') <span class="mt-1 block text-xs font-bold text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.25em] text-slate-400">Subject</label>
                        <input type="text" wire:model.live="subject" placeholder="Contoh: Pertanyaan kerja sama" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-300 focus:bg-white focus:ring-4 focus:ring-blue-100">
                        @error('subject') <span class="mt-1 block text-xs font-bold text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.25em] text-slate-400">Message</label>
                        <textarea rows="6" wire:model.live="message" placeholder="Tuliskan pesan Anda di sini..." class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-300 focus:bg-white focus:ring-4 focus:ring-blue-100"></textarea>
                        @error('message') <span class="mt-1 block text-xs font-bold text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" wire:loading.attr="disabled" wire:target="sendContact" class="inline-flex w-full items-center justify-center rounded-2xl bg-slate-900 px-6 py-4 text-sm font-black uppercase tracking-[0.18em] text-white transition hover:bg-blue-600 disabled:cursor-not-allowed disabled:bg-slate-300">
                        <span wire:loading.remove wire:target="sendContact">Kirim Pesan</span>
                        <span wire:loading wire:target="sendContact">Memproses...</span>
                    </button>
                </form>
            </div>
        </div>
    </section>
</div>
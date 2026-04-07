<div class="min-h-screen bg-white">
    <!-- Hero Section -->
    <div class="bg-slate-900 py-20 px-6 text-center">
        <h1 class="text-4xl md:text-6xl font-black text-white mb-4">Temukan Buku Favoritmu.</h1>
        <p class="text-slate-400 text-lg mb-8 max-w-2xl mx-auto">Jelajahi ribuan koleksi buku terbaik dari penulis
            ternama hanya di BookStore.</p>

        <!-- Search Bar -->
        <div class="max-w-xl mx-auto relative">
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari judul buku atau penulis..."
                class="w-full bg-white/10 border border-white/20 rounded-full px-6 py-4 text-white placeholder-slate-500 focus:ring-2 focus:ring-blue-500 outline-none backdrop-blur-md transition">
            <div class="absolute right-4 top-4 text-slate-500">
                <svg xmlns="http://w3.org" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        <p wire:loading wire:target="search,categoryId" class="mt-4 text-xs font-bold uppercase tracking-[0.2em] text-blue-200">
            Memuat hasil pencarian...
        </p>
    </div>

    <!-- Filter Kategori -->
    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="flex flex-wrap gap-2 justify-center mb-10">
            <button wire:click="$set('categoryId', null)"
                class="px-5 py-2 rounded-full text-sm font-bold transition {{ !$categoryId ? 'bg-blue-600 text-white shadow-lg' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                Semua
            </button>
            @foreach ($this->categories as $cat)
                <button wire:click="$set('categoryId', {{ $cat->id }})"
                    wire:loading.attr="disabled" wire:target="categoryId"
                    class="px-5 py-2 rounded-full text-sm font-bold transition {{ $categoryId == $cat->id ? 'bg-blue-600 text-white shadow-lg' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    {{ $cat->name }}
                </button>
            @endforeach
        </div>

        <!-- Book Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-8">
            @forelse($this->books as $book)
                <div wire:click="showDetail({{ $book->id }})" class="group cursor-pointer">
                    <div
                        class="relative aspect-[3/4] rounded-2xl overflow-hidden shadow-sm bg-gray-100 mb-3 border border-gray-100">
                        @if ($this->cartBookIds->contains((int) $book->id))
                            <span class="absolute left-2 top-2 z-10 rounded-full bg-emerald-600 px-2.5 py-1 text-[10px] font-black uppercase tracking-[0.2em] text-white">
                                Di Keranjang
                            </span>
                        @endif
                        <img src="{{ asset('storage/' . $book->cover) }}"
                            class="h-full w-full object-cover group-hover:scale-110 transition duration-500">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                            <span class="text-white text-xs font-bold bg-blue-600 px-3 py-1 rounded-full">Lihat
                                Detail</span>
                        </div>
                    </div>
                    <h3 class="font-bold text-gray-900 line-clamp-1 group-hover:text-blue-600 transition">
                        {{ $book->title }}</h3>
                    <p class="text-sm text-gray-500 mb-1">{{ $book->author }}</p>
                    <div class="mt-1 flex items-center justify-between gap-3">
                        <p class="font-black text-blue-600">Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                        <span class="rounded-full px-2.5 py-1 text-[10px] font-black uppercase tracking-[0.2em] {{ $book->stock > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700' }}">
                            Stok {{ $book->stock }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-gray-400 italic">Buku tidak ditemukan.</p>
                </div>
            @endforelse
        </div>

        <!-- Ganti Paginasi dengan Tombol Load More -->
        <div class="mt-16 flex justify-center">
            @if ($this->books->hasMorePages())
                <button wire:click="loadMore" wire:loading.attr="disabled"
                    class="group flex flex-col items-center gap-2">

                    <div
                        class="px-10 py-4 bg-slate-900 text-white rounded-2xl font-black uppercase tracking-widest hover:bg-blue-600 transition-all shadow-xl shadow-slate-200 active:scale-95">
                        <span wire:loading.remove wire:target="loadMore">Muat Lebih Banyak</span>
                        <span wire:loading wire:target="loadMore">Menyiapkan Buku...</span>
                    </div>

                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">
                        Menampilkan {{ $this->books->count() }} dari {{ $this->books->total() }} Buku
                    </p>
                </button>
            @else
                <div class="text-center py-10">
                    <div class="h-1 w-20 bg-slate-100 mx-auto rounded-full mb-4"></div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Semua koleksi telah
                        ditampilkan</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Detail Buku -->
    @if ($selectedBook)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/35 p-4 backdrop-blur-sm" wire:click.self="closeModal">
            <div
                class="relative bg-white rounded-3xl shadow-2xl w-full max-w-4xl overflow-hidden flex flex-col md:flex-row border border-gray-100">
                <!-- Cover Section -->
                <div class="w-full md:w-1/2 bg-slate-50 p-8 flex items-center justify-center">
                    <img src="{{ asset('storage/' . $selectedBook->cover) }}"
                        class="max-h-[450px] rounded-xl shadow-2xl rotate-2">
                </div>

                <!-- Content Section -->
                <div class="w-full md:w-1/2 p-8 md:p-12">
                    <div class="flex justify-between items-start">
                        <span
                            class="text-[10px] font-black tracking-widest text-blue-600 uppercase bg-blue-50 px-3 py-1 rounded-full">
                            {{ $selectedBook->category->name }}
                        </span>
                        <button wire:click="closeModal"
                            class="text-gray-400 hover:text-gray-900 transition text-2xl">&times;</button>
                    </div>

                    <h2 class="text-3xl font-black text-gray-900 mt-4 leading-tight">{{ $selectedBook->title }}</h2>
                    <p class="text-gray-500 mt-2">Karya <span
                            class="font-bold text-gray-800">{{ $selectedBook->author }}</span></p>

                    <div class="mt-8">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Tentang Buku</h4>
                        <p class="text-gray-600 leading-relaxed text-sm h-32 overflow-y-auto pr-2">
                            {{ $selectedBook->description }}
                        </p>
                    </div>

                    <div class="mt-10 flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-400 font-bold">Harga</p>
                            <p class="text-3xl font-black text-gray-900">Rp {{ number_format($selectedBook->price, 0, ',', '.') }}
                            </p>
                            <p class="mt-2 text-xs font-black uppercase tracking-[0.2em] {{ $selectedBook->stock > 0 ? 'text-emerald-600' : 'text-red-600' }}">
                                Stok {{ $selectedBook->stock }}
                            </p>
                        </div>

                        @if ($this->selectedBookInCart)
                            <a href="{{ route('user.cart') }}"
                                class="inline-flex items-center justify-center rounded-2xl bg-emerald-50 px-8 py-4 font-bold text-emerald-700 ring-1 ring-emerald-200 transition hover:bg-emerald-100">
                                Sudah di Keranjang
                            </a>
                        @else
                            <button wire:click="addToCart({{ $selectedBook->id }})" wire:loading.attr="disabled" wire:target="addToCart"
                                class="rounded-2xl bg-blue-600 px-8 py-4 font-bold text-white shadow-xl shadow-blue-200 transition active:scale-95 hover:bg-blue-700 disabled:cursor-not-allowed disabled:bg-slate-300">
                                <span wire:loading.remove wire:target="addToCart">Tambah ke Keranjang</span>
                                <span wire:loading wire:target="addToCart">Memproses...</span>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

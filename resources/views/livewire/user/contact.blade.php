<div class="mx-auto max-w-5xl p-4 sm:p-6 lg:py-12">
    <div class="grid gap-10 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-xl shadow-slate-200/60 md:grid-cols-2">
        <!-- Info Side -->
        <div class="flex flex-col justify-between bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-700 p-10 text-white">
            <div>
                <h1 class="text-3xl font-black mb-4 uppercase tracking-tighter">Hubungi Kami</h1>
                <p class="text-indigo-100 leading-relaxed">Halo, <span
                        class="font-bold text-white">{{ auth()->user()->name }}</span>! Ada kendala dengan pesanan atau
                    pertanyaan seputar buku? Tim kami siap membantu.</p>
            </div>

            <div class="space-y-6 mt-10">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-indigo-500 rounded-xl">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <p class="font-bold text-sm">support@bookstore.com</p>
                </div>
            </div>
        </div>

        <!-- Form Side -->
        <div class="p-10">
            <form wire:submit.prevent="send" class="space-y-5">
                <!-- Info Pengirim (Auto-filled & Disabled) -->
                <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 mb-2">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Pengirim Aktif</p>
                    <p class="text-sm font-bold text-gray-700">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                </div>

                <!-- Subject -->
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 ml-1">Subjek
                        Pesan</label>
                    <input type="text" wire:model.live="subject" placeholder="Contoh: Kendala Pembayaran"
                        class="w-full border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-indigo-500 outline-none transition border text-sm">
                    @error('subject')
                        <span class="text-red-500 text-[10px] font-bold mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Message -->
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 ml-1">Pesan
                        Anda</label>
                    <textarea wire:model.live="message" rows="5" placeholder="Tuliskan detail pertanyaan Anda di sini..."
                        class="w-full border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-indigo-500 outline-none transition border text-sm"></textarea>
                    @error('message')
                        <span class="text-red-500 text-[10px] font-bold mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" wire:loading.attr="disabled" wire:target="send"
                    class="w-full rounded-xl bg-indigo-600 py-4 font-black uppercase tracking-widest text-white shadow-lg shadow-indigo-100 transition hover:bg-indigo-700 active:scale-95 disabled:cursor-not-allowed disabled:bg-slate-300">
                    <span wire:loading.remove wire:target="send">Kirim Pesan Sekarang</span>
                    <span wire:loading wire:target="send">Mengirim Pesan...</span>
                </button>
            </form>
        </div>
    </div>
</div>

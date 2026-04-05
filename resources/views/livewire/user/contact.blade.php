<div class="max-w-4xl mx-auto p-6 lg:py-12">
    <div class="grid md:grid-cols-2 gap-12 bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
        <!-- Info Side -->
        <div class="bg-indigo-600 p-10 text-white flex flex-col justify-between">
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
            @if (session()->has('message'))
                <div
                    class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl border border-green-100 font-bold text-sm flex items-center gap-3">
                    <span>✅</span> {{ session('message') }}
                </div>
            @endif

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
                    <input type="text" wire:model="subject" placeholder="Contoh: Kendala Pembayaran"
                        class="w-full border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-indigo-500 outline-none transition border text-sm">
                    @error('subject')
                        <span class="text-red-500 text-[10px] font-bold mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Message -->
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 ml-1">Pesan
                        Anda</label>
                    <textarea wire:model="message" rows="5" placeholder="Tuliskan detail pertanyaan Anda di sini..."
                        class="w-full border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-indigo-500 outline-none transition border text-sm"></textarea>
                    @error('message')
                        <span class="text-red-500 text-[10px] font-bold mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-4 rounded-xl font-black uppercase tracking-widest hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 active:scale-95">
                    Kirim Pesan Sekarang
                </button>
            </form>
        </div>
    </div>
</div>

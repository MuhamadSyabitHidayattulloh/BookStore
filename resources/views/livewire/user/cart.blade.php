<div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:py-12">
    <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <p class="text-xs font-black uppercase tracking-[0.28em] text-blue-600">Cart Checkout</p>
            <h1 class="mt-3 text-3xl font-black text-slate-950">Keranjang Belanja</h1>
            <p class="mt-2 max-w-2xl text-sm leading-7 text-slate-600">Pilih item yang ingin dibeli, lengkapi phone dan alamat, lalu checkout hanya untuk item terpilih.</p>
        </div>

        @if ($this->items->count() > 0)
            <div class="flex gap-3">
                <button type="button" wire:click="selectAllItems" wire:loading.attr="disabled" wire:target="selectAllItems" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-xs font-black uppercase tracking-[0.2em] text-slate-600 transition hover:border-blue-200 hover:text-blue-700 disabled:cursor-not-allowed disabled:opacity-70">
                    Pilih Semua
                </button>
                <button type="button" wire:click="deselectAllItems" wire:loading.attr="disabled" wire:target="deselectAllItems" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-xs font-black uppercase tracking-[0.2em] text-slate-600 transition hover:border-blue-200 hover:text-blue-700 disabled:cursor-not-allowed disabled:opacity-70">
                    Kosongkan
                </button>
            </div>
        @endif
    </div>

    @if ($this->items->count() > 0)
        <div class="grid gap-6 lg:grid-cols-[1.15fr_0.85fr]">
            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-6 py-4">
                    <p class="text-sm font-black uppercase tracking-[0.2em] text-slate-500">Item Tersedia</p>
                </div>

                <div class="divide-y divide-slate-200">
                    @foreach ($this->items as $item)
                        <div class="flex flex-col gap-4 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex items-start gap-4">
                                <label class="mt-2 flex h-5 w-5 cursor-pointer items-center justify-center rounded-full border border-slate-300 bg-white">
                                    <input type="checkbox" value="{{ $item->id }}" wire:model.live="selectedItems" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                </label>

                                <img src="{{ asset('storage/'.$item->book->cover) }}" class="h-24 w-16 rounded-2xl object-cover shadow-sm" alt="{{ $item->book->title }}">

                                <div>
                                    <p class="text-lg font-black text-slate-950">{{ $item->book->title }}</p>
                                    <p class="mt-1 text-sm text-slate-500">{{ $item->book->author }}</p>
                                    <p class="mt-2 text-sm font-black text-blue-600">Rp {{ number_format($item->book->price, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between gap-4 sm:justify-end">
                                <div class="flex items-center gap-3 rounded-full border border-slate-200 px-4 py-2">
                                    <button wire:click="decrement({{ $item->id }})" class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-100 font-black text-slate-700 transition hover:bg-blue-50 hover:text-blue-700">-</button>
                                    <span class="min-w-6 text-center font-black text-slate-900">{{ $item->quantity }}</span>
                                    <button wire:click="increment({{ $item->id }})" class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-100 font-black text-slate-700 transition hover:bg-blue-50 hover:text-blue-700">+</button>
                                </div>

                                <button wire:click="removeItem({{ $item->id }})" class="text-xs font-black uppercase tracking-[0.2em] text-red-500 transition hover:text-red-600">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-xs font-black uppercase tracking-[0.28em] text-blue-600">Data Pengiriman</p>
                    <h2 class="mt-3 text-xl font-black text-slate-950">Wajib isi sebelum checkout</h2>

                    <form class="mt-6 space-y-4">
                        <div>
                            <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.25em] text-slate-400">Phone <span class="text-red-500">*</span></label>
                            <input type="text" wire:model.live="phone" placeholder="08xxxxxxxxxx" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-300 focus:bg-white focus:ring-4 focus:ring-blue-100">
                            @error('phone') <span class="mt-1 block text-xs font-bold text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.25em] text-slate-400">Alamat <span class="text-red-500">*</span></label>
                            <textarea wire:model.live="address" rows="4" placeholder="Alamat lengkap pengiriman" class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-blue-300 focus:bg-white focus:ring-4 focus:ring-blue-100"></textarea>
                            @error('address') <span class="mt-1 block text-xs font-bold text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-xs font-black uppercase tracking-[0.28em] text-slate-400">Ringkasan Checkout</p>
                    <div class="mt-4 flex items-center justify-between text-sm text-slate-600">
                        <span>Item dipilih</span>
                        <span class="font-black text-slate-900">{{ count($selectedItems) }}</span>
                    </div>
                    <div class="mt-3 flex items-center justify-between border-t border-slate-200 pt-4">
                        <span class="text-sm font-bold uppercase tracking-[0.2em] text-slate-500">Total Estimasi</span>
                        <p class="text-2xl font-black text-slate-950">Rp {{ number_format($this->selectedItemsTotal, 0, ',', '.') }}</p>
                    </div>
                    @error('selectedItems') <span class="mt-3 block text-xs font-bold text-red-500">{{ $message }}</span> @enderror

                    <button wire:click="checkout" wire:loading.attr="disabled" wire:target="checkout" class="mt-6 w-full rounded-2xl bg-blue-600 px-6 py-4 text-sm font-black uppercase tracking-[0.18em] text-white shadow-lg shadow-blue-200 transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:bg-slate-300" @disabled(empty($selectedItems))>
                        <span wire:loading.remove wire:target="checkout">Checkout Sekarang</span>
                        <span wire:loading wire:target="checkout">Memproses Checkout...</span>
                    </button>
                </div>
            </div>
        </div>
    @else
        <div class="rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-20 text-center shadow-sm">
            <p class="text-slate-500 font-medium">Keranjangmu masih kosong.</p>
            <a href="{{ route('user.explore') }}" class="mt-3 inline-block font-black text-blue-600 transition hover:text-blue-700">Mulai Belanja →</a>
        </div>
    @endif
</div>

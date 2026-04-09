<div class="min-h-screen flex items-center justify-center bg-slate-50 px-4 py-10" x-data="{ tab: '{{ request()->routeIs('register') ? 'register' : 'login' }}' }">
    <div class="w-full max-w-md overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-xl shadow-slate-200/70">
        <!-- Tab Switcher -->
        <div class="flex border-b">
            <button type="button" @click="tab = 'login'" :class="tab === 'login' ? 'text-blue-600 border-b-2 border-blue-600 bg-blue-50/30' : 'text-gray-400 hover:text-gray-600'" class="w-1/2 py-4 text-sm font-bold transition">
                LOGIN
            </button>
            <button type="button" @click="tab = 'register'" :class="tab === 'register' ? 'text-blue-600 border-b-2 border-blue-600 bg-blue-50/30' : 'text-gray-400 hover:text-gray-600'" class="w-1/2 py-4 text-sm font-bold transition">
                REGISTER
            </button>
        </div>

        <div class="p-8">
            @if (session()->has('error'))
                <div class="mb-4 p-3 bg-red-50 text-red-600 rounded-lg text-sm border border-red-100">{{ session('error') }}</div>
            @endif

            <!-- Form Login -->
            <form x-show="tab === 'login'" x-cloak wire:submit.prevent="login" class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold uppercase text-gray-500">Email Address <span class="text-red-500">*</span></label>
                    <input type="email" wire:model="email" class="w-full mt-1 border rounded-xl p-3 focus:ring-2 focus:ring-blue-500 outline-none transition">
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase text-gray-500">Password <span class="text-red-500">*</span></label>
                    <input type="password" wire:model="password" class="w-full mt-1 border rounded-xl p-3 focus:ring-2 focus:ring-blue-500 outline-none transition">
                    @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <button type="submit" wire:loading.attr="disabled" wire:target="login" class="w-full rounded-xl bg-blue-600 py-3 font-bold text-white shadow-lg shadow-blue-200 transition duration-200 hover:bg-blue-700 disabled:cursor-not-allowed disabled:bg-slate-300">
                    <span wire:loading.remove wire:target="login">Masuk Ke Akun</span>
                    <span wire:loading wire:target="login">Memproses...</span>
                </button>
            </form>

            <!-- Form Register -->
            <form x-show="tab === 'register'" x-cloak wire:submit.prevent="register" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase text-gray-500">Nama <span class="text-red-500">*</span></label>
                        <input type="text" wire:model="name" class="w-full mt-1 border rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase text-gray-500">Email <span class="text-red-500">*</span></label>
                        <input type="email" wire:model="email" class="w-full mt-1 border rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase text-gray-500">Password <span class="text-red-500">*</span></label>
                        <input type="password" wire:model="password" class="w-full mt-1 border rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase text-gray-500">Konfirmasi <span class="text-red-500">*</span></label>
                        <input type="password" wire:model="password_confirmation" class="w-full mt-1 border rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    @error('password') <span class="text-red-500 text-xs col-span-2">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase text-gray-500">Nomor Telepon</label>
                        <input type="text" wire:model="phone" placeholder="08xxxxxxxxxx" class="w-full mt-1 border rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase text-gray-500">Alamat</label>
                        <input type="text" wire:model="address" placeholder="Alamat lengkap" class="w-full mt-1 border rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase text-gray-500">Avatar</label>
                    <input type="file" wire:model="avatar" class="text-xs mt-1">
                    @error('avatar') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror

                    <div class="mt-3 flex items-center gap-3 rounded-xl border border-dashed border-slate-300 bg-slate-50 p-3">
                        @if ($avatar)
                            <img src="{{ $avatar->temporaryUrl() }}" class="h-16 w-16 rounded-full object-cover border border-white shadow" alt="Preview Avatar">
                        @else
                            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-slate-200 text-slate-400">
                                <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg>
                            </div>
                        @endif
                        <p class="text-[11px] text-slate-500">Preview avatar akan muncul di sini.</p>
                    </div>
                </div>

                <button type="submit" wire:loading.attr="disabled" wire:target="register" class="w-full rounded-xl bg-blue-600 py-3 font-bold text-white shadow-lg shadow-blue-200 transition duration-200 hover:bg-blue-700 disabled:cursor-not-allowed disabled:bg-slate-300">
                    <span wire:loading.remove wire:target="register">Daftar Sekarang</span>
                    <span wire:loading wire:target="register">Memproses...</span>
                </button>
            </form>
        </div>
    </div>
</div>

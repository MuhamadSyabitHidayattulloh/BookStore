<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden border border-gray-100">
        <!-- Tab Switcher -->
        <div class="flex border-b">
            <button wire:click="$set('isLogin', true)" class="w-1/2 py-4 text-sm font-bold transition {{ $isLogin ? 'text-blue-600 border-b-2 border-blue-600 bg-blue-50/30' : 'text-gray-400 hover:text-gray-600' }}">
                LOGIN
            </button>
            <button wire:click="$set('isLogin', false)" class="w-1/2 py-4 text-sm font-bold transition {{ !$isLogin ? 'text-blue-600 border-b-2 border-blue-600 bg-blue-50/30' : 'text-gray-400 hover:text-gray-600' }}">
                REGISTER
            </button>
        </div>

        <div class="p-8">
            @if (session()->has('error'))
                <div class="mb-4 p-3 bg-red-50 text-red-600 rounded-lg text-sm border border-red-100">{{ session('error') }}</div>
            @endif

            @if ($isLogin)
                <!-- Form Login -->
                <form wire:submit.prevent="login" class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase">Email Address</label>
                        <input type="email" wire:model="email" class="w-full mt-1 border rounded-xl p-3 focus:ring-2 focus:ring-blue-500 outline-none transition">
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase">Password</label>
                        <input type="password" wire:model="password" class="w-full mt-1 border rounded-xl p-3 focus:ring-2 focus:ring-blue-500 outline-none transition">
                        @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition duration-200">
                        Masuk Ke Akun
                    </button>
                </form>
            @else
                <!-- Form Register -->
                <form wire:submit.prevent="register" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase">Nama</label>
                            <input type="text" wire:model="name" class="w-full mt-1 border rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase">Email</label>
                            <input type="email" wire:model="email" class="w-full mt-1 border rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase">Password</label>
                            <input type="password" wire:model="password" class="w-full mt-1 border rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase">Konfirmasi</label>
                            <input type="password" wire:model="password_confirmation" class="w-full mt-1 border rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        @error('password') <span class="text-red-500 text-xs col-span-2">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase italic">*Avatar (Opsional)</label>
                        <input type="file" wire:model="avatar" class="text-xs mt-1">
                        @error('avatar') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition duration-200">
                        Daftar Sekarang
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>

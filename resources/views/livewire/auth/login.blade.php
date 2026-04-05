<div>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
            @if (session()->has('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            <form wire:submit.prevent="login">
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="email" wire:model.defer="email" required
                        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" id="password" wire:model.defer="password" required
                        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
                </div>
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition duration-200">Login</button>
            </form>
            <p class="mt-4 text-center text-gray-600">Tidak punya akun? <a href="{{ route('register') }}"
                    class="text-blue-500 hover:underline">Daftar di sini</a></p>
        </div>
</div>

<div class="p-6">
    <!-- Header & Search -->
    <div class="flex justify-between items-center mb-4 gap-4">
        <div class="relative w-full max-w-xs text-gray-400 focus-within:text-gray-600">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </span>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama atau email..." 
                class="w-full border rounded-lg pl-10 pr-4 py-2 shadow-sm focus:ring-2 focus:ring-emerald-500 outline-none transition">
        </div>
        <button wire:click="create" class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 shadow transition">+ User</button>
    </div>

    <!-- Alert -->
    @if (session()->has('message')) <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm font-medium">{{ session('message') }}</div> @endif

    <!-- Table -->
    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50 text-left font-medium text-gray-900">
                <tr>
                    <th class="px-4 py-3">User</th>
                    <th class="px-4 py-3">Role</th>
                    <th class="px-4 py-3">Kontak</th>
                    <th class="px-4 py-3">Alamat</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($this->users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 flex items-center gap-3">
                            <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : 'https://ui-avatars.com?name='.$user->name }}" class="h-10 w-10 rounded-full object-cover border shadow-sm">
                            <div>
                                <p class="font-bold text-gray-900">{{ $user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $user->email }}</p>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-700' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-600">{{ $user->phone ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-600 truncate max-w-xs">{{ $user->address ?? '-' }}</td>
                        <td class="px-4 py-3 text-center space-x-2">
                            <button wire:click="edit({{ $user->id }})" class="text-amber-600 font-bold hover:underline">Edit</button>
                            <button wire:click="delete({{ $user->id }})" wire:confirm="Hapus user ini?" class="text-red-600 font-bold hover:underline">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot><tr><td colspan="5" class="px-4 py-3 bg-gray-50 border-t">{{ $this->users->links() }}</td></tr></tfoot>
        </table>
    </div>

    <!-- Invisible Backdrop Modal -->
    @if($isOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-transparent">
        <div class="fixed inset-0" wire:click="$set('isOpen', false)"></div>
        <div class="relative bg-white rounded-xl shadow-2xl border border-gray-200 w-full max-w-md p-6 max-h-[95vh] overflow-y-auto">
            <h2 class="text-lg font-bold mb-4 border-b pb-2">{{ $userId ? 'Edit User' : 'Tambah User' }}</h2>
            
            <form wire:submit.prevent="save" class="space-y-4">
                <!-- Avatar Preview -->
                <div class="flex items-center gap-4 bg-gray-50 p-3 rounded-lg border border-dashed border-gray-300">
                    @if ($avatar)
                        <img src="{{ $avatar->temporaryUrl() }}" class="h-16 w-16 rounded-full object-cover border-2 border-white shadow">
                    @elseif($oldAvatar)
                        <img src="{{ asset('storage/' . $oldAvatar) }}" class="h-16 w-16 rounded-full object-cover border-2 border-white shadow">
                    @else
                        <div class="h-16 w-16 rounded-full bg-gray-200 flex items-center justify-center text-gray-400"><svg class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg></div>
                    @endif
                    <div class="flex-1">
                        <input type="file" wire:model="avatar" class="text-xs">
                        <p class="text-[10px] text-gray-500 mt-1 italic leading-tight">PNG, JPG (Max 1MB). Kosongkan jika tidak ingin mengubah.</p>
                        @error('avatar') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <input type="text" wire:model="name" placeholder="Nama Lengkap" class="w-full border rounded-lg p-2 text-sm">
                        @error('name') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <input type="email" wire:model="email" placeholder="Email" class="w-full border rounded-lg p-2 text-sm">
                        @error('email') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <input type="password" wire:model="password" placeholder="Password {{ $userId ? '(Opsional)' : '' }}" class="w-full border rounded-lg p-2 text-sm">
                        @error('password') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <select wire:model="role" class="w-full border rounded-lg p-2 text-sm">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                        @error('role') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <input type="text" wire:model="phone" placeholder="Nomor Telepon (Contoh: 08123...)" class="w-full border rounded-lg p-2 text-sm">
                    @error('phone') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <textarea wire:model="address" placeholder="Alamat Lengkap" class="w-full border rounded-lg p-2 text-sm h-20"></textarea>
                    @error('address') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end gap-2 pt-4 border-t">
                    <button type="button" wire:click="$set('isOpen', false)" class="text-gray-500 text-sm hover:text-gray-700">Batal</button>
                    <button type="submit" class="bg-emerald-600 text-white px-5 py-2 rounded-lg text-sm font-bold shadow hover:bg-emerald-700 transition">
                        {{ $userId ? 'Simpan Perubahan' : 'Simpan User' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>

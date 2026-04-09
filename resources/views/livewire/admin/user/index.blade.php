<div class="space-y-6">
    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.3em] text-emerald-600">User Management</p>
                <h1 class="mt-2 text-2xl font-black text-slate-900">Kelola Akun Pengguna</h1>
                <p class="mt-1 text-sm text-slate-500">Atur role, data profil, dan informasi kontak user secara terstruktur.</p>
            </div>

            <div class="flex gap-3">
                <div class="relative w-full max-w-xs text-slate-400 focus-within:text-slate-600">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama atau email..."
                        class="w-full rounded-xl border border-slate-200 py-2 pl-10 pr-4 text-sm outline-none transition focus:border-emerald-300 focus:ring-4 focus:ring-emerald-100">
                </div>

                <button wire:click="create" wire:loading.attr="disabled" wire:target="create" class="rounded-xl bg-emerald-600 px-4 py-2 text-sm font-bold text-white transition hover:bg-emerald-700 disabled:cursor-not-allowed disabled:bg-slate-300">
                    + User
                </button>
            </div>
        </div>

        <p wire:loading wire:target="search,create,save,delete,edit" class="mt-4 text-xs font-bold uppercase tracking-[0.2em] text-emerald-500">
            Memproses data user...
        </p>
    </section>

    <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-slate-600">
                <tr>
                    <th class="px-4 py-3">User</th>
                    <th class="px-4 py-3">Role</th>
                    <th class="px-4 py-3">Kontak</th>
                    <th class="px-4 py-3">Alamat</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse ($this->users as $user)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : 'https://ui-avatars.com?name='.$user->name }}" class="h-10 w-10 rounded-full border border-slate-200 object-cover shadow-sm">
                                <div>
                                    <p class="font-bold text-slate-900">{{ $user->name }}</p>
                                    <p class="text-xs text-slate-500">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="rounded-full px-2.5 py-1 text-xs font-bold {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-slate-100 text-slate-700' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-slate-600">{{ $user->phone ?? '-' }}</td>
                        <td class="max-w-xs truncate px-4 py-3 text-slate-600">{{ $user->address ?? '-' }}</td>
                        <td class="space-x-2 px-4 py-3 text-center">
                            <button wire:click="edit({{ $user->id }})" wire:loading.attr="disabled" wire:target="edit({{ $user->id }})" class="font-bold text-amber-600 hover:text-amber-700 disabled:opacity-60">Edit</button>
                            <button wire:click="delete({{ $user->id }})" wire:confirm="Hapus user ini?" wire:loading.attr="disabled" wire:target="delete({{ $user->id }})" class="font-bold text-red-600 hover:text-red-700 disabled:opacity-60">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-12 text-center text-slate-500">Belum ada data user.</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="border-t bg-slate-50 px-4 py-3">{{ $this->users->links() }}</td>
                </tr>
            </tfoot>
        </table>
    </section>

    @if($isOpen)
        <div x-data="{ modalOpen: true }" x-show="modalOpen" x-transition.opacity.duration.150ms class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/35 px-4" x-on:click.self="modalOpen = false; setTimeout(() => $wire.closeModal(), 150)">
            <div class="relative w-full max-w-md rounded-2xl border border-slate-200 bg-white p-6 shadow-2xl">
                <h2 class="mb-4 border-b pb-3 text-lg font-black text-slate-900">{{ $userId ? 'Edit User' : 'Tambah User' }}</h2>

                <form wire:submit.prevent="save" class="space-y-4">
                    <div class="flex items-center gap-4 rounded-xl border border-dashed border-slate-300 bg-slate-50 p-3">
                        @if ($avatar)
                            <img src="{{ $avatar->temporaryUrl() }}" class="h-16 w-16 rounded-full border-2 border-white object-cover shadow">
                        @elseif($oldAvatar)
                            <img src="{{ asset('storage/' . $oldAvatar) }}" class="h-16 w-16 rounded-full border-2 border-white object-cover shadow">
                        @else
                            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-slate-200 text-slate-400">
                                <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg>
                            </div>
                        @endif
                        <div class="flex-1">
                            <label class="mb-1 block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Avatar</label>
                            <input type="file" wire:model="avatar" class="text-xs">
                            <p class="mt-1 text-[10px] italic text-slate-500">PNG/JPG max 1MB.</p>
                            @error('avatar') <span class="text-[10px] font-bold text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Nama <span class="text-red-500">*</span></label>
                            <input type="text" wire:model="name" placeholder="Nama Lengkap" class="w-full rounded-xl border border-slate-200 p-2.5 text-sm outline-none focus:border-emerald-300 focus:ring-4 focus:ring-emerald-100">
                            @error('name') <p class="mt-1 text-[10px] font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Email <span class="text-red-500">*</span></label>
                            <input type="email" wire:model="email" placeholder="Email" class="w-full rounded-xl border border-slate-200 p-2.5 text-sm outline-none focus:border-emerald-300 focus:ring-4 focus:ring-emerald-100">
                            @error('email') <p class="mt-1 text-[10px] font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Password @if(!$userId)<span class="text-red-500">*</span>@endif</label>
                            <input type="password" wire:model="password" placeholder="Password" class="w-full rounded-xl border border-slate-200 p-2.5 text-sm outline-none focus:border-emerald-300 focus:ring-4 focus:ring-emerald-100">
                            @error('password') <p class="mt-1 text-[10px] font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Role <span class="text-red-500">*</span></label>
                            <select wire:model="role" class="w-full rounded-xl border border-slate-200 p-2.5 text-sm outline-none focus:border-emerald-300 focus:ring-4 focus:ring-emerald-100">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                            @error('role') <p class="mt-1 text-[10px] font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Nomor Telepon</label>
                        <input type="text" wire:model="phone" placeholder="Nomor Telepon" class="w-full rounded-xl border border-slate-200 p-2.5 text-sm outline-none focus:border-emerald-300 focus:ring-4 focus:ring-emerald-100">
                        @error('phone') <p class="mt-1 text-[10px] font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Alamat</label>
                        <textarea wire:model="address" placeholder="Alamat Lengkap" class="h-20 w-full rounded-xl border border-slate-200 p-2.5 text-sm outline-none focus:border-emerald-300 focus:ring-4 focus:ring-emerald-100"></textarea>
                        @error('address') <p class="mt-1 text-[10px] font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-2 border-t pt-4">
                        <button type="button" x-on:click="modalOpen = false; setTimeout(() => $wire.closeModal(), 150)" class="px-3 py-2 text-sm font-medium text-slate-500">Batal</button>
                        <button type="submit" wire:loading.attr="disabled" wire:target="save" class="rounded-xl bg-emerald-600 px-5 py-2 text-sm font-bold text-white shadow transition hover:bg-emerald-700 disabled:cursor-not-allowed disabled:bg-slate-300">
                            <span wire:loading.remove wire:target="save">{{ $userId ? 'Simpan Perubahan' : 'Simpan User' }}</span>
                            <span wire:loading wire:target="save">Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
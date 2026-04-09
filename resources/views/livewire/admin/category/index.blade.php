<div class="space-y-6">
    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.3em] text-indigo-600">Category Management</p>
                <h1 class="mt-2 text-2xl font-black text-slate-900">Kelola Kategori Buku</h1>
                <p class="mt-1 text-sm text-slate-500">Rapikan struktur kategori untuk memudahkan pencarian dan pengelompokan koleksi.</p>
            </div>

            <div class="flex gap-3">
                <div class="relative w-full max-w-xs text-slate-400 focus-within:text-slate-600">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari kategori..."
                        class="w-full rounded-xl border border-slate-200 py-2 pl-10 pr-4 text-sm outline-none transition focus:border-indigo-300 focus:ring-4 focus:ring-indigo-100">
                </div>

                <button wire:click="create" wire:loading.attr="disabled" wire:target="create"
                    class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-bold text-white transition hover:bg-indigo-700 disabled:cursor-not-allowed disabled:bg-slate-300">
                    + Kategori
                </button>
            </div>
        </div>

        <p wire:loading wire:target="search,create,save,delete" class="mt-4 text-xs font-bold uppercase tracking-[0.2em] text-indigo-500">
            Memproses data...
        </p>
    </section>

    <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-slate-600">
                <tr>
                    <th class="px-4 py-3 w-20 text-center">No</th>
                    <th class="px-4 py-3">Nama Kategori</th>
                    <th class="px-4 py-3 text-center">Total Buku</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-200">
                @forelse ($this->categories as $index => $cat)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3 text-center text-slate-500">{{ $this->categories->firstItem() + $index }}</td>
                        <td class="px-4 py-3 font-semibold text-slate-900">{{ $cat->name }}</td>
                        <td class="px-4 py-3 text-center">
                            <span class="rounded-lg bg-slate-100 px-2 py-1 text-xs font-bold text-slate-600">{{ $cat->books_count }} Buku</span>
                        </td>
                        <td class="px-4 py-3 text-center space-x-3">
                            <button wire:click="edit({{ $cat->id }})" wire:loading.attr="disabled" wire:target="edit({{ $cat->id }})" class="font-bold text-indigo-600 transition hover:text-indigo-700 disabled:opacity-60">Edit</button>
                            <button wire:click="delete({{ $cat->id }})" wire:confirm="Hapus?" wire:loading.attr="disabled" wire:target="delete({{ $cat->id }})" class="font-bold text-red-600 transition hover:text-red-700 disabled:opacity-60">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-12 text-center text-slate-500">Belum ada kategori.</td>
                    </tr>
                @endforelse
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="4" class="border-t bg-slate-50 px-4 py-3">{{ $this->categories->links() }}</td>
                </tr>
            </tfoot>
        </table>
    </section>

    <div x-data="{ modalOpen: @entangle('isOpen').live }" x-cloak x-show="modalOpen" x-transition.opacity.duration.150ms class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/35 px-4" x-on:click.self="modalOpen = false; $wire.closeModal()" x-on:keydown.escape.window="modalOpen = false; $wire.closeModal()">
            <div class="relative w-full max-w-sm rounded-2xl border border-slate-200 bg-white p-6 shadow-2xl">
                <h2 class="mb-4 border-b pb-3 text-lg font-black text-slate-900">{{ $categoryId ? 'Edit' : 'Tambah' }} Kategori</h2>
                <form wire:submit.prevent="save" class="space-y-4">
                    <div>
                        <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Nama Kategori <span class="text-red-500">*</span></label>
                        <input type="text" wire:model="name" placeholder="Nama Kategori"
                            class="w-full rounded-xl border border-slate-200 p-3 text-sm outline-none transition focus:border-indigo-300 focus:ring-4 focus:ring-indigo-100">
                        @error('name')
                            <p class="mt-1 text-xs font-bold text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-2 border-t pt-4">
                        <button type="button" x-on:click="modalOpen = false; $wire.closeModal()" class="px-3 py-2 text-sm font-medium text-slate-500">Batal</button>
                        <button type="submit" wire:loading.attr="disabled" wire:target="save"
                            class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-bold text-white transition hover:bg-indigo-700 disabled:cursor-not-allowed disabled:bg-slate-300">
                            <span wire:loading.remove wire:target="save">Simpan</span>
                            <span wire:loading wire:target="save">Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
    </div>
</div>
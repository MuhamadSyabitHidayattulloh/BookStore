<div class="space-y-6">
    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.3em] text-blue-600">Books Management</p>
                <h1 class="mt-2 text-2xl font-black text-slate-900">Kelola Koleksi Buku</h1>
                <p class="mt-1 text-sm text-slate-500">Tambahkan, ubah, dan rapikan data buku beserta stok dan kategorinya.</p>
            </div>

            <div class="flex gap-3">
                <div class="relative w-full max-w-xs text-slate-400 focus-within:text-slate-600">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari buku atau penulis..."
                        class="w-full rounded-xl border border-slate-200 py-2 pl-10 pr-4 text-sm outline-none transition focus:border-blue-300 focus:ring-4 focus:ring-blue-100">
                </div>

                <button wire:click="create" wire:loading.attr="disabled" wire:target="create" class="rounded-xl bg-blue-600 px-4 py-2 text-sm font-bold text-white transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:bg-slate-300">
                    + Buku
                </button>
            </div>
        </div>

        <p wire:loading wire:target="search,create,save,delete,edit" class="mt-4 text-xs font-bold uppercase tracking-[0.2em] text-blue-500">
            Memproses data buku...
        </p>
    </section>

    <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-slate-600">
                <tr>
                    <th class="px-4 py-3">Cover</th>
                    <th class="px-4 py-3">Judul</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3">Harga</th>
                    <th class="px-4 py-3">Stok</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-200 text-slate-700">
                @forelse ($this->books as $book)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3">
                            <img src="{{ asset('storage/' . $book->cover) }}" class="h-14 w-10 rounded-lg object-cover shadow-sm">
                        </td>
                        <td class="px-4 py-3 font-semibold text-slate-900">{{ $book->title }}</td>
                        <td class="px-4 py-3 text-xs">
                            <span class="rounded-full bg-blue-50 px-2 py-1 text-blue-700">{{ $book->category->name }}</span>
                        </td>
                        <td class="px-4 py-3 font-mono text-slate-600">Rp {{ number_format($book->price, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 {{ $book->stock < 5 ? 'font-bold text-red-600' : '' }}">{{ $book->stock }}</td>
                        <td class="space-x-2 px-4 py-3 text-center">
                            <button wire:click="edit({{ $book->id }})" wire:loading.attr="disabled" wire:target="edit({{ $book->id }})" class="font-bold text-amber-600 disabled:opacity-60">Edit</button>
                            <button wire:click="delete({{ $book->id }})" wire:confirm="Hapus?" wire:loading.attr="disabled" wire:target="delete({{ $book->id }})" class="font-bold text-red-600 disabled:opacity-60">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center text-slate-500">Belum ada buku yang sesuai pencarian.</td>
                    </tr>
                @endforelse
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="6" class="border-t bg-slate-50 px-4 py-3">{{ $this->books->links() }}</td>
                </tr>
            </tfoot>
        </table>
    </section>

    @if ($isOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/35 px-4" wire:click.self="closeModal">
            <div class="relative max-h-[90vh] w-full max-w-lg overflow-y-auto rounded-2xl border border-slate-200 bg-white p-6 shadow-2xl">
                <h2 class="mb-4 border-b pb-3 text-lg font-black text-slate-900">{{ $bookId ? 'Edit Buku' : 'Tambah Buku' }}</h2>

                <form wire:submit.prevent="save" class="space-y-3">
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Judul <span class="text-red-500">*</span></label>
                    <input type="text" wire:model="title" placeholder="Judul" class="w-full rounded-xl border border-slate-200 p-2.5 text-sm outline-none focus:border-blue-300 focus:ring-4 focus:ring-blue-100">
                    @error('title') <p class="text-xs font-bold text-red-500">{{ $message }}</p> @enderror

                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Penulis <span class="text-red-500">*</span></label>
                    <input type="text" wire:model="author" placeholder="Penulis" class="w-full rounded-xl border border-slate-200 p-2.5 text-sm outline-none focus:border-blue-300 focus:ring-4 focus:ring-blue-100">
                    @error('author') <p class="text-xs font-bold text-red-500">{{ $message }}</p> @enderror

                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Kategori <span class="text-red-500">*</span></label>
                    <select wire:model="category_id" class="w-full rounded-xl border border-slate-200 p-2.5 text-sm outline-none focus:border-blue-300 focus:ring-4 focus:ring-blue-100">
                        <option value="">Pilih Kategori</option>
                        @foreach ($this->categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-xs font-bold text-red-500">{{ $message }}</p> @enderror

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Harga <span class="text-red-500">*</span></label>
                            <input type="number" wire:model="price" placeholder="Harga" class="w-full rounded-xl border border-slate-200 p-2.5 text-sm outline-none focus:border-blue-300 focus:ring-4 focus:ring-blue-100">
                            @error('price') <p class="text-xs font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Stok <span class="text-red-500">*</span></label>
                            <input type="number" wire:model="stock" placeholder="Stok" class="w-full rounded-xl border border-slate-200 p-2.5 text-sm outline-none focus:border-blue-300 focus:ring-4 focus:ring-blue-100">
                            @error('stock') <p class="text-xs font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea wire:model="description" placeholder="Deskripsi" class="h-24 w-full rounded-xl border border-slate-200 p-2.5 text-sm outline-none focus:border-blue-300 focus:ring-4 focus:ring-blue-100"></textarea>
                    @error('description') <p class="text-xs font-bold text-red-500">{{ $message }}</p> @enderror

                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Cover @if (!$bookId)<span class="text-red-500">*</span>@endif</label>
                    <input type="file" wire:model="cover" class="text-sm">
                    @error('cover') <p class="text-xs font-bold text-red-500">{{ $message }}</p> @enderror

                    <div class="mt-2 flex items-center gap-4 rounded-xl border border-dashed bg-slate-50 p-3">
                        @if ($cover)
                            <img src="{{ $cover->temporaryUrl() }}" class="h-20 w-16 rounded-lg object-cover shadow">
                        @elseif($oldCover)
                            <img src="{{ asset('storage/' . $oldCover) }}" class="h-20 w-16 rounded-lg object-cover shadow">
                        @endif
                        <div wire:loading wire:target="cover" class="text-xs italic text-blue-500">Uploading...</div>
                    </div>

                    <div class="flex justify-end gap-2 border-t pt-4">
                        <button type="button" wire:click="closeModal" class="px-3 py-2 text-sm font-medium text-slate-500">Batal</button>
                        <button type="submit" wire:loading.attr="disabled" wire:target="save" class="rounded-xl bg-blue-600 px-4 py-2 text-sm font-bold text-white disabled:cursor-not-allowed disabled:bg-slate-300">
                            <span wire:loading.remove wire:target="save">Simpan</span>
                            <span wire:loading wire:target="save">Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
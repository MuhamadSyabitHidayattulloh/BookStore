<div class="p-6">
    <div class="flex justify-between items-center mb-4 gap-4">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari buku atau penulis..."
            class="w-full max-w-xs border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none shadow-sm">
        <button wire:click="create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">+
            Buku</button>
    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50 text-left">
                <tr>
                    <th class="px-4 py-3">Cover</th>
                    <th class="px-4 py-3">Judul</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3">Harga</th>
                    <th class="px-4 py-3">Stok</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-gray-700">
                @foreach ($this->books as $book)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3"><img src="{{ asset('storage/' . $book->cover) }}"
                                class="h-14 w-10 rounded object-cover shadow-sm"></td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $book->title }}</td>
                        <td class="px-4 py-3 text-xs"><span
                                class="bg-blue-50 text-blue-700 px-2 py-1 rounded-full">{{ $book->category->name }}</span>
                        </td>
                        <td class="px-4 py-3 font-mono text-gray-600">Rp {{ number_format($book->price, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 {{ $book->stock < 5 ? 'text-red-600 font-bold' : '' }}">{{ $book->stock }}
                        </td>
                        <td class="px-4 py-3 text-center space-x-2">
                            <button wire:click="edit({{ $book->id }})"
                                class="text-amber-600 font-bold">Edit</button>
                            <button wire:click="delete({{ $book->id }})" wire:confirm="Hapus?"
                                class="text-red-600 font-bold">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" class="px-4 py-3 bg-gray-50 border-t">{{ $this->books->links() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    @if ($isOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-transparent">
            <div class="fixed inset-0" wire:click="$set('isOpen', false)"></div>
            <div
                class="relative bg-white rounded-xl shadow-2xl border w-full max-w-md p-6 max-h-[90vh] overflow-y-auto">
                <h2 class="text-lg font-bold mb-4 border-b pb-2">{{ $bookId ? 'Edit Buku' : 'Tambah Buku' }}</h2>
                <form wire:submit.prevent="save" class="space-y-3">
                    <input type="text" wire:model="title" placeholder="Judul" class="w-full border rounded-lg p-2">
                    @error('title')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror

                    <input type="text" wire:model="author" placeholder="Penulis"
                        class="w-full border rounded-lg p-2">
                    @error('author')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror

                    <select wire:model="category_id" class="w-full border rounded-lg p-2">
                        <option value="">Pilih Kategori</option>
                        @foreach ($this->categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror

                    <div class="flex gap-2">
                        <div class="w-1/2">
                            <input type="number" wire:model="price" placeholder="Harga"
                                class="w-full border rounded-lg p-2">
                            @error('price')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-1/2">
                            <input type="number" wire:model="stock" placeholder="Stok"
                                class="w-full border rounded-lg p-2">
                            @error('stock')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <textarea wire:model="description" placeholder="Deskripsi" class="w-full border rounded-lg p-2"></textarea>
                    @error('description')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror

                    <input type="file" wire:model="cover" class="text-sm">
                    @error('cover')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror

                    <div class="mt-2 flex items-center gap-4 bg-gray-50 p-2 rounded border border-dashed">
                        @if ($cover)
                            <img src="{{ $cover->temporaryUrl() }}" class="h-20 w-16 object-cover rounded shadow">
                        @elseif($oldCover)
                            <img src="{{ asset('storage/' . $oldCover) }}"
                                class="h-20 w-16 object-cover rounded shadow">
                        @endif
                        <div wire:loading wire:target="cover" class="text-xs text-blue-500 italic">Uploading...</div>
                    </div>

                    <div class="flex justify-end gap-2 pt-4 border-t">
                        <button type="button" wire:click="$set('isOpen', false)"
                            class="text-gray-500 text-sm">Batal</button>
                        <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>

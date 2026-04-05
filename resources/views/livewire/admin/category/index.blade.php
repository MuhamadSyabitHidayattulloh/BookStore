<div class="p-6">
    <div class="flex justify-between items-center mb-4 gap-4">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari kategori..."
            class="w-full max-w-xs border rounded-lg px-4 py-2 shadow-sm outline-none focus:ring-2 focus:ring-indigo-500">
        <button wire:click="create"
            class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 shadow transition">+
            Kategori</button>
    </div>

    @if (session()->has('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-3 text-sm">{{ session('error') }}</div>
    @endif

    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50 text-left">
                <tr>
                    <th class="px-4 py-3 w-20 text-center">No</th>
                    <th class="px-4 py-3">Nama Kategori</th>
                    <th class="px-4 py-3 text-center">Total Buku</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($this->categories as $index => $cat)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-center text-gray-500">{{ $this->categories->firstItem() + $index }}
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $cat->name }}</td>
                        <td class="px-4 py-3 text-center"><span
                                class="px-2 py-1 bg-gray-100 rounded-md">{{ $cat->books_count }} Buku</span></td>
                        <td class="px-4 py-3 text-center space-x-3">
                            <button wire:click="edit({{ $cat->id }})"
                                class="text-indigo-600 font-bold">Edit</button>
                            <button wire:click="delete({{ $cat->id }})" wire:confirm="Hapus?"
                                class="text-red-600 font-bold">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="px-4 py-3 bg-gray-50 border-t">{{ $this->categories->links() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    @if ($isOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-transparent">
            <div class="fixed inset-0" wire:click="$set('isOpen', false)"></div>
            <div class="relative bg-white rounded-xl shadow-2xl border w-full max-w-xs p-6">
                <h2 class="text-lg font-bold mb-4">{{ $categoryId ? 'Edit' : 'Tambah' }} Kategori</h2>
                <form wire:submit.prevent="save" class="space-y-4">
                    <div>
                        <input type="text" wire:model="name" placeholder="Nama Kategori"
                            class="w-full border rounded-lg p-2.5 outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end gap-2 pt-2 border-t">
                        <button type="button" wire:click="$set('isOpen', false)"
                            class="text-gray-500 text-sm">Batal</button>
                        <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-bold shadow">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>

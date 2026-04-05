<div class="p-6">
    <div class="mb-8">
        <h1 class="text-2xl font-black text-gray-800">Inbox Pesan</h1>
        <p class="text-sm text-gray-500">Kelola aspirasi dan pertanyaan dari pelanggan Anda.</p>
    </div>

    <div class="space-y-4">
        @forelse($this->messages as $msg)
            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col md:flex-row gap-6 transition hover:shadow-md {{ !$msg->is_read ? 'border-l-4 border-l-indigo-600' : '' }}">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <!-- Mengambil data user dari relasi -->
                        <span class="font-black text-gray-900">{{ $msg->user->name }}</span>
                        <span class="text-gray-400 text-xs">&bull;</span>
                        <span class="text-xs text-gray-500 font-medium">{{ $msg->user->email }}</span>

                        @if (!$msg->is_read)
                            <span
                                class="bg-indigo-100 text-indigo-700 text-[10px] font-black px-2 py-0.5 rounded-full uppercase tracking-tighter">Baru</span>
                        @endif
                    </div>

                    <h3 class="font-bold text-indigo-600 mb-2">{{ $msg->subject }}</h3>
                    <p class="text-sm text-gray-600 leading-relaxed italic">"{{ $msg->message }}"</p>
                    <p class="text-[10px] text-gray-400 mt-4 uppercase font-bold">
                        {{ $msg->created_at->diffForHumans() }}</p>
                </div>

                <div class="flex items-center gap-3">
                    @if (!$msg->is_read)
                        <button wire:click="markAsRead({{ $msg->id }})"
                            class="bg-indigo-50 text-indigo-600 px-4 py-2 rounded-lg text-xs font-bold hover:bg-indigo-100 transition">
                            Tandai Dibaca
                        </button>
                    @endif
                    <button wire:click="delete({{ $msg->id }})" wire:confirm="Hapus pesan ini?"
                        class="p-2 text-red-400 hover:text-red-600 transition">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        @empty
            <div class="text-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed">
                <p class="text-gray-400 italic">Belum ada pesan masuk.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $this->messages->links() }}
    </div>
</div>

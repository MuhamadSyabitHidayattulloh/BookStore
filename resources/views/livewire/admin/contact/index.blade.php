<div class="space-y-6">
    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <p class="text-xs font-black uppercase tracking-[0.3em] text-indigo-600">Inbox Center</p>
        <h1 class="mt-2 text-2xl font-black text-slate-900">Pesan Masuk Pelanggan</h1>
        <p class="mt-1 text-sm text-slate-500">Pantau pertanyaan user, tandai pesan yang sudah ditangani, dan rapikan inbox admin.</p>

        <p wire:loading wire:target="markAsRead,delete" class="mt-4 text-xs font-bold uppercase tracking-[0.2em] text-indigo-500">
            Memproses aksi inbox...
        </p>
    </section>

    <section class="space-y-4">
        @forelse($this->messages as $msg)
            <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-md {{ !$msg->is_read ? 'ring-1 ring-indigo-100' : '' }}">
                <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                    <div class="flex-1">
                        <div class="mb-2 flex flex-wrap items-center gap-3">
                            <span class="font-black text-slate-900">{{ $msg->user->name }}</span>
                            <span class="text-xs text-slate-400">{{ $msg->user->email }}</span>
                            @if (!$msg->is_read)
                                <span class="rounded-full bg-indigo-100 px-2.5 py-1 text-[10px] font-black uppercase tracking-[0.2em] text-indigo-700">Baru</span>
                            @endif
                        </div>

                        <h3 class="text-base font-black text-indigo-700">{{ $msg->subject }}</h3>
                        <p class="mt-2 text-sm leading-7 text-slate-600">{{ $msg->message }}</p>
                        <p class="mt-3 text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400">{{ $msg->created_at->diffForHumans() }}</p>
                    </div>

                    <div class="flex items-center gap-2">
                        @if (!$msg->is_read)
                            <button wire:click="markAsRead({{ $msg->id }})" wire:loading.attr="disabled" wire:target="markAsRead({{ $msg->id }})"
                                class="rounded-xl bg-indigo-50 px-4 py-2 text-xs font-bold text-indigo-700 transition hover:bg-indigo-100 disabled:cursor-not-allowed disabled:opacity-60">
                                Tandai Dibaca
                            </button>
                        @endif

                        <button wire:click="delete({{ $msg->id }})" wire:confirm="Hapus pesan ini?" wire:loading.attr="disabled" wire:target="delete({{ $msg->id }})"
                            class="rounded-xl bg-red-50 px-4 py-2 text-xs font-bold text-red-600 transition hover:bg-red-100 disabled:cursor-not-allowed disabled:opacity-60">
                            Hapus
                        </button>
                    </div>
                </div>
            </article>
        @empty
            <div class="rounded-3xl border border-dashed border-slate-300 bg-slate-50 py-20 text-center text-slate-500">
                Belum ada pesan masuk.
            </div>
        @endforelse
    </section>

    <div>
        {{ $this->messages->links() }}
    </div>
</div>
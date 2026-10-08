@extends('layouts.app')

@section('title', 'Kategori')

@section('content')

{{-- ============ HERO ============ --}}
<section class="relative overflow-hidden bg-gradient-to-br from-forest-950 via-forest-900 to-forest-700">
    <div class="pointer-events-none absolute -right-24 -top-24 h-80 w-80 rounded-full bg-lime-400/20 blur-3xl"></div>
    <div class="pointer-events-none absolute -left-20 bottom-0 h-72 w-72 rounded-full bg-lime-500/10 blur-3xl"></div>

    <div class="relative mx-auto max-w-7xl px-5 py-16">
        <span class="inline-flex items-center gap-2 rounded-full border border-lime-400/30 bg-lime-400/15 px-4 py-1.5 text-[11px] font-bold uppercase tracking-widest text-lime-300">
            <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-lime-400"></span>
            Manajemen Koleksi
        </span>

        <h1 class="mt-6 text-4xl font-extrabold leading-[1.1] text-white md:text-5xl">
            Kelola <span class="text-lime-400">Kategori</span> Buku
        </h1>
        <p class="mt-4 max-w-2xl text-base text-forest-100/80 md:text-lg">
            Susun koleksi perpustakaan berdasarkan kategori agar mudah ditelusuri.
        </p>

        <div class="mt-8">
            <a href="{{ route('Category.create') }}"
               class="inline-flex items-center gap-2 rounded-xl bg-lime-500 px-6 py-3 text-sm font-bold text-forest-950 shadow-lg shadow-lime-500/20 transition hover:bg-lime-400">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" d="M12 5v14M5 12h14"/>
                </svg>
                Tambah Kategori
            </a>
        </div>
    </div>
</section>

{{-- ============ LIST KATEGORI ============ --}}
<section class="mx-auto max-w-7xl px-5 py-12">

    <div class="mb-7">
        <h2 class="text-2xl font-extrabold tracking-tight text-forest-900">Semua Kategori</h2>
        <p class="mt-1 text-sm text-forest-500">Total {{ $kategori->count() }} kategori terdaftar</p>
    </div>

    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($kategori as $item)
            <article class="card-hover group relative overflow-hidden rounded-2xl border border-forest-100 bg-white p-6 shadow-sm">

                <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-lime-100/70 transition group-hover:scale-125"></div>

                <div class="relative">
                    <div class="flex items-start justify-between gap-3">
                        <span class="grid h-12 w-12 place-items-center rounded-2xl bg-forest-900 text-lg font-black text-lime-400">
                            {{ strtoupper(substr($item->Name, 0, 1)) }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-lime-100 px-3 py-1 text-[11px] font-bold text-forest-800">
                            {{ $item->MengambilBuku_count ?? $item->MengambilBuku->count() }} buku
                        </span>
                    </div>

                    <h3 class="mt-5 text-lg font-extrabold text-forest-900">{{ $item->Name }}</h3>
                    <p class="mt-2 line-clamp-3 min-h-[3.75rem] text-sm leading-relaxed text-forest-500">
                        {{ $item->Description ?: 'Belum ada deskripsi untuk kategori ini.' }}
                    </p>

                    <div class="mt-6 flex items-center gap-2 border-t border-dashed border-forest-100 pt-5">
                        <a href="{{ route('Category.edit', $item) }}"
                           class="inline-flex flex-1 items-center justify-center gap-1.5 rounded-xl border border-forest-200 px-4 py-2.5 text-sm font-bold text-forest-700 transition hover:border-lime-400 hover:bg-lime-50">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.4-9.4a2 2 0 112.8 2.8L11 16l-4 1 1-4 9.6-9.4z"/>
                            </svg>
                            Edit
                        </a>

                        <form action="{{ route('Category.destroy', $item) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Hapus"
                                class="grid h-10 w-10 place-items-center rounded-xl border border-forest-200 text-forest-500 transition hover:border-rose-300 hover:bg-rose-50 hover:text-rose-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 7h12M9 7V5a1 1 0 011-1h4a1 1 0 011 1v2m2 0v12a2 2 0 01-2 2H8a2 2 0 01-2-2V7h12z"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full rounded-3xl border-2 border-dashed border-forest-200 bg-white px-6 py-20 text-center">
                <div class="mx-auto grid h-16 w-16 place-items-center rounded-2xl bg-lime-100 text-forest-700">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
                    </svg>
                </div>
                <h3 class="mt-5 text-lg font-bold text-forest-900">Belum ada kategori</h3>
                <p class="mx-auto mt-1.5 max-w-sm text-sm text-forest-500">
                    Buat kategori terlebih dahulu sebelum menambahkan buku.
                </p>
                <a href="{{ route('Category.create') }}"
                   class="mt-6 inline-flex items-center gap-2 rounded-xl bg-forest-900 px-5 py-3 text-sm font-bold text-lime-400 transition hover:bg-forest-800">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M12 5v14M5 12h14"/>
                    </svg>
                    Tambah Kategori
                </a>
            </div>
        @endforelse
    </div>
</section>

@endsection
@extends('layouts.app')

@section('title', 'Koleksi Buku')

@section('content')

{{-- ============ HERO ============ --}}
<section class="relative overflow-hidden bg-gradient-to-br from-forest-950 via-forest-900 to-forest-700">
    <div class="pointer-events-none absolute -right-24 -top-24 h-80 w-80 rounded-full bg-lime-400/20 blur-3xl"></div>
    <div class="pointer-events-none absolute -left-20 bottom-0 h-72 w-72 rounded-full bg-lime-500/10 blur-3xl"></div>

    <div class="relative mx-auto max-w-7xl px-5 py-16">
        <span class="inline-flex items-center gap-2 rounded-full border border-lime-400/30 bg-lime-400/15 px-4 py-1.5 text-[11px] font-bold uppercase tracking-widest text-lime-300">
            <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-lime-400"></span>
            Perpustakaan Digital
        </span>

        <h1 class="mt-6 text-4xl font-extrabold leading-[1.1] text-white md:text-5xl">
            Jelajahi <span class="text-lime-400">Koleksi Buku</span><br class="hidden sm:block"> Tanpa Batas
        </h1>
        <p class="mt-4 max-w-2xl text-base text-forest-100/80 md:text-lg">
            Kelola, telusuri, dan tambahkan koleksi buku perpustakaan dalam satu tempat yang rapi.
        </p>

        {{-- Search --}}
        <form action="{{ route('Book.index') }}" method="GET" class="mt-8 max-w-2xl">
            <div class="flex items-center gap-2 rounded-2xl bg-white p-2 shadow-2xl shadow-forest-950/40">
                <svg class="ml-2 h-5 w-5 shrink-0 text-forest-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="7"/><path stroke-linecap="round" d="M20 20l-3.5-3.5"/>
                </svg>
                <input type="text" name="q" value="{{ request('q') }}"
                       placeholder="Cari judul, penulis, atau kategori..."
                       class="w-full bg-transparent px-2 py-2.5 text-sm text-forest-900 placeholder-forest-400 focus:outline-none">
                <button class="rounded-xl bg-lime-500 px-6 py-2.5 text-sm font-bold text-forest-950 transition hover:bg-lime-400">
                    Cari
                </button>
            </div>
        </form>

        {{-- Stats --}}
        <div class="mt-10 grid max-w-3xl grid-cols-2 gap-3 sm:grid-cols-3">
            <div class="rounded-2xl border border-white/10 bg-white/5 px-5 py-4 backdrop-blur">
                <p class="text-2xl font-extrabold text-lime-400">{{ $buku->count() }}</p>
                <p class="mt-0.5 text-xs font-semibold uppercase tracking-wider text-forest-100/70">Total Buku</p>
            </div>
            <div class="rounded-2xl border border-white/10 bg-white/5 px-5 py-4 backdrop-blur">
                <p class="text-2xl font-extrabold text-lime-400">{{ $buku->sum('stock') }}</p>
                <p class="mt-0.5 text-xs font-semibold uppercase tracking-wider text-forest-100/70">Total Stok</p>
            </div>
            <div class="col-span-2 rounded-2xl border border-white/10 bg-white/5 px-5 py-4 backdrop-blur sm:col-span-1">
                <p class="text-2xl font-extrabold text-lime-400">{{ $buku->pluck('category_id')->unique()->count() }}</p>
                <p class="mt-0.5 text-xs font-semibold uppercase tracking-wider text-forest-100/70">Kategori Terpakai</p>
            </div>
        </div>
    </div>
</section>

{{-- ============ LIST BUKU ============ --}}
<section class="mx-auto max-w-7xl px-5 py-12">

    <div class="mb-7 flex flex-wrap items-end justify-between gap-4">
        <div>
            <h2 class="text-2xl font-extrabold tracking-tight text-forest-900">Daftar Buku</h2>
            <p class="mt-1 text-sm text-forest-500">
                @if (request('q'))
                    Hasil pencarian untuk "<span class="font-semibold text-forest-700">{{ request('q') }}</span>"
                @else
                    Semua koleksi yang tersedia di perpustakaan
                @endif
            </p>
        </div>

        <div class="flex items-center gap-2">
            @if (request('q'))
                <a href="{{ route('Book.index') }}"
                   class="rounded-xl border border-forest-200 bg-white px-4 py-2.5 text-sm font-semibold text-forest-600 transition hover:bg-forest-50">
                    Reset
                </a>
            @endif
            <a href="{{ route('Book.create') }}"
               class="inline-flex items-center gap-1.5 rounded-xl bg-forest-900 px-5 py-2.5 text-sm font-bold text-lime-400 transition hover:bg-forest-800">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" d="M12 5v14M5 12h14"/>
                </svg>
                Tambah Buku
            </a>
        </div>
    </div>

    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($buku as $item)
            <article class="card-hover group flex flex-col rounded-2xl border border-forest-100 bg-white p-5 shadow-sm">

                <div class="flex items-start justify-between gap-3">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-lime-100 px-3 py-1 text-[11px] font-bold text-forest-800">
                        <span class="h-1.5 w-1.5 rounded-full bg-lime-500"></span>
                        {{ $item->MengambilKategory->Name ?? 'Tanpa Kategori' }}
                    </span>
                    <span class="rounded-lg bg-forest-900 px-2.5 py-1 text-[11px] font-bold text-lime-400">
                        {{ $item->published_year }}
                    </span>
                </div>

                <h3 class="mt-4 text-lg font-bold leading-snug text-forest-900 transition group-hover:text-forest-600">
                    {{ $item->title }}
                </h3>
                <p class="mt-1 text-sm text-forest-500">
                    oleh <span class="font-semibold text-forest-700">{{ $item->author }}</span>
                </p>

                <div class="mt-auto flex items-center justify-between border-t border-dashed border-forest-100 pt-4 mt-5">
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-semibold uppercase tracking-wider text-forest-400">Stok</span>
                        <span class="rounded-md px-2 py-0.5 text-sm font-extrabold
                            {{ $item->stock > 0 ? 'bg-lime-100 text-forest-800' : 'bg-rose-100 text-rose-700' }}">
                            {{ $item->stock }}
                        </span>
                    </div>

                    <div class="flex items-center gap-1">
                        <a href="{{ route('Book.edit', $item) }}"
                           title="Edit"
                           class="grid h-9 w-9 place-items-center rounded-lg border border-forest-200 text-forest-600 transition hover:border-lime-400 hover:bg-lime-50 hover:text-forest-800">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.4-9.4a2 2 0 112.8 2.8L11 16l-4 1 1-4 9.6-9.4z"/>
                            </svg>
                        </a>

                        <form action="{{ route('Book.destroy', $item) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Hapus"
                                class="grid h-9 w-9 place-items-center rounded-lg border border-forest-200 text-forest-500 transition hover:border-rose-300 hover:bg-rose-50 hover:text-rose-600">
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
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 5a2 2 0 012-2h9l5 5v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5z"/>
                        <path stroke-linecap="round" d="M14 3v6h6"/>
                    </svg>
                </div>
                <h3 class="mt-5 text-lg font-bold text-forest-900">Belum ada buku</h3>
                <p class="mx-auto mt-1.5 max-w-sm text-sm text-forest-500">
                    Koleksi masih kosong. Mulai tambahkan buku pertama Anda ke perpustakaan.
                </p>
                <a href="{{ route('Book.create') }}"
                   class="mt-6 inline-flex items-center gap-2 rounded-xl bg-forest-900 px-5 py-3 text-sm font-bold text-lime-400 transition hover:bg-forest-800">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M12 5v14M5 12h14"/>
                    </svg>
                    Tambah Buku Pertama
                </a>
            </div>
        @endforelse
    </div>
</section>

@endsection
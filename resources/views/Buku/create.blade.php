@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')

<section class="bg-gradient-to-br from-forest-950 via-forest-900 to-forest-700">
    <div class="mx-auto max-w-7xl px-5 py-12">
        <nav class="flex items-center gap-2 text-xs font-semibold text-forest-200/80">
            <a href="{{ route('Book.index') }}" class="transition hover:text-lime-400">Buku</a>
            <span>/</span>
            <span class="text-lime-400">Tambah</span>
        </nav>
        <h1 class="mt-4 text-3xl font-extrabold text-white md:text-4xl">Tambah Buku Baru</h1>
        <p class="mt-2 max-w-xl text-sm text-forest-100/75">
            Lengkapi data di bawah untuk menambahkan koleksi baru ke perpustakaan.
        </p>
    </div>
</section>

<section class="mx-auto max-w-3xl px-5 py-12">
    <div class="overflow-hidden rounded-3xl border border-forest-100 bg-white shadow-soft">

        <div class="h-1.5 w-full bg-gradient-to-r from-forest-900 via-lime-500 to-lime-300"></div>

        <form action="{{ route('Book.store') }}" method="POST" class="p-7 md:p-9">
            @csrf

            {{-- Kategori --}}
            <div class="mb-6">
                <label for="category_id" class="mb-2 block text-sm font-bold text-forest-900">
                    Kategori <span class="text-lime-600">*</span>
                </label>
                <select name="category_id" id="category_id" required
                    class="w-full rounded-xl border bg-white px-4 py-3 text-sm text-forest-900 transition
                    focus:border-lime-500 focus:outline-none focus:ring-4 focus:ring-lime-500/20
                    {{ $errors->has('category_id') ? 'border-rose-400' : 'border-forest-200' }}">
                    <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>-- Pilih Kategori --</option>
                    @foreach ($kategori as $kat)
                        <option value="{{ $kat->id }}" {{ old('category_id') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->Name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Judul --}}
            <div class="mb-6">
                <label for="title" class="mb-2 block text-sm font-bold text-forest-900">
                    Judul Buku <span class="text-lime-600">*</span>
                </label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required maxlength="255"
                    placeholder="Contoh: Pemrograman Laravel untuk Pemula"
                    class="w-full rounded-xl border px-4 py-3 text-sm text-forest-900 placeholder-forest-400 transition
                    focus:border-lime-500 focus:outline-none focus:ring-4 focus:ring-lime-500/20
                    {{ $errors->has('title') ? 'border-rose-400' : 'border-forest-200' }}">
                @error('title')
                    <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Penulis + Tahun --}}
            <div class="mb-6 grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="author" class="mb-2 block text-sm font-bold text-forest-900">
                        Penulis <span class="text-lime-600">*</span>
                    </label>
                    <input type="text" name="author" id="author" value="{{ old('author') }}" required maxlength="100"
                        placeholder="Nama penulis"
                        class="w-full rounded-xl border px-4 py-3 text-sm text-forest-900 placeholder-forest-400 transition
                        focus:border-lime-500 focus:outline-none focus:ring-4 focus:ring-lime-500/20
                        {{ $errors->has('author') ? 'border-rose-400' : 'border-forest-200' }}">
                    @error('author')
                        <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="published_year" class="mb-2 block text-sm font-bold text-forest-900">
                        Tahun Terbit <span class="text-lime-600">*</span>
                    </label>
                    <input type="number" name="published_year" id="published_year"
                        value="{{ old('published_year', date('Y')) }}" required min="1900" max="{{ date('Y') + 1 }}"
                        class="w-full rounded-xl border px-4 py-3 text-sm text-forest-900 transition
                        focus:border-lime-500 focus:outline-none focus:ring-4 focus:ring-lime-500/20
                        {{ $errors->has('published_year') ? 'border-rose-400' : 'border-forest-200' }}">
                    @error('published_year')
                        <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Stok --}}
            <div class="mb-8">
                <label for="stock" class="mb-2 block text-sm font-bold text-forest-900">
                    Stok <span class="text-lime-600">*</span>
                </label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" required min="0"
                    class="w-full rounded-xl border px-4 py-3 text-sm text-forest-900 transition
                    focus:border-lime-500 focus:outline-none focus:ring-4 focus:ring-lime-500/20
                    {{ $errors->has('stock') ? 'border-rose-400' : 'border-forest-200' }}">
                @error('stock')
                    <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="flex flex-col-reverse gap-3 border-t border-forest-100 pt-6 sm:flex-row sm:justify-end">
                <a href="{{ route('Book.index') }}"
                   class="inline-flex items-center justify-center rounded-xl border border-forest-200 px-6 py-3 text-sm font-bold text-forest-600 transition hover:bg-forest-50">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-forest-900 px-7 py-3 text-sm font-bold text-lime-400 shadow-sm transition hover:bg-forest-800">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Buku
                </button>
            </div>
        </form>
    </div>
</section>

@endsection
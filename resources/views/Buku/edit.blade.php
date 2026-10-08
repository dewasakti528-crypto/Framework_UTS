@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')

<section class="bg-gradient-to-br from-forest-950 via-forest-900 to-forest-700">
    <div class="mx-auto max-w-7xl px-5 py-12">
        <nav class="flex items-center gap-2 text-xs font-semibold text-forest-200/80">
            <a href="{{ route('Book.index') }}" class="transition hover:text-lime-400">Buku</a>
            <span>/</span>
            <span class="text-lime-400">Edit</span>
        </nav>
        <h1 class="mt-4 text-3xl font-extrabold text-white md:text-4xl">Edit Buku</h1>
        <p class="mt-2 max-w-xl text-sm text-forest-100/75">
            Perbarui informasi buku "<span class="font-semibold text-lime-400">{{ $buku->title }}</span>".
        </p>
    </div>
</section>

<section class="mx-auto max-w-3xl px-5 py-12">
    <div class="overflow-hidden rounded-3xl border border-forest-100 bg-white shadow-soft">

        <div class="h-1.5 w-full bg-gradient-to-r from-forest-900 via-lime-500 to-lime-300"></div>

        <form action="{{ route('Book.update', $buku) }}" method="POST" class="p-7 md:p-9">
            @csrf
            @method('PUT')

            {{-- Kategori --}}
            <div class="mb-6">
                <label for="category_id" class="mb-2 block text-sm font-bold text-forest-900">
                    Kategori <span class="text-lime-600">*</span>
                </label>
                <select name="category_id" id="category_id" required
                    class="w-full rounded-xl border bg-white px-4 py-3 text-sm text-forest-900 transition
                    focus:border-lime-500 focus:outline-none focus:ring-4 focus:ring-lime-500/20
                    {{ $errors->has('category_id') ? 'border-rose-400' : 'border-forest-200' }}">
                    @foreach ($kategori as $kat)
                        <option value="{{ $kat->id }}"
                            {{ old('category_id', $buku->category_id) == $kat->id ? 'selected' : '' }}>
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
                <input type="text" name="title" id="title" required maxlength="255"
                    value="{{ old('title', $buku->title) }}"
                    class="w-full rounded-xl border px-4 py-3 text-sm text-forest-900 transition
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
                    <input type="text" name="author" id="author" required maxlength="100"
                        value="{{ old('author', $buku->author) }}"
                        class="w-full rounded-xl border px-4 py-3 text-sm text-forest-900 transition
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
                    <input type="number" name="published_year" id="published_year" required
                        value="{{ old('published_year', $buku->published_year) }}"
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
                <input type="number" name="stock" id="stock" required min="0"
                    value="{{ old('stock', $buku->stock) }}"
                    class="w-full rounded-xl border px-4 py-3 text-sm text-forest-900 transition
                    focus:border-lime-500 focus:outline-none focus:ring-4 focus:ring-lime-500/20
                    {{ $errors->has('stock') ? 'border-rose-400' : 'border-forest-200' }}">
                @error('stock')
                    <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="flex flex-col-reverse gap-3 border-t border-forest-100 pt-6 sm:flex-row sm:justify-between">
                <form action="{{ route('Book.destroy', $buku) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-rose-200 px-5 py-3 text-sm font-bold text-rose-600 transition hover:bg-rose-50 sm:w-auto">
                        Hapus Buku
                    </button>
                </form>

                <div class="flex flex-col-reverse gap-3 sm:flex-row">
                    <a href="{{ route('Book.index') }}"
                       class="inline-flex items-center justify-center rounded-xl border border-forest-200 px-6 py-3 text-sm font-bold text-forest-600 transition hover:bg-forest-50">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-forest-900 px-7 py-3 text-sm font-bold text-lime-400 shadow-sm transition hover:bg-forest-800">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        Perbarui Buku
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection
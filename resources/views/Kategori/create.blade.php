@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

<section class="bg-gradient-to-br from-forest-950 via-forest-900 to-forest-700">
    <div class="mx-auto max-w-7xl px-5 py-12">
        <nav class="flex items-center gap-2 text-xs font-semibold text-forest-200/80">
            <a href="{{ route('Category.index') }}" class="transition hover:text-lime-400">Kategori</a>
            <span>/</span>
            <span class="text-lime-400">Tambah</span>
        </nav>
        <h1 class="mt-4 text-3xl font-extrabold text-white md:text-4xl">Tambah Kategori</h1>
        <p class="mt-2 max-w-xl text-sm text-forest-100/75">
            Buat kategori baru untuk mengelompokkan koleksi buku.
        </p>
    </div>
</section>

<section class="mx-auto max-w-3xl px-5 py-12">
    <div class="overflow-hidden rounded-3xl border border-forest-100 bg-white shadow-soft">

        <div class="h-1.5 w-full bg-gradient-to-r from-forest-900 via-lime-500 to-lime-300"></div>

        <form action="{{ route('Category.store') }}" method="POST" class="p-7 md:p-9">
            @csrf

            {{-- Nama --}}
            <div class="mb-6">
                <label for="Name" class="mb-2 block text-sm font-bold text-forest-900">
                    Nama Kategori <span class="text-lime-600">*</span>
                </label>
                <input type="text" name="Name" id="Name" value="{{ old('Name') }}" required maxlength="100"
                    placeholder="Contoh: Teknologi & Komputer"
                    class="w-full rounded-xl border px-4 py-3 text-sm text-forest-900 placeholder-forest-400 transition
                    focus:border-lime-500 focus:outline-none focus:ring-4 focus:ring-lime-500/20
                    {{ $errors->has('Name') ? 'border-rose-400' : 'border-forest-200' }}">
                @error('Name')
                    <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="mb-8">
                <label for="Description" class="mb-2 block text-sm font-bold text-forest-900">
                    Deskripsi <span class="text-forest-400 font-medium">(opsional)</span>
                </label>
                <textarea name="Description" id="Description" rows="5"
                    placeholder="Jelaskan secara singkat cakupan kategori ini..."
                    class="w-full resize-none rounded-xl border px-4 py-3 text-sm text-forest-900 placeholder-forest-400 transition
                    focus:border-lime-500 focus:outline-none focus:ring-4 focus:ring-lime-500/20
                    {{ $errors->has('Description') ? 'border-rose-400' : 'border-forest-200' }}">{{ old('Description') }}</textarea>
                @error('Description')
                    <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="flex flex-col-reverse gap-3 border-t border-forest-100 pt-6 sm:flex-row sm:justify-end">
                <a href="{{ route('Category.index') }}"
                   class="inline-flex items-center justify-center rounded-xl border border-forest-200 px-6 py-3 text-sm font-bold text-forest-600 transition hover:bg-forest-50">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-forest-900 px-7 py-3 text-sm font-bold text-lime-400 shadow-sm transition hover:bg-forest-800">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</section>

@endsection
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Beranda') &middot; PustakaLime</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui'] },
                    colors: {
                        lime: {
                            50:'#f7fee7',100:'#ecfccb',200:'#d9f99d',300:'#bef264',
                            400:'#a3e635',500:'#84cc16',600:'#65a30d',700:'#4d7c0f',
                            800:'#3f6212',900:'#365314',950:'#1a2e05',
                        },
                        forest: {
                            50:'#f0fdf4',100:'#dcfce7',200:'#bbf7d0',300:'#86efac',
                            400:'#4ade80',500:'#22c55e',600:'#16a34a',700:'#15803d',
                            800:'#166534',900:'#14532d',950:'#052e16',
                        },
                    },
                    boxShadow: {
                        soft: '0 10px 30px -12px rgba(5, 46, 22, 0.25)',
                    },
                },
            },
        };
    </script>
    <style>
        ::-webkit-scrollbar { width: 10px; height: 10px; }
        ::-webkit-scrollbar-track { background: #f0fdf4; }
        ::-webkit-scrollbar-thumb { background: #bef264; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #84cc16; }
        .card-hover { transition: all .22s cubic-bezier(.4,0,.2,1); }
        .card-hover:hover { transform: translateY(-3px); box-shadow: 0 16px 32px -16px rgba(5,46,22,.35); }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-forest-50/40 font-sans text-forest-950 antialiased">

    {{-- ================= NAVBAR ================= --}}
    <header class="sticky top-0 z-40 border-b border-forest-100 bg-white/90 backdrop-blur-md">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-5 py-3.5">

            <a href="{{ url('/') }}" class="flex items-center gap-2.5 shrink-0">
                <span class="grid h-9 w-9 place-items-center rounded-xl bg-forest-900 text-lg font-black text-lime-400">P</span>
                <span class="text-lg font-extrabold tracking-tight text-forest-900">
                    Pustaka<span class="text-lime-600">Lime</span>
                </span>
            </a>

            <nav class="hidden items-center gap-1 md:flex">
                @php
                    $isBook = request()->routeIs('Book.*');
                    $isCat  = request()->routeIs('Category.*');
                @endphp
                <a href="{{ route('Book.index') }}"
                   class="rounded-lg px-4 py-2 text-sm font-semibold transition
                   {{ $isBook ? 'bg-lime-100 text-forest-900' : 'text-forest-600 hover:bg-forest-50 hover:text-forest-900' }}">
                    Buku
                </a>
                <a href="{{ route('Category.index') }}"
                   class="rounded-lg px-4 py-2 text-sm font-semibold transition
                   {{ $isCat ? 'bg-lime-100 text-forest-900' : 'text-forest-600 hover:bg-forest-50 hover:text-forest-900' }}">
                    Kategori
                </a>
            </nav>

            <div class="flex items-center gap-2">
                <a href="{{ route('Book.create') }}"
                   class="inline-flex items-center gap-1.5 rounded-xl bg-forest-900 px-4 py-2.5 text-sm font-bold text-lime-400 shadow-sm transition hover:bg-forest-800">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M12 5v14M5 12h14"/>
                    </svg>
                    <span class="hidden sm:inline">Buku Baru</span>
                </a>
            </div>
        </div>
    </header>

    {{-- ================= FLASH MESSAGE ================= --}}
    @if (session('success') || session('error'))
        <div class="mx-auto w-full max-w-7xl px-5 pt-6">
            @if (session('success'))
                <div class="flex items-start gap-3 rounded-2xl border border-lime-300 bg-lime-50 px-5 py-4 shadow-sm">
                    <span class="mt-0.5 grid h-6 w-6 shrink-0 place-items-center rounded-full bg-lime-500 text-white">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    </span>
                    <p class="text-sm font-semibold text-forest-800">{{ session('success') }}</p>
                </div>
            @endif
            @if (session('error'))
                <div class="flex items-start gap-3 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 shadow-sm">
                    <span class="mt-0.5 grid h-6 w-6 shrink-0 place-items-center rounded-full bg-rose-500 text-white font-bold">!</span>
                    <p class="text-sm font-semibold text-rose-700">{{ session('error') }}</p>
                </div>
            @endif
        </div>
    @endif

    {{-- ================= CONTENT ================= --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- ================= FOOTER ================= --}}
    <footer class="mt-20 border-t border-forest-100 bg-white">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-4 px-5 py-8 sm:flex-row">
            <div class="flex items-center gap-2.5">
                <span class="grid h-8 w-8 place-items-center rounded-lg bg-forest-900 text-sm font-black text-lime-400">P</span>
                <span class="text-sm font-bold text-forest-900">Pustaka<span class="text-lime-600">Lime</span></span>
            </div>
            <p class="text-xs text-forest-500">&copy; {{ date('Y') }} PustakaLime. Dibuat dengan Laravel &amp; Tailwind.</p>
        </div>
    </footer>

</body>
</html>
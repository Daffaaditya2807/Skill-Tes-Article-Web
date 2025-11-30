<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Artikel - InfoNow!</title>

    {{-- Fonts & Icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Alpine JS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-50">

    {{-- Navigation --}}
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm border-b border-gray-200"
        x-data="{ mobileMenuOpen: false, scrolled: false }" x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
        :class="{ 'shadow-md': scrolled }">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Logo --}}
                <a href="{{ route('landing') }}" class="flex items-center gap-2">
                    <span class="text-xl font-bold text-gray-900">InfoNow!</span>
                </a>

                {{-- Desktop Navigation --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('landing') }}"
                        class="text-gray-700 hover:text-blue-600 transition font-medium">Beranda</a>
                    <a href="{{ route('landing') }}#about"
                        class="text-gray-700 hover:text-blue-600 transition font-medium">Tentang</a>
                    <a href="{{ route('article.list') }}" class="text-blue-600 font-semibold">Artikel</a>
                    <a href="{{ route('login') }}"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-medium flex items-center gap-2">
                        <span class="material-icons text-sm">login</span>
                        Masuk
                    </a>
                </div>

                {{-- Mobile Menu Button --}}
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-gray-700">
                    <span class="material-icons" x-show="!mobileMenuOpen">menu</span>
                    <span class="material-icons" x-show="mobileMenuOpen">close</span>
                </button>
            </div>

            {{-- Mobile Navigation --}}
            <div x-show="mobileMenuOpen" x-transition class="md:hidden py-4 space-y-3">
                <a href="{{ route('landing') }}"
                    class="block text-gray-700 hover:text-blue-600 transition font-medium py-2">Beranda</a>
                <a href="{{ route('landing') }}#about"
                    class="block text-gray-700 hover:text-blue-600 transition font-medium py-2">Tentang</a>
                <a href="{{ route('article.list') }}"
                    class="block text-blue-600 font-semibold transition font-medium py-2">Artikel</a>
                <a href="{{ route('login') }}"
                    class="block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-medium text-center">
                    Masuk
                </a>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="pt-24 pb-16 min-h-screen">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            {{-- Header --}}
            <div class="text-center space-y-4 mb-12">
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-900">Semua Artikel</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Jelajahi koleksi lengkap artikel kami yang penuh dengan wawasan dan informasi menarik.
                </p>
            </div>

            {{-- Articles Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($articles as $article)
                    <div
                        class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden hover:shadow-xl transition">
                        <div class="relative h-48">
                            @if ($article->image && file_exists(public_path('storage/' . $article->image)))
                                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                                    class="w-full h-48 object-cover"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            @else
                                <img src="{{ $article->image ? asset('storage/' . $article->image) : '' }}"
                                    alt="{{ $article->title }}" class="w-full h-48 object-cover" style="display: none;"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            @endif
                            <div class="w-full h-48 bg-linear-to-br from-gray-100 to-gray-200 border-2 border-dashed border-gray-300 flex items-center justify-center"
                                style="{{ $article->image && file_exists(public_path('storage/' . $article->image)) ? 'display: none;' : 'display: flex;' }}">
                                <span class="material-icons text-gray-400 opacity-50 text-6xl">image</span>
                            </div>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-center gap-2 text-sm text-gray-500">
                                <span class="material-icons text-xs">calendar_today</span>
                                <span>{{ $article->created_at->format('d M Y') }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 line-clamp-2">{{ $article->title }}</h3>
                            <p class="text-gray-600 line-clamp-3">{{ $article->deskripsi }}</p>
                            <a href="{{ route('article.detail', $article->slug) }}"
                                class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium group">
                                <span>Baca Selengkapnya</span>
                                <span
                                    class="material-icons text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-20">
                        <span class="material-icons text-gray-300 text-8xl mb-4">article</span>
                        <p class="text-gray-500 text-xl font-medium mb-2">Belum ada artikel tersedia</p>
                        <p class="text-gray-400">Artikel akan muncul di sini setelah dipublikasikan</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if ($articles->hasPages())
                <div class="mt-12 ">
                    {{ $articles->links('vendor.pagination.custom') }}
                </div>
            @endif
        </div>
    </main>

    @include('landing.partials.footer')

</body>

</html>

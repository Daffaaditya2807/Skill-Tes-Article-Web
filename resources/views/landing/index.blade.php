<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfoNow!</title>

    {{-- Fonts & Icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Alpine JS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-white">

    {{-- Navigation --}}
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm border-b border-gray-200"
        x-data="{ mobileMenuOpen: false, scrolled: false }" x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })" :class="{ 'shadow-md': scrolled }">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Logo --}}
                <div class="flex items-center gap-2">
                    <span class="text-xl font-bold text-gray-900">InfoNow!</span>
                </div>

                {{-- Desktop Navigation --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="#home" class="text-gray-700 hover:text-blue-600 transition font-medium">Home</a>
                    <a href="#about" class="text-gray-700 hover:text-blue-600 transition font-medium">Tentang</a>
                    <a href="#articles" class="text-gray-700 hover:text-blue-600 transition font-medium">Artikel</a>
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
                <a href="#home" class="block text-gray-700 hover:text-blue-600 transition font-medium py-2">Home</a>
                <a href="#about" class="block text-gray-700 hover:text-blue-600 transition font-medium py-2">About</a>
                <a href="#articles"
                    class="block text-gray-700 hover:text-blue-600 transition font-medium py-2">Articles</a>
                <a href="{{ route('login') }}"
                    class="block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-medium text-center">
                    Masuk
                </a>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section id="home" class="pt-16">
        <div class="relative bg-linear-to-br from-blue-50 via-white to-purple-50 py-20 sm:py-32 lg:py-40">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col items-center gap-8 text-center">
                    {{-- Hero Title --}}
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 max-w-4xl leading-tight">
                        Discover, Read, and Share
                        <span class="text-blue-600">Infonow!</span>
                    </h1>

                    {{-- Hero Description --}}

                    <p class="text-lg sm:text-xl text-gray-600 max-w-3xl">
                        Selamat datang di sumber artikel yang penuh wawasan. Apakah Anda di sini untuk belajar,
                        menjelajah, atau berkontribusi, setiap artikel dibuat untuk menginformasikan dan menginspirasi.
                    </p>

                    {{-- CTA Buttons --}}
                    <div class="flex flex-col sm:flex-row gap-4 mt-4">
                        <a href="{{ route('register') }}"
                            class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition font-medium flex items-center justify-center gap-2 group">

                            <span>Mulai</span>
                            <span
                                class="material-icons text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                        <a href="#articles"
                            class="bg-white text-gray-700 border border-gray-300 px-8 py-3 rounded-lg hover:bg-gray-50 transition font-medium flex items-center justify-center gap-2">
                            <span>Jelajahi Artikel</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- About Section --}}
    <section id="about" class="py-16 sm:py-24 lg:py-32 bg-gray-50">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-12 md:gap-16 lg:gap-24">
                {{-- Header --}}
                <div class="text-center space-y-4">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900">Tentang Infonow</h2>


                    <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto">
                        Platform kami menjadi bukti kekuatan pengetahuan bersama. Bersama-sama, kita telah membangun
                        komunitas tempat ide berkembang dan pembelajaran tak pernah berhenti.
                    </p>
                </div>

                {{-- Stats --}}
                <div class="relative">
                    <div
                        class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8 grid grid-cols-2 lg:grid-cols-3 gap-8">
                        {{-- Stat 1 --}}
                        <div class="text-center space-y-2">
                            <div
                                class="w-12 h-12 bg-blue-100 rounded-full mx-auto flex items-center justify-center mb-4">
                                <span class="material-icons text-blue-600">article</span>
                            </div>
                            <p class="text-3xl font-bold text-blue-600" id="stat1">500+</p>
                            <p class="text-sm text-gray-600">Artikel Terbit</p>
                        </div>



                        {{-- Stat 3 --}}
                        <div class="text-center space-y-2">
                            <div
                                class="w-12 h-12 bg-green-100 rounded-full mx-auto flex items-center justify-center mb-4">
                                <span class="material-icons text-green-600">edit</span>
                            </div>
                            <p class="text-3xl font-bold text-green-600" id="stat3">50+</p>
                            <p class="text-sm text-gray-600">Penulis</p>
                        </div>

                        {{-- Stat 4 --}}
                        <div class="text-center space-y-2">
                            <div
                                class="w-12 h-12 bg-orange-100 rounded-full mx-auto flex items-center justify-center mb-4">
                                <span class="material-icons text-orange-600">star</span>
                            </div>
                            <p class="text-3xl font-bold text-orange-600" id="stat4">4.8/5</p>
                            <p class="text-sm text-gray-600">Rating Rata-rata</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Articles Section --}}
    <section id="articles" class="py-16 sm:py-24 lg:py-32 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            {{-- Header --}}
            <div class="text-center space-y-4 mb-12 sm:mb-16 lg:mb-24">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900">Artikel</h2>
                <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto">
                    Temukan konten paling populer kami. Dari wawasan teknologi hingga tips gaya hidup, kami siap
                    membantu Anda.
                </p>
            </div>

            {{-- Articles Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($latestArticles as $article)
                    <div
                        class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition">
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
                    <div class="col-span-3 text-center py-12">
                        <span class="material-icons text-gray-300 text-6xl mb-4">article</span>
                        <p class="text-gray-500 text-lg">Belum ada artikel tersedia</p>
                    </div>
                @endforelse
            </div>

            {{-- View All Button --}}
            @if ($latestArticles->count() > 0)
                <div class="text-center mt-12">
                    <a href="{{ route('article.list') }}"
                        class="inline-flex items-center gap-2 bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition font-medium group">
                        <span>Lihat Semua Artikel</span>
                        <span
                            class="material-icons text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                </div>
            @endif


        </div>
    </section>

    @include('landing.partials.footer')

    {{-- Smooth Scroll Script --}}
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>

</body>

</html>

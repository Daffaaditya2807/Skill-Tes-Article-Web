<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title ?? 'Article Detail' }} - InfoNow!</title>

    {{-- Fonts & Icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Alpine JS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Alpine Cloak Style --}}
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-50">

    {{-- Navigation --}}
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200 shadow-sm">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Back Button & Logo --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('landing') }}"
                        class="flex items-center gap-2 text-gray-600 hover:text-blue-600 transition">
                        <span class="material-icons">arrow_back</span>
                        <span class="hidden sm:inline font-medium">Back</span>
                    </a>
                    <div class="h-6 w-px bg-gray-300 hidden sm:block"></div>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                            <span class="material-icons text-white text-sm">article</span>
                        </div>
                        <span class="text-lg font-bold text-gray-900">InfoNow!</span>
                    </div>
                </div>

                {{-- Login Button --}}
                <a href="{{ route('login') }}"
                    class="bg-blue-600 text-white px-4 sm:px-6 py-2 rounded-lg hover:bg-blue-700 transition font-medium flex items-center gap-2">
                    <span class="material-icons text-sm">login</span>
                    <span class="hidden sm:inline">Masuk</span>
                </a>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="pt-16">
        {{-- Article Header --}}
        <article class="bg-white border-b border-gray-200">
            <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
                {{-- Breadcrumb --}}
                <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
                    <a href="{{ route('landing') }}" class="hover:text-blue-600 transition">Beranda</a>
                    <span class="material-icons text-xs">chevron_right</span>
                    <a href="{{ route('article.list') }}" class="hover:text-blue-600 transition">Artikel</a>
                    <span class="material-icons text-xs">chevron_right</span>
                    <span class="text-gray-900">{{ $article->title }}</span>
                </div>

                {{-- Title --}}
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                    {{ $article->title }}
                </h1>

                {{-- Meta Info --}}
                <div class="flex flex-wrap items-center gap-4 sm:gap-6 text-gray-600">
                    <div class="flex items-center gap-2">
                        <span class="material-icons text-sm">calendar_today</span>
                        <span class="text-sm">{{ $article->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-icons text-sm">schedule</span>
                        <span class="text-sm">{{ $article->created_at->format('H:i') }} WIB</span>
                    </div>
                </div>
            </div>
        </article>

        {{-- Article Content --}}
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
            {{-- Featured Image --}}
            <div class="mb-8 sm:mb-12">
                <div class="relative w-full h-64 sm:h-96">
                    @if ($article->image && file_exists(public_path('storage/' . $article->image)))
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                            class="w-full h-64 sm:h-96 object-cover rounded-xl shadow-lg"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    @else
                        <img src="{{ $article->image ? asset('storage/' . $article->image) : '' }}"
                            alt="{{ $article->title }}"
                            class="w-full h-64 sm:h-96 object-cover rounded-xl shadow-lg" style="display: none;"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    @endif
                    <div class="w-full h-64 sm:h-96 bg-linear-to-br from-gray-100 to-gray-200 border-2 border-dashed border-gray-300 rounded-xl shadow-lg flex items-center justify-center"
                        style="{{ $article->image && file_exists(public_path('storage/' . $article->image)) ? 'display: none;' : 'display: flex;' }}">
                        <span class="material-icons text-gray-400 opacity-50 text-8xl">image</span>
                    </div>
                </div>
            </div>

            {{-- Article Body --}}
            <div class="prose prose-lg max-w-none">
                <div class="text-gray-700 leading-relaxed space-y-6 whitespace-pre-wrap">
                    {!! nl2br(e($article->deskripsi)) ??
                        '
                                                                <p>Artikel ini belum memiliki deskripsi.</p>
                                                            ' !!}
                </div>
            </div>

            {{-- Share Section --}}
            <div class="mt-5 sm:mt-12 pt-8 border-t border-gray-200" x-data="{ copied: false }">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Bagikan artikel ini</h3>
                <div class="flex flex-wrap gap-3">

                    {{-- WhatsApp Share --}}
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' - ' . url()->current()) }}"
                        target="_blank" rel="noopener noreferrer"
                        class="flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        <span class="material-icons text-sm">share</span>
                        <span>WhatsApp</span>
                    </a>

                    {{-- Copy Link --}}
                    <button @click="navigator.clipboard.writeText(window.location.href); copied = true; setTimeout(() => copied = false, 2000)"
                        class="flex items-center gap-2 px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition relative">
                        <span class="material-icons text-sm" x-show="!copied">link</span>
                        <span class="material-icons text-sm" x-show="copied" x-cloak>check</span>
                        <span x-show="!copied">Salin Link</span>
                        <span x-show="copied" x-cloak>Tersalin!</span>
                    </button>
                </div>
            </div>
        </div>
    </main>

    @include('landing.partials.footer')

    {{-- Smooth Scroll --}}
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

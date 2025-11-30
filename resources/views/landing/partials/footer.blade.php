{{-- Footer --}}
<footer class="bg-gray-900 text-white py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            {{-- Brand --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                        <span class="material-icons text-white">article</span>
                    </div>
                    <span class="text-xl font-bold">InfoNow!</span>
                </div>
                <p class="text-gray-400">Sumber artikel berkualitas dan konten penuh wawasan.</p>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="font-semibold mb-4">Link Cepat</h4>
                <div class="space-y-2">
                    <a href="{{ route('landing') }}" class="block text-gray-400 hover:text-white transition">Beranda</a>
                    <a href="{{ route('article.list') }}" class="block text-gray-400 hover:text-white transition">Semua
                        Artikel</a>
                </div>
            </div>

            {{-- Account --}}
            <div>
                <h4 class="font-semibold mb-4">Akun</h4>
                <div class="space-y-2">
                    <a href="{{ route('login') }}" class="block text-gray-400 hover:text-white transition">Masuk</a>
                    <a href="{{ route('register') }}" class="block text-gray-400 hover:text-white transition">Daftar</a>
                </div>
            </div>

            {{-- Connect --}}
            <div>
                <h4 class="font-semibold mb-4">Hubungi Kami</h4>
                <div class="flex gap-3">
                    <a href="#"
                        class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-gray-700 transition">
                        <span class="material-icons text-sm">facebook</span>
                    </a>
                    <a href="#"
                        class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-gray-700 transition">
                        <span class="material-icons text-sm">mail</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; 2025 InfoNow!. All rights reserved.</p>
        </div>
    </div>
</footer>

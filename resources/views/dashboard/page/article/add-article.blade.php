@extends('dashboard.layouts.app')

@section('title', 'Tambah Artikel')

@section('content')

    <div class="mx-auto max-w-4xl">

        {{-- Header --}}
        <div class="mb-6 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard.article.index') }}" class="text-gray-600 hover:text-gray-900 transition">
                    <span class="material-icons">arrow_back</span>
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Tambah Artikel</h1>
            </div>
            <p class="text-gray-500 text-sm mt-2">Buat artikel baru dengan mengisi formulir di bawah ini</p>
        </div>

        {{-- Form --}}
        <form action="{{ route('dashboard.article.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Card Container --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

                {{-- Title Field --}}
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul<span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="title" name="title" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        placeholder="Masukkan judul artikel">
                    <p class="text-xs text-gray-500 mt-1">Judul akan ditampilkan di bagian atas artikel</p>
                </div>

                {{-- Slug Field --}}
                <div class="mb-6">
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                        Slug <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="slug" name="slug" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-gray-50"
                        placeholder="article-slug" readonly>
                    <p class="text-xs text-gray-500 mt-1">Akan dibuat otomatis dari judul (versi URL-friendly)</p>
                </div>

                {{-- Image Upload --}}
                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                        Gambar Unggulan <span class="text-red-500">*</span>
                    </label>

                    {{-- Image Preview --}}
                    <div class="mb-3">
                        <div id="imagePreview"
                            class="hidden w-full h-64 border-2 border-gray-300 rounded-lg overflow-hidden">
                            <img src="" alt="Preview" class="w-full h-full object-cover">
                        </div>
                        <div id="imagePlaceholder"
                            class="w-full h-64 border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center bg-gray-50">
                            <span class="material-icons text-gray-400 text-5xl mb-2">image</span>
                            <p class="text-gray-500 text-sm">Tidak ada gambar yang dipilih</p>
                        </div>
                    </div>

                    <input type="file" id="image" name="image" accept="image/*"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-xs text-gray-500 mt-1">Ukuran yang disarankan: 1200x630px (JPG, PNG, max 2MB)</p>
                </div>

                {{-- Description Field --}}
                <div class="mb-6">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="10" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition resize-y"
                        placeholder="Tulis konten artikel Anda di sini..."></textarea>
                    <p class="text-xs text-gray-500 mt-1">Minimal 100 karakter disarankan</p>
                </div>

            </div>

            {{-- Action Buttons --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex flex-col sm:flex-row gap-3 justify-end">
                    <a href="{{ route('dashboard.article.index') }}"
                        class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition text-center">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition flex items-center justify-center gap-2">
                        <span class="material-icons text-sm">save</span>
                        Simpan Artikel
                    </button>
                </div>
            </div>

        </form>

    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Auto-generate slug from title
            $('#title').on('input', function() {
                let title = $(this).val();
                let slug = title
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '') // Remove special characters
                    .replace(/\s+/g, '-') // Replace spaces with hyphens
                    .replace(/-+/g, '-') // Replace multiple hyphens with single hyphen
                    .trim();
                $('#slug').val(slug);
            });

            // Image preview
            $('#image').on('change', function(e) {
                const file = e.target.files[0];

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview img').attr('src', e.target.result);
                        $('#imagePreview').removeClass('hidden');
                        $('#imagePlaceholder').addClass('hidden');
                    }
                    reader.readAsDataURL(file);
                } else {
                    // Reset preview jika user cancel pilih gambar
                    $('#imagePreview').addClass('hidden');
                    $('#imagePlaceholder').removeClass('hidden');
                }
            });

            // Form validation before submit
            $('form').on('submit', function(e) {
                let errors = [];

                // Validate title
                const title = $('#title').val().trim();
                if (title.length < 3) {
                    errors.push('Judul minimal 3 karakter.');
                }

                // Validate description
                const desc = $('#deskripsi').val().trim();
                if (desc.length < 10) {
                    errors.push('Deskripsi minimal 10 karakter.');
                }

                // Gambar TIDAK wajib → tidak divalidasi

                if (errors.length > 0) {
                    e.preventDefault();
                    alert('Perbaiki kesalahan berikut:\n\n' + errors.join('\n'));
                }
            });
        });
    </script>
@endsection

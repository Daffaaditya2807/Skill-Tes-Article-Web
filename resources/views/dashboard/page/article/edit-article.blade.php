@extends('dashboard.layouts.app')

@section('title', 'Ubah Artikel')

@section('content')

    <div class="mx-auto max-w-4xl">

        {{-- Header --}}
        <div class="mb-6 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard.article.index') }}" class="text-gray-600 hover:text-gray-900 transition">
                    <span class="material-icons">arrow_back</span>
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Ubah Artikel</h1>
            </div>
            <p class="text-gray-500 text-sm mt-2">Perbarui informasi artikel dengan mengubah formulir di bawah ini</p>
        </div>

        {{-- Form --}}
        <form action="{{ route('dashboard.article.update', $article->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Card Container --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

                {{-- Title Field --}}
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="title" name="title" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        placeholder="Masukkan judul artikel" value="{{ old('title', $article->title) }}">
                    <p class="text-xs text-gray-500 mt-1">Judul akan ditampilkan di bagian atas artikel</p>
                </div>

                {{-- Slug Field --}}
                <div class="mb-6">
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                        Slug <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="slug" name="slug" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-gray-50"
                        placeholder="article-slug" readonly value="{{ old('slug', $article->slug) }}">
                    <p class="text-xs text-gray-500 mt-1">Akan dibuat otomatis dari judul (versi URL-friendly)</p>
                </div>

                {{-- Image Upload --}}
                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                        Gambar Unggulan
                    </label>

                    {{-- Image Preview --}}
                    <div class="mb-3">
                        {{-- Jika artikel punya gambar DAN file exists --}}
                        @if ($article->image && file_exists(public_path('storage/' . $article->image)))
                            <div id="imagePreview" class="w-full h-64 border-2 border-gray-300 rounded-lg overflow-hidden">
                                <img src="{{ asset('storage/' . $article->image) }}" alt="Preview"
                                    class="w-full h-full object-cover"
                                    onerror="this.parentElement.classList.add('hidden'); document.getElementById('imagePlaceholder').classList.remove('hidden');">
                            </div>

                            <div id="imagePlaceholder"
                                class=" w-full h-64 border-2 border-dashed border-gray-300
                       rounded-lg flex flex-col items-center justify-center bg-gray-50">
                                <span class="material-icons text-gray-400 text-5xl mb-2">image</span>
                                <p class="text-gray-500 text-sm">Tidak ada gambar yang dipilih</p>
                            </div>

                            {{-- Jika artikel TIDAK punya gambar atau file tidak exists --}}
                        @else
                            <div id="imagePreview"
                                class="hidden w-full h-64 border-2 border-gray-300 rounded-lg overflow-hidden">
                                <img src="" alt="Preview" class="w-full h-full object-cover"
                                    onerror="this.parentElement.classList.add('hidden'); document.getElementById('imagePlaceholder').classList.remove('hidden');">
                            </div>

                            <div id="imagePlaceholder"
                                class="w-full h-64 border-2 border-dashed border-gray-300
                       rounded-lg flex flex-col items-center justify-center bg-gray-50">
                                <span class="material-icons text-gray-400 text-5xl mb-2">image</span>
                                <p class="text-gray-500 text-sm">Tidak ada gambar yang dipilih</p>
                            </div>
                        @endif
                    </div>

                    <input type="file" id="image" name="image" accept="image/*"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">

                    <p class="text-xs text-gray-500 mt-1">
                        Kosongkan untuk mempertahankan gambar saat ini. Ukuran yang direkomendasikan: 1200x630px.
                    </p>
                </div>


                {{-- Description Field --}}
                <div class="mb-6">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="10" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition resize-y"
                        placeholder="Tulis konten artikel Anda di sini...">{{ old('deskripsi', $article->deskripsi) }}</textarea>
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
                        Perbarui Artikel
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
                }
            });

            // Form validation before submit
            $('form').on('submit', function(e) {
                let isValid = true;
                let errors = [];

                // Check title
                if ($('#title').val().trim().length < 3) {
                    errors.push('Title must be at least 3 characters');
                    isValid = false;
                }

                // Check description
                if ($('#deskripsi').val().trim().length < 10) {
                    errors.push('Description must be at least 10 characters');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                    alert('Please fix the following errors:\n\n' + errors.join('\n'));
                }
            });
        });
    </script>
@endsection

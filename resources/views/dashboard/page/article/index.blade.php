@extends('dashboard.layouts.app')

@section('title', 'Daftar Artikel')

@section('content')

    <div class="mx-auto max-w-screen-2xl">

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center justify-between"
                x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                <div class="flex items-center gap-2">
                    <span class="material-icons text-green-600">check_circle</span>
                    <span>{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-green-600 hover:text-green-800">
                    <span class="material-icons text-sm">close</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center justify-between"
                x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                <div class="flex items-center gap-2">
                    <span class="material-icons text-red-600">error</span>
                    <span>{{ session('error') }}</span>
                </div>
                <button @click="show = false" class="text-red-600 hover:text-red-800">
                    <span class="material-icons text-sm">close</span>
                </button>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-4">

                {{-- Title --}}
                <h2 class="text-lg font-semibold">Daftar Artikel</h2>

                {{-- Filter Section --}}
                <div class="flex flex-col sm:flex-row sm:items-center gap-3 w-full md:w-auto">

                    {{-- Search --}}
                    <div class="relative w-full sm:w-60">
                        <input type="text" placeholder="Cari artikel..."
                            class="border rounded-lg py-2 pl-10 pr-4 text-sm w-full bg-gray-50" />

                        <span class="absolute left-3 top-2.5 text-gray-400 material-icons text-base">
                            search
                        </span>
                    </div>

                    {{-- Create Button --}}
                    <a href="{{ route('dashboard.article.create') }}"
                        class="border rounded-lg px-4 py-3 text-sm flex items-center justify-center gap-2 bg-blue-600 text-white hover:bg-blue-700 transition
                       w-full sm:w-auto">
                        <span class="material-icons text-base">add</span>
                        Buat Artikel Baru
                    </a>

                </div>

            </div>


            {{-- Table --}}
            <div class="overflow-x-auto">
                <table id="articlesTable" class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-gray-500 text-sm border-b border-t border-black">
                            {{-- Selalu Tampil --}}
                            <th class="py-3 px-2">Gambar</th>
                            <th class="px-2">Judul</th>
                            {{-- Tampil hanya di Tablet (md) ke atas --}}
                            <th class="hidden md:table-cell px-2">Slug</th>

                            {{-- Tampil hanya di Laptop (lg) ke atas --}}
                            <th class="hidden lg:table-cell px-2">Tanggal Dibuat</th>

                            {{-- Selalu Tampil --}}
                            <th class="px-2 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-sm">



                        @foreach ($articles as $article)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-4 px-2 align-center">
                                    <div class="relative inline-block w-14 h-14">
                                        @if ($article->image && file_exists(public_path('storage/' . $article->image)))
                                            {{-- Jika gambar tersedia dan file exists --}}
                                            <img src="{{ asset('storage/' . $article->image) }}" alt="Article Image"
                                                class="w-14 h-14 object-cover rounded-lg"
                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        @else
                                            {{-- Hidden img untuk fallback --}}
                                            <img src="{{ $article->image ? asset('storage/' . $article->image) : '' }}"
                                                alt="Article Image"
                                                class="w-14 h-14 object-cover rounded-lg" style="display: none;"
                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        @endif
                                        {{-- Placeholder --}}
                                        <div class="w-14 h-14 bg-linear-to-br from-gray-100 to-gray-200 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center"
                                            style="{{ $article->image && file_exists(public_path('storage/' . $article->image)) ? 'display: none;' : 'display: flex;' }}">
                                            <span class="material-icons text-gray-400 opacity-50 text-3xl">
                                                image
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-2 align-center">
                                    <div class="font-medium text-gray-900">{{ $article->title }}
                                    </div>
                                    <div class="text-gray-500 text-xs mt-1 line-clamp-1 truncate max-w-[200px]">
                                        {{ $article->deskripsi }}
                                    </div>
                                    <dl class="lg:hidden text-xs text-gray-500 mt-1">
                                        <div class="md:hidden"><span class="font-bold">Slug:</span>
                                            {{ $article->slug }}
                                        </div>
                                        <div><span class="font-bold">Created:</span>
                                            {{ $article->created_at->format('d M Y') }}</div>
                                    </dl>
                                </td>

                                {{-- Hidden on Mobile, Visible on Tablet+ --}}
                                <td class="hidden md:table-cell px-2 align-center text-gray-600">
                                    {{ $article->slug }}
                                </td>

                                {{-- Hidden on Mobile/Tablet, Visible on Laptop+ --}}
                                <td class="hidden lg:table-cell px-2 align-center text-gray-600">
                                    {{ $article->created_at->format('d M Y') }}</td>

                                <td class="px-2 align-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('dashboard.article.edit', ['id' => $article->id]) }}"
                                            class="text-blue-600 border border-blue-600 px-2 py-2 rounded-lg text-xs hover:bg-blue-50 transition">
                                            <span class="material-icons text-sm align-middle">edit</span>
                                        </a>
                                        <button data-id="{{ $article->id }}"
                                            class="delete-article text-red-600 border border-red-600 px-2 py-2 rounded-lg text-xs hover:bg-red-50 transition">
                                            <span class="material-icons text-sm align-middle">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>

@endsection

@section('styles')
    <style>
        /* Berikan jarak antara tabel dan info/pagination DataTables */
        #articlesTable_info {
            margin-top: 1.5rem;
            font-size: 0.875rem;
            color: #6b7280;
        }

        #articlesTable_paginate {
            margin-top: 1.5rem;
        }

        .dataTables_wrapper {
            margin-top: 0;
        }



        /* Styling untuk pagination buttons */
        .dataTables_paginate .paginate_button {
            padding: 0.5rem 0.75rem;
            margin: 0 0.125rem;
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
            background: white;
            font-size: 0.875rem;
            color: #374151;
            transition: all 0.2s;
        }

        .no-data-row td {
            height: 0;
            padding: 0;
            border: none;
        }

        .no-data-message {
            position: relative;
            z-index: 5;
        }


        .dataTables_paginate .paginate_button:hover {
            background: #f3f4f6;
            border-color: #d1d5db;
        }

        .dataTables_paginate .paginate_button.current {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .dataTables_paginate .paginate_button.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Flexbox untuk info dan pagination */
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            display: inline-block;
        }

        /* Ukuran font tabel */
        #articlesTable {
            font-size: 0.875rem;
        }

        #articlesTable thead th {
            font-size: 0.875rem;
        }

        #articlesTable tbody td {
            font-size: 0.875rem;
        }

        /* Line clamp untuk deskripsi */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables
            var table = $('#articlesTable').DataTable({
                "pageLength": 10,
                "order": [
                    [3, 'desc']
                ], // Sort by Created At column (index 3)
                "language": {
                    "search": "Cari:",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ artikel",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 artikel",
                    "infoFiltered": "(difilter dari _MAX_ total artikel)",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                    "zeroRecords": "Artikel tidak ada"

                },
                "dom": 'rtip',
                "responsive": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": [0, 4]
                }] // Disable sorting for Image and Actions columns
            });

            // Integrate custom search input with DataTables
            $('input[placeholder="Cari artikel..."]').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Delete article
            $(document).on('click', '.delete-article', function(e) {
                e.preventDefault();
                const articleId = $(this).data('id');

                if (confirm('Apakah Anda yakin ingin menghapus artikel ini?')) {
                    // Create form dynamically with Laravel route
                    const deleteUrl = '{{ route('dashboard.article.destroy', ':id') }}'.replace(':id',
                        articleId);
                    const form = $('<form>', {
                        'method': 'POST',
                        'action': deleteUrl
                    });

                    // Add CSRF token
                    form.append($('<input>', {
                        'type': 'hidden',
                        'name': '_token',
                        'value': '{{ csrf_token() }}'
                    }));

                    // Add DELETE method
                    form.append($('<input>', {
                        'type': 'hidden',
                        'name': '_method',
                        'value': 'DELETE'
                    }));

                    // Append to body and submit
                    $('body').append(form);
                    form.submit();
                }
            });
        });
    </script>
@endsection

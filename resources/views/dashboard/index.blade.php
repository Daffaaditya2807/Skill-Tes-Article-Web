@extends('dashboard.layouts.app')

@section('title', 'Beranda')

@section('content')

    <div class="mx-auto max-w-screen-2xl">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">

            {{-- Card 1 --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white">
                    <span class="material-icons">article</span>
                </div>
                <div>
                    <h3 class="text-2xl font-bold">{{ number_format($totalArticles) }}</h3>
                    <p class="text-gray-500 text-sm">Total Berita diunggah</p>
                </div>

            </div>

            {{-- Card 2 --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white">
                    <span class="material-icons">group</span>
                </div>
                <div>
                    <h3 class="text-2xl font-bold">{{ number_format($totalAdmins) }}</h3>
                    <p class="text-gray-500 text-sm">Jumlah Admin</p>
                </div>

            </div>

            {{-- Card 3 --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-cyan-500 flex items-center justify-center text-white">
                    <span class="material-icons">today</span>
                </div>
                <div>
                    <h3 class="text-2xl font-bold">{{ number_format($todayArticlesCount) }}</h3>
                    <p class="text-gray-500 text-sm">Jumlah Berita Hari Ini</p>
                </div>
            </div>

        </div>


        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-4">

                {{-- Title --}}
                <h2 class="text-lg font-semibold">Berita Terbaru</h2>

                {{-- Filter Section --}}
                <div class="flex flex-col sm:flex-row sm:items-center gap-3 w-full md:w-auto">

                    {{-- Search --}}
                    <div class="relative w-full sm:w-60">
                        <input type="text" placeholder="Cari berita..."
                            class="border rounded-lg py-2 pl-10 pr-4 text-sm w-full bg-gray-50" />

                        <span class="absolute left-3 top-2.5 text-gray-400 material-icons text-base">
                            search
                        </span>
                    </div>

                    {{-- Date Filter --}}
                    {{-- <div
                        class="border rounded-lg px-3 py-3 flex items-center justify-between gap-2 
                    text-sm text-gray-600 bg-gray-50 w-full sm:w-auto">
                        <span class="material-icons text-base">calendar_today</span>
                        <span class="whitespace-nowrap">Oct 01, 2022 - Nov 27, 2022</span>
                    </div> --}}

                    {{-- Filter Button --}}
                    {{-- <button
                        class="border rounded-lg px-4 py-3 text-sm flex items-center justify-center gap-2 bg-gray-50 
                       w-full sm:w-auto">
                        <span class="material-icons text-base">filter_list</span>
                        Filter
                    </button> --}}

                </div>

            </div>


            {{-- Table --}}
            <div class="overflow-x-auto">
                <table id="ordersTable" class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-gray-500 text-sm border-b border-t border-black">
                            {{-- Selalu Tampil --}}
                            <th class="py-3 px-2">Gambar</th>
                            <th class="px-2">Judul</th>

                            {{-- Tampil hanya di Tablet (md) ke atas --}}
                            <th class="hidden md:table-cell px-2">Slug</th>

                            {{-- Tampil hanya di Laptop (lg) ke atas --}}
                            <th class="hidden lg:table-cell px-2">Tanggal</th>
                            <th class="hidden lg:table-cell px-2">Waktu</th>
                        </tr>
                    </thead>

                    <tbody class="text-sm">
                        @forelse ($todayArticles as $article)
                            <tr class="border-b border-gray-300 hover:bg-gray-50">
                                <td class="py-4 px-2 align-center">
                                    <div class="relative inline-block w-14 h-14">
                                        @if ($article->image && file_exists(public_path('storage/' . $article->image)))
                                            <img src="{{ asset('storage/' . $article->image) }}" alt="Article Image"
                                                class="w-14 h-14 object-cover rounded-lg"
                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        @else
                                            <img src="{{ $article->image ? asset('storage/' . $article->image) : '' }}"
                                                alt="Article Image"
                                                class="w-14 h-14 object-cover rounded-lg" style="display: none;"
                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        @endif
                                        <div class="w-14 h-14 bg-linear-to-br from-gray-100 to-gray-200 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center"
                                            style="{{ $article->image && file_exists(public_path('storage/' . $article->image)) ? 'display: none;' : 'display: flex;' }}">
                                            <span class="material-icons text-gray-400 opacity-50 text-3xl">
                                                image
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-2 align-center">
                                    <div class="font-medium text-gray-900">{{ $article->title }}</div>
                                    <div class="text-gray-500 text-xs mt-1 line-clamp-1 truncate max-w-[200px]">
                                        {{ $article->deskripsi }}
                                    </div>
                                    <dl class="lg:hidden text-xs text-gray-500 mt-1">
                                        <div class="md:hidden"><span class="font-bold">Slug:</span>
                                            {{ $article->slug }}
                                        </div>
                                        <div><span class="font-bold">Waktu:</span>
                                            {{ $article->created_at->format('H:i') }}</div>
                                    </dl>
                                </td>

                                {{-- Hidden on Mobile, Visible on Tablet+ --}}
                                <td class="hidden md:table-cell px-2 align-center text-gray-600">
                                    {{ $article->slug }}
                                </td>

                                {{-- Hidden on Mobile/Tablet, Visible on Laptop+ --}}
                                <td class="hidden lg:table-cell px-2 align-center text-gray-600">
                                    {{ $article->created_at->format('d M Y') }}</td>
                                <td class="hidden lg:table-cell px-2 align-center text-gray-600">
                                    {{ $article->created_at->format('H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <span class="material-icons text-5xl text-gray-300 mb-2">article</span>
                                        <p class="text-sm">Tidak ada berita yang diunggah hari ini</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

        </div>

    </div>

@endsection

@section('styles')
    <style>
        /* Berikan jarak antara tabel dan info/pagination DataTables */
        #ordersTable_info {
            margin-top: 1.5rem;
            font-size: 0.875rem;
            /* text-sm */
            color: #6b7280;
            /* text-gray-500 */
        }

        #ordersTable_paginate {
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
            /* text-sm */
            color: #374151;
            transition: all 0.2s;
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


        /* Ukuran font tabel - sesuaikan di sini jika ingin mengubah */
        #ordersTable {
            font-size: 0.875rem;
            /* text-sm - ubah sesuai kebutuhan */
        }

        #ordersTable thead th {
            font-size: 0.875rem;
            /* text-sm untuk header */
        }

        #ordersTable tbody td {
            font-size: 0.875rem;
            /* text-sm untuk body */
        }

        /* Line clamp untuk deskripsi */
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables
            var table = $('#ordersTable').DataTable({
                "pageLength": 10,
                "order": [
                    [4, 'desc']
                ], // Sort by time column (index 4) - newest first
                "language": {
                    "search": "Cari:",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ berita",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 berita",
                    "infoFiltered": "(difilter dari _MAX_ total berita)",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                    "zeroRecords": "Berita tidak ditemukan"
                },
                "dom": 'rtip',
                "responsive": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": [0]
                }] // Disable sorting for Image column
            });

            // Integrate custom search input with DataTables
            $('input[placeholder="Cari berita..."]').on('keyup', function() {
                table.search(this.value).draw();
            });
        });
    </script>
@endsection

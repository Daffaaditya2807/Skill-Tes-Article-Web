@if ($paginator->hasPages())
    <nav class="flex justify-center">
        <ul class="flex items-center space-x-1 bg-gray-200 text-gray-700 rounded-xl shadow px-2 py-1">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="px-3 py-2 opacity-40 cursor-not-allowed">
                    <span class="material-icons text-base">chevron_left</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="px-3 py-2 hover:bg-gray-300 rounded-lg transition">
                        <span class="material-icons text-base text-gray-700">chevron_left</span>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Dots --}}
                @if (is_string($element))
                    <li class="px-3 py-2">{{ $element }}</li>
                @endif

                {{-- Array of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="px-4 py-2 bg-blue-600 text-white rounded-lg font-bold">
                                {{ $page }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 hover:bg-gray-300 rounded-lg transition">
                        <span class="material-icons text-base">chevron_right</span>
                    </a>
                </li>
            @else
                <li class="px-3 py-2 opacity-40 cursor-not-allowed">
                    <span class="material-icons text-base">chevron_right</span>
                </li>
            @endif
        </ul>
    </nav>
@endif

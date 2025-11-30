<aside x-data="{ open: window.innerWidth > 768 }" @toggle-sidebar.window="
        open = !open
    "
    @resize.window="
        open = window.innerWidth > 768;
    "
    class="fixed top-16 left-0 z-40 h-[calc(100vh-4rem)] 
           bg-white text-gray-700 border-r border-gray-200
           transition-all duration-300 ease-in-out shadow-sm
           overflow-hidden"
    :class="open ? 'w-64' : 'w-20'">

    <nav class="mt-4 flex flex-col gap-1 h-full">

        {{-- BRAND --}}
        <div class="flex items-center gap-3 px-5 py-3">
            {{-- Logo --}}
            <div class="w-9 h-9 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-7 h-7 text-blue-600">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                    <line x1="16" y1="13" x2="8" y2="13" />
                    <line x1="16" y1="17" x2="8" y2="17" />
                    <line x1="10" y1="9" x2="8" y2="9" />
                </svg>
            </div>

            {{-- Title --}}
            <span class="font-bold text-xl text-gray-900" x-show="open" x-transition>
                InfoNow!
            </span>
        </div>

        {{-- MENU ITEM COMPONENT --}}
        @php
            function menuItem($routes, $icon, $label)
            {
                $isActive = false;

                foreach ($routes as $r) {
                    if (request()->routeIs($r)) {
                        $isActive = true;
                        break;
                    }
                }

                return [
                    'isActive' => $isActive,
                    'icon' => $icon,
                    'label' => $label,
                    'route' => route($routes[0]), // default redirect point
                ];
            }

            $menus = [
                menuItem(['dashboard.index'], 'home', 'Beranda'),
                // SEMUA ROUTE ARTICLE ACTIVE
                menuItem(
                    [
                        'dashboard.article.index',
                        'dashboard.article.create',
                        'dashboard.article.edit',
                        'dashboard.article.store',
                        'dashboard.article.update',
                        'dashboard.article.destroy',
                    ],
                    'description',
                    'Artikel',
                ),
            ];

        @endphp

        {{-- Loop menu --}}
        @foreach ($menus as $m)
            <a href="{{ $m['route'] }}">
                <div class="flex items-center gap-3 py-3 px-4 rounded-lg mx-3 cursor-pointer transition
                        hover:bg-gray-100 relative"
                    :class="open ? '' : 'justify-center px-3'"
                    style="{{ $m['isActive'] ? 'background-color:#e8f0ff;color:#2563eb;font-weight:600;' : '' }}">

                    {{-- Icon --}}
                    <span class="material-icons text-xl"
                        style="{{ $m['isActive'] ? 'color:#2563eb;' : 'color:#6b7280;' }}">
                        {{ $m['icon'] }}
                    </span>

                    {{-- Label --}}
                    <span x-show="open" x-transition class="text-sm">
                        {{ $m['label'] }}
                    </span>
                </div>
            </a>
        @endforeach

        {{-- Spacer to push logout to bottom --}}
        <div class="grow"></div>

        {{-- Logout Button --}}
        <div class="border-t border-gray-200 pt-2 pb-5 px-3">
            <form method="POST" action="{{ route('logout') }}"
                onsubmit="return confirm('Apakah Anda yakin ingin logout?')">
                @csrf
                <button type="submit"
                    class="flex items-center gap-3 w-full py-3 px-4 rounded-lg transition hover:bg-red-50 text-red-600"
                    :class="open ? '' : 'justify-center px-3'">
                    {{-- Icon --}}
                    <span class="material-icons text-xl">
                        logout
                    </span>

                    {{-- Label --}}
                    <span x-show="open" x-transition class="text-sm font-medium">
                        Logout
                    </span>
                </button>
            </form>
        </div>

    </nav>
</aside>

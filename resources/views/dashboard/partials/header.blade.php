<header x-data="{ open: false }" class="fixed top-0 left-0 right-0 z-50 bg-slate-50 border-b border-gray-200">

    <div class="h-16 flex items-center justify-between px-4">

        {{-- Left: Sidebar Toggle --}}
        <div class="flex items-center gap-4">
            <button @click="$dispatch('toggle-sidebar')"
                class="p-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            {{-- Middle: Realtime Clock --}}
            <div x-data="clock" x-init="start()"
                class="flex items-center text-sm font-medium text-gray-700 select-none">

                {{-- Desktop: full date --}}
                <span class="hidden md:flex items-center">
                    <span x-text="date"></span>
                    <span class="mx-2">•</span>
                    <span x-text="time" class="font-semibold"></span>
                </span>

                {{-- Mobile: only time --}}
                <span class="md:hidden font-semibold" x-text="time"></span>
            </div>
        </div>


        {{-- Right: User Menu --}}
        <div class="relative" x-data="{ userMenu: false }">
            <button @click="userMenu = !userMenu" class="flex items-center gap-2 p-2 rounded-lg hover:bg-gray-100">

                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" class="w-8 h-8 rounded-full" />

                <span class="text-gray-700 text-sm font-medium hidden md:block">
                    {{ auth()->user()->name }}
                </span>
            </button>

            {{-- Dropdown --}}
            <div x-show="userMenu" @click.outside="userMenu = false" x-transition
                class="absolute right-0 mt-2 w-40 bg-white border border-gray-200
                       rounded-lg shadow-lg p-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-gray-100 rounded">
                        Logout
                    </button>
                </form>

            </div>
        </div>

    </div>
</header>

{{-- Alpine Clock Script --}}
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('clock', () => ({
            time: '',
            date: '',

            start() {
                this.update();
                setInterval(() => this.update(), 1000);
            },
            update() {
                const now = new Date();

                // Jam realtime (detik berjalan)
                this.time = now.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });

                // Hari & tanggal
                this.date = now.toLocaleDateString('id-ID', {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
            }
        }));
    });
</script>

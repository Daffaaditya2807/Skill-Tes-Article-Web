<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @yield('styles')

</head>

<body class="bg-gray-100">

    {{-- Header --}}
    @include('dashboard.partials.header')

    {{-- Sidebar --}}
    @include('dashboard.partials.sidebar')

    {{-- Main Content --}}
    <main class="pt-20 transition-all" x-data="{ sidebarWide: window.innerWidth >= 768 }"
        @toggle-sidebar.window="
        if (window.innerWidth < 768) {
            sidebarWide = false; // mobile = jangan dorong konten
        } else {
            sidebarWide = !sidebarWide; // desktop toggle biasa
        }
    "
        @resize.window="
        sidebarWide = window.innerWidth >= 768
    "
        :class="{
            'ml-24': window.innerWidth < 768,
            'ml-64': sidebarWide && window.innerWidth >= 768,
            'ml-20': !sidebarWide && window.innerWidth >= 768
        }">
        <div class="p-4 md:p-6">
            @yield('content')
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    @yield('scripts')
</body>

</html>

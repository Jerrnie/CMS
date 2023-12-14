<!DOCTYPE html>
<html lang="{{ $page->language ?? 'en' }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="referrer" content="always">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- <link rel="canonical" href="{{ $page->getUrl() }}"> --}}

        <title>

            @if (isset($headerName))
                {{ config('app.name', 'Laravel').$headerName }}
            @else
                {{ config('app.name', 'Laravel') }}
            @endif

        </title>
       <!-- Fonts -->
       <link rel="preconnect" href="https://fonts.bunny.net">
       <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

       <!-- Scripts -->
       @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body>
        <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
            @include('layouts.admin-sidebar')

            <div class="flex-1 flex flex-col overflow-hidden">
                @include('layouts.admin-navigation')

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="container mx-auto px-6 py-8">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset($setting->logo) }}" >
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @auth
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
        @endauth

        @guest
            @include('layouts.guest-navigation')
        @endguest

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>

    @guest
    <script>

        window.onload = function() {
    if (window.location.hash === '#logoutSuccess') {
        Swal.fire({
                        icon: 'success',
                        title: 'Logout Success',
                        showConfirmButton: false,
                        timer: 1500
                    });
    }
}
    </script>
    @endguest

</html>

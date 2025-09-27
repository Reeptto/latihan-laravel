<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen">
            {{-- ======= HEADER / NAVBAR ATAS ======= --}}
            @include('layouts.navigation')
            {{-- ======= navigation.blade.php bawaan Breeze/Jetstream ======= --}}

            {{-- ======= BODY: Sidebar + konten ======= --}}
            <div class="flex">
            {{-- ======= Sidebar di kiri tepat dibawah header ======= --}}
                <aside class="w-64 bg-white border-r shadow-sm min-h-screen">
                    <nav class="p-4 space-y-1">
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()-> routeIs('dashboard.*') ? ' bg-gray-200 font-semibold' : '' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('mahasiswa.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()-> routeIs('mahasiswa.*') ? ' bg-gray-200 font-semibold' : '' }}">
                            Mahasiswa
                        </a>
                        <a href="{{ route('kelas.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()-> routeIs('kelas.*') ? ' bg-gray-200 font-semibold' : '' }}">
                            Ruangan
                        </a>
                        <a href="{{ route('dosen.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()-> routeIs('dosen
                        .*') ? ' bg-gray-200 font-semibold' : '' }}">
                            Dosen
                        </a>
                        <a href="{{ route('matkul.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()-> routeIs('matkul
                        .*') ? ' bg-gray-200 font-semibold' : '' }}">
                            Mata Kuliah
                        </a>
                    </nav>
                </aside>
                
                {{-- ======= Konten utama di kanan ======= --}}
                
                <main class="flex-1 p-6">
                    {{ $slot ?? ''}}
                    @yield('content')
                </main>
            </div>
        </div>            
    </body>
</html>

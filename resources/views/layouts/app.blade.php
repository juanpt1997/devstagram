<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DevStagram - @yield('title')</title>
    @stack('styles')
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    @livewireStyles
</head>

<body class="bg-gray-100">
    <header class="p-5 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-3xl font-black">
                DevStagram
            </a>

            {{-- @if (auth()->user())
                <p>Autenticado</p>
            @else
                <p>No autenticado</p>
            @endif --}} {{-- ? Eso equivale a utilizar las directivas de abajo @auth, @guest --}}
            @auth
                <nav class="flex gap-2 items-center">
                    <a href="{{ route('posts.create') }}"
                        class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Crear
                    </a>

                    <a class="font-bold text-gray-600 text-sm" href="{{ route('posts.index', auth()->user()->username) }}">
                        Hola: <span class="font-normal">{{ auth()->user()->username }}</span>
                    </a>
                    {{-- <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('logout') }}">
                        Cerrar Sesión
                    </a> --}} {{-- ? En vez de tener un enlace que realiza una petición de tipo get para interactura con la base de datos, haremos lo siguiente --}}
                    <form method="post" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="font-bold uppercase text-gray-600 text-sm">
                            Cerrar Sesión
                        </button>
                    </form>
                </nav>
            @endauth
            @guest
                <nav class="flex gap-2 items-center">
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('login') }}">Login</a>
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register.index') }}">Crear
                        Cuenta</a>
                </nav>
            @endguest

        </div>
    </header>

    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10">@yield('title')</h2>
        @yield('content')
    </main>

    <footer class="text-center mt-10 p-5 text-gray-500 font-bold uppercase">
        DevStagram - Todos los derechos reservados {{ now()->year }}
    </footer>

    @livewireScripts
</body>

</html>

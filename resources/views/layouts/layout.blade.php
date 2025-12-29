<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <title>CubeStack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="navbar bg-base-200 shadow-sm">
        <div class="navbar-start">
          <a class="btn btn-ghost text-xl" href="/">
                <img src="{{ asset('image/logo.jpg') }}" alt="CubeStack Logo" class="h-8 w-auto" />

            </a>
            <div class="dropdown">
                <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </div>
                <ul tabindex="-1"
                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow bg-neutral">
                    <li><a>Information</a></li>
                    <li>
                        <a>Algorithms</a>
                        <ul class="p-2">
                            <li><a>Oll</a></li>
                            <li><a>Pll</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1">
                <li class="bg-base-300 rounded-sm mr-5"><a>Information</a></li>
                <li>
                    <details class="bg-base-300 rounded-sm ml-5">
                        <summary>Algorithms</summary>
                        <ul class="p-2 bg-neutral w-40 z-1">
                            <li><a>Submenu 1</a></li>
                            <li><a>Submenu 2</a></li>
                        </ul>
                    </details>
                </li>
                {{-- <li><a>Item 3</a></li> --}}
            </ul>
        </div>
        <div class="navbar-end">
            <a href="/register" class="btn">Register</a>
        </div>
    </div>
    <main>
        @yield('content')
    </main>
    <footer></footer>
</body>

</html>

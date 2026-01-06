<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <title>CubeStack</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
                    <li><a href="/info">Information</a></li>
                    <li>
                        <a>Algorithms</a>
                        <ul class="menu menu-vertical px-2">
                            @foreach ($navCategories as $category)
                                <li>
                                    @if ($category->children->isNotEmpty())
                                        <details class="bg-base-200 rounded-sm ml-3">
                                            <summary>{{ $category->name }}</summary>
                                            <ul class="menu menu-vertical px-2">
                                                @foreach ($category->children as $child)
                                                    <li>
                                                        <a
                                                            href="{{ route('algorithms.index', ['category' => $child->id]) }}">
                                                            {{ $child->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </details>
                                    @else
                                        <a href="{{ route('algorithms.index', ['category' => $category->id]) }}">
                                            {{ $category->name }}
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                            @auth
                                <li class="mt-2">
                                    <a href="{{ route('categories.create') }}" class="text-primary">
                                        + Add Category
                                    </a>
                                </li>
                            @endauth
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1">
                <li class="bg-base-300 rounded-sm mr-5"><a href="/info">Information</a></li>

                <li>
                    <details class="bg-base-300 rounded-sm ml-5 z-50">
                        <summary>Algorithms</summary>
                        <ul class="menu menu-vertical px-2">
                            @foreach ($navCategories as $category)
                                <li>
                                    @if ($category->children->isNotEmpty())
                                        <details class="bg-base-200 rounded-sm ml-3">
                                            <summary>{{ $category->name }}</summary>
                                            <ul class="menu menu-vertical px-2">
                                                @foreach ($category->children as $child)
                                                    <li>
                                                        <a
                                                            href="{{ route('algorithms.index', ['category' => $child->id]) }}">
                                                            {{ $child->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </details>
                                    @else
                                        <a href="{{ route('algorithms.index', ['category' => $category->id]) }}">
                                            {{ $category->name }}
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                            @auth
                                <li class="mt-2 border-t border-base-300 pt-2">
                                    <a href="{{ route('categories.create') }}" class="text-primary font-semibold">
                                        + Add Category
                                    </a>
                                </li>
                            @endauth
                        </ul>
                    </details>
                </li>
        </div>
        <div class="navbar-end">
            @guest
                <a href="{{ route('login') }}" class="btn">login</a>
            @endguest

            @auth
                <div class="dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-ghost avatar">
                        <div class="w-10 rounded-full">
                            <img src="{{ asset('image/profilePicture.jpg') }}" />
                        </div>
                    </label>
                    <ul tabindex="0" class="menu dropdown-content bg-base-100 rounded-box w-52 shadow">
                        <li><a href="/account">Account</a></li>
                        <li>
                            <form method="POST" action="/logout">
                                @csrf
                                <button class="btn btn-error btn-sm">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth
        </div>
    </div>
    @if (session('success'))
        <div class="fixed top-5 right-5 z-50">
            <div class="alert alert-success shadow-lg">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        </div>
        <script>
            setTimeout(() => {
                const alert = document.querySelector('.alert-success');
                if (alert) {
                    alert.remove();
                }
            }, 4000); // 4 seconds
        </script>
    @endif
    <main>
        @yield('content')
    </main>
    <footer></footer>

</body>

</html>

@extends('layouts.layout')

@section('content')
    <main>
        <div class="flex mt-10 justify-center p-2">
    <div class="card w-full max-w-md shadow-xl bg-base-100 p-6">
        <div class="card-body">
            <h2 class="card-title text-3xl">Login</h2>

            @if ($errors->any())
                <div class="alert alert-error shadow-lg mb-4">
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="/login" class="space-y-4">
                @csrf

                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                    class="input input-bordered w-full @error('email') input-error @enderror" required>
                @error('email')
                    <p class="text-error text-sm">{{ $message }}</p>
                @enderror

                <div class="relative">
                    <input id="password" type="password" name="password" placeholder="Password"
                        class="input input-bordered w-full pr-12 @error('password') input-error @enderror" required>

                    <button type="button" id="togglePassword"
                        class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                        👁️
                    </button>
                </div>

                @error('password')
                    <p class="text-error text-sm">{{ $message }}</p>
                @enderror

                <button class="btn btn-primary w-full">Login</button>
            </form>

            <p class="text-center mt-4">
                No account?
                <a href="/register" class="link link-primary">Register</a>
            </p>
        </div>
    </div>
</div>

    </main>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    passwordToggle('#password', '#togglePassword');
});
</script>

@endsection

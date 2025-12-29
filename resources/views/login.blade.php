@extends('layouts.layout')

@section('content')

<main>
 <div class="card w-full max-w-md shadow-xl bg-base-100">
    <div class="card-body">
        <h2 class="card-title text-3xl">Login</h2>

        @if ($errors->any())
            <div class="alert alert-error shadow-lg mb-4">
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="/login" class="space-y-4">
            @csrf

            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="input input-bordered w-full @error('email') input-error @enderror" required>
            @error('email')
                <p class="text-error text-sm">{{ $message }}</p>
            @enderror

            <input type="password" name="password" placeholder="Password" class="input input-bordered w-full @error('password') input-error @enderror" required>
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
</main>
@endsection
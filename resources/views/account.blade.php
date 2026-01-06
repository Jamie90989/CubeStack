@extends('layouts.layout')

@section('content')

<main><div class="p-10">
    <div class="card shadow-lg bg-base-100 p-6 max-w-xl mx-auto">
        <h1 class="text-3xl font-bold">Welcome, {{ auth()->user()->name }}!</h1>
        <p class="mt-2 text-base-content/70">You are now logged in.</p>
    </div>
</div>

<div class="w-full bg-base-100 shadow-md py-3 px-6 flex justify-center items-center space-x-3">
    @auth
        <a href="{{ route('algorithms.create') }}" class="btn btn-lg btn-primary">
            + Add Algorithm
        </a>

        <a href="{{ route('categories.create') }}" class="btn btn-lg btn-secondary">
            + Add Category
        </a>
    @endauth
</div>



</main>
@endsection
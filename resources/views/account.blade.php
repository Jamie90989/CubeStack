@extends('layouts.layout')

@section('content')

<main>
 
<nav class="navbar bg-base-100 shadow-lg px-6">
    <div class="flex-1">
        <a class="text-xl font-bold">My Dashboard</a>
    </div>

    <div class="flex-none">
        <form method="POST" action="/logout">
            @csrf
            <button class="btn btn-error btn-sm">Logout</button>
        </form>
    </div>
</nav>

<div class="p-10">
    <div class="card shadow-lg bg-base-100 p-6 max-w-xl mx-auto">
        <h1 class="text-3xl font-bold">Welcome, {{ auth()->user()->name }}!</h1>
        <p class="mt-2 text-base-content/70">You are now logged in.</p>
    </div>
</div>
</main>
@endsection
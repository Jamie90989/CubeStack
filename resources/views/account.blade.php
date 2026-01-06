@extends('layouts.layout')

@section('content')

<main>
 

<div class="p-10">
    <div class="card shadow-lg bg-base-100 p-6 max-w-xl mx-auto">
        <h1 class="text-3xl font-bold">Welcome, {{ auth()->user()->name }}!</h1>
        <p class="mt-2 text-base-content/70">You are now logged in.</p>
    </div>
</div>
</main>
@endsection
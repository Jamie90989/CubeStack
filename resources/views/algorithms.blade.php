@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.layout')

@section('content')
    <main>
        <div class="w-full bg-base-100 py-3 px-6 flex justify-center items-center space-x-3">
            @auth
                    <a href="{{ route('algorithms.create') }}" class="btn btn-md btn-primary">
                        + Add Algorithm
                    </a>
            @endauth
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-4 gap-4 z-10">
            @forelse ($algorithms as $algorithm)
                <div class="card bg-base-100 shadow-md p-4 flex flex-col hover:shadow-xl transition-shadow duration-300">
                    <div class="mt-3 flex justify-end">
                        <a href="{{ route('algorithms.edit', $algorithm->id) }}" class="btn btn-sm btn-outline btn-primary">
                            Edit
                        </a>
                    </div>
                    <img src="{{ $algorithm->image
                        ? (Str::startsWith($algorithm->image, 'image/')
                            ? asset($algorithm->image)
                            : asset('storage/' . $algorithm->image))
                        : asset('image/noImgFound.png') }}"
                        alt="{{ $algorithm->name }}" class="w-full h-40 md:h-48 lg:h-56 object-contain mb-2 rounded-xl">
                    <h2 class="font-bold text-lg mt-2">{{ $algorithm->name }}</h2>
                    <p class="text-sm mt-1 line-clamp-3 bg-slate-200 rounded-md">{{ $algorithm->description }}</p>
                    <p class="text-sm mt-1 break-words">{{ $algorithm->algorithm }}</p>
                    <p class="mt-1 text-xs text-gray-500">Group: {{ $algorithm->group }}</p>
                </div>
            @empty
                <p class="col-span-1 sm:col-span-2 md:col-span-3 lg:col-span-4 text-center text-gray-500">No algorithms
                    found
                    for this category.</p>
            @endforelse
        </div>

    </main>
@endsection

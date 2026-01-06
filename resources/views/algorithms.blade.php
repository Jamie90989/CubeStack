@extends('layouts.layout')

@section('content')
    <main>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 z-10">
    @forelse ($algorithms as $algorithm)
        <div class="card bg-base-100 shadow-md p-4 flex flex-col hover:shadow-xl transition-shadow duration-300">
            <img src="{{ $algorithm->image }}" alt="{{ $algorithm->name }}"
                class="w-full h-40 md:h-48 lg:h-56 object-contain rounded-md mb-2">
            <h2 class="font-bold text-lg mt-2">{{ $algorithm->name }}</h2>
            <p class="text-sm mt-1 line-clamp-3">{{ $algorithm->description }}</p>
            <p class="text-sm mt-1 break-words">{{ $algorithm->algorithm }}</p>
            <p class="mt-1 text-xs text-gray-500">Group: {{ $algorithm->group }}</p>
        </div>
    @empty
        <p class="col-span-1 sm:col-span-2 md:col-span-3 lg:col-span-4 text-center text-gray-500">No algorithms found for this category.</p>
    @endforelse
</div>

    </main>
@endsection

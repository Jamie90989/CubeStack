@extends('layouts.layout')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h1 class="text-xl font-bold mb-6">Add Algorithm</h1>

    <form method="POST" action="{{ route('algorithms.store') }}" enctype="multipart/form-data">
        @csrf

        {{-- Name --}}
        <div class="form-control mb-4">
            <label class="label">Name</label>
            <input type="text" name="name" class="input input-bordered" 
                   value="{{ old('name') }}" required>
            @error('name')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        {{-- Algorithm --}}
        <div class="form-control mb-4">
            <label class="label">Algorithm</label>
            <textarea name="algorithm" class="textarea textarea-bordered" rows="4" required>{{ old('algorithm') }}</textarea>
            @error('algorithm')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        {{-- Description --}}
        <div class="form-control mb-4">
            <label class="label">Description</label>
            <textarea name="description" class="textarea textarea-bordered" rows="2">{{ old('description') }}</textarea>
            @error('description')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        {{-- Group --}}
        <div class="form-control mb-4">
            <label class="label">Group</label>
            <input type="text" name="group" class="input input-bordered" value="{{ old('group') }}">
            @error('group')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        {{-- Category --}}
        <div class="form-control mb-4">
            <label class="label">Category</label>
            <select name="category_id" class="select select-bordered" required>
                <option value="">Select a Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {!! str_repeat('&nbsp;&nbsp;&nbsp;', $category->category_level - 1) !!}
                        {{ $category->name }} (Level {{ $category->category_level }})
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        {{-- Image --}}
        <div class="form-control mb-4">
            <label class="label">Image (optional)</label>
            <input type="file" name="image" class="file-input file-input-bordered">
            @error('image')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <button class="btn btn-primary w-full">Create Algorithm</button>
    </form>
</div>
@endsection

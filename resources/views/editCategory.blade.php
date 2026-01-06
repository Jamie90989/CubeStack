@extends('layouts.layout')

@section('content')
<div class="flex mt-10 justify-center p-2">
    <div class="max-w-lg w-full bg-white p-6 rounded shadow">
        <h1 class="text-xl font-bold mb-4">Edit Category</h1>

        {{-- Update Form --}}
        <form method="POST" action="{{ route('categories.update', $category->id) }}">
            @csrf
            @method('PUT')

            {{-- Category Name --}}
            <div class="form-control mb-4">
                <label class="label">Category Name</label>
                <input type="text" name="name" class="input input-bordered" 
                       value="{{ old('name', $category->name) }}" required>
            </div>

            {{-- Parent Category --}}
            <div class="form-control mb-4">
                <label class="label">Parent Category</label>
                <select name="parent_category_id" class="select select-bordered">
                    <option value="">None (Top Level)</option>
                    @foreach ($categories as $parent)
                        @if($parent->id !== $category->id) {{-- Prevent selecting self as parent --}}
                            <option value="{{ $parent->id }}" 
                                {{ old('parent_category_id', $category->parent_category_id) == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <button class="btn btn-success w-full">Update Category</button>
        </form>

        <form method="POST" action="{{ route('categories.destroy', $category->id) }}"
              onsubmit="return confirm('Are you sure you want to delete this category?');"
              class="mt-4">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-error w-full">Delete Category</button>
        </form>
    </div>
</div>
@endsection

@php
    function renderCategoryOptions($categories, $prefix = '')
    {
        foreach ($categories as $category) {
            echo '<option value="' . $category->id . '"';
            echo old('category_id') == $category->id ? ' selected' : '';
            echo '>' . $prefix . $category->name . '</option>';

            if ($category->children->isNotEmpty()) {
                renderCategoryOptions($category->children, $prefix . '-- ');
            }
        }
    }
@endphp

@extends('layouts.layout')

@section('content')
    <div class="flex mt-10 justify-center  p-2">
        <div class="max-w-xl w-full bg-white p-6 rounded shadow">
            <h1 class="text-xl font-bold mb-6">Add Algorithm</h1>

            <form method="POST" action="{{ route('algorithms.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- Name --}}
                <div class="form-control mb-4">
                    <label class="label">Name</label>
                    <input type="text" name="name" class="input input-bordered" value="{{ old('name') }}" required>
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
                        @php renderCategoryOptions($categories); @endphp
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
    </div>
@endsection

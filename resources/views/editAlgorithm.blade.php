@extends('layouts.layout')

@section('content')
    <div class="flex mt-10 justify-center p-2">
        <div class="max-w-xl w-full bg-white p-6 rounded shadow">
            <h1 class="text-xl font-bold mb-6">Edit Algorithm</h1>

            <form method="POST" action="{{ route('algorithms.update', $algorithm->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="form-control mb-4">
                    <label class="label">Name</label>
                    <input type="text" name="name" class="input input-bordered"
                        value="{{ old('name', $algorithm->name) }}" required>
                    @error('name')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Algorithm --}}
                <div class="form-control mb-4">
                    <label class="label">Algorithm</label>
                    <textarea name="algorithm" class="textarea textarea-bordered" rows="4" required>{{ old('algorithm', $algorithm->algorithm) }}</textarea>
                    @error('algorithm')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="form-control mb-4">
                    <label class="label">Description</label>
                    <textarea name="description" class="textarea textarea-bordered" rows="2">{{ old('description', $algorithm->description) }}</textarea>
                    @error('description')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Group --}}
                <div class="form-control mb-4">
                    <label class="label">Group</label>
                    <input type="text" name="group" class="input input-bordered"
                        value="{{ old('group', $algorithm->group) }}">
                    @error('group')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Category --}}
                <div class="form-control mb-4">
                    <label class="label">Category</label>
                    <select name="category_id" class="select select-bordered" required>
                        <option value="">Select a Category</option>
                        @php
                            function renderCategoryOptions($categories, $prefix = '', $selected = null)
                            {
                                foreach ($categories as $category) {
                                    echo '<option value="' . $category->id . '"';
                                    echo $selected == $category->id ? ' selected' : '';
                                    echo '>' . $prefix . $category->name . '</option>';
                                    if ($category->children->isNotEmpty()) {
                                        renderCategoryOptions($category->children, $prefix . '-- ', $selected);
                                    }
                                }
                            }
                            renderCategoryOptions($categories, '', old('category_id', $algorithm->category_id));
                        @endphp
                    </select>
                    @error('category_id')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Image --}}
                <div class="form-control mb-4">
                    <label class="label">Image (optional)</label>
                    <input type="file" name="image" class="file-input file-input-bordered">
                    @if ($algorithm->image)
                        <p class="text-xs mt-1">Current image: <img src="{{ asset('storage/' . $algorithm->image) }}"
                                class="h-12 w-12 object-contain inline-block rounded"></p>
                    @endif
                    @error('image')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <button class="btn btn-success w-full">Update Algorithm</button>
            </form>
            <form method="POST" action="{{ route('algorithms.destroy', $algorithm->id) }}"
                onsubmit="return confirm('Are you sure you want to delete this algorithm?');" class="mt-3">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-error w-full">Delete Algorithm</button>
            </form>
        </div>
    </div>
@endsection

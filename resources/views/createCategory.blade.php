@extends('layouts.layout')

@section('content')
<div class="flex mt-10 justify-center p-2">
    <div class="max-w-lg w-full bg-white p-6 rounded shadow">
        <h1 class="text-xl font-bold mb-4">Add Category</h1>

        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            <div class="form-control mb-4">
                <label class="label">Category Name</label>
                <input type="text" name="name" class="input input-bordered" required>
            </div>

            <div class="form-control mb-4">
                <label class="label">Parent Category</label>
                <select name="parent_category_id" class="select select-bordered">
                    <option value="">None (Top Level)</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary w-full">Create Category</button>
        </form>
    </div>
</div>

@endsection

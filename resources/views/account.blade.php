@extends('layouts.layout')

@section('content')
    <main>
        <div class="p-10">
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
        <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
                    <h1 class="text-xl font-bold mb-6">Manage Your Categories</h1>

                    {{-- Flash Messages --}}
                    @if (session('success'))
                        <div class="alert alert-success shadow-lg mb-4">
                            <div>{{ session('success') }}</div>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-error shadow-lg mb-4">
                            <div>{{ session('error') }}</div>
                        </div>
                    @endif

                    {{-- Select Category --}}
                    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
                        <h1 class="text-xl font-bold mb-6">Manage Your Categories</h1>

                        {{-- Flash messages --}}
                        @if (session('success'))
                            <div class="alert alert-success shadow-lg mb-4">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-error shadow-lg mb-4">{{ session('error') }}</div>
                        @endif

                       <form method="GET" action="{{ route('categories.edit') }}">
    <div class="form-control mb-4">
        <label class="label">Select a Category to Edit or Delete</label>
        <select name="category_id" class="select select-bordered" required>
            <option value="">-- Choose a category --</option>

            @php
                // Recursive function to render options in nav order
                function renderCategoryOptions($categories, $prefix = '') {
                    foreach ($categories as $category) {
                        echo '<option value="'. $category->id .'">'. $prefix . $category->name .'</option>';
                        if ($category->children->isNotEmpty()) {
                            renderCategoryOptions($category->children, $prefix . '-- ');
                        }
                    }
                }
            @endphp

            @php renderCategoryOptions($categories); @endphp

        </select>
    </div>

    <button type="submit" class="btn btn-secondary w-full">Edit Selected Category</button>
</form>

                    </div>
                </div>



    </main>
@endsection

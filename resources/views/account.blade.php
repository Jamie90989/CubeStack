@extends('layouts.layout')

@section('content')
    <main>
        <div class="p-10">
            <div class="card shadow-lg bg-base-100 p-6 max-w-xl mx-auto">
                <h1 class="text-3xl font-bold">Welcome, {{ auth()->user()->name }}!</h1>
            </div>
        </div>

        <div class="w-full bg-base-100 shadow-md py-3 px-6 flex justify-center items-center space-x-3">
            @auth
                <a href="{{ route('algorithms.create') }}" class="btn btn-lg btn-primary">
                    + Add Algorithm
                </a>

                <a href="{{ route('categories.create') }}" class="btn btn-lg btn-primary">
                    + Add Category
                </a>
                <p>Hide standard Algorithms</p>
                <label class="toggle text-base-content cursor-pointer" id="hideStandardToggle">
                    <input type="checkbox" {{ auth()->user()->hideStandardAlgs ? '' : 'checked' }} />
                    <svg aria-label="enabled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g stroke-linejoin="round" stroke-linecap="round" stroke-width="4" fill="none" stroke="currentColor">
                            <path d="M20 6 9 17l-5-5"></path>
                        </g>
                    </svg>
                    <svg aria-label="disabled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </label>

            @endauth
        </div>

        {{-- Select Category --}}
        <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
            <h1 class="text-xl font-bold mb-6">Manage Your Categories</h1>
            <form method="GET" action="{{ route('categories.edit') }}">
                <div class="form-control mb-4">
                    <label class="label">Select a Category to Edit or Delete</label>
                    <select name="category_id" class="select select-bordered" required>
                        <option value="">-- Choose a category --</option>
                        @php
                            function renderCategoryOptions($categories, $prefix = '')
                            {
                                foreach ($categories as $category) {
                                    echo '<option value="' .
                                        $category->id .
                                        '">' .
                                        $prefix .
                                        $category->name .
                                        '</option>';
                                    if ($category->children->isNotEmpty()) {
                                        renderCategoryOptions($category->children, $prefix . '-- ');
                                    }
                                }
                            }
                        @endphp
                        @php renderCategoryOptions($categories); @endphp
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-full">Edit Selected Category</button>
            </form>
        </div>
        <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
            <h1 class="text-xl font-bold mb-6">edit account settings</h1>
            <a href="{{ route('users.edit', auth()->user()) }}" class="btn btn-lg btn-primary w-full">
                Edit account settings
            </a>

        </div>


    </main>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.querySelector('#hideStandardToggle input');

        toggle.addEventListener('change', function() {
            fetch("{{ route('user.toggleHideStandard') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('hideStandardAlgs is now:', data.hideStandardAlgs);
                    } else {
                        console.error('Failed to toggle');
                    }
                })
                .catch(err => console.error('Error:', err));
        });
    });
</script>

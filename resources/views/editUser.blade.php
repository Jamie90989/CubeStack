@extends('layouts.layout')

@section('content')
<main>
    <div class="flex mt-10 justify-center p-2">
        <div class="card w-full max-w-lg shadow-xl bg-base-100 p-6">
            <div class="card-body">
                <h2 class="card-title text-3xl">Edit Account</h2>

                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

              <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-4">
    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <input type="text" name="name" placeholder="Full Name" value="{{ old('name', $user->name) }}"
                        class="input input-bordered w-full @error('name') input-error @enderror" >
                    @error('name')
                        <p class="text-error text-sm">{{ $message }}</p>
                    @enderror

                    <!-- Email -->
                    <input type="email" name="email" placeholder="Email Address" value="{{ old('email', $user->email) }}"
                        class="input input-bordered w-full @error('email') input-error @enderror" >
                    @error('email')
                        <p class="text-error text-sm">{{ $message }}</p>
                    @enderror

                    <!-- Password -->
                    <div class="relative">
                        <input id="password" type="password" name="password" placeholder="New Password (leave blank to keep current)"
                            class="input input-bordered w-full pr-12 @error('password') input-error @enderror">
                        <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                            👁️
                        </button>
                    </div>
                    @error('password')
                        <p class="text-error text-sm">{{ $message }}</p>
                    @enderror

                    <h3 class="text-xl font-semibold pt-4">Security Questions</h3>

                    <!-- Security Questions Loop -->
                    @for ($i = 1; $i <= 3; $i++)
                        <select name="securityQuestion{{ $i }}"
                            class="select select-bordered w-full @error('securityQuestion'.$i) select-error @enderror" >
                            <option value="" disabled selected>-- Choose a question --</option>

                            @php
                                $questions = [
                                    1 => [
                                        "What is your mother's maiden name?",
                                        "What city were you born in?",
                                        "What is the name of your first pet?"
                                    ],
                                    2 => [
                                        "What was your first school called?",
                                        "What is your favorite movie?",
                                        "What was your childhood nickname?"
                                    ],
                                    3 => [
                                        "What was your dream job as a child?",
                                        "What is your favorite food?",
                                        "What is your favourite holiday destination?"
                                    ]
                                ];
                            @endphp

                            @foreach ($questions[$i] as $question)
                                <option value="{{ $question }}" {{ old('securityQuestion'.$i, $user->{'securityQuestion'.$i}) == $question ? 'selected' : '' }}>
                                    {{ $question }}
                                </option>
                            @endforeach
                        </select>
                        @error('securityQuestion'.$i)
                            <p class="text-error text-sm">{{ $message }}</p>
                        @enderror

                        <input name="securityAnswer{{ $i }}" type="text" placeholder="Answer {{ $i }}"
                            class="input input-bordered w-full @error('securityAnswer'.$i) input-error @enderror">
                        @error('securityAnswer'.$i)
                            <p class="text-error text-sm">{{ $message }}</p>
                        @enderror
                    @endfor

                    <button class="btn btn-primary w-full mt-4">Update Account</button>
                </form>

            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    passwordToggle('#password', '#togglePassword');
});
</script>
@endsection

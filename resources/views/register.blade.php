@extends('layouts.layout')

@section('content')
    <main>


        <div class="card w-full max-w-lg shadow-xl bg-base-100">
            <div class="card-body">
                <h2 class="card-title text-3xl">Create Account</h2>

                <form method="POST" action="/register" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}"
                        class="input input-bordered w-full @error('name') input-error @enderror" required>
                    @error('name')
                        <p class="text-error text-sm">{{ $message }}</p>
                    @enderror

                    <!-- Email -->
                    <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}"
                        class="input input-bordered w-full @error('email') input-error @enderror" required>
                    @error('email')
                        <p class="text-error text-sm">{{ $message }}</p>
                    @enderror

                    <!-- Password -->
                    <div class="relative">
                        <input id="password" type="password" name="password" placeholder="Password"
                            class="input input-bordered w-full pr-12 @error('password') input-error @enderror" required>

                        <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                            👁️
                        </button>
                    </div>

                    @error('password')
                        <p class="text-error text-sm">{{ $message }}</p>
                    @enderror

                    <h3 class="text-xl font-semibold pt-4">Security Questions</h3>

                    <!-- Question 1 -->
                    <select name="securityQuestion1"
                        class="select select-bordered w-full @error('securityQuestion1') select-error @enderror" required>
                        <option value="" disabled selected>-- Choose a question --</option>
                        <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                        <option value="What city were you born in?">What city were you born in?</option>
                        <option value="What is the name of your first pet?">What is the name of your first pet?</option>
                    </select>
                    @error('securityQuestion1')
                        <p class="text-error text-sm">{{ $message }}</p>
                    @enderror
                    <input name="securityAnswer1" type="text" placeholder="Answer 1" value="{{ old('securityAnswer1') }}"
                        class="input input-bordered w-full @error('securityAnswer1') input-error @enderror" required>
                    @error('securityAnswer1')
                        <p class="text-error text-sm">{{ $message }}</p>
                    @enderror

                    <!-- Question 2 -->
                    <select name="securityQuestion2"
                        class="select select-bordered w-full @error('securityQuestion2') select-error @enderror" required>
                        <option value="" disabled selected>-- Choose a question --</option>
                        <option value="What was your first school called?"
                            {{ old('securityQuestion2') == 'What was your first school called?' ? 'selected' : '' }}>What
                            was your first school called?</option>
                        <option value="What is your favorite movie?"
                            {{ old('securityQuestion2') == 'What is your favorite movie?' ? 'selected' : '' }}>What is your
                            favorite movie?</option>
                        <option value="What was your childhood nickname?"
                            {{ old('securityQuestion2') == 'What was your childhood nickname?' ? 'selected' : '' }}>What
                            was your childhood nickname?</option>
                    </select>
                    @error('securityQuestion2')
                        <p class="text-error text-sm">{{ $message }}</p>
                    @enderror
                    <input name="securityAnswer2" type="text" placeholder="Answer 2"
                        value="{{ old('securityAnswer2') }}"
                        class="input input-bordered w-full @error('securityAnswer2') input-error @enderror" required>
                    @error('securityAnswer2')
                        <p class="text-error text-sm">{{ $message }}</p>
                    @enderror

                    <!-- Question 3 -->
                    <select name="securityQuestion3"
                        class="select select-bordered w-full @error('securityQuestion3') select-error @enderror" required>
                        <option value="" disabled selected>-- Choose a question --</option>
                        <option value="What was your dream job as a child?"
                            {{ old('securityQuestion3') == 'What was your dream job as a child?' ? 'selected' : '' }}>What
                            was your dream job as a child?</option>
                        <option value="What is your favorite food?"
                            {{ old('securityQuestion3') == 'What is your favorite food?' ? 'selected' : '' }}>What is your
                            favorite food?</option>
                        <option value="What is your favourite holiday destination?"
                            {{ old('securityQuestion3') == 'What is your favourite holiday destination?' ? 'selected' : '' }}>
                            What is your favourite holiday destination?</option>
                    </select>
                    @error('securityQuestion3')
                        <p class="text-error text-sm">{{ $message }}</p>
                    @enderror
                    <input name="securityAnswer3" type="text" placeholder="Answer 3"
                        value="{{ old('securityAnswer3') }}"
                        class="input input-bordered w-full @error('securityAnswer3') input-error @enderror" required>
                    @error('securityAnswer3')
                        <p class="text-error text-sm">{{ $message }}</p>
                    @enderror

                    <button class="btn btn-primary w-full mt-4">Register</button>
                </form>

                <p class="text-center mt-4">
                    Already have an account?
                    <a href="/login" class="link link-primary">Login</a>
                </p>
            </div>
        </div>
    </main>
           
<script>
document.addEventListener('DOMContentLoaded', function () {
    passwordToggle('#password', '#togglePassword');
});
</script>

@endsection

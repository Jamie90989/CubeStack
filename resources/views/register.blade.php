@extends('layouts.layout')

@section('content')

<main>
   

<div class="card w-full max-w-lg shadow-xl bg-base-100">
    <div class="card-body">
        <h2 class="card-title text-3xl">Create Account</h2>

        <form method="POST" action="/register" class="space-y-4">
            @csrf

            <!-- Name -->
            <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" class="input input-bordered w-full @error('name') input-error @enderror" required>
            @error('name')
                <p class="text-error text-sm">{{ $message }}</p>
            @enderror

            <!-- Email -->
            <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" class="input input-bordered w-full @error('email') input-error @enderror" required>
            @error('email')
                <p class="text-error text-sm">{{ $message }}</p>
            @enderror

            <!-- Password -->
            <input type="password" name="password" placeholder="Password" class="input input-bordered w-full @error('password') input-error @enderror" required>
            @error('password')
                <p class="text-error text-sm">{{ $message }}</p>
            @enderror

            <h3 class="text-xl font-semibold pt-4">Security Questions</h3>

            <!-- Question 1 -->
            <select name="security_question_1" class="select select-bordered w-full @error('security_question_1') select-error @enderror" required>
                <option value="" disabled selected>-- Choose a question --</option>
                <option value="What is your mother's maiden name?" >What is your mother's maiden name?</option>
                <option value="What city were you born in?" >What city were you born in?</option>
                <option value="What is the name of your first pet?" >What is the name of your first pet?</option>
            </select>
            @error('security_question_1')
                <p class="text-error text-sm">{{ $message }}</p>
            @enderror
            <input name="security_answer_1" type="text" placeholder="Answer 1" value="{{ old('security_answer_1') }}" class="input input-bordered w-full @error('security_answer_1') input-error @enderror" required>
            @error('security_answer_1')
                <p class="text-error text-sm">{{ $message }}</p>
            @enderror

            <!-- Question 2 -->
            <select name="security_question_2" class="select select-bordered w-full @error('security_question_2') select-error @enderror" required>
                <option value="" disabled selected>-- Choose a question --</option>
                <option value="What was your first school called?" {{ old('security_question_2') == "What was your first school called?" ? 'selected' : '' }}>What was your first school called?</option>
                <option value="What is your favorite movie?" {{ old('security_question_2') == "What is your favorite movie?" ? 'selected' : '' }}>What is your favorite movie?</option>
                <option value="What was your childhood nickname?" {{ old('security_question_2') == "What was your childhood nickname?" ? 'selected' : '' }}>What was your childhood nickname?</option>
            </select>
            @error('security_question_2')
                <p class="text-error text-sm">{{ $message }}</p>
            @enderror
            <input name="security_answer_2" type="text" placeholder="Answer 2" value="{{ old('security_answer_2') }}" class="input input-bordered w-full @error('security_answer_2') input-error @enderror" required>
            @error('security_answer_2')
                <p class="text-error text-sm">{{ $message }}</p>
            @enderror

            <!-- Question 3 -->
            <select name="security_question_3" class="select select-bordered w-full @error('security_question_3') select-error @enderror" required>
                <option value="" disabled selected>-- Choose a question --</option>
                <option value="What was your dream job as a child?" {{ old('security_question_3') == "What was your dream job as a child?" ? 'selected' : '' }}>What was your dream job as a child?</option>
                <option value="What is your favorite food?" {{ old('security_question_3') == "What is your favorite food?" ? 'selected' : '' }}>What is your favorite food?</option>
                <option value="What is the name of your best friend?" {{ old('security_question_3') == "What is the name of your best friend?" ? 'selected' : '' }}>What is the name of your best friend?</option>
            </select>
            @error('security_question_3')
                <p class="text-error text-sm">{{ $message }}</p>
            @enderror
            <input name="security_answer_3" type="text" placeholder="Answer 3" value="{{ old('security_answer_3') }}" class="input input-bordered w-full @error('security_answer_3') input-error @enderror" required>
            @error('security_answer_3')
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
@endsection
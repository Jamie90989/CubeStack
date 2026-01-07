@extends('layouts.layout')

@section('content')
<main>
    <div class="flex mt-10 justify-center p-2">
        <div class="card w-full max-w-lg shadow-xl bg-base-100 p-6">
            <div class="card-body">
                <h2 class="card-title text-2xl">Security Verification</h2>

                <p class="text-sm text-gray-500 mb-4">
                    Please answer the following security questions to continue.
                </p>

                @if($errors->has('security'))
                    <p class="text-error mb-4">{{ $errors->first('security') }}</p>
                @endif

                <form method="POST" action="{{ route('users.security.verify') }}" class="space-y-4">
                    @csrf

                    @foreach($questions as $index => $question)
                        <div class="mb-4">
                            <label class="block font-medium mb-1">{{ $question }}</label>
                            <input type="text" name="answer_{{ $index }}" 
                                   class="input input-bordered w-full" required>
                        </div>
                    @endforeach

                    <button class="btn btn-primary w-full mt-4">
                        Verify & Continue
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

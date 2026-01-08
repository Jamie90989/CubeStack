@extends('layouts.layout')

@section('content')
    <main>
       <div class="relative w-full max-w-4xl mx-auto p-4 mt-20 m-10">
            <div class="absolute inset-0 grid grid-cols-6 grid-rows-6 gap-1 z-0">
                <div class="bg-white"></div>
                <div class="bg-yellow-400"></div>
                <div class="bg-red-500"></div>
                <div class="bg-orange-500"></div>
                <div class="bg-blue-500"></div>
                <div class="bg-green-500"></div>

                <div class="bg-yellow-400"></div>
                <div class="bg-white"></div>
                <div class="bg-orange-500"></div>
                <div class="bg-red-500"></div>
                <div class="bg-green-500"></div>
                <div class="bg-blue-500"></div>

                <div class="bg-red-500"></div>
                <div class="bg-orange-500"></div>
                <div class="bg-white"></div>
                <div class="bg-yellow-400"></div>
                <div class="bg-blue-500"></div>
                <div class="bg-green-500"></div>

                <div class="bg-orange-500"></div>
                <div class="bg-red-500"></div>
                <div class="bg-yellow-400"></div>
                <div class="bg-white"></div>
                <div class="bg-green-500"></div>
                <div class="bg-blue-500"></div>

                <div class="bg-blue-500"></div>
                <div class="bg-green-500"></div>
                <div class="bg-blue-500"></div>
                <div class="bg-green-500"></div>
                <div class="bg-red-500"></div>
                <div class="bg-orange-500"></div>

                <div class="bg-green-500"></div>
                <div class="bg-blue-500"></div>
                <div class="bg-green-500"></div>
                <div class="bg-blue-500"></div>
                <div class="bg-orange-500"></div>
                <div class="bg-red-500"></div>
            </div>

            <div
               class="relative z-10 bg-[#c7c8ff] border-4 border-black p-8 text-center w-full mx-auto">
                <h1 class="text-2xl font-bold mb-4">
                    welcome to
                    <div class="whitespace-nowrap">
                        <span class="text-red-500 text-outline">C</span>
                        <span class="text-blue-500 text-outline">u</span>
                        <span class="text-green-500 text-outline">b</span>
                        <span class="text-yellow-500 text-outline">e</span>
                        <span class="text-purple-600 text-outline">S</span>
                        <span class="text-orange-500 text-outline">t</span>
                        <span class="text-teal-500 text-outline">a</span>
                        <span class="text-pink-500 text-outline">c</span>
                        <span class="text-indigo-500 text-outline">k</span>!
                    </div>
                </h1>

                <p class="text-sm mb-2">
                    the site to organise all your algorithms!
                </p>

                <p class="text-sm mb-4">
                    now you'll be able to learn and memorise<br>
                    all your rubiks cube algorithms in one place!
                </p>

                <p class="font-semibold mb-6">
                    sign up for <b>FREE</b> to enjoy all perks!
                </p>

                <a href="{{ route('register') }}"
                    class="btn btn-lg border-2 border-black px-6 py-2 bg-[#eae8dc] 
                           shadow-[4px_4px_0px_0px_black] 
                           hover:translate-x-1 hover:translate-y-1 hover:shadow-none
                           transition">
                    Lets go!
                </a>

            </div>
        </div>
        </div>

    </main>
@endsection

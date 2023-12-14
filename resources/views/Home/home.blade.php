<x-app-layout>

    <x-slot name="headerName">
        {{ __('Home') }}
    </x-slot>

    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home Page') }}
        </h2>
    </x-slot> --}}

    <div class="py-12 -mt-12">
        <div class=" w-3/3">
            @include('home.partials.banner')
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @guest


                    <div class="mx-auto px-4 items-center justify-center py-5 bg-blue-100 w-full text-center">
                        <h1 class="text-2xl   font-bold mb-4">Login for Registered Users</h1>

                        <div class="mb-5 ml-7">
                            <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4">
                                Consultant
                            </a>
                            <a href="{{ route('admin.login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                ZFF Staff
                            </a>
                        </div>

                        <p>Don't have an account yet? <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register here.</a></p>
                    </div>
                    @endguest
                    @include('home.partials.search-bar')
                </div>
            </div>
        </div>
    </div>

    <div class="py-12 -mt-14">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <header>
                        <h2 class="text-xl font-semibold text-gray-900">
                            {{ __('Opportunities') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __("Check out offers that's fitted on your qualifications") }}
                        </p>
                    </header>

                    <div class=" mx-auto py-8">

                        <div class=" bg-gray-50 shadow-md rounded-lg p-6 mb-4 flex items-start justify-between">
                          <div>
                            <h2 class="text-xl font-semibold mb-2">Job Title</h2>
                            <p class="text-gray-600 mb-4">Description of the opportunity goes here...</p>
                          </div>
                          <button class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-300">Apply</button>
                        </div>

                        <div class="bg-gray-50 shadow-md rounded-lg p-6 mb-4 flex items-start justify-between">
                          <div>
                            <h2 class="text-xl font-semibold mb-2">Job Title</h2>
                            <p class="text-gray-600 mb-4">Description of the opportunity goes here...</p>
                          </div>
                          <button class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-300">Apply</button>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

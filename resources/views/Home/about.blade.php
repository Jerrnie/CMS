<x-app-layout>

    <x-slot name="headerName">
        {{ __('About') }}
    </x-slot>

    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home Page') }}
        </h2>
    </x-slot> --}}

    <div class="py-12 -mt-12">
        <div class=" w-3/3">
            <x-banner>
                <x-slot name="title">About us</x-slot>
                <x-slot name="subtitle">Learn more information about ZFF</x-slot>
            </x-banner>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @include('home.partials.about-zff')
                </div>
            </div>
        </div>
    </div>


</x-app-layout>

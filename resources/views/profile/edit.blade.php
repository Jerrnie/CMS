<x-app-layout>

    <x-slot name="headerName">
        {{ __('Profile') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <style>
        .required:after {
            content:" *";
            color: red;
        }
    </style>

    {{-- <div class="mt-12 max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6 flex py-4  px-24 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
          <span class="font-medium">Please provide your complete details; it'll significantly enhance your application's chances of approval.</span>
            <ul class="mt-1.5 list-disc list-inside">
              <li>Basic Information</li>
          </ul>
        </div>
      </div> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class=" max-w-6xl">
                    <ul class="flex border-b">
                        <li class="mr-6">
                            <a href="#profileInfo" class="tab-button text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-500 pb-2">Profile / Password</a>
                        </li>
                        <li class="mr-6">
                            <a href="#basicInfo" class="tab-button text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-500 pb-2">Basic Info</a>
                        </li>
                        <li class="mr-6">
                            <a href="#consultantInfo" class="tab-button text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-500 pb-2">Consultant Info</a>
                        </li>
                        <li class="mr-6">
                            <a href="#expertise" class="tab-button text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-500 pb-2">Expertise</a>
                        </li>

                    </ul>
                    <div class="mt-4">
                        <div id="profileInfo" class="tab-content">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                        <div id="basicInfo" class="tab-content hidden">
                            @include('profile.partials.update-basic-information')
                        </div>
                        <div id="consultantInfo" class="tab-content hidden">
                            @include('profile.partials.update-consultant-information')
                        </div>
                        <div id="expertise" class="tab-content hidden">
                            @include('profile.partials.update-expertise-information')
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="py-7 tab-content" id="profileInfo">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <div class="mt-4">
                            @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>
    </div>





    <script src="{{ asset('js/tabs.js') }}"></script>


</x-app-layout>

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <x-slot name="headerName">
        {{ __('Admin Login') }}
    </x-slot>

    <h1 class="flex text-center text-4xl relative pb-5">Admin Login</h1>

    <form method="POST" action="{{ route('admin.login.submit') }}"> <!-- Changed route to admin.login.submit -->
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <!-- User Login Link -->
            <a href="{{ route('login') }}" class="underline text-sm text-gray-600 hover:text-gray-900">
                {{ __('User Login') }}
            </a>

            <x-primary-button class="ms-3">
                {{ __('Log in') }} <!-- Changed from Log in to Admin Log in -->
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

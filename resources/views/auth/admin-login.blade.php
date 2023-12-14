<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <x-slot name="headerName">
        {{ __('Admin Login') }}
    </x-slot>

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



        <div class="flex items-center justify-end mt-4">


            <x-primary-button class="ms-3">
                {{ __('Admin Log in') }} <!-- Changed from Log in to Admin Log in -->
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-18">
            <div class="flex">
                <!-- Logo -->
                <div class="flex justify-center items-center h-full w-60">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/ZFF logo with text.png') }}" alt="ZFF Logo" >
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>

                    <x-nav-link :href="route('opportunities.index')" :active="request()->routeIs('opportunities.index')">
                        {{ __('Opportunities') }}
                    </x-nav-link>

                    <div x-data="{ open: false }" @click.away="open = false" style="padding-top: 20px">
                        <button @click="open = !open" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            {{ __('Applications') }}
                            <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-show="open" class="absolute mt-2 w-48 rounded-md shadow-lg z-20">
                            <div class="rounded-md bg-white shadow-xs">
                                <div class="py-1">
                                    <a href="#" class="{{ request()->routeIs('ongoing-app') ? 'text-blue-500' : 'text-gray-700'  }}  block px-4 py-2 text-sm  hover:bg-gray-100">Ongoing Application</a>
                                    <a href="#" class="{{ request()->routeIs('bookmark') ? 'text-blue-500' : 'text-gray-700'  }}  block px-4 py-2 text-sm hover:bg-gray-100">Book Marked</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div x-data="{ open: false }" @click.away="open = false" style="padding-top: 20px">
                        <button @click="open = !open" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            {{ __('Projects') }}
                            <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-show="open" class="absolute mt-2 w-48 rounded-md shadow-lg z-20">
                            <div class="rounded-md bg-white shadow-xs">
                                <div class="py-1">
                                    <a href="{{ route('opportunities.ongoing') }}" class="{{ request()->routeIs('ongoing-proj') ? 'text-blue-500' : 'text-gray-700'  }}  block px-4 py-2 text-sm  hover:bg-gray-100">Ongoing Project</a>
                                    <a href="#" class="{{ request()->routeIs('history') ? 'text-blue-500' : 'text-gray-700'  }}  block px-4 py-2 text-sm  hover:bg-gray-100">History</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
                        {{ __('About') }}
                    </x-nav-link>

                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->getFullName() }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('opportunities.index')" :active="request()->routeIs('opportunities.index')">
                {{ __('Opportunities') }}
            </x-responsive-nav-link>

    <!-- Add your dropdowns here -->
    <div x-data="{ open: false }" @click.away="open = false">
        <button @click="open = !open" class="w-full text-left py-2 px-3 text-gray-600 rounded-md hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
            {{ __('Applications') }}
            <svg class="ml-2 h-5 w-5 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>

        <div x-show="open" class="mt-2 w-full rounded-md bg-white shadow-xs">
            <div class="py-1">
                <a href="#" class="{{ request()->routeIs('ongoing-app') ? 'text-blue-500' : 'text-gray-700' }} block px-4 py-2 text-sm hover:bg-gray-100">Ongoing Application</a>
                <a href="#" class="{{ request()->routeIs('bookmark') ? 'text-blue-500' : 'text-gray-700' }} block px-4 py-2 text-sm hover:bg-gray-100">Book Marked</a>
            </div>
        </div>
    </div>

    <div x-data="{ open: false }" @click.away="open = false">
        <button @click="open = !open" class="w-full text-left py-2 px-3 text-gray-600 rounded-md hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
            {{ __('Projects') }}
            <svg class="ml-2 h-5 w-5 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>

        <div x-show="open" class="mt-2 w-full rounded-md bg-white shadow-xs">
            <div class="py-1">
                <a href="#" class="{{ request()->routeIs('ongoing-proj') ? 'text-blue-500' : 'text-gray-700' }} block px-4 py-2 text-sm hover:bg-gray-100">Ongoing Project</a>
                <a href="#" class="{{ request()->routeIs('history') ? 'text-blue-500' : 'text-gray-700' }} block px-4 py-2 text-sm hover:bg-gray-100">History</a>
            </div>
        </div>
    </div>

    <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">
        {{ __('About') }}
    </x-responsive-nav-link>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

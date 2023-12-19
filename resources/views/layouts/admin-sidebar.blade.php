<div x-cloak :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

<div x-cloak :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('images/ZFF logo with text.png') }}" alt="ZFF Logo" >
            </a>
        </div>
    </div>

    <nav class="mt-10">
        <a class="{{ request()->routeIs('admin.dashboard') ?  'active-sidebar-link':'inactive-sidebar-link'}}" href="{{ route('admin.dashboard') }}">
            <x-svg.nav-dashboard />

            <span class="mx-3">Dashboard</span>
        </a>

        <!-- Users -->
        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="/users">
            <x-svg.nav-user />
            <span class="mx-3">Users</span>
        </a>

        <!-- User Management -->
        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="/user-management">
            <x-svg.nav-user-manage />
            <span class="mx-3">User Management</span>
        </a>

        <!-- Projects Dropdown -->
        <div x-data="{ open: false }">
            <button @click="open = !open" class="w-full flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="mx-3">Projects</span>
            </button>

            <div x-show="open" class="flex flex-col bg-gray-800">
                <!-- All Open -->
                <a class="pl-10 flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="/projects/all-open">
                    <x-svg.nav-all />

                    <span class="mx-3">All Projects</span>
                </a>
                <!-- All Open -->
                <a class="pl-10 flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="/projects/all-open">
                    <x-svg.nav-open />
                    <span class="mx-3">Open Projects</span>
                </a>
                <!-- Ongoing Projects -->
                <a class="pl-10 flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="/projects/ongoing">
                    <x-svg.nav-ongoing />
                    <span class="mx-3">Ongoing Projects</span>
                </a>
                <!-- History -->
                <a class="pl-10 flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="/projects/history">
                    <x-svg.nav-history />

                    <span class="mx-3">History</span>
                </a>
            </div>
        </div>


        <!-- Categories Dropdown -->
        <div x-data="{ open: false }">
            <button @click="open = !open" class="w-full flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="mx-3">Categories</span>
            </button>

            <div x-show="open" class="flex flex-col bg-gray-800">
                <!-- Expertise Category -->
                <a class="pl-10 flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="#">
                    <x-svg.nav-expertise />
                    <span class="mx-3">Expertise Category</span>
                </a>
                <!-- Specialization Category -->
                <a class="pl-10 flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="#">
                    <x-svg.nav-docs />
                    <span class="mx-3">Specialization Category</span>
                </a>
            </div>
        </div>

        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('admin.settings') }}">
            <x-svg.nav-gear />
            <span class="mx-3">Settings</span>
        </a>

        <br>
        <hr class="my-4">
        <br>


        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('admin.ui') }}">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
            </svg>

            <span class="mx-3">UI Elements</span>
        </a>

        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('admin.tables') }}">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>

            <span class="mx-3">Tables</span>
        </a>

        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="{{ route('admin.forms') }}">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>

            <span class="mx-3">Forms</span>
        </a>
    </nav>
</div>

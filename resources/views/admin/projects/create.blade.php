<x-admin-layout>

    <x-slot name="headerName">
        {{ __('Create new project') }}
    </x-slot>

    <x-stepper.setup-one/>

    <h3 class="text-gray-700 text-3xl font-medium">Create Project</h3>


    <div class="py-4 tab-content" id="profileInfo">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p- sm:p-8 bg-white shadow sm:rounded-lg">
                @include('admin.projects.partials.create-new-project')
            </div>
        </div>
    </div>

</x-admin-layout>

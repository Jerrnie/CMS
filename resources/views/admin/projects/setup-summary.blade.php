<x-admin-layout>

    <x-slot name="headerName">
        {{ __('Reference') }}
    </x-slot>

    <x-stepper.setup-three :project="$project"/>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <p class="text-center text-gray-500 text-lg">Project Title</p>
            <h3 class="text-center text-gray-700 text-3xl font-medium">{{ $project->title }}</h3>
            <div class="flex justify-between mt-4">
                <p class="text-gray-700 text-lg">Code: <strong>{{ $project->code }}</strong></p>
                <p class="text-gray-700 text-lg">Status: <strong>{{ ucfirst($status->name) }}</strong></p>
            </div>
            <div class="flex justify-between mt-4">
                <p class="text-gray-700 text-lg">Budget Code: <strong>{{ $budgetcode->unit_activity }}</strong></p>
                <p class="text-gray-700 text-lg">Unit: <strong>{{ $project->unit->name }}</strong></p>
            </div>
        </div>
    </div>


    <div class="py-4 tab-content" id="profileInfo">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                @include('admin.projects.partials.setup-description-project')
            </div>
        </div>
    </div>

    <div class="py-4 tab-content" id="profileInfo">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                @include('admin.projects.partials.setup-summary-project')
            </div>
        </div>
    </div>

    <div class="py-4 tab-content" id="profileInfo">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                @include('admin.projects.partials.action-buttons')
            </div>
        </div>
    </div>

    @if ($errors->any())

    <script>
        let message = '';
        @foreach ($errors->all() as $error)
            message += '<li>{{ $error }}</li>';
        @endforeach

        if (message) {
            Swal.fire({
                icon: 'error',
                position: "top-end",
                title: 'Validation Error',
                html: message,
                showConfirmButton: false,
                timer: 2500
            });
        }
    </script>
@endif

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            position: "top-end",
            title: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2500
        });
    </script>
@endif


</x-admin-layout>

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

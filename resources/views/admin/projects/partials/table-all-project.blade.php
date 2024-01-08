<div class="flex flex-wrap -m-4">
    @foreach ($projects as $project)
        <div class="p-4 w-full">
            <div class="h-full border-2 border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300 ease-in-out">
                <div class="p-6">
                    <h2 class="title-font text-2xl font-medium text-gray-900 mb-3">{{ ucwords($project->title) }}</h2>
                    <div class="flex flex-wrap justify-between items-center mb-3">
                        <p class="text-gray-500"><strong>Status:</strong> {{ ucfirst($project->status->name) }}</p>
                        <p class="text-gray-500"><strong>Date Coverage:</strong>
                            {{$project->date_coverage}}
                        </p>
                    </div>
                    <div class="flex flex-wrap justify-between items-center mb-3">
                        <p class="text-gray-500"><strong>Consultant:</strong> {{ $project->consultant ? $project->consultant_name : 'N/A' }}</p>
                        <p class="text-gray-500"><strong>Expertise Field:</strong> {{ $project->expertise_field_name }}</p>
                    </div>
                    <div class="flex flex-wrap justify-between items-center">
                        <p class="text-gray-500">{{ Str::limit($project->description, 85, '...') }}</p>
                        <div class="mt-3 sm:mt-0 sm:ml-2">
                            <a href="{{ route('admin.projects.setup', $project->id) }}" class="inline-flex items-center bg-green-500 text-white px-3 py-2 rounded mr-2 hover:bg-green-600 transition-colors duration-300 ease-in-out">Edit</a>
                            <a href="{{ route('admin.projects.view', $project->id) }}" class="inline-flex items-center bg-indigo-500 text-white px-3 py-2 rounded hover:bg-indigo-600 transition-colors duration-300 ease-in-out">View
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="mt-4">
    {{ $projects->links() }}
</div>

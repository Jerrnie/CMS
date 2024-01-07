

<div class="flex flex-wrap -m-4">
    @foreach ($projects as $project)
        <div class="p-4 w-full">
            <div class="h-full border-2 border-gray-200 rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-center">
                        <h2 class="title-font text-3xl font-medium text-gray-900">{{ $project->title }}</h2>
                        <p class="text-gray-500">Status: {{ ucfirst($project->status->name) }}</p>
                    </div>
                    <div class="flex justify-between items-center">
                        <p class="text-gray-500">Consultant: {{ $project->consultant ? $project->consultant_name : 'N/A' }}</p>
                        <p class="text-gray-500">Expertise Field: {{ $project->expertise_field_name }}</p>
                    </div>
                    <div class="flex justify-between items-center">
                        <p class="text-gray-500">{{ Str::limit($project->description, 45, '...') }}</p>
                        <div>
                            <a href="{{ route('admin.projects.setup', $project->id) }}" class="mt-3 inline-flex items-center bg-green-500 text-white px-3 py-2 rounded mr-2">Edit</a>
                            <a href="{{ route('admin.projects.view', $project->id) }}" class="mt-3 inline-flex items-center bg-indigo-500 text-white px-3 py-2 rounded">View
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

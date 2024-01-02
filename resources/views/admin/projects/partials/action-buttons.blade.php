<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <h2 class="text-lg leading-6 font-medium text-gray-900 text-center align-self-center">Action Buttons</h2>

            <div class="flex justify-center mt-4 space-x-4">

                {{-- Post Project Button --}}
                @if($status->code == 1)
                    <form action="{{ route('admin.projects.post', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to post this project?');" class="flex">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition-colors duration-200">
                            Post Project
                        </button>
                    </form>
                @endif

                {{-- Unpost Project Button --}}
                @if($status->code == 2)
                    <form action="{{ route('admin.projects.unpost', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to unpost this project?');" class="flex">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700 transition-colors duration-200">
                            Unpost Project
                        </button>
                    </form>
                @endif
                {{-- Delete Project Button --}}
                <form action="{{ route('admin.projects.delete', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');" class="flex">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition-colors duration-200">
                        Delete Project
                    </button>
                </form>

                {{-- remove assigned consultant --}}
                @if($project->consultant_id)
                    <form action="{{ route('admin.projects.remove.consultant', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove the assigned consultant?');" class="flex">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition-colors duration-200">
                            Remove Assigned Consultant
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

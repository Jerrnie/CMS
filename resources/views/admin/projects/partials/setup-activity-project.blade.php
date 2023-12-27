<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <header class="pb-4 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Edit Activity') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __("Add deliverables and edit activity name") }}
                        </p>
                    </div>

                    <div class="flex items-center">
                        <a href="{{ route('admin.projects.setup.reference', ['project' => $project->id]) }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition-colors duration-200 mr-2">
                            Finish Activity Setup
                        </a>
                        <form action="{{ route('admin.projects.delete.activity', $activity->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this activity?');" class="flex">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition-colors duration-200">
                                Delete Activity
                            </button>
                        </form>
                    </div>
                </header>

                <div class="flex flex-wrap -mx-2">
                    <div class="w-full sm:w-1/2 px-2">
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full">
                            <form method="POST" action="{{ route('admin.projects.edit.activity', $activity) }}">
                                @csrf
                                @method('PUT')
                                <div class="flex justify-between items-center px-5 py-3 text-gray-700 border-b bg-blue-200">
                                    <h3 class="text-sm">Edit Activity Title</h3>
                                </div>

                                <div class="px-5 py-6 bg-gray-200 text-gray-700 border-b">
                                    <label class="text-xs">Name e.g (Phase 1: Design)</label>

                                    <div class="mt-2 relative rounded-md shadow-sm">
                                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-600">
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/>
                                            </svg>
                                        </span>

                                        <input type="text" value="{{ $activity->title }}" name="title" class="form-input w-full px-12 py-2 appearance-none rounded-md focus:border-indigo-600" autocomplete="off">
                                    </div>
                                </div>

                                <div class="flex justify-between items-center px-5 py-3">
                                    <button type="submit" class="px-3 py-1 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-500 focus:outline-none">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="w-full sm:w-1/2 px-2">
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full">
                            <form method="POST" action="{{ route('admin.projects.add.deliverable', $activity) }}">
                                @csrf
                                @method('POST')
                                <div class="flex justify-between items-center px-5 py-3 text-gray-700 border-b bg-purple-200">
                                    <h3 class="text-sm">Add deliverables</h3>
                                </div>

                                <div class="px-5 py-6 bg-gray-200 text-gray-700 border-b">
                                    <label class="text-xs">Detail e.g (Make database for user)</label>

                                    <div class="mt-2 relative rounded-md shadow-sm">
                                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-600">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18v18H3zM16 8.5a3.5 3.5 0 11-7 0 3.5 3.5 0 017 0zM3 3a2 2 0 012-2h14a2 2 0 012 2v4H3V3z"></path>
                                            </svg>
                                        </span>
                                        <input type="text" name="title" class="form-input w-full px-12 py-2 appearance-none rounded-md focus:border-indigo-600" autocomplete="off">
                                    </div>
                                </div>

                                <div class="flex justify-between items-center px-5 py-3">
                                    <button type="submit" class="px-3 py-1 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-500 focus:outline-none">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


    <!-- Deliverables -->
    <div class="flex">

        <!-- Deliverables Table -->
            @if($activity->deliverables->isEmpty())
            <div class="-mx-3 py-2 px-4">
                <x-cards.info title="Info" subtitle="There's no deliverables for this activity" />
            </div>
            @else
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Deliverable') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($activity->deliverables as $deliverable)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $deliverable->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center gap-2">
                                        <x-modal-edit-deliverables :deliverable="$deliverable" />


                                        <form id="delete-form-{{ $deliverable->id }}" action="{{ route('admin.projects.delete.deliverable', $deliverable->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button" onclick="confirmDelete({{ $deliverable->id }})"  class="px-4 py-2 bg-red-600 text-white rounded delete-btn hover:bg-red-700 transition-colors duration-200">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
    </div>
    <script>
        function confirmDelete(deliverableId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + deliverableId).submit();
                }
            })
        }
        </script>

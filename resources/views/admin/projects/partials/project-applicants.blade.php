{{-- applicants --}}
<div class="bg-white px-4 pt-5 pb-2 sm:p-4 sm:pb-2">
    <div class="sm:flex sm:items-start">
        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
            <h2 class="text-center text-xl leading-6 font-medium text-gray-900 pb-4" id="modal-title">
                {{ __('Applicants') }}
            </h2>
            <div class="mt-2">
                <table class="min-w-full divide-y divide-gray-200 shadow-sm rounded-lg overflow-hidden">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date of Application
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- Loop through your applicants data --}}
                        @forelse ($applicants as $applicant)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-lg text-gray-700">{{ $applicant->user->getFullName(); }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-lg text-gray-700">{{ date('F j, Y', strtotime($applicant->application_date)) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex">
                                        <button class="mr-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200 ease-in-out">
                                            View
                                        </button>
                                        @if (!$consultant)
                                        <form method="POST" action="{{ route('admin.projects.applications.assign', ['applicant' => $applicant->id]) }}">
                                            @csrf
                                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-200 ease-in-out">
                                                Select
                                            </button>
                                        </form>
                                    @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                    <x-cards.info title="Info" subtitle="There's no applicants for this project yet." />
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

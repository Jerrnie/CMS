<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                {{-- header add tranch --}}
                <div class="flex justify-between px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <h2 class="text-lg leading-6 font-medium text-gray-900">Tranch</h2>
                        <x-btn-create-tranch :project="$project"/>
                </div>

                @if ($tranches)
                    <table class="min-w-full divide-y divide-gray-200">
                        @include('admin.projects.partials.thead-tranch')
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($tranches as $tranch)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $tranch->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $tranch->budget }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($tranch->date_from)->diffInWeekdays(\Carbon\Carbon::parse($tranch->date_to)) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {{ \Carbon\Carbon::parse($tranch->date_from)->format('F j, Y') }}<br>
                                        to<br>
                                        {{ \Carbon\Carbon::parse($tranch->date_to)->format('F j, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <select class="form-select block w-full mt-1">

                                                @if ($tranch->activities->isEmpty())
                                                    <option>No Activity</option>
                                                @endif
                                                @foreach ($tranch->activities as $activity)
                                                    <option>{{ $activity->title }}</option>
                                                @endforeach
                                            </select>
                                            {{-- <a href="{{ route('admin.projects.setup.activity', ['tranch' => $tranch]) }}">
                                                <button class="mt-2 px-4 py-2 bg-blue-600 text-white rounded">+</button>
                                            </a> --}}

                                            <x-modal-activity :tranch="$tranch"/>






                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button class="px-4 py-2 bg-red-600 text-white rounded">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>
</div>

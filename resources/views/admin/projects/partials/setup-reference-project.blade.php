<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                {{-- header add trench --}}
                <div class="flex justify-between px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <h2 class="text-lg leading-6 font-medium text-gray-900">Trench</h2>
                        <x-btn-create-trench :project="$project"/>
                </div>

                @if ($trenches)
                    <table class="min-w-full divide-y divide-gray-200">
                        @include('admin.projects.partials.thead-trench')
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($trenches as $trench)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $trench->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $trench->budget }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($trench->date_from)->diffInWeekdays(\Carbon\Carbon::parse($trench->date_to)) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {{ \Carbon\Carbon::parse($trench->date_from)->format('F j, Y') }}<br>
                                        to<br>
                                        {{ \Carbon\Carbon::parse($trench->date_to)->format('F j, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <select class="form-select block w-full mt-1">

                                                @if ($trench->activities->isEmpty())
                                                    <option>No Activity</option>
                                                @endif
                                                @foreach ($trench->activities as $activity)
                                                    <option>{{ $activity->title }}</option>
                                                @endforeach
                                            </select>

                                            <x-modal-activity :trench="$trench"/>


                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <x-modal-edit-trench :trench="$trench"/>


                                        <form method="POST" action="{{ route('admin.projects.delete.reference', $trench->id) }}" class="inline-block" >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded delete-btn hover:bg-red-700 transition-colors duration-200">Delete</button>
                                        </form>
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

<script>
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
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
                    this.parentElement.submit();
                }
            })
        });
    });
    </script>

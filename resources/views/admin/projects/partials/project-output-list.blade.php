<section class=" ">
    <div class="">
        <header>
            {{-- <h2 class="text-lg font-medium text-gray-900">
                {{ __('Your outputs for this tranch') }}
            </h2> --}}

        </header>

        @csrf
        @method('patch')

        <div class="w-full overflow-x-auto pt-5">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 text-gray-900 uppercase border-b border-gray-600">
                    <tr>
                        <th class="px-4 py-3 uppercase font-semibold text-sm">Title</th>
                        <th class="px-4 py-3 uppercase font-semibold text-sm">Description</th>
                        <th class="px-4 py-3 uppercase font-semibold text-sm">URL/File</th>
                        <th class="px-4 py-3 uppercase font-semibold text-sm">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-gray-700">
                    @forelse ($documentRows as $row)
                    <tr data-id="{{ $row['id'] }}" class="border">
                        <td class="px-4 py-3">
                            <input disabled value="{{ $row['title'] }}"  class="block " type="text" required autofocus />
                        </td>
                        <td class="px-4 py-3">
                            <textarea disabled  class="block " type="text" required autofocus >{{ $row['description'] }}</textarea>
                        </td>
                        <td class="px-4 py-3">
                            <input disabled value="{{ $row['type'] === 1 ? $row['original_file_name'] : $row['url'] }}" class="block " type="text" />
                        </td>
                        <td class="px-4 py-3 flex justify-start items-center space-x-2">
                            @if ($row['type'] === 1)
                            @php
                                $file = asset('storage/public/supporting-documents/' . $row['user_id'] . '/' . $row['file_name'])
                            @endphp
                            <a href="{{ $file }}" download class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center shadow-md">
                                <x-svg-download class="w-4 h-4" />
                            </a>
                            @endif
                            <button type="button" data-id="{{ $row['id'] }}" class="delete-btn bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center shadow-md">
                                <x-svg-trashcan class="w-4 h-4" />
                            </button>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-3 text-center border-solid border-bottom border-gray-500 transition-colors duration-200">No uploads yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <script>
            document.querySelectorAll('.delete-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');

                    fetch('/delete-attachment/' + id, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Remove the document row from the table
                        console.log(data.debugger);
                        var row = document.querySelector('tr[data-id="' + id + '"]');
                        if (row) {
                            row.remove();
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
                });
            });
        </script>
    </div>
</section>

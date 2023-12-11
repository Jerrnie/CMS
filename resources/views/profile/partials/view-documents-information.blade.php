<section>
    <div class="flex justify-between items-center">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Attachments') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __("Your Supporting Documents") }}
            </p>
        </header>

    </div>

</section>

        @csrf
        @method('patch')

            <div class="overflow-x-auto pt-5">
                <table class="min-w-full divide-y divide-gray-200 shadow-sm rounded-lg overflow-hidden">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="py-3  uppercase font-semibold text-sm w-1/4">Title</th>
                            <th class="py-3  uppercase font-semibold text-sm">Description</th>
                            <th class="py-3  uppercase font-semibold text-sm">Category</th>
                            <th class="py-3  uppercase font-semibold text-sm">URL/File</th>
                            <th class="py-3  uppercase font-semibold text-sm">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 divide-y divide-gray-200">
                        @foreach ($documentRows as $row)
                        <tr data-id="{{ $row['id'] }}">
                                <td class="py-2 px-1">
                                    <input disabled value="{{ $row['title'] }}"  class="block " type="text" required autofocus />
                                </td>
                                <td class="py-2 px-1">
                                    <textarea disabled  class="block " type="text" required autofocus >{{ $row['description'] }}</textarea>
                                </td>
                                <td class="py-2 px-1">
                                    <input disabled value="{{ $row->category->name }}"  class="block " type="text" required autofocus />
                                </td>
                                <td class="py-2 px-1">
                                    <input disabled value="{{ $row['type'] === 1 ? $row['original_file_name'] : $row['url'] }}" class="block " type="text" />
                                </td>
                                <td class="py-2 px-1 flex justify-start items-center space-x-2">

                                    <td class="py-2 px-1 flex justify-end items-center space-x-2">
                                        @if ($row['type'] === 1)

                                        @php
                                            $file = asset('storage/public/supporting-documents/' . $row['user_id'] . '/' . $row['file_name'])
                                        @endphp
                                        <a href="{{ $file }}" download class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center shadow-md">
                                            <x-svg-download class="w-4 h-4" />
                                        </a>

                                    {{ $file }}
                                    @endif
                                        <button type="button" data-id="{{ $row['id'] }}" class="delete-btn bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center shadow-md">
                                            <x-svg-trashcan class="w-4 h-4" />
                                        </button>
                                    </td>
                                </td>
                            </tr>
                        @endforeach
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
</section>

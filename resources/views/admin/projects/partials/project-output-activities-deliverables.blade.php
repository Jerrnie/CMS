<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Activity
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Deliverable
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($tranch->activities as $activity)
            @foreach ($activity->deliverables as $deliverable)
                <tr class="{{ $loop->parent->iteration % 2 === 0 ? 'bg-gray-50' : 'bg-white' }}">
                    @if ($loop->first)
                        <td class="px-6 py-4 whitespace-nowrap" rowspan="{{ count($activity->deliverables) }}">{{ $activity->title }}</td>
                    @endif
                    <td class="px-6 py-4 whitespace-nowrap">{{ $deliverable->title }}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>

<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                {{-- Header --}}
                <div class="flex justify-between px-4 py-3 bg-gray-100 text-center align-self-center align-items-center sm:px-6">
                    <h2 class="text-lg leading-6 font-medium text-gray-900 text-center align-self-center">Terms of Reference</h2>
                </div>

                @if ($tranches)
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-4 py-2 text-left">Activity</th>
                                <th class="px-4 py-2 text-left">Deliverable</th>
                                <th class="px-4 py-2 text-center">Person Days</th>
                                <th class="px-4 py-2 text-center">Date</th>
                                <th class="px-4 py-2 text-right">Budget</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 border border-gray-300">
                            @php
                                $totalPersonDays = 0;
                                $totalCost = 0;
                                $rowNum = 0;
                            @endphp
                            @foreach ($tranches as $tranch)
                                @php
                                    $tranch_rowspan = 0;
                                    $totalCost += $tranch->budget;
                                    $personDays = \Carbon\Carbon::parse($tranch->date_from)->diffInWeekdays(\Carbon\Carbon::parse($tranch->date_to));
                                    $totalPersonDays += $personDays;
                                    $rowNum++;
                                @endphp
                                <tr class="{{ $rowNum % 2 === 0 ? 'bg-gray-50' : 'bg-white' }}">
                                    <td></td>
                                    <td></td>
                                    <td rowspan="{{ $tranch_rowspan + 1 }}" class="text-center border-r border-gray-200">{{ $personDays }}</td>
                                    <td rowspan="{{ $tranch_rowspan + 1 }}" class="text-center border-r border-gray-200">
                                        {{ \Carbon\Carbon::parse($tranch->date_from)->format('F j, Y') }}
                                        to
                                        {{ \Carbon\Carbon::parse($tranch->date_to)->format('F j, Y') }}
                                    </td>
                                    <td rowspan="{{ $tranch_rowspan + 1 }}" class="pr-4 text-right border-r border-gray-200">{{ $tranch->budget }}</td>
                                </tr>
                                @foreach ($tranch->activities as $activity)
                                    @php
                                        $firstDeliverable = true;
                                    @endphp
                                    @foreach ($activity->deliverables as $deliverable)
                                        <tr class="{{ $rowNum % 2 === 0 ? 'bg-gray-50' : 'bg-white' }}">
                                            @if ($firstDeliverable)
                                                <td rowspan="{{ $activity->deliverables->count() }}" class="pl-4 border-r border-gray-200">{{ $activity->title }}</td>
                                                @php
                                                    $firstDeliverable = false;
                                                @endphp
                                            @endif
                                            <td class="pl-4 border-r border-gray-200">{{ $deliverable->title }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" class="text-right border-r border-gray-200"></td>
                                <td class="text-center border-r border-gray-200 font-semibold">{{ $totalPersonDays }} days</td>
                                <td colspan="1" class="text-right border-r border-gray-200 font-semibold">Total &nbsp;</td>
                                <td colspan="1" class="pr-4 text-right border-r border-gray-200 font-semibold">{{ number_format($totalCost, 2) }} </td>
                            </tr>
                        </tfoot>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>

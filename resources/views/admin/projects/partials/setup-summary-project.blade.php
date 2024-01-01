<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                {{-- header add tranch --}}
                <div class="flex justify-between px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <h2 class="text-lg leading-6 font-medium text-gray-900">Tranch</h2>
                </div>

                @if ($tranches)
                    <table class="min-w-full divide-y divide-gray-200">
                        @include('admin.projects.partials.thead-summary')
                        <tbody class="bg-white divide-y divide-gray-200">


                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>
</div>



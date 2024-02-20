<div class="bg-white shadow overflow-hidden sm:rounded-lg mx-4 my-4 p-4">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            {{ __('Assigned Consultant for this Project') }}
        </h3>
    </div>
    <div class="border-t border-gray-200">
        <dl>
            @if ($consultant)
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Consultant Name
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $consultant->getFullName() }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Consultant Email
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $consultant->email }}
                    </dd>
                </div>
                <div class="px-4 py-5 sm:px-6 flex justify-end">
                    <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        View
                    </a>
                </div>
            @else
                <div class="px-4 py-5 sm:px-6">
                    <x-cards.info title="Info" subtitle="There's no applicants for this project yet." />
                </div>
            @endif
        </dl>
    </div>
</div>

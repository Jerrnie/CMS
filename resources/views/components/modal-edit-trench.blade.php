<div class="inline-block" x-data="{ isOpen: false }">
    <button @click="isOpen = true" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition-colors duration-200">Edit</button>

<form action="{{ route('admin.projects.edit.reference', ['tranch' => $tranch]) }}" method="POST" >
    @csrf
    @method('PUT')
    <div x-show="isOpen" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Add Tranch
                            </h3>
                            <div class="mt-2">
                                <label class="text-xs">Budget</label>
                                <div class="mt-2">
                                    <input type="number" value="{{ $tranch->budget }}" name="budget" placeholder="Budget" class="form-input mt-1 block w-full">
                                </div>
                            </div>
                            <div class="mt-2">
                                <label class="text-xs">From</label>
                                <div class="mt-2">
                                    <input name="date_from" value={{ $tranch->date_from }} type="date" placeholder="Date From" class="form-input mt-1 block w-full">
                                </div>
                            </div>
                            <div class="mt-2">
                                <label class="text-xs">To</label>
                                <div class="mt-2">
                                    <input name="date_to" value={{ $tranch->date_to }} type="date" placeholder="Date To" class="form-input mt-1 block w-full">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Save
                    </button>
                    <button  @click="isOpen = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
</div>

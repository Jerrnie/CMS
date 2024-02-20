<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @foreach ($tranches as $tranch)
            <div class="bg-white px-4 pt-5 sm:p-4 sm:pb-4 shadow sm:rounded-lg">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-center text-3xl leading-6 font-medium text-gray-900 mb-4" id="modal-title">
                            {{ __('Project Tranche '.'# '. ($loop->iteration) ) . $tranches[$loop->index]->description }}
                        </h3>
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                <div class="tab-group max-w-6xl">
                                    <ul class="flex border-b justify-between">
                                        <div class="flex">
                                            <li class="mr-6">
                                                <a href="#actAndDeliverables{{ $loop->index }}" class="tab-button text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-500 pb-2 active">Activities and Deliverables</a>
                                            </li>
                                            <li class="mr-6">
                                                <a href="#outputs{{ $loop->index }}" class="tab-button text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-500 pb-2">Outputs</a>
                                            </li>
                                            <li class="mr-6">
                                                <a href="#trancheStatus{{ $loop->index }}" class="tab-button text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-500 pb-2">Tracklist</a>
                                            </li>
                                        </div>
                                        <div>
                                            <span class="text-green-700">Budget: {{ $tranch->budget }} PHP</span>
                                        </div>
                                    </ul>
                                    <div class="mt-4">

                                        <div id="actAndDeliverables{{ $loop->index }}" class="tab-content">
                                            @include('admin.projects.partials.project-output-activities-deliverables')
                                        </div>

                                        <div x-data="{open{{ $loop->index }}:false}" id="outputs{{ $loop->index }}" class="tab-content hidden">
                                            @include('admin.projects.partials.project-output-list')
                                            <hr class="my-4 border-gray-200">
                                            <div class="flex justify-end">
                                                <div class="mb-2">
                                                    <button @click="open{{ $loop->index }} = true" class="px-5 py-3 rounded-xl text-sm font-medium text-indigo-600 bg-white outline-none focus:outline-none m-1 hover:m-0 focus:m-0 border border-indigo-600 hover:border-4 focus:border-4 hover:border-indigo-800 hover:text-indigo-800 focus:border-purple-200 transition-all">Upload  <i class="fa-solid fa-upload ml-2 text-xl align-middle leading-none"> </i>
                                                    </button>
                                                </div>
                                            </div>
                                                <div x-show="open{{ $loop->index }}" class=" -mt fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                                    <div class="flex items-end justify-center min-h-screen">
                                                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="open{{ $loop->index }} = false" ></div>
                                                        <div class="bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                                            <form method="POST" action="{{ route('opportunities.ongoing.storeOutputs', ['tranch' => $tranch->id]) }}" enctype="multipart/form-data">
                                                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                                <h5 class="modal-title" id="uploadModalLabel">Upload</h5>
                                                                @include('admin.projects.partials.project-output-upload')
                                                            </div>
                                                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                                <button type="button" class="h-full inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-offset-2 transition ease-in-out duration-150" @click="open{{ $loop->index }} = false" >Close</button>
                                                                <x-primary-button class="mr-4">
                                                                    {{ __('Submit') }}
                                                                </x-primary-button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>

                                        <div id="trancheStatus{{ $loop->index }}" class="tab-content hidden">
                                            @include('admin.projects.partials.project-output-tracklist')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script>
    function modal() {
        return {
            open: false
        }
    }
</script>


<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const tabGroups = Array.prototype.slice.call(document.querySelectorAll('.tab-group'));

        tabGroups.forEach(group => {
            const tabs = Array.prototype.slice.call(group.querySelectorAll('.tab-button'));
            const contents = Array.prototype.slice.call(group.querySelectorAll('.tab-content'));

            tabs.forEach(tab => {
                tab.addEventListener('click', (event) => {
                    event.preventDefault();

                    // Remove active classes
                    tabs.forEach(t => t.classList.remove('active'));
                    contents.forEach(c => c.classList.add('hidden'));

                    // Add active class to clicked tab and corresponding content
                    tab.classList.add('active');
                    const content = group.querySelector(tab.getAttribute('href'));
                    content.classList.remove('hidden');
                });
            });
        });
    });
</script>
<style>
    .tab-button.active {
        color: #4a5568; /* Text color corresponding to text-gray-700 */
        border-color: #718096; /* Border color corresponding to border-gray-500 */
    }
</style>

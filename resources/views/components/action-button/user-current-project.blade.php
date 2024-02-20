<div>
    <div class="grid grid-cols-3 gap-5 mb-4">
        <div>
            <a  href="{{ route('opportunities.ongoing.show', ['opportunity' => $project->id]) }}" class="{{ Route::is('opportunities.ongoing.show') ? 'p-4 rounded bg-indigo-500 text-white shadow-md flex items-center justify-center w-full' : 'p-4 rounded bg-white text-indigo-500 shadow-md flex items-center justify-center w-full' }}">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 mr-2"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                />
              </svg>
                Project Details
            </a>

        </div>
        {{-- <div>
            <button class="{{ Route::is('opportunities.ongoing.chats') ? 'p-4 rounded bg-indigo-500 text-white shadow-md flex items-center justify-center w-full' : 'p-4 rounded bg-white text-indigo-500 shadow-md flex items-center justify-center w-full' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                </svg>
                Chats
            </button>
        </div> --}}
        <div>
            <a href="{{ route('opportunities.ongoing.outputs', ['opportunity' => $project->id]) }}" class="{{ Route::is('opportunities.ongoing.outputs') ? 'p-4 rounded bg-indigo-500 text-white shadow-md flex items-center justify-center w-full' : 'p-4 rounded bg-white text-indigo-500 shadow-md flex items-center justify-center w-full' }}">
                <!-- SVG for Outputs (Checkmark) -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Outputs
            </a>
        </div>
    </div>
</div>

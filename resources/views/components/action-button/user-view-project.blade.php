<div>
    <div class="grid grid-cols-3 gap-5 mb-4">
        {{-- $hasApplied --}}
        <div>

            {{--
            $project->consultantStatus
            # 1 = no consultant assigned
            # 2 = consultant assigned but not the user
            # 3 = consultant assigned and the user --}}


            @if ($project->consultantStatus == 1 || $project->consultantStatus == 4)
                @if($project->hasApplied)
                    <form method="POST" action="{{ route('opportunities.unapply', $project->id) }}" class="flex">
                        @csrf
                        @method('POST')
                        <button class="p-4 rounded bg-red-500 text-white shadow-md flex items-center justify-center w-full transform transition duration-500 ease-in-out hover:bg-red-700 hover:scale-105">
                            Unapply
                        </button>
                    </form>
                @else
                    <form method="POST" action="{{ route('opportunities.apply', $project->id) }}" class="flex">
                        @csrf
                        <button class="p-4 rounded bg-white text-indigo-500 shadow-md flex items-center justify-center transform transition duration-500 ease-in-out hover:bg-indigo-500 hover:text-white hover:scale-105 w-full">
                            Apply For This Project
                        </button>
                    </form>
                @endif
            @elseif ($project->consultantStatus == 2)
                <button class="p-4 rounded bg-gray-500  text-white shadow-md flex items-center justify-center w-full cursor-not-allowed" disabled>
                    (Someone is already assigned)
                </button>
            @elseif ($project->consultantStatus == 3)
                <button class="p-4 rounded bg-gray-500 text-white shadow-md flex items-center justify-center w-full cursor-not-allowed" disabled>
                    (You have been hired for this project)
                </button>
            @endif



        </div>

        {{-- $isBookmarked --}}
        <div>
            @if(true)
                <button class="p-4 rounded bg-green-500 text-white shadow-md flex items-center justify-center transform transition duration-500 ease-in-out hover:bg-green-700 hover:scale-105 w-full">
                    Bookmarked
                </button>
            @else
                <button class="p-4 rounded bg-white text-green-500 shadow-md flex items-center justify-center transform transition duration-500 ease-in-out hover:bg-green-500 hover:text-white hover:scale-105 w-full">
                    Add to Bookmark
                </button>
            @endif
        </div>

        @if ($project->consultantStatus == 3)
        <div>
            {{-- if ($project->consultantStatus == 3) --}}
                <a href="#" class="p-4 rounded bg-white text-indigo-500 shadow-md flex items-center justify-center transform transition duration-500 ease-in-out hover:bg-indigo-500 hover:text-white hover:scale-105 w-full">
                    View in my Project / Output
                </a>
        </div>
        @endif

        {{-- Outputs button --}}
        <div>
            {{-- Uncomment the button when needed --}}
            {{-- <button class="p-4 rounded bg-white text-indigo-500 shadow-md flex items-center justify-center w-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                </svg>
                Outputs
            </button> --}}
        </div>
    </div>
</div>

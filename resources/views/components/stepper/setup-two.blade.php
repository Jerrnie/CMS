<div class="pb-10 px-20">
    <h2 class="sr-only">Steps</h2>

    <div class="after:mt-4 after:block after:h-1 after:w-full after:rounded-lg after:bg-blue-300">
      <ol class="grid grid-cols-3 text-sm font-medium text-gray-500">

        {{-- detail --}}
        <li class="relative flex justify-start text-gray-600">
            <span class="absolute -bottom-[1.75rem] start-0 rounded-full bg-gray-600 text-white">
                <x-svg.step-unchecked/>
            </span>
            <a href="{{ route('admin.projects.setup', ['project' => $project->id]) }}" class="hidden sm:block"> Details </a>
            <a href="{{ route('admin.projects.setup', ['project' => $project->id]) }}">
            <x-svg.step-detail/>
        </a>
        </li>


        {{-- Terms of Reference --}}
        <li class="relative flex justify-center text-blue-600">
          <span class="absolute -bottom-[1.75rem] left-1/2 -translate-x-1/2 rounded-full bg-blue-600 text-white">
            <x-svg.step-unchecked/>
          </span>
          <a href="{{ route('admin.projects.setup.reference', ['project' => $project->id]) }}" class="hidden sm:block"> Terms of Reference </a>
          <a href="{{ route('admin.projects.setup.reference', ['project' => $project->id]) }}">
            <x-svg.step-address/>
        </a>

        </li>

        <li class="relative flex justify-end">
          <span class="absolute -bottom-[1.75rem] end-0 rounded-full bg-gray-600 text-white">
            <x-svg.step-unchecked/>
          </span>
          <span class="hidden sm:block"> Summary </span>
        <x-svg.step-payment/>
        </li>



      </ol>
    </div>
  </div>

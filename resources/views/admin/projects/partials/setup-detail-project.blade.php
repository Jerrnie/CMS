<section>

    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Project details') }}
        </h2>
    </header>

    <form method="post" action="{{ route('admin.projects.update', ['project' => $project]) }}" class="mt-6 space-y-6">
    {{-- <form method="post" action="#" class="mt-6 space-y-6"> --}}

        @csrf
        @method('put')

        <!-- Title -->
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input value="{{ $project->title }}" id="title" class="block mt-1 w-full" type="text" name="title" required autofocus />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- Description -->
        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-textarea-input value="{{ $project->description }}"  id="description" class="block mt-1 w-full" name="description" required></x-textarea-input>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <!-- Expertise and Expertise Detail -->
        <div class="flex justify-between">
            <div class="w-1/2 pr-2">
                <x-input-label for="expertise" :value="__('Expertise')" />
                <select name="expertise_field_id" class="block w-full mt-1 custom-input-style" required>
                    <option value="">-- Select Field --</option>
                    @foreach ($expertiseFields as $id => $name)
                    <option :value="{{ $id }}"
                    @if ($project->expertise_field_id == $id)
                        selected
                    @endif
                    >{{ $name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('expertise_field_id')" class="mt-2" />
            </div>

            <div class="w-1/2 pl-2">
                <x-input-label for="expertise_detail" :value="__('Expertise Detail')" />
                <x-text-input value="{{ $project->expertise_detail }}" id="expertise_detail" class="block mt-1 w-full" type="text" name="expertise_detail" required />
                <x-input-error :messages="$errors->get('expertise_detail')" class="mt-2" />
            </div>
        </div>
        <!-- Unit -->
        <div>
            <x-input-label for="unit" :value="__('Unit')" />
            <select name="unit_id" class="block w-full mt-1 custom-input-style" required>
                <option value="">-- Select Unit --</option>
                @foreach ($units as $id => $name)
                <option :value="{{ $id }}"
                @if ($project->unit_id == $id)
                    selected
                @endif
                >{{ $name }}

            </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('unit_id')" class="mt-2" />
        </div>

        {{-- BUDGET CODE --}}
        <div>
            <x-input-label for="budget_code" :value="__('Budget Code')" />
            <select name="budgetcode_id" class="block w-full custom-input-style" required>
                <option value="">-- Select Budget Code --</option>
                @foreach ($budgetCodes as $budgetCode)
                <option value="{{ $budgetCode->id }}"
                    @if ($project->budgetcode_id == $budgetCode->id)
                        selected

                    @endif
                    >{{ $budgetCode->unit_activity }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('budgetcode_id')" class="mt-2" />
        </div>

        <!-- Save Button -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Update') }}</x-primary-button>
            <a href="{{ route('admin.projects.setup.reference', ['project' => $project->id]) }}"
                class="ml-auto inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Next') }}</a>

            @if ($errors->has('unit_id'))
            <script>
                Swal.fire({
                    icon: 'error',
                    position: "top-end",
                    title: "{{ $errors->first('unit_id') }}",
                    showConfirmButton: false,
                    timer: 2500
                });
            </script>
            @endif

            @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    position: "top-end",
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2500
                });
            </script>
            @endif
        </div>
    </form>


</section>

<section>

    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Project details') }}
        </h2>
    </header>

    <form method="post" action="{{ route('profile-basic-info.update') }}" class="mt-6 space-y-6">
    {{-- <form method="post" action="#" class="mt-6 space-y-6"> --}}

        @csrf
        @method('patch')

        <!-- Title -->
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" required autofocus />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- Description -->
        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-textarea-input id="description" class="block mt-1 w-full" name="description" required></x-textarea-input>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <!-- Expertise and Expertise Detail -->
        <div class="flex justify-between">
            <div class="w-1/2 pr-2">
                <x-input-label for="expertise" :value="__('Expertise')" />
                <select class="block w-full" required>
                    <option value="0">-- Select Field --</option>
                    @foreach ($expertiseFields as $id => $name)
                    <option :value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('expertise')" class="mt-2" />
            </div>

            <div class="w-1/2 pl-2">
                <x-input-label for="expertise_detail" :value="__('Expertise Detail')" />
                <x-text-input id="expertise_detail" class="block mt-1 w-full" type="text" name="expertise_detail" required />
                <x-input-error :messages="$errors->get('expertise_detail')" class="mt-2" />
            </div>
        </div>
        <!-- Unit -->
        <div>
            <x-input-label for="unit" :value="__('Unit')" />
            <select  class="block w-full" required>
                <option value="0">-- Select Unit --</option>
                @foreach ($units as $id => $name)
                <option :value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('unit')" class="mt-2" />
        </div>

        <!-- Save Button -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Next') }}</x-primary-button>

            @if (session('status') === 'basicInfo-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600"
                >{{ __('Saved.') }}</p>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Basic Information Updated',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
            @endif
        </div>
    </form>


</section>

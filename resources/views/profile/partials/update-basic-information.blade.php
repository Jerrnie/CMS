<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Basic Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your basic information") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile-basic-info.update') }}" class="mt-6 space-y-6">
    {{-- <form method="post" action="#" class="mt-6 space-y-6"> --}}

        @csrf
        @method('patch')

        <!-- Date of Birth -->
        <div>
            <x-input-label for="dob" :value="__('Date of Birth')" />
            <x-text-input id="dob" class="block mt-1 w-full" type="date" name="dob" :value="old('dob', optional($user->basicInformation)->dob)" required autofocus />
            <x-input-error :messages="$errors->get('dob')" class="mt-2" />
        </div>


<!-- Sex -->
<div class="mt-4">
    <x-input-label for="sex" :value="__('Sex')" />
    <x-select-input id="sex" class="block mt-1 w-full" name="sex" :options="$sexOptions" :selected="old('sex', optional($user->basicInformation)->sex)" required />
    <x-input-error :messages="$errors->get('sex')" class="mt-2" />
</div>

<!-- Country -->
<div class="mt-4">
    <x-input-label for="country" :value="__('Country')" />
    <select id="country" class="block mt-1 w-full" name="country" required autofocus>
        <option value="">Select Country</option>
    </select>
    <x-input-error :messages="$errors->get('country')" class="mt-2" />
</div>

<!-- Citizenship -->
<div class="mt-4">
    <x-input-label for="citizenship" :value="__('Citizenship')" />
    <select id="citizenship" class="block mt-1 w-full" name="citizenship" required autofocus>
        <option value="">Select Citizenship</option>
    </select>
    <x-input-error :messages="$errors->get('citizenship')" class="mt-2" />
</div>

<!-- Government ID Type -->
<div class="mt-4">
    <x-input-label for="gov_id_type" :value="__('Gov ID Type')" />
    <x-select-input id="gov_id_type" class="block mt-1 w-full" name="gov_id_type" :options="$idTypeOptions" :selected="old('gov_id_type', optional($user->basicInformation)->gov_id_type)" required />
    <x-input-error :messages="$errors->get('gov_id_type')" class="mt-2" />
</div>

<!-- Government ID Number -->
<div class="mt-4">
    <x-input-label for="gov_id_number" :value="__('Gov ID No. (e.g., passport, national ID, etc.)')" />
    <x-text-input id="gov_id_number" class="block mt-1 w-full" type="text" name="gov_id_number" :value="old('gov_id_number', optional($user->basicInformation)->gov_id_number)" required autofocus />
    <x-input-error :messages="$errors->get('gov_id_number')" class="mt-2" />
</div>


        <!-- Save Button -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

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

    <script>
        // Function to fetch and populate dropdown
        async function populateDropdown() {
    const countriesSelect = document.getElementById('country');
    const citizenshipSelect = document.getElementById('citizenship');

    let previousCountry = '{{ $user->basicInformation->country ?? '' }}';
    let previousCitizenship = '{{ $user->basicInformation->citizenship ?? '' }}';

    try {
        const response = await fetch('https://restcountries.com/v3.1/all');
        const countriesData = await response.json();

        // Sort countries alphabetically by name
        countriesData.sort((a, b) => {
            if (a.name.common < b.name.common) return -1;
            if (a.name.common > b.name.common) return 1;
            return 0;
        });

        // Populate Country dropdown
        countriesData.forEach(country => {
            const option = document.createElement('option');
            option.value = country.name.common;
            option.textContent = country.name.common;
            if (country.name.common === previousCountry) {
                option.selected = true;
            }
            countriesSelect.appendChild(option);
        });

        // Populate Citizenship dropdown
        countriesData.forEach(country => {
            const option = document.createElement('option');
            option.value = country.name.common;
            option.textContent = country.name.common;
            if (country.name.common === previousCitizenship) {
                option.selected = true;
            }
            citizenshipSelect.appendChild(option);
        });
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}


// Call the function to populate dropdowns when the page loads
populateDropdown();

    </script>

</section>

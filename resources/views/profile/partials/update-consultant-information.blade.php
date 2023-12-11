<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Consultant Information
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Update your consultant information
        </p>
    </header>

    <form method="post" action="{{ route('profile-consultant-info.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

<!-- Years of Work/Consulting Experience -->
<div class="mt-4">
    <x-input-label class="required" for="years_experience" :value="__('Years of work and/or consulting experience')" />
    <x-text-input id="years_experience" class="block mt-1 w-full" type="number" name="years_experience" :value="old('years_experience', optional($user->consultantInformation)->years_experience)" required autofocus />
    <x-input-error :messages="$errors->get('years_experience')" class="mt-2" />
</div>

<!-- Consulting Category -->
<div class="mt-4">
    <x-input-label class="required" for="consulting_category" :value="__('Consulting Category')" />
    <x-select-input id="consulting_category" class="block mt-1 w-full" name="consulting_category" :options="$consultingCategoryOptions" :selected="old('consulting_category', optional($user->consultantInformation)->consulting_category)" required />
    <x-input-error :messages="$errors->get('consulting_category')" class="mt-2" />
</div>

<div class="mt-4 border p-2" x-data="{ showRelativeName: {{ $user->consultantInformation && $user->consultantInformation->relatives_at_zff === 'yes' ? 'true' : 'false' }} }">
<!-- Relatives working at ZFF -->
<x-input-label class="required" for="relatives_at_zff" :value="__('Do you have any close relatives working at ZFF?')" />
<div class="mt-2 space-x-4">
    <input type="radio" id="relatives_yes" name="relatives_at_zff" value="yes" @click="showRelativeName = true" {{ $user->consultantInformation && $user->consultantInformation->relatives_at_zff === 'yes' ? 'checked' : '' }} required>
    <label for="relatives_yes">Yes</label>
    <input type="radio" id="relatives_no" name="relatives_at_zff" value="no" @click="showRelativeName = false" {{ !$user->consultantInformation || $user->consultantInformation->relatives_at_zff === 'no' ? 'checked' : '' }} required>
    <label for="relatives_no">No</label>
</div>


    <!-- Name of ZFF Staff Relative -->
    <div class="mt-4" x-show="showRelativeName">
        <div class="border-b pb-4">
            <x-input-label class="required" for="zff_staff_relative_name" :value="__('If yes, please enter the full name of the close relative working at ZFF.')" />
            <x-text-input id="zff_staff_relative_name" class="block mt-1 w-full" type="text" name="zff_staff_relative_name" :value="old('zff_staff_relative_name', optional($user->consultantInformation)->zff_staff_relative_name)" x-bind:required="showRelativeName" autofocus />
            <x-input-error :messages="$errors->get('zff_staff_relative_name')" class="mt-2" />
        </div>
    </div>
</div>

<div class="mt-4 border p-2" x-data="{ showZFFPartner: {{ $user->consultantInformation && $user->consultantInformation->zff_staff_partner > 0 ? 'true' : 'false' }} }">
    <!-- ZFF Staff Spouse or Registered Domestic Partner -->
    <x-input-label class="required" for="zff_staff_partner" :value="__('Are you an ZFF Staff Spouse or Registered Domestic Partner?')" />
    <div class="mt-2 space-x-4">
        <input type="radio" id="not_applicable" name="zff_staff_partner" value="0" @click="showZFFPartner = false" {{ !$user->consultantInformation || $user->consultantInformation->zff_staff_partner === '0' ? 'checked' : '' }} required>
        <label for="not_applicable">Not Applicable</label>
        <input type="radio" id="staff_spouse" name="zff_staff_partner" value="1" @click="showZFFPartner = true" {{ $user->consultantInformation && $user->consultantInformation->zff_staff_partner === '1' ? 'checked' : '' }} required>
        <label for="staff_spouse">ZFF Staff Spouse</label>
        <input type="radio" id="registered_partner" name="zff_staff_partner" value="2" @click="showZFFPartner = true" {{ $user->consultantInformation && $user->consultantInformation->zff_staff_partner === '2' ? 'checked' : '' }} required>
        <label for="registered_partner">ZFF Registered Domestic Partner</label>
    </div>


    <!-- Details of ZFF Staff Partner -->
    <div class="mt-4" x-show="showZFFPartner">
        <div class=" pb-4">
            <x-input-label class="required" for="partner_name" :value="__('Name of ZFF Staff Partner')" />
            <x-text-input id="partner_name" class="block mt-1 w-full" type="text" name="partner_name" :value="old('partner_name', optional($user->consultantInformation)->partner_name)" x-bind:required="showZFFPartner" autofocus />
            <x-input-error :messages="$errors->get('partner_name')" class="mt-2" />
        </div>

        <div class=" pb-4 mt-4">
            <x-input-label class="required" for="partner_position_title" :value="__('Position Title of ZFF Staff Partner')" />
            <x-text-input id="partner_position_title" class="block mt-1 w-full" type="text" name="partner_position_title" :value="old('partner_position_title', optional($user->consultantInformation)->partner_position_title)" x-bind:required="showZFFPartner" />
            <x-input-error :messages="$errors->get('partner_position_title')" class="mt-2" />
        </div>

        <div class=" pb-4 mt-4">
            <x-input-label class="required" for="partner_employee_number" :value="__('Employee Number of ZFF Staff Partner')" />
            <x-text-input id="partner_employee_number" class="block mt-1 w-full" type="text" name="partner_employee_number" :value="old('partner_employee_number', optional($user->consultantInformation)->partner_employee_number)" x-bind:required="showZFFPartner" />
            <x-input-error :messages="$errors->get('partner_employee_number')" class="mt-2" />
        </div>
    </div>
</div>


<div class="mt-4 border p-2" x-data="{ showZFFStaff: {{ $user->consultantInformation && $user->consultantInformation->zff_staff === 'yes' ? 'true' : 'false' }}, directorOrAbove: false }">
    <!-- Have you ever been an ZFF staff? -->
    <x-input-label class="required" for="zff_staff" :value="__('Have you ever been an ZFF staff?')" />
    <div class="mt-2 space-x-4">
        <input type="radio" id="yes_zff_staff" name="zff_staff" value="yes" @click="showZFFStaff = true" {{ $user->consultantInformation && $user->consultantInformation->zff_staff === 'yes' ? 'checked' : '' }} required>
        <label for="yes_zff_staff">Yes</label>
        <input type="radio" id="no_zff_staff" name="zff_staff" value="no" @click="showZFFStaff = false" {{ $user->consultantInformation && $user->consultantInformation->zff_staff === 'no' ? 'checked' : '' }} required>
        <label for="no_zff_staff">No</label>
    </div>

    <!-- Details for ZFF Staff -->
    <div class="mt-4" x-show="showZFFStaff">
        <div class=" pb-4">
            <x-input-label class="required" for="position_title" :value="__('Position Title')" />
            <x-text-input id="position_title" class="block mt-1 w-full" type="text" name="position_title" :value="old('position_title', optional($user->consultantInformation)->position_title)" x-bind:required="showZFFStaff" autofocus />
            <x-input-error :messages="$errors->get('position_title')" class="mt-2" />
        </div>

        <div class=" pb-4 mt-4">
            <x-input-label class="required" for="employee_number" :value="__('Employee Number')" />
            <x-text-input id="employee_number" class="block mt-1 w-full" type="text" name="employee_number" :value="old('employee_number', optional($user->consultantInformation)->employee_number)" x-bind:required="showZFFStaff" />
            <x-input-error :messages="$errors->get('employee_number')" class="mt-2" />
        </div>

        <div class=" pb-4 mt-4">
            <x-input-label class="required" for="employment_end_date" :value="__('Employment End Date')" />
            <x-text-input id="employment_end_date" class="block mt-1 w-full" type="date" name="employment_end_date" :value="old('employment_end_date', optional($user->consultantInformation)->employment_end_date)" x-bind:required="showZFFStaff" />
            <x-input-error :messages="$errors->get('employment_end_date')" class="mt-2" />
        </div>

        <div class=" pb-4 mt-4">
            <!-- Was your last position with ZFF, Director Level or above? -->
            <x-input-label class="required" for="director_or_above" :value="__('Was your last position with ZFF, Director Level or above?')" />
            <div class="mt-2 space-x-4">
                <input type="radio" id="yes_director_above" name="director_or_above" value="yes" @click="directorOrAbove = true" {{ optional($user->consultantInformation)->director_or_above ? 'checked' : '' }} required>
                <label for="yes_director_above">Yes</label>
                <input type="radio" id="no_director_above" name="director_or_above" value="no" @click="directorOrAbove = false" {{ !$user->consultantInformation || !$user->consultantInformation->director_or_above ? 'checked' : '' }} required>
                <label for="no_director_above">No</label>
            </div>
        </div>
    </div>
</div>


<div class="mt-4 border p-2" x-data="{ showGovernmentEmployee: {{ $user->consultantInformation && $user->consultantInformation->government_employee === 'yes' ? 'true' : 'false' }} }">
    <!-- Have you been or are you currently a government employee? -->
    <x-input-label class="required" for="government_employee" :value="__('Have you been or are you currently a government employee?')" />
    <div class="mt-2 space-x-4">
        <input type="radio" id="yes_government_employee" name="government_employee" value="yes" @click="showGovernmentEmployee = true" {{ $user->consultantInformation && $user->consultantInformation->government_employee === 'yes' ? 'checked' : '' }} required>
        <label for="yes_government_employee">Yes</label>
        <input type="radio" id="no_government_employee" name="government_employee" value="no" @click="showGovernmentEmployee = false" {{ !$user->consultantInformation || $user->consultantInformation->government_employee === 'no' ? 'checked' : '' }} required>
        <label for="no_government_employee">No</label>
    </div>

    <!-- Details for Government Employee -->
    <div class="mt-4" x-show="showGovernmentEmployee">
        <div class=" pb-4">
            <x-input-label class="required" for="agency_name" :value="__('Government Agency Name')" />
            <x-text-input id="agency_name" class="block mt-1 w-full" type="text" name="agency_name" :value="old('agency_name', optional($user->consultantInformation)->agency_name)" x-bind:required="showGovernmentEmployee" autofocus />
            <x-input-error :messages="$errors->get('agency_name')" class="mt-2" />
            <!-- Add error handling if needed -->
        </div>

        <div class=" pb-4 mt-4">
            <x-input-label class="required" for="country" :value="__('Country')" />
            <x-text-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country', optional($user->consultantInformation)->country)" x-bind:required="showGovernmentEmployee" />
            <x-input-error :messages="$errors->get('country')" class="mt-2" />
        </div>

        <div class=" pb-4 mt-4">
            <x-input-label class="required" for="gov_employment_end_date" :value="__('Employment End Date')" />

            <x-text-input id="gov_employment_end_date" class="block mt-1 w-full" type="date" name="gov_employment_end_date" :value="old('gov_employment_end_date', optional($user->consultantInformation)->gov_employment_end_date)" x-bind:required="showGovernmentEmployee" />


            <x-input-error :messages="$errors->get('gov_employment_end_date')" class="mt-2" />
        </div>
    </div>
</div>


<div class="p-2">
    <x-input-label class="required" for="consulting_assignment_at_zff" :value="__('Have you ever participated in a consulting assignment with ZFF?')" />
    <div class="mt-2 space-x-4">
        <input type="radio" id="consulting_assignment_zff_yes" name="consulting_assignment_at_zff" value="yes" @click="showConsultingAssignment = true" {{ $user->consultantInformation && $user->consultantInformation->consulting_assignment_at_zff === 'yes' ? 'checked' : '' }} required>
        <label for="consulting_assignment_zff_yes">Yes</label>
        <input type="radio" id="consulting_assignment_zff_no" name="consulting_assignment_at_zff" value="no" @click="showConsultingAssignment = false" {{ $user->consultantInformation && $user->consultantInformation->consulting_assignment_at_zff === 'no' ? 'checked' : '' }} required>
        <label for="consulting_assignment_zff_no">No</label>
    </div>
</div>
<div class="p-2 border" x-data="{ showDetails: {{ $user->consultantInformation && $user->consultantInformation->found_guilty === 'yes' ? 'true' : 'false' }}, guiltyDetails: '{{ $user->consultantInformation ? $user->consultantInformation->guiltyDetails : '' }}' }">
    <!-- Found guilty or convicted -->
    <label class="block">
        <span class="required">Have you been found guilty or convicted of a violation of law that is not a minor traffic violation?</span>
        <div class="mt-2 space-x-4">
            <input type="radio" id="found_guilty_yes" name="found_guilty" value="yes" @click="showDetails = true" {{ $user->consultantInformation && $user->consultantInformation->found_guilty === 'yes' ? 'checked' : '' }} required>
            <label for="found_guilty_yes">Yes</label>
            <input type="radio" id="found_guilty_no" name="found_guilty" value="no" @click="showDetails = false" {{ $user->consultantInformation && $user->consultantInformation->found_guilty === 'no' ? 'checked' : '' }} required>
            <label for="found_guilty_no">No</label>
        </div>
    </label>

    <!-- Details if 'Yes' is selected -->
    <div x-show="showDetails" class="mt-4">
        <x-input-label class="required" for="guiltyDetails" :value="__('Please enter details:')" />
        <x-text-input id="guiltyDetails" class="block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" type="text" name="guiltyDetails" x-model="guiltyDetails" x-bind:required="showDetails" autofocus />
        <x-input-error :messages="$errors->get('guiltyDetails')" class="mt-2" />
    </div>
</div>


        <!-- Save Button -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'consultantInfo-updated')
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
                        title: 'Consultant Information Updated',
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>
            @endif
        </div>
    </form>
</section>


<script>
    window.addEventListener('DOMContentLoaded', function () {
        window.Alpine.data('yourComponentName', () => ({
            relatives_at_zff: null, // Initialize with the appropriate default value

            toggleRelativeSection(value) {
                this.relatives_at_zff = value;
            }
        }));
    });

//     // Get the value of the date input field
// const employmentEndDateInput = document.getElementById('employment_end_date');
// const employmentEndDateValue = employmentEndDateInput.value;

// // Check if a date is entered and format it
// if (employmentEndDateValue) {
//     // Create a Date object from the input value
//     const date = new Date(employmentEndDateValue);

//     // Format the date to YYYY-MM-DD (or any other desired format)
//     const formattedDate = date.toISOString().split('T')[0];

//     // Set the formatted date back to the input field
//     employmentEndDateInput.value = formattedDate;
// }

</script>


<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Fields of Specialization') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Provide at least one expertise.") }}
        </p>
    </header>

    <form x-data="expertiseList()" x-ref="expertiseForm" @submit.prevent="validateForm" method="post" action="{{ route('profile-basic-info.update') }}" class="mt-6 space-y-6">
            {{-- <form method="post" action="#" class="mt-6 space-y-6"> --}}
    <div role="alert" x-show="formData.errors.length > 0">
        <div class="bg-orange-500 text-white font-bold rounded-t px-4 py-2">
          Warning
        </div>
        <div class="border border-t-0 border-orange-400 rounded-b bg-orange-100 px-4 py-3 text-red-700">
          <template x-for="(error, index) in formData.errors" :key="index">
            <p x-text="error"></p>
        </template>
        </div>
    </div>

        @csrf
        @method('patch')

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg overflow-hidden" x-ref="expertiseTable">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="py-3 px-4 uppercase font-semibold text-sm">Field</th>
                            <th class="py-3 px-4 uppercase font-semibold text-sm">Expertise</th>
                            <th class="py-3 px-4 uppercase font-semibold text-sm">Experience (Months)</th>
                            <th class="py-3 px-4 uppercase font-semibold text-sm">Primary</th>
                            <th class="py-3 px-4 uppercase font-semibold text-sm">Delete</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <template x-for="(row, index) in formData.rows" :key="index">
                            <tr class="border-b border-purple-400">
                                <td class="py-3 px-4">
                                    <select x-model="row.expertise_field_id" class="block w-full" required>
                                        <option value="0">-- Select Field --</option>
                                        @foreach ($expertiseFields as $id => $name)
                                        <option :value="{{ $id }}" x-bind:selected="row.expertise_field_id == {{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="py-3 px-4">
                                    <input x-model="row.detail" class="block w-full" type="text" required autofocus />
                                </td>
                                <td class="py-3 px-4">
                                    <input x-model="row.years_of_experience" class="block w-full" type="number" required autofocus />
                                </td>
                                <td class="py-3 px-4 text-center self-center">
                                    <input x-model="row.is_primary" x-bind:checked="row.is_primary" type="checkbox" class="align-self-center"/>
                                </td>
                                <td class="py-3 px-4">
                                    <button @click="formData.rows.splice(index, 1)" type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center shadow-md">
                                        <x-svg-trashcan/>
                                    </button>
                                </td>

                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>


            <div class="flex justify-between items-center gap-4">
                <button @click="submitExpertise()" class="custom-btn">Save</button>

                @if (session('status') === 'expertise-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 4000)"
                        class="text-sm text-green-600"
                    >{{ __('Saved.') }}</p>
                @endif

                <div class="mt-4">
                    <button @click="addRow()" type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add More Expertise</button>
                </div>
            </div>



        <script>
            function expertiseList() {
                return {
                    formData: {
                errors: [],
                rows: @json($expertiseRows ?? []),
                },
                addRow() {
                    this.formData.rows.push({ expertise_field_id: 0, detail: '', years_of_experience: 0, is_primary: false });
                },
                init() {
                    if (this.formData.rows.length === 0) {
                        this.addRow();
                    }
                },

                    validateForm() {
                        this.formData.errors = [];
                        let primaryCount = 0;

                        this.formData.rows.forEach((row, index) => {
                            if (row.expertise_field_id === 0 || !row.detail || !row.years_of_experience) {
                                this.formData.errors.push(`Row ${index + 1}: Please fill in all required fields.`);
                            }

                            if (row.years_of_experience < 1) {
                                this.formData.errors.push(`Row ${index + 1}: Months of experience must be greater than one.`);
                            }

                            if (row.years_of_experience > 600) {
                                this.formData.errors.push(`Row ${index + 1}: Months of experience must be less than 600.`);
                            }

                            if (row.is_primary) {
                                primaryCount++;
                            }
                        });

                        if (primaryCount > 1) {
                            this.formData.errors.push('Only one expertise can be marked as primary.');
                        }

                        if (this.formData.rows.length < 1) {
                            this.formData.errors.push(`Please add at least one expertise.`);
                        }

                        return this.formData.errors.length === 0;
                    },

                    submitExpertise() {
                if (this.validateForm()) {
                    console.log(this.formData.rows);
                    fetch('/profile-expertise-info', {
                        method: 'PATCH',
                        data: JSON.stringify(this.formData.rows),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(this.formData.rows)
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data.message); // Log response
                        console.log(data.asd); // Log response
                        // Optionally, handle success message or UI updates here
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Handle error scenarios here
                    });
                }
            },
        };
    }
</script>

    </form>




</section>

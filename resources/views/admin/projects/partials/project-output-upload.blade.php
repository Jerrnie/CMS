<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Add Attachment') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Attach file to see your output of your requestor") }}
        </p>
    </header>


        @csrf

        <div class="mt-4">
            <x-input-label class="required" for="title" :value="__('Title')" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" required autofocus />
        </div>

        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <x-textarea-input id="description" class="block mt-1 w-full" name="description" rows="3"></x-textarea-input>
        </div>

        <h2 class="mt-4">Define Attachment</h2>
        <ul class="mt-2 text-sm text-gray-600">
            <li>
                Only files with the following extensions can be attached:
                <strong>.doc, .docx, .gif, .jpeg, .jpg, .pdf, .ppt, .pptx, .rtf, .xls, .xlsx, .zip, .zipx.</strong>
            </li>
            <li>
                Limit the size of each attachment to <strong>10 MB</strong>.
            </li>
            <li>
                Limit the total size of all attachments to <strong>10 MB</strong>.
            </li>
            <li>
                You may use a file compression utility software such as WinZip to comply with the attachment restrictions.
            </li>
        </ul>

        <div x-data="{ type: '1' }">
            <div class="mt-4">
                <x-input-label class="required" for="type" :value="__('Type')" />
                <div class="mt-1">
                    <input type="radio" checked id="file" name="type" value="1" x-model="type">
                    <label for="file">{{ __('File') }}</label><br>
                    <input type="radio" id="url" name="type" value="2" x-model="type">
                    <label for="url">{{ __('URL') }}</label>
                </div>
            </div>

            <div class="mt-4" x-show="type === '1'">
                <x-input-label class="required" for="attachment" :value="__('Attachment')" />
                <x-file-input id="attachment" class="block mt-1 w-full" name="attachment"  x-bind:required="type ==='1'" />
            </div>

            <div class="mt-4" x-show="type === '2'">
                <x-input-label for="url" :value="__('URL')" />
                <x-text-input id="url" class="block mt-1 w-full" type="url" name="url" x-bind:required="type ==='2'" />
            </div>

            <hr>

            <div class="mt-4">


                @if (session('status') === 'supporting-document-uploaded')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-green-600"
                    >
                        {{ __('Saved.') }}
                    </p>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: '{{ session('updateSuccess') }}',
                            text: 'Added Successfully',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>
                @endif
            </div>
        </div>
    </form>
</section>

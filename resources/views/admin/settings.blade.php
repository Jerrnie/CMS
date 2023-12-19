<x-admin-layout>

    <x-slot name="headerName">
        {{ __('Settings') }}
    </x-slot>

    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home Page') }}
        </h2>
    </x-slot> --}}

    <h3 class="text-gray-700 text-3xl font-semibold">Settings</h3>



    <div class="mt-8">
        <h4 class="text-gray-600">Banners & Logo</h4>

        <div class="mt-4">
            <div class="p-6 bg-white rounded-md shadow-md max-w-lg w-full">
                <div class="" x-data="Setting()">
                    {{-- <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data"> --}}
                        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="flex justify-between sm:justify-normal sm:flex-row border-b py-2 my-auto">
                            <x-input-label class="sm:w-1/4 my-auto" for="logo" :value="__('Site Logo')" />
                            <x-text-input @change="onLogoChange()" id="logo" class=" mt-1 w-full sm:w-3/4 hidden" type="file" name="logo" value="{{ asset('logos/'.$setting->logo) }}" />
                            <div class="flex">
                                <img id="logo_logo" @click="onLogoClick()" src="{{ asset($setting->logo) }}" alt="logo" class="w-20 h-20 rounded-full object-cover hover:cursor-pointer hover:opacity-90 transition-all" />

                            </div>
                            <x-input-error :messages="$errors->get('logo')" class="mt-1 w-1/4" />
                        </div>
                        <div class="flex justify-between sm:justify-normal sm:flex-row border-b py-2 my-auto">
                            <x-input-label class="sm:w-1/4 my-auto" for="HomePageBanner" :value="__('Home Page Banner')" />
                            <x-text-input @change="onHomePageBannerChange()" id="HomePageBanner" class=" mt-1 w-full sm:w-3/4 hidden" type="file" name="HomePageBanner" value="{{ asset($setting->HomePageBanner) }}" />
                            <div class="flex">
                                <img id="HomePageBanner_logo" @click="onHomePageBannerClick()" src="{{ asset($setting->HomePageBanner) }}" alt="Home Page Banner" class="w-80 h-20 rounded-xl object-cover hover:cursor-pointer hover:opacity-90 transition-all" />

                            </div>
                            <x-input-error :messages="$errors->get('HomePageBanner')" class="mt-1 w-1/4" />
                        </div>

                        {{-- opportunities Banner --}}

                        <div class="flex justify-between sm:justify-normal sm:flex-row border-b py-2 my-auto">
                            <x-input-label class="sm:w-1/4 my-auto" for="opportunitiesBanner" :value="__('Opportunities Banner')" />
                            <x-text-input @change="onOpportunitiesBannerChange()" id="opportunitiesBanner" class=" mt-1 w-full sm:w-3/4 hidden" type="file" name="opportunitiesBanner" value="{{ asset($setting->opportunitiesBanner) }}" />
                            <div class="flex">
                                <img id="opportunitiesBanner_logo" @click="onOpportunitiesBannerClick()" src="{{ asset($setting->opportunitiesBanner) }}" alt="opportunities Banner" class="w-80 h-20 rounded-xl object-cover hover:cursor-pointer hover:opacity-90 transition-all" />

                            </div>
                            <x-input-error :messages="$errors->get('opportunitiesBanner')" class="mt-1 w-1/4" />
                        </div>

                        {{-- applications Banner --}}
                        <div class="flex justify-between sm:justify-normal sm:flex-row border-b py-2 my-auto">
                            <x-input-label class="sm:w-1/4 my-auto" for="applicationsBanner" :value="__('Applications Banner')" />
                            <x-text-input @change="onApplicationsBannerChange()" id="applicationsBanner" class=" mt-1 w-full sm:w-3/4 hidden" type="file" name="applicationsBanner" value="{{ asset($setting->applicationsBanner) }}" />
                            <div class="flex">
                                <img id="applicationsBanner_logo" @click="onApplicationsBannerClick()" src="{{ asset($setting->applicationsBanner) }}" alt="applications Banner" class="w-80 h-20 rounded-xl object-cover hover:cursor-pointer hover:opacity-90 transition-all" />

                            </div>
                            <x-input-error :messages="$errors->get('applicationsBanner')" class="mt-1 w-1/4" />
                        </div>
                        {{-- projects Banner --}}
                        <div class="flex justify-between sm:justify-normal sm:flex-row border-b py-2 my-auto">
                            <x-input-label class="sm:w-1/4 my-auto" for="projectsBanner" :value="__('Projects Banner')" />
                            <x-text-input @change="onProjectsBannerChange()" id="projectsBanner" class=" mt-1 w-full sm:w-3/4 hidden" type="file" name="projectsBanner" value="{{ asset($setting->projectsBanner) }}" />
                            <div class="flex">
                                <img id="projectsBanner_logo" @click="onProjectsBannerClick()" src="{{ asset($setting->projectsBanner) }}" alt="projects Banner" class="w-80 h-20 rounded-xl object-cover hover:cursor-pointer hover:opacity-90 transition-all" />

                            </div>
                            <x-input-error :messages="$errors->get('projectsBanner')" class="mt-1 w-1/4" />
                        </div>
                        {{-- about us --}}
                        <div class="flex justify-between sm:justify-normal sm:flex-row border-b py-2 my-auto">
                            <x-input-label class="sm:w-1/4 my-auto" for="aboutUsBanner" :value="__('About Us Banner')" />
                            <x-text-input @change="onAboutUsBannerChange()" id="aboutUsBanner" class=" mt-1 w-full sm:w-3/4 hidden" type="file" name="aboutUsBanner" value="{{ asset($setting->aboutUsBanner) }}" />
                            <div class="flex">
                                <img id="aboutUsBanner_logo" @click="onAboutUsBannerClick()" src="{{ asset($setting->aboutUsBanner) }}" alt="aboutUs Banner" class="w-80 h-20 rounded-xl object-cover hover:cursor-pointer hover:opacity-90 transition-all" />

                            </div>
                            <x-input-error :messages="$errors->get('aboutUsBanner')" class="mt-1 w-1/4" />
                        </div>

                        <div class="flex justify-end w-full mt-5">
                            <x-primary-button type="submit" class="ml-3">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

{{-- logo
homepage
opportunities
applications
projects
about_us --}}


<script>
    function Setting(){
        return {
            logo: null,
            HomePageBanner: null,
            opportunitiesBanner: null,
            applicationsBanner: null,
            projectsBanner: null,
            aboutUsBanner: null,

            init(){
                this.logo = document.getElementById('logo').files[0];
                this.HomePageBanner = document.getElementById('HomePageBanner').files[0];
                this.opportunitiesBanner = document.getElementById('opportunitiesBanner').files[0];
                this.applicationsBanner = document.getElementById('applicationsBanner').files[0];
                this.projectsBanner = document.getElementById('projectsBanner').files[0];
                this.aboutUsBanner = document.getElementById('aboutUsBanner').files[0];
            },
            onLogoChange(){
                this.logo = document.getElementById('logo').files[0];
                // override the src of the image
                let reader = new FileReader();
                reader.onload = (e) => {
                    document.getElementById('logo_logo').src = e.target.result;
                }
                reader.readAsDataURL(this.logo);

            },

            onHomePageBannerChange(){
                this.HomePageBanner = document.getElementById('HomePageBanner').files[0];
                // override the src of the image
                let reader = new FileReader();
                reader.onload = (e) => {
                    document.getElementById('HomePageBanner_logo').src = e.target.result;
                }
                reader.readAsDataURL(this.HomePageBanner);

            },

            onOpportunitiesBannerChange(){
                this.opportunitiesBanner = document.getElementById('opportunitiesBanner').files[0];
                // override the src of the image
                let reader = new FileReader();
                reader.onload = (e) => {
                    document.getElementById('opportunitiesBanner_logo').src = e.target.result;
                }
                reader.readAsDataURL(this.opportunitiesBanner);

            },

            onApplicationsBannerChange(){
                this.applicationsBanner = document.getElementById('applicationsBanner').files[0];
                // override the src of the image
                let reader = new FileReader();
                reader.onload = (e) => {
                    document.getElementById('applicationsBanner_logo').src = e.target.result;
                }
                reader.readAsDataURL(this.applicationsBanner);

            },

            onProjectsBannerChange(){
                this.projectsBanner = document.getElementById('projectsBanner').files[0];
                // override the src of the image
                let reader = new FileReader();
                reader.onload = (e) => {
                    document.getElementById('projectsBanner_logo').src = e.target.result;
                }
                reader.readAsDataURL(this.projectsBanner);

            },

            onAboutUsBannerChange(){
                this.aboutUsBanner = document.getElementById('aboutUsBanner').files[0];
                // override the src of the image
                let reader = new FileReader();
                reader.onload = (e) => {
                    document.getElementById('aboutUsBanner_logo').src = e.target.result;
                }
                reader.readAsDataURL(this.aboutUsBanner);

            },

            onAboutUsBannerClick(){
                document.getElementById('aboutUsBanner').click();
            },

            onProjectsBannerClick(){
                document.getElementById('projectsBanner').click();
            },

            onApplicationsBannerClick(){
                document.getElementById('applicationsBanner').click();
            },

            onOpportunitiesBannerClick(){
                document.getElementById('opportunitiesBanner').click();
            },



            onLogoClick(){
                document.getElementById('logo').click();
            },

            onHomePageBannerClick(){
                document.getElementById('HomePageBanner').click();
            }
        }
    }

</script>

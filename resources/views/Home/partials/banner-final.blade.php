@php
    if (request()->routeIs('home')||request()->routeIs('/')){
        $banner = $setting->HomePageBanner;
    }
    if (request()->routeIs('opportunities.index')) {
        $banner = $setting->opportunitiesBanner;
    }
    if (request()->routeIs('ongoing-app')|| request()->routeIs('bookmark')) {
        $banner = $setting->applicationsBanner;
    }
    if (request()->routeIs('ongoing-proj')||request()->routeIs('history')) {
        $banner = $setting->contactUsBanner;
    }
    if (request()->routeIs('about')) {
        $banner = $setting->aboutUsBanner;
    }
    if ($banner == null || $banner == '') {
        $banner = asset('banners/123.jpg');
    }

@endphp


<div class="relative bg-cover bg-center h-96" style="background-image: url({{ asset($banner) }});">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="absolute inset-0 flex items-center justify-start pl-10">
      <div class="text-white">
        <h1 class="text-4xl font-bold mb-4">All Opportunities</h1>
        <p class="text-lg">Check out offers that's fitted on your qualifications </p>
      </div>
    </div>
  </div>

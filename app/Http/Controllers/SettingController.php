<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\ImageService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this -> imageService = $imageService;
    }

    public function updateSettings(Request $request)
    {
        $request -> validate([
            'logo' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:40000',
            'HomePageBanner' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:40000',
            'opportunitiesBanner' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:40000',
            'applicationsBanner' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:40000',
            'projectsBanner' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:40000',
            'aboutUsBanner' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:40000',
        ]);


        $setting = Setting::first();

        // upload logo
        if ($request->hasFile('logo')) {
            $this->imageService->delete($setting->logo);
            $logo = $this->imageService->upload($request->logo, 'logos', 'public', 'logo');
        }

        // upload homepage
        if ($request->hasFile('HomePageBanner')) {
            $this->imageService->delete($setting->HomePageBanner);
            $HomePageBanner = $this->imageService->upload($request->HomePageBanner, 'banners', 'public', 'HomePageBanner');
        }

        // upload opportunities
        if ($request->hasFile('opportunitiesBanner')) {
            $this->imageService->delete($setting->opportunitiesBanner);
            $opportunitiesBanner = $this->imageService->upload($request->opportunitiesBanner, 'banners', 'public', 'opportunitiesBanner');
        }

        // upload applications

        if ($request->hasFile('applicationsBanner')) {
            $this->imageService->delete($setting->applicationsBanner);
            $applicationsBanner = $this->imageService->upload($request->applicationsBanner, 'banners', 'public', 'applicationsBanner');
        }

        // upload projects
        if ($request->hasFile('projectsBanner')) {
            $this->imageService->delete($setting->projectsBanner);
            $projectsBanner = $this->imageService->upload($request->projectsBanner, 'banners', 'public', 'projectsBanner');
        }

        // upload about_us

        if ($request->hasFile('aboutUsBanner')) {
            $this->imageService->delete($setting->aboutUsBanner);
            $aboutUsBanner = $this->imageService->upload($request->aboutUsBanner, 'banners', 'public', 'aboutUsBanner');
        }

        $setting->update([
            'logo' => $logo ?? $setting->logo,
            'HomePageBanner' => $HomePageBanner ?? $setting->HomePageBanner,
            'opportunitiesBanner' => $opportunitiesBanner ?? $setting->opportunitiesBanner,
            'applicationsrBanner' => $applicationsBanner ?? $setting->applicationsBanner,
            'projectsBanner' => $projectsBanner ?? $setting->projectsBanner,
            'aboutUsBanner' => $aboutUsBanner ?? $setting->aboutUsBanner,
        ]);

        return redirect()->back()->with('success', 'Settings updated successfully');
    }
}

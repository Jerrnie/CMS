<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ExpertiseField;
use APP\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {

         // Define the options for the sex select input
         $sexOptions = [
             'male' => 'Male',
             'female' => 'Female',
             'other' => 'Other',
         ];

         $idTypeOptions = [
             'passport' => 'Passport',
             'drivers_license' => 'Driver\'s License',
             'other' => 'Other',
         ];

         $consultingCategoryOptions = [
            'employee_organization' => 'Employee of Firm/Organization',
            'employee_private_practice' => 'Employee of Firm/Organization but Having the Right of Private Practice',
            'self_employed' => 'Self-Employed',
            'partners_principal' => 'Partners/Principal of a Firm',
            'others' => 'Others',
        ];

        $expertiseFields = ExpertiseField::pluck('name', 'id');
        $expertiseRows = $request->user()->expertiseList()->get();

        return view('profile.edit', [
            'user' => $request->user(),
            'sexOptions' => $sexOptions,
            'idTypeOptions' => $idTypeOptions,
            'consultingCategoryOptions' => $consultingCategoryOptions,
            'expertiseFields' => $expertiseFields,
            'expertiseRows' => $expertiseRows,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BasicInformation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileBasicInfoUpdateRequest;

class BasicInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BasicInformation $basicInformation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BasicInformation $basicInformation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileBasicInfoUpdateRequest $request, BasicInformation $basicInformation): RedirectResponse
    {
        $user = Auth::user();

        $basicInfo = $user->basicInformation ?? new BasicInformation();

        // Convert the date format before saving
        $dob = $request->input('dob');
        if ($dob) {
            $parsedDate = \DateTime::createFromFormat('m/d/Y', $dob);
            if ($parsedDate !== false) {
                $dob = $parsedDate->format('Y-m-d');
            } else {
                // Handle invalid date input or display an error message
            }
        }


        $basicInfo->fill($request->validated());
        $basicInfo->dob = $dob; // Set the formatted date to the 'dob' attribute

        $user->basicInformation()->save($basicInfo);

        return Redirect::route('profile.edit')->with('status', 'basicInfo-updated')->withFragment('basicInfo');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BasicInformation $basicInformation)
    {
        //
    }
}

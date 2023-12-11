<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileConsultantinfoUpdateRequest;
use App\Models\ConsultantInfo;

class ConsultantInfoController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ConsultantInfo $consultantInformation): RedirectResponse
    {


            $employment_end_date = $request->input('employment_end_date');
            if ($employment_end_date) {
                $parsedDate = \DateTime::createFromFormat('m/d/Y', $employment_end_date);
                if ($parsedDate !== false) {
                    $employment_end_date = $parsedDate->format('Y-m-d');
                } else {
                    // Handle invalid date input or display an error message
                }
            }
            $gov_employment_end_date = $request->input('gov_employment_end_date');
            if ($gov_employment_end_date) {
                $parsedDate = \DateTime::createFromFormat('m/d/Y', $gov_employment_end_date);
                if ($parsedDate !== false) {
                    $gov_employment_end_date = $parsedDate->format('Y-m-d');
                } else {
                    // Handle invalid date input or display an error message
                }
            }

        $user = Auth::user();

        $consultantInfo = $user->consultantInformation ?? new ConsultantInfo();

        $consultantInfo->fill($request->all());

        $user->consultantInformation()->save($consultantInfo);

        return Redirect::route('profile.edit')->with('status', 'consultantInfo-updated')->withFragment('consultantInfo');

    }


}

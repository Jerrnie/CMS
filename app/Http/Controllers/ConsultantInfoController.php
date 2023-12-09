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
    public function update(ProfileConsultantinfoUpdateRequest $request, ConsultantInfo $consultantInformation): RedirectResponse
    {

        $user = Auth::user();

        $consultantInfo = $user->consultantInformation ?? new ConsultantInfo();

        $consultantInfo->fill($request->validated());

        $user->consultantInformation()->save($consultantInfo);

        return Redirect::route('profile.edit')->with('status', 'consultantInfo-updated')->withFragment('consultantInfo');

    }


}

<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Assignment;
use App\Models\Status;
use Illuminate\Http\Request;

class AssignmentController extends Controller
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
    public function show(Assignment $assignment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assignment $assignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assignment $assignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assignment $assignment)
    {
        //
    }

    public function assignConsultant($applicant)
    {
        //verification needed

        $applicant_id = $applicant;
        $projectApplicant = Applicant::where('id', $applicant_id)->first();
        $assignment = Assignment::where('project_id', $projectApplicant->project_id)->first();


        $assignment->consultant_id = $projectApplicant->user_id;
        $assignment->save();

        #status model where project id = projectApplicant->project_id
        $status = Status::where('project_id', $projectApplicant->project_id)->first();

        $status->name = 'ongoing';
        $status->code = 3; //ongoing
        $status->save();

        //return back with success message
        return redirect()->back()->with('success', 'Consultant assigned successfully');

    }
}

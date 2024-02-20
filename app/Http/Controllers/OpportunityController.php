<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Status;
use App\Models\Tranch;
use App\Models\Project;
use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Models\ExpertiseField;

class OpportunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('opportunities.index');
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
    public function show(string $id)
    {
        $project = Project::with('status', 'budgetcode', 'unit', 'assignments', 'tranches','applicants')
        ->where('id', $id)
        ->first();

        $expertiseField = ExpertiseField::find($project->expertise_field_id);

        if (!$expertiseField) {
            $project->expertise_field_name = '';
        }
        else{
            $project->expertise_field_name = $expertiseField->name;
        }

        $consultant = Admin::find($project->consultant_id);

        if (!$consultant) {
            $project->consultant_name = '';
        }
        else{
            $project->consultant_name = $consultant->name;
        }

        $status = Status::where('project_id', $project->id)->first();

        $budgetcode = $project->budgetcode()->first();

        $unit = $project->unit()->first();


        //////////////////////////

        #get assignments

        $consultant_id = null;
        $isLogged = auth()->user() ? true : false;
        $assignments = $project->assignments()->get();

        if ($isLogged) {

            $application = Applicant::where('user_id', auth()->user()->id)
            ->where('project_id', $project->id)
            ->first();

            #check if user is assigned to the project
            $project->isAssigned = $project->assignments()->where('consultant_id', auth()->user()->id)->exists();

            #get the assigned consultant
            $consultant_id = $project->assignments()->where('project_id', $project->id)->first();

            # 1 = no consultant assigned
            # 2 = consultant assigned but not the user
            # 3 = consultant assigned and the user
            if (!$consultant_id) {
                $project->consultantStatus = 1;
            }
            else{
                if ($consultant_id->consultant_id != auth()->user()->id) {
                    $project->consultantStatus = 2;
                }
                else{
                    $project->consultantStatus = 3;
                }
            }


            //check if user is already applied
            if ($application) {
                // The user has applied for the project
                $project->hasApplied = true;
            } else {
                // The user has not applied for the project
                $project->hasApplied = false;
            }

            }
        else{
            $project->isAssigned = false;
            $project->consultantStatus = 4;
        }

        /////////////////

        $tranches = Tranch::where('project_id', $project->id)
        ->with(['activities', 'activities.deliverables'])
        ->get();

        // Check if each tranch has at least one activity and each activity has at least one deliverable
        foreach ($tranches as $tranchIndex => $tranch) {
            if ($tranch->activities->isEmpty()) {
                return redirect()->back()->with('error', 'Tranch ' . ($tranchIndex + 1) . ' has no activities.');
            }

            foreach ($tranch->activities as $activityIndex => $activity) {
                if ($activity->deliverables->isEmpty()) {
                    return redirect()->back()->with('error', 'Activity ' . ($activityIndex + 1) . ' in tranch ' . ($tranchIndex + 1) . ' has no deliverables.');
                }
            }
        }

        $total_budget = $tranches->sum('budget');

        //get min date and max date from tranches

        $min_date = $tranches->min('date_from');
        $max_date = $tranches->max('date_to');

        $period = $min_date . ' - ' . $max_date;


        return view('opportunities.show', [
            'project' => $project,
            'status' => $status,
            'budgetcode' => $budgetcode,
            'unit' => $unit,
            'assignments' => $assignments,
            'tranches' => $tranches,
            'total_budget' => $total_budget,
            'period' => $period,
        ]);
    }

    public function showOngoing(string $id)
    {
        $project = Project::with('status', 'budgetcode', 'unit', 'assignments', 'tranches','applicants')
        ->where('id', $id)
        ->first();

        $expertiseField = ExpertiseField::find($project->expertise_field_id);

        if (!$expertiseField) {
            $project->expertise_field_name = '';
        }
        else{
            $project->expertise_field_name = $expertiseField->name;
        }

        $consultant = Admin::find($project->consultant_id);

        if (!$consultant) {
            $project->consultant_name = '';
        }
        else{
            $project->consultant_name = $consultant->name;
        }

        $status = Status::where('project_id', $project->id)->first();

        $budgetcode = $project->budgetcode()->first();

        $unit = $project->unit()->first();


        //////////////////////////

        #get assignments

        $consultant_id = null;
        $isLogged = auth()->user() ? true : false;
        $assignments = $project->assignments()->get();

        if ($isLogged) {

            $application = Applicant::where('user_id', auth()->user()->id)
            ->where('project_id', $project->id)
            ->first();

            #check if user is assigned to the project
            $project->isAssigned = $project->assignments()->where('consultant_id', auth()->user()->id)->exists();

            #get the assigned consultant
            $consultant_id = $project->assignments()->where('project_id', $project->id)->first();

            # 1 = no consultant assigned
            # 2 = consultant assigned but not the user
            # 3 = consultant assigned and the user
            if (!$consultant_id) {
                $project->consultantStatus = 1;
            }
            else{
                if ($consultant_id->consultant_id != auth()->user()->id) {
                    $project->consultantStatus = 2;
                }
                else{
                    $project->consultantStatus = 3;
                }
            }


            //check if user is already applied
            if ($application) {
                // The user has applied for the project
                $project->hasApplied = true;
            } else {
                // The user has not applied for the project
                $project->hasApplied = false;
            }

            }
        else{
            $project->isAssigned = false;
            $project->consultantStatus = 4;
        }

        /////////////////

        $tranches = Tranch::where('project_id', $project->id)
        ->with(['activities', 'activities.deliverables'])
        ->get();

        // Check if each tranch has at least one activity and each activity has at least one deliverable
        foreach ($tranches as $tranchIndex => $tranch) {
            if ($tranch->activities->isEmpty()) {
                return redirect()->back()->with('error', 'Tranch ' . ($tranchIndex + 1) . ' has no activities.');
            }

            foreach ($tranch->activities as $activityIndex => $activity) {
                if ($activity->deliverables->isEmpty()) {
                    return redirect()->back()->with('error', 'Activity ' . ($activityIndex + 1) . ' in tranch ' . ($tranchIndex + 1) . ' has no deliverables.');
                }
            }
        }

        $total_budget = $tranches->sum('budget');

        //get min date and max date from tranches

        $min_date = $tranches->min('date_from');
        $max_date = $tranches->max('date_to');

        $period = $min_date . ' - ' . $max_date;


        return view('opportunities.currentProject', [
            'project' => $project,
            'status' => $status,
            'budgetcode' => $budgetcode,
            'unit' => $unit,
            'assignments' => $assignments,
            'tranches' => $tranches,
            'total_budget' => $total_budget,
            'period' => $period,
        ]);
    }

    public function outputs(string $id)
    {
        // temp
        $documentRows = [];

        $project = Project::with('status', 'budgetcode', 'unit', 'assignments', 'tranches','applicants')
        ->where('id', $id)
        ->first();

        $expertiseField = ExpertiseField::find($project->expertise_field_id);

        if (!$expertiseField) {
            $project->expertise_field_name = '';
        }
        else{
            $project->expertise_field_name = $expertiseField->name;
        }

        $consultant = Admin::find($project->consultant_id);

        if (!$consultant) {
            $project->consultant_name = '';
        }
        else{
            $project->consultant_name = $consultant->name;
        }

        $status = Status::where('project_id', $project->id)->first();

        $budgetcode = $project->budgetcode()->first();

        $unit = $project->unit()->first();

        #trench with activities and deliverables

        $tranches = Tranch::where('project_id', $project->id)
        ->with(['activities', 'activities.deliverables'])
        ->get();





        //return a view
        return view('opportunities.outputs', [
            'project' => $project,
            'status' => $status,
            'budgetcode' => $budgetcode,
            'unit' => $unit,
            'tranches' => $tranches,
            'documentRows' => $documentRows,


        ]);


    }
    //apply for opportunity
    public function apply(Request $request, string $id)
    {
        //if not login redirect back with message to login first
        if (!auth()->user()) {
            return redirect()->back()->with('error', 'Please login first.');
        }

        //get project base on id with assignment and status
        $project = Project::with('status', 'assignments')->where('id', $id)->first();

        //check if status is posted
        if ($project->status->code != '2') {
            return redirect()->back()->with('error', 'You cannot apply for this opportunity.');
        }

        //getapplicants
        $applicants = $project->applicants()->get();

        //check if user is already applied
        if ($applicants->contains('user_id', auth()->user()->id)) {
            return redirect()->back()->with('error', 'You have already applied for this opportunity.');
        }

        $applicant = new Applicant();

        $applicant->user_id = auth()->user()->id;
        $applicant->project_id = $project->id;
        $applicant->application_date = now();

        $applicant->save();

        return redirect()->back()->with('success', 'You have successfully applied for this opportunity.');

    }

    //unapply for opportunity
    public function unapply(Request $request, string $id)
    {
        //if not login redirect back with message to login first
        if (!auth()->user()) {
            return redirect()->back()->with('error', 'Please login first.');
        }

        //get project base on id with assignment and status
        $project = Project::with('status', 'assignments')->where('id', $id)->first();

        //check if status is posted
        if ($project->status->code != '2') {
            return redirect()->back()->with('error', 'You cannot unapply for this opportunity.');
        }

        //getapplicants
        $applicants = $project->applicants()->get();

        //check if user is already applied
        if (!$applicants->contains('user_id', auth()->user()->id)) {
            return redirect()->back()->with('error', 'You have not applied for this opportunity.');
        }

        $applicant = Applicant::where('user_id', auth()->user()->id)
        ->where('project_id', $project->id)
        ->first();

        $applicant->delete();

        return redirect()->back()->with('success', 'You have successfully unapplied for this opportunity.');
    }

    public function ongoing()
    {
        $user = auth()->user();
        $user_id = $user->id;

        $projects = Project::with('status', 'budgetcode', 'unit', 'assignments', 'tranches','applicants')
        ->whereHas('assignments', function ($query) use ($user_id) {
            $query->where('consultant_id', $user_id);
        })->get();

        //get consultant name and get expertise field name
        foreach ($projects as $project) {
            if ($project->consultant_id) {
                $consultant = Admin::find($project->consultant_id);
                $project->consultant_name = $consultant->name;
            }

            //get expertise field name
            $expertiseField = ExpertiseField::find($project->expertise_field_id);

            if (!$expertiseField) {
                $project->expertise_field_name = '';
            }
            else{
                $project->expertise_field_name = $expertiseField->name;
            }

            //get the date converage of each project lowest date of its tranches and highest date of its tranches
            $tranches = $project->tranches;

            // Find the earliest and latest dates
            $earliestDate = $tranches->min('date_from');
            $latestDate = $tranches->max('date_to');

            // Format the dates for display
            if ($earliestDate && $latestDate) {
                $dateCoverage = \Carbon\Carbon::parse($earliestDate)->format('F j, Y') . ' to ' . \Carbon\Carbon::parse($latestDate)->format('F j, Y');
                $project->date_coverage = $dateCoverage;
            } else {
                $project->date_coverage = 'N/A'; // or any default value
            }
        }

        //return view with all
        return view('opportunities.ongoing', [
            'projects' => $projects,

        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

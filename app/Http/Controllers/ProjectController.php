<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Admin;
use App\Models\Status;
use App\Models\Tranch;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Activity;
use App\Models\UnitAdmin;
use App\Models\Assignment;
use App\Models\BudgetCode;
use App\Models\Deliverable;
use Illuminate\Http\Request;
use App\Models\ExpertiseField;
use Illuminate\Support\Facades\Auth;
use App\Services\CodeGeneratorService;
use App\Http\Requests\SubmitProjectRequest;

class ProjectController extends Controller
{
    protected $codeGeneratorService;

    public function __construct()
    {
        //codegenerator service
        $this->codeGeneratorService = new CodeGeneratorService();
    }

    public function getAdminUnits()
    {
        $unitsAdmin = Auth::user()->unitsAdmin()->with('unit')->get();
        $units = $unitsAdmin->pluck('unit.name', 'unit.id');
        return $units;
    }

    public function getSetting()
    {
        return Setting::first();
    }

    public function getStatus($project_id)
    {
        return Status::where('project_id', $project_id)->first();
    }

    public function getBudgetCodes($unitAdminIds, $setting)
    {
        return BudgetCode::with('unit', 'quarter')
            ->where('year_id', $setting->year_id)
            ->where('quarter_id', $setting->quarter_id)
            ->whereIn('unit_id', $unitAdminIds)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function getBudgetCode($project)
    {
        return $project->budgetcode()->first();
    }

    public function getUnitAdminIds()
    {
        $unitsAdmin = Auth::user()->unitsAdmin()->with('unit')->get();
        return $unitsAdmin->pluck('unit.id')->toArray();
    }


    public function post(Project $project)
    {
        //make the status as posted
        $status = Status::where('project_id', $project->id)->first();
        $status->name = 'posted';
        $status->code = 2;
        $status->save();

        //redirect to back
        return redirect()->back()->with('success', 'Project posted successfully');

        // return redirect()->route('admin.projects.index');
    }

    public function unpost(Project $project)
    {
        // aake the project to draft
        $status = Status::where('project_id', $project->id)->first();
        $status->name = 'draft';
        $status->code = 1;
        $status->save();

        //redirect to back
        return redirect()->back()->with('success', 'Project unposted successfully');

        // return redirect()->route('admin.projects.index');
    }

    //delete project
    public function delete(Project $project)
    {
        //delete project
        $project->delete();

        //redirect to homepage
        return redirect()->route('admin.dashboard')->with('success', 'Project deleted successfully');

        // return redirect()->route('admin.projects.index');
    }

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
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }

    public function removeConsultant(Project $project)
{
    // Ensure there's a consultant to remove
    if (!$project->consultant_id) {
        return redirect()->back()->with('error', 'No consultant assigned to this project.');
    }

    // Remove the consultant
    $project->consultant_id = null;
    $project->save();

    return redirect()->back()->with('success', 'Consultant removed successfully.');
}

    public function setupSummary($project_id)
    {

        $project = Project::find($project_id);

        //get tranches with activity and deliverables
        $tranches = Tranch::where('project_id', $project->id);
        $tranches->with(['activities', 'activities.deliverables']);
        $tranches = $tranches->get();

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
        $expertiseFields = ExpertiseField::pluck('name', 'id');

        $status = Status::where('project_id', $project->id)->first();

        $units = $this->getAdminUnits();

        $setting = $this->getSetting();

        $unitAdminIds = $this->getUnitAdminIds();

        $budgetCodes = $this->getBudgetCodes($unitAdminIds, $setting);

        $budgetcode = $project->budgetcode()->first();

        $budgetCodes->push($budgetcode);

        //get tranches with activity and deliverables
        $tranches = Tranch::where('project_id', $project->id);
        $tranches->with(['activities', 'activities.deliverables']);
        $tranches = $tranches->get();

        $total_budget = $tranches->sum('budget');

        //get min date and max date from tranches

        $min_date = $tranches->min('date_from');
        $max_date = $tranches->max('date_to');

        $period = $min_date . ' - ' . $max_date;



        return view('admin.projects.setup-summary', [
            'project' => $project,
            'expertiseFields' => $expertiseFields,
            'units' => $units,
            'status' => $status,
            'budgetcode' => $budgetcode,
            'budgetCodes' => $budgetCodes,
            'tranches' => $tranches,
            'total_budget' => $total_budget,
            'period' => $period,
        ]);

    }

    public function createProject()
    {
        $expertiseFields = ExpertiseField::pluck('name', 'id');

        $units = $this->getAdminUnits();

        $setting = $this->getSetting();

        $unitAdminIds = $this->getUnitAdminIds();

        $budgetCodes = $this->getBudgetCodes($unitAdminIds, $setting);


        return view('admin.projects.create', [
            'expertiseFields' => $expertiseFields,
            'units' => $units,
            'budgetCodes' => $budgetCodes,
        ]);
    }

    public function submitProject(SubmitProjectRequest $request)
    {

        //check if the selected unit is in the admin's units
        $unit = UnitAdmin::find("$request->unit_id");

        if (!$unit) {
            return redirect()->back()->withErrors(['unit_id' => 'You are not allowed to create projects for this unit']);
        }

        $project = new Project();
        $code = $this->codeGeneratorService->generateCode($project, 'PRJ');
        $project->title = $request->title;
        $project->code = $code;
        $project->description = $request->description;
        $project->expertise_detail = $request->expertise_detail;
        $project->expertise_field_id = $request->expertise_field_id;
        $project->budgetcode_id = $request->budgetcode_id;
        $project->unit_id = $request->unit_id;
        $project->save();


        // add status to draft

        $status = new Status;
        $status->name = 'draft';
        $status->code = 1;
        $status->project_id = $project->id;
        $status->save();


        //assign the project to the admin

        $assignment = new Assignment;
        $assignment->project_id = $project->id;
        $assignment->requestor_id = Auth::user()->id;
        $assignment->save();

        // redirect to admin.projects.setup with project id
        return redirect()->route('admin.projects.setup', $project->id);

    }

    public function updateProject(SubmitProjectRequest $request, Project $project)
    {

        //check if the selected unit is in the admin's units
        $unit = UnitAdmin::find("$request->unit_id");

        if (!$unit) {
            return redirect()->back()->withErrors(['unit_id' => 'You are not allowed to create projects for this unit']);
        }

        $project->title = $request->title;
        $project->description = $request->description;
        $project->expertise_detail = $request->expertise_detail;
        $project->expertise_field_id = $request->expertise_field_id;
        $project->budgetcode_id = $request->budgetcode_id;
        $project->unit_id = $request->unit_id;
        $project->save();

        // redirect to admin.projects.setup with project id
        return redirect()->route('admin.projects.setup', $project->id)->with('success', 'Project updated successfully');
    }

    public function setupProject($project_id){

        $project = Project::find($project_id);

        $expertiseFields = ExpertiseField::pluck('name', 'id');

        $status = Status::where('project_id', $project->id)->first();

        $units = $this->getAdminUnits();

        $setting = $this->getSetting();

        $unitAdminIds = $this->getUnitAdminIds();

        $budgetCodes = $this->getBudgetCodes($unitAdminIds, $setting);

        $budgetcode = $project->budgetcode()->first();

        $budgetCodes->push($budgetcode);


        return view('admin.projects.setup-details', [
            'project' => $project,
            'expertiseFields' => $expertiseFields,
            'units' => $units,
            'status' => $status,
            'budgetcode' => $budgetcode,
            'budgetCodes' => $budgetCodes,
        ]);
    }

    public function setupReference($project_id){
        $project = Project::find($project_id);

        $expertiseFields = ExpertiseField::pluck('name', 'id');

        $status = Status::where('project_id', $project->id)->first();

        $units = $this->getAdminUnits();

        $setting = $this->getSetting();

        $unitAdminIds = $this->getUnitAdminIds();

        $budgetCodes = $this->getBudgetCodes($unitAdminIds, $setting);

        $budgetcode = $project->budgetcode()->first();

        $budgetCodes->push($budgetcode);

        $tranches = Tranch::where('project_id', $project->id)
        ->with(['activities', 'activities.deliverables'])
        ->get();


        return view('admin.projects.setup-reference', [
            'project' => $project,
            'expertiseFields' => $expertiseFields,
            'units' => $units,
            'status' => $status,
            'budgetcode' => $budgetcode,
            'budgetCodes' => $budgetCodes,
            'tranches' => $tranches,
            'setting' => $setting,
        ]);
    }

    public function submitReference(Request $request, Project $project)
    {

        //validate cost/budget, date from and date to
        $request->validate([
            'budget' => 'required|numeric',
            'date_from' => 'required|date',
            'date_to' => 'required|date|after_or_equal:date_from',
        ]);

        //insert new tranch

        $tranch = new Tranch;
        $tranch->budget = $request->budget;
        $tranch->date_from = $request->date_from;
        $tranch->date_to = $request->date_to;
        $tranch->project_id = $project->id;
        $tranch->save();

        return redirect()->back()->with('success', 'Project reference updated successfully');
    }

    public function setupActivity(Tranch $tranch)
    {
        $project = $tranch->project()->first();

        $expertiseFields = ExpertiseField::pluck('name', 'id');

        $status = Status::where('project_id', $project->id)->first();

        $units = $this->getAdminUnits();

        $setting = $this->getSetting();

        $unitAdminIds = $this->getUnitAdminIds();

        $budgetCodes = $this->getBudgetCodes($unitAdminIds, $setting);

        $budgetcode = $project->budgetcode()->first();

        $budgetCodes->push($budgetcode);

        $tranches = Tranch::where('project_id', $project->id)
        ->with(['activities', 'activities.deliverables'])
        ->get();

        return view('admin.projects.setup-activities', [
            'project' => $project,
            'expertiseFields' => $expertiseFields,
            'units' => $units,
            'status' => $status,
            'budgetcode' => $budgetcode,
            'budgetCodes' => $budgetCodes,
            'tranches' => $tranches,
            'tranch' => $tranch,
        ]);
    }

    public function submitActivity(Request $request, Tranch $tranch)
    {

        //validate cost/budget, date from and date to
        $request->validate([
            'title' => 'required|string',
        ]);

        $project = $tranch->project()->first();

        $expertiseFields = ExpertiseField::pluck('name', 'id');

        $status = Status::where('project_id', $project->id)->first();

        $units = $this->getAdminUnits();

        $setting = $this->getSetting();

        $unitAdminIds = $this->getUnitAdminIds();

        $budgetCodes = $this->getBudgetCodes($unitAdminIds, $setting);

        $budgetcode = $project->budgetcode()->first();

        $budgetCodes->push($budgetcode);

        //insert new activity

        $activity = new Activity;
        $activity->title = $request->title;
        $activity->tranch_id = $tranch->id;
        $activity->save();


        //redirect to admin.projects.setup.activity with all the data to setup activity

        return view('admin.projects.setup-activities', [
            'project' => $project,
            'expertiseFields' => $expertiseFields,
            'units' => $units,
            'status' => $status,
            'budgetcode' => $budgetcode,
            'budgetCodes' => $budgetCodes,
            'tranch' => $tranch,
            'activity' => $activity,
        ])->with('success', 'Project activity updated successfully');

        //redirect to admin.projects.setup.activity


        // return redirect()->back()->with('success', 'Project activity updated successfully');
    }

    //edit activity view
    public function editActivityView(Activity $activity)
    {
        $project = $activity->tranch->project()->first();

        $expertiseFields = ExpertiseField::pluck('name', 'id');

        $status = Status::where('project_id', $project->id)->first();

        $units = $this->getAdminUnits();

        $setting = $this->getSetting();

        $unitAdminIds = $this->getUnitAdminIds();

        $budgetCodes = $this->getBudgetCodes($unitAdminIds, $setting);

        $budgetcode = $project->budgetcode()->first();

        $budgetCodes->push($budgetcode);

        $tranches = Tranch::where('project_id', $project->id)
        ->with(['activities', 'activities.deliverables'])
        ->get();

        return view('admin.projects.setup-activities', [
            'project' => $project,
            'expertiseFields' => $expertiseFields,
            'units' => $units,
            'status' => $status,
            'budgetcode' => $budgetcode,
            'budgetCodes' => $budgetCodes,
            'tranches' => $tranches,
            'tranch' => $activity->tranch,
            'activity' => $activity,
        ]);
    }


    //edit activity
    public function editActivity(Request $request, Activity $activity)
    {
        $activity->title = $request->title;
        $activity->save();

        return redirect()->back()->with('success', 'Project activity updated successfully');
    }

    //delete activity
    public function deleteActivity(Activity $activity)
    {
        $tranch = $activity->tranch()->first();
        $activity->delete();

        $project = $tranch->project()->first();

        $expertiseFields = ExpertiseField::pluck('name', 'id');

        $status = Status::where('project_id', $project->id)->first();

        $units = $this->getAdminUnits();

        $setting = $this->getSetting();

        $unitAdminIds = $this->getUnitAdminIds();

        $budgetCodes = $this->getBudgetCodes($unitAdminIds, $setting);

        $budgetcode = $project->budgetcode()->first();

        $budgetCodes->push($budgetcode);

        $tranches = Tranch::where('project_id', $project->id)
        ->with(['activities', 'activities.deliverables'])
        ->get();

        return view('admin.projects.setup-reference', [
            'project' => $project,
            'expertiseFields' => $expertiseFields,
            'units' => $units,
            'status' => $status,
            'budgetcode' => $budgetcode,
            'budgetCodes' => $budgetCodes,
            'tranches' => $tranches,
            'setting' => $setting,
        ])->with('success', 'Project activity deleted successfully');


    }

    //add deliverable
    public function addDeliverable(Request $request ,Activity $activity)
    {
        $request->validate([
            'title' => 'required|string',
        ]);
        $activityID = $activity->id;

        $activity->deliverables()->create([
            'title' => $request->title,
            'activity_id' => $activityID,
        ]);
        $project = $activity->tranch->project()->first();

        $expertiseFields = ExpertiseField::pluck('name', 'id');

        $status = Status::where('project_id', $project->id)->first();

        $units = $this->getAdminUnits();

        $setting = $this->getSetting();

        $unitAdminIds = $this->getUnitAdminIds();

        $budgetCodes = $this->getBudgetCodes($unitAdminIds, $setting);

        $budgetcode = $project->budgetcode()->first();

        $budgetCodes->push($budgetcode);

        $tranches = Tranch::where('project_id', $project->id)
        ->with(['activities', 'activities.deliverables'])
        ->get();

        return view('admin.projects.setup-activities', [
            'project' => $project,
            'expertiseFields' => $expertiseFields,
            'units' => $units,
            'status' => $status,
            'budgetcode' => $budgetcode,
            'budgetCodes' => $budgetCodes,
            'tranches' => $tranches,
            'tranch' => $activity->tranch,
            'activity' => $activity,
        ])->with('success', 'Project deliverable added successfully');

    }

    //delete deliverable
    public function deleteDeliverable($deliverable_id)
    {

        $activity = Deliverable::find($deliverable_id)->activity()->first();

        $deliverable = Deliverable::find($deliverable_id);
        $deliverable->delete();

        $project = $activity->tranch->project()->first();

        $expertiseFields = ExpertiseField::pluck('name', 'id');

        $status = Status::where('project_id', $project->id)->first();

        $units = $this->getAdminUnits();

        $setting = $this->getSetting();

        $unitAdminIds = $this->getUnitAdminIds();

        $budgetCodes = $this->getBudgetCodes($unitAdminIds, $setting);

        $budgetcode = $project->budgetcode()->first();

        $budgetCodes->push($budgetcode);

        $tranches = Tranch::where('project_id', $project->id)
        ->with(['activities', 'activities.deliverables'])
        ->get();

        return view('admin.projects.setup-activities', [
            'project' => $project,
            'expertiseFields' => $expertiseFields,
            'units' => $units,
            'status' => $status,
            'budgetcode' => $budgetcode,
            'budgetCodes' => $budgetCodes,
            'tranches' => $tranches,
            'tranch' => $activity->tranch,
            'activity' => $activity,
        ])->with('success', 'Project deliverable deleted successfully');

    }

    //edit deliverable
    public function editDeliverable(Request $request, $deliverable_id)
    {
        $deliverable = Deliverable::find($deliverable_id);
        $deliverable->title = $request->title;
        $deliverable->save();

        return redirect()->back()->with('success', 'Project deliverable updated successfully');
    }

    //delete tranch/reference
    public function deleteReference($tranch_id)
    {
        $tranch = Tranch::find($tranch_id);
        $tranch->delete();

        return redirect()->back()->with('success', 'Project reference deleted successfully');
    }

    //edit tranch/reference
    public function editReference(Request $request, $tranch_id)
    {
        $tranch = Tranch::find($tranch_id);
        $tranch->budget = $request->budget;
        $tranch->date_from = $request->date_from;
        $tranch->date_to = $request->date_to;
        $tranch->save();

        return redirect()->back()->with('success', 'Project reference updated successfully');
    }
}

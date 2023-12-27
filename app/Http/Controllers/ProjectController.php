<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Admin;
use App\Models\Status;
use App\Models\Trench;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Activity;
use App\Models\UnitAdmin;
use App\Models\Assignment;
use App\Models\BudgetCode;
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

        $trenches = Trench::where('project_id', $project->id)
        ->with(['activities', 'activities.deliverables'])
        ->get();


        return view('admin.projects.setup-reference', [
            'project' => $project,
            'expertiseFields' => $expertiseFields,
            'units' => $units,
            'status' => $status,
            'budgetcode' => $budgetcode,
            'budgetCodes' => $budgetCodes,
            'trenches' => $trenches,
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

        //insert new trench

        $trench = new Trench;
        $trench->budget = $request->budget;
        $trench->date_from = $request->date_from;
        $trench->date_to = $request->date_to;
        $trench->project_id = $project->id;
        $trench->save();

        return redirect()->back()->with('success', 'Project reference updated successfully');
    }

    public function setupActivity(Trench $trench)
    {
        $project = $trench->project()->first();

        $expertiseFields = ExpertiseField::pluck('name', 'id');

        $status = Status::where('project_id', $project->id)->first();

        $units = $this->getAdminUnits();

        $setting = $this->getSetting();

        $unitAdminIds = $this->getUnitAdminIds();

        $budgetCodes = $this->getBudgetCodes($unitAdminIds, $setting);

        $budgetcode = $project->budgetcode()->first();

        $budgetCodes->push($budgetcode);

        $trenches = Trench::where('project_id', $project->id)
        ->with(['activities', 'activities.deliverables'])
        ->get();

        return view('admin.projects.setup-activities', [
            'project' => $project,
            'expertiseFields' => $expertiseFields,
            'units' => $units,
            'status' => $status,
            'budgetcode' => $budgetcode,
            'budgetCodes' => $budgetCodes,
            'trenches' => $trenches,
            'trench' => $trench,
        ]);
    }

    public function submitActivity(Request $request, Trench $trench)
    {

        //validate cost/budget, date from and date to
        $request->validate([
            'title' => 'required|string',
        ]);

        //insert new activity

        $activity = new Activity;
        $activity->title = $request->title;
        $activity->trench_id = $trench->id;
        $activity->save();

        //redirect to admin.projects.setup.activity

        //get back here


        return redirect()->back()->with('success', 'Project activity updated successfully');
    }

    //edit activity
    public function editActivity(Request $request, Activity $activity)
    {
        $activity->title = $request->title;
        $activity->save();

        return redirect()->back()->with('success', 'Project activity updated successfully');
    }

    //delete trench/reference
    public function deleteReference($trench_id)
    {
        $trench = Trench::find($trench_id);
        $trench->delete();

        return redirect()->back()->with('success', 'Project reference deleted successfully');
    }

    //edit trench/reference
    public function editReference(Request $request, $trench_id)
    {
        $trench = Trench::find($trench_id);
        $trench->budget = $request->budget;
        $trench->date_from = $request->date_from;
        $trench->date_to = $request->date_to;
        $trench->save();

        return redirect()->back()->with('success', 'Project reference updated successfully');
    }
}

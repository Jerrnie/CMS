<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Admin;
use App\Models\Status;
use App\Models\Project;
use App\Models\UnitAdmin;
use App\Models\Assignment;
use App\Models\BudgetCode;
use Illuminate\Http\Request;
use App\Models\ExpertiseField;
use Illuminate\Support\Facades\Auth;
use App\Services\CodeGeneratorService;
use App\Http\Requests\SubmitProjectRequest;
use App\Models\Setting;

class ProjectController extends Controller
{
    protected $codeGeneratorService;

    public function __construct()
    {
        //codegenerator service
        $this->codeGeneratorService = new CodeGeneratorService();
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
        $units = Unit::pluck('name', 'id');

        //get admin

        $unitsAdmin = Auth::user()->unitsAdmin()->with('unit')->get();
        $units = $unitsAdmin->pluck('unit.name', 'unit.id');

        //get setting
        $setting = Setting::first();
        //get budget code

        $unitAdminIds = $unitsAdmin->pluck('unit.id')->toArray();


        //get the budget base on year,  quarter and unitof the admins
        $budgetCodes = BudgetCode::with('unit', 'quarter')
            ->where('year_id', $setting->year_id)
            ->where('quarter_id', $setting->quarter_id)
            ->whereIn('unit_id', $unitAdminIds)
            ->orderBy('id', 'desc')
            ->get();



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
        $units = Unit::pluck('name', 'id');

        //get admin units

        $unitsAdmin = Auth::user()->unitsAdmin()->with('unit')->get();
        $units = $unitsAdmin->pluck('unit.name', 'unit.id');

        //get setting
        $setting = Setting::first();

        //get status

        $status = Status::where('project_id', $project->id)->first();
        //get budgetcode name
        $unitAdminIds = $unitsAdmin->pluck('unit.id')->toArray();

        //get the budget base on year,  quarter and unitof the admins
        $budgetCodes = BudgetCode::with('unit', 'quarter')
            ->where('year_id', $setting->year_id)
            ->where('quarter_id', $setting->quarter_id)
            ->whereIn('unit_id', $unitAdminIds)
            ->orderBy('id', 'desc')
            ->get();

        //get budgetcode name
        $budgetcode = $project->budgetcode()->first();

        // Add $budgetcode to the $budgetCodes collection
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
        $units = Unit::pluck('name', 'id');

        //get setting
        $setting = Setting::first();

        //get admin units

        $unitsAdmin = Auth::user()->unitsAdmin()->with('unit')->get();
        $units = $unitsAdmin->pluck('unit.name', 'unit.id');

        //get status
        $status = Status::where('project_id', $project->id)->first();
        $unitAdminIds = $unitsAdmin->pluck('unit.id')->toArray();

        //get the budget base on year,  quarter and unitof the admins
        $budgetCodes = BudgetCode::with('unit', 'quarter')
            ->where('year_id', $setting->year_id)
            ->where('quarter_id', $setting->quarter_id)
            ->whereIn('unit_id', $unitAdminIds)
            ->orderBy('id', 'desc')
            ->get();

        //get budgetcode name
        $budgetcode = $project->budgetcode()->first();

        // Add $budgetcode to the $budgetCodes collection
        $budgetCodes->push($budgetcode);

        return view('admin.projects.setup-reference', [
            'project' => $project,
            'expertiseFields' => $expertiseFields,
            'units' => $units,
            'status' => $status,
            'budgetcode' => $budgetcode,
            'budgetCodes' => $budgetCodes,
        ]);
    }
}

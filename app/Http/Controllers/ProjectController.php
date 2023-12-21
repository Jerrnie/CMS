<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Admin;
use App\Models\Status;
use App\Models\Project;
use App\Models\UnitAdmin;
use App\Models\Assignment;
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

        return view('admin.projects.create', [
            'expertiseFields' => $expertiseFields,
            'units' => $units,
        ]);
    }

    public function submitProject(SubmitProjectRequest $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'expertise_detail' => 'required',
            'expertise_field_id' => 'required|exists:expertise_fields,id',
            'unit_id' => 'required|exists:units,id',
        ]);

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

    public function setupProject($project_id){
        return view('admin.projects.setup');
    }
}

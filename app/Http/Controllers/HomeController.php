<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\ExpertiseField;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::with('status', 'budgetcode', 'unit', 'assignments', 'tranches')
            ->whereHas('status', function ($query) {
                $query->where('code', 2);
            })
            ->paginate(4);

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

        return view('home.home', [
            'projects' => $projects,
        ]);
    }
}

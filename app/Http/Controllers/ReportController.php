<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index($project_id)
    {
        $project = Project::with('reports')->findOrFail($project_id);
        $reports = $project->reports()->paginate(10);

        return view('report.index', compact('project', 'reports'));
    }

    public function store(Request $request, $project_id)
    {

    }

    public function edit($project_id, $report_id)
    {

    }

    public function update(Request $request, $project_id, $report_id)
    {

    }
}

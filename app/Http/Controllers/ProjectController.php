<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\InspectionDependency;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskDependency;
use App\Models\TaskPayment;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::with('client');

        $client_id = $request->client;
        if ($client_id) $projects->where('client_id', $request->client);

        $projects = $projects->paginate(10);

        $filter_data = [
            'client' => $client_id,
        ];
        $projects->appends(array_filter($filter_data));

        return view('project.index', compact('projects', 'client_id'));
    }

    public function create(Request $request)
    {
        $clients = User::where('is_client', true);
        $client_id = $request->client;
        if ($client_id) $clients->where('id', $client_id);
        $clients = $clients->get();

        $access_token = auth()->user()->createToken('accessToken')->plainTextToken;

        return view('project.create', compact('clients', 'access_token', 'client_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id'                 => 'required|exists:users,id',
            'name'                      => 'required',
            'estimated_completion_date' => 'required|date_format:Y-m-d',
            'estimated_budget'          => 'required',
        ]);

        $project_data = [
            'client_id'                 => $request->client_id,
            'name'                      => $request->name,
            'estimated_completion_date' => $request->estimated_completion_date,
            'estimated_budget'          => $request->estimated_budget,
            'status'                    => $request->status,
            'comment'                   => $request->comment,
        ];

        try {
            $project = Project::create($project_data);

            return redirect()
                ->route('task.create', $project->id)
                ->with('success', 'Project created successfully');
        } catch (\Exception $exception) {
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function edit($project_id)
    {
        $project = Project::findOrFail($project_id);

        return view('project.edit', compact('project'));
    }

    public function update(Request $request, $project_id)
    {
        $request->validate([
            'name'                      => 'required',
            'estimated_completion_date' => 'required|date_format:Y-m-d',
            'estimated_budget'          => 'required',
        ]);

        $project = Project::findOrFail($project_id);

        $project_data = [
            'name'                      => $request->name,
            'estimated_completion_date' => $request->estimated_completion_date,
            'estimated_budget'          => $request->estimated_budget,
            'status'                    => $request->status,
            'comment'                   => $request->comment,
        ];

        try {
            $project->update($project_data);

            return redirect()
                ->route('task.create', $project_id)
                ->with('success', 'Project updated successfully');
        } catch (\Exception $exception) {
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }
}

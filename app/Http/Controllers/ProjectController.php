<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\SettingsTask;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::with('client')
            ->latest();

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
                ->route('project.default-task', $project->id)
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

    public function defaultTask($project_id)
    {
        $project = Project::withCount('tasks')->findOrFail($project_id);
        if ($project->tasks_count) return redirect()->route('task.create', $project->id);

        $default_tasks = SettingsTask::get();

        return view('project.default-task', compact('default_tasks', 'project'));
    }

    public function defaultTaskStore(Request $request, $project_id)
    {
        $request->validate([
            'tasks'                                 => 'required|array',
            'array.*.name'                          => 'required',
            'array.*.estimated_start_date'          => 'required|date_format:Y-m-d',
            'array.*.estimated_completion_date'     => 'required|date_format:Y-m-d|after_or_equal:tasks.*.estimated_start_date',
            'array.*.total_budget'                  => 'required|min:1',
        ]);

        $project = Project::findOrFail($project_id);

        $task_data = [];
        foreach ($request->tasks as $task) {
            if (!isset($task['checked']) || !$task['checked']) continue;

            $task_data[] = [
                'project_id'                => $project_id,
                'name'                      => $task['name'],
                'estimated_start_date'      => $task['estimated_start_date'],
                'estimated_completion_date' => $task['estimated_completion_date'],
                'status'                    => $task['status'],
                'total_budget'              => $task['total_budget'],
                'completion_percentage'     => $task['status'] == config('app.STATUSES.Completed') ? 100 : 0,
                'created_at'                => Carbon::now(),
                'updated_at'                => Carbon::now(),
            ];
        }

        try {
            if (count($task_data)) Task::insert($task_data);

            return redirect()
                ->route('project.default-payment', $project_id)
                ->with('success', 'Task added successfully');
        } catch (\Exception $exception) {
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }
}

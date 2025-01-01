<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\Payment;
use App\Models\Project;
use App\Models\SettingsInspection;
use App\Models\SettingsPayment;
use App\Models\SettingsTask;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $all_clients = auth()->user()->clients;
        $client = $request->client ? $all_clients->where('id', $request->client)->first() : null;

        $projects = Project::with('client')
            ->when($client,
                fn ($query) => $query->where('client_id', $client->id),
                fn ($query) => $query->whereIn('client_id', $all_clients->pluck('id')->toArray())
            )
            ->latest()
            ->paginate(10);

        $filter_data = $request->all();
        $projects->appends(array_filter($filter_data));

        return view('project.index', compact('projects', 'all_clients', 'client'));
    }

    public function create(Request $request)
    {
        $clients = auth()->user()->clients;

        $client_id = $request->client;
        if ($client_id) $clients = $clients->where('id', $client_id);

        $access_token = auth()->user()->createToken('accessToken')->plainTextToken;

        return view('project.create', compact('clients', 'access_token', 'client_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id'                 => 'required|exists:users,id',
            'name'                      => 'required',
            'estimated_completion_date' => 'required|date_format:Y-m-d|after:today',
        ]);

        $project_data = [
            'client_id'                 => $request->client_id,
            'name'                      => $request->name,
            'estimated_completion_date' => $request->estimated_completion_date,
            'estimated_budget'          => $request->estimated_budget,
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
        $project = Project::find($project_id);
        if (!$project) return back()->with('error', 'Project Not Found');

        return view('project.edit', compact('project'));
    }

    public function update(Request $request, $project_id)
    {
        $request->validate([
            'name'                      => 'required',
            'estimated_completion_date' => 'required|date_format:Y-m-d',
        ]);

        $project = Project::find($project_id);
        if (!$project) return back()->with('error', 'Project Not Found');

        $project_data = [
            'name'                      => $request->name,
            'estimated_completion_date' => $request->estimated_completion_date,
            'comment'                   => $request->comment,
        ];

        try {
            $project->update($project_data);

            return redirect()
                ->route('task.index', $project_id)
                ->with('success', 'Project updated successfully');
        } catch (\Exception $exception) {
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function clientUpdateStatus(Request $request, $project_id)
    {
        $request->validate([
            'status'    => 'required',
        ]);

        $project = auth()->user()
            ->projects()
            ->find($project_id);
        if (!$project) return back()->with('error', 'Project Not Found');

        $project_data = [
            'status'    => $request->status,
        ];

        try {
            $project->update($project_data);

            return back()->with('success', 'Project updated successfully');
        } catch (\Exception $exception) {
            return redirect()
                ->back()
                ->with('error', $exception->getMessage())
                ->withInput();
        }
    }

    public function defaultTask($project_id)
    {
        $project = Project::withCount('tasks')->find($project_id);
        if (!$project) return back()->with('error', 'Project Not Found');

        if ($project->tasks_count) return redirect()->route('task.index', $project->id);

        $default_tasks = SettingsTask::where('is_enabled', true)->get();

        return view('project.default-task', compact('default_tasks', 'project'));
    }

    public function defaultTaskStore(Request $request, $project_id)
    {
        $request->validate([
            'tasks'                                 => 'required|array',
            'tasks.*.name'                          => 'required',
            'tasks.*.estimated_start_date'          => 'required|date_format:Y-m-d',
            'tasks.*.estimated_completion_date'     => 'required|date_format:Y-m-d|after_or_equal:tasks.*.estimated_start_date|after:today',
        ]);

        $project = Project::find($project_id);
        if (!$project) return back()->with('error', 'Project Not Found');

        $task_data = [];
        foreach ($request->tasks as $task) {
            if (!isset($task['checked']) || !$task['checked']) continue;

            $task_data[] = [
                'project_id'                => $project->id,
                'name'                      => $task['name'],
                'estimated_start_date'      => $task['estimated_start_date'],
                'estimated_completion_date' => $task['estimated_completion_date'],
                'status'                    => config('app.STATUSES.Pending'),
                'completion_percentage'     => 0,
                'created_at'                => Carbon::now(),
                'updated_at'                => Carbon::now(),
            ];
        }

        try {
            if (count($task_data)) Task::insert($task_data);

            return redirect()
                ->route('project.index', $project_id)
                ->with('success', 'Task added successfully');
        } catch (\Exception $exception) {
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }
}

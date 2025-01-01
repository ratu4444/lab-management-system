<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index ()
    {
        $statuses = config('app.STATUSES');

        $user = auth()->user()
            ->load([
                'clients.projects' => fn ($projectQuery) => $projectQuery
                    ->withCount(['tasks' => fn ($taskQuery) => $taskQuery->where('status', '!=', $statuses['Canceled'])])
                    ->with('client:id,name')
            ]);

        $projects = $user->clients
            ->pluck('projects')
            ->flatten();

        $running_projects = $projects->filter(fn ($project) =>
            $project->status ===  $statuses['Pending']
            || ($project->completion_percentage > 0 && $project->completion_percentage < 100)
        );

        $project_reports = [
            'type'              => 'projects',
            'heading'           => 'Total Projects',
            'card_icon'         => 'fa fa-list',
            'card_background'   => 'l-bg-green',
            'count'             => $projects->count(),
            'url'               => route('project.index')
        ];

        $client_reports = [
            'type'              => 'clients',
            'heading'           => 'Total Researchers',
            'card_icon'         => 'fa fa-users',
            'card_background'   => 'l-bg-orange',
            'count'             => $user->clients->count(),
            'url'               => route('client.index')
        ];

        $task_reports = [
            'type'              => 'tasks',
            'heading'           => 'Total Tasks',
            'card_icon'         => 'fa fa-clipboard-list',
            'card_background'   => 'l-bg-red',
            'count'             => $projects->sum('tasks_count'),
            'url'               => null,
        ];

        $reports = [
            $project_reports,
            $client_reports,
            $task_reports,
        ];

        return view('index', compact('reports', 'running_projects'));
    }

    public function clientIndex(Request $request)
    {
        $request->validate([
            'project'   => 'nullable|exists:projects,id',
            'client'    => 'nullable|exists:users,id',
        ]);

        $user = auth()->user();
        $all_projects = $user->is_client
            ? Project::where('client_id', auth()->id())
                ->latest()
                ->get()
            : $user->load([
                'clients.projects' => fn ($projectQuery) => $projectQuery->with([
                    'tasks',
                    'reports' => fn ($reportQuery) => $reportQuery->where('is_active', true)->with('task:id,name'),
                    'client'
                ])
            ])->clients
                ->pluck('projects')
                ->flatten()
                ->when($request->client, fn ($projects) => $projects->where('client_id', $request->client));

        $project = $request->project ? $all_projects->where('id', $request->project)->first() : $all_projects->first();
        abort_unless($project, 404);

        return view('client-index', compact('project', 'all_projects'));
    }
}

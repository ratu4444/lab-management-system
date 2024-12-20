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

        $projects = Project::withCount(['tasks' => function($tasks) use ($statuses) {
            return $tasks->where('status', '!=', $statuses['Canceled']);
        }, 'inspections'])
            ->withSum(['payments' => function($paymentQuery) use ($statuses) {
                $paymentQuery->where('status', $statuses['Completed']);
            }], 'amount')
            ->with('client')
            ->get();

        $running_projects = $projects->filter(function ($project) use ($statuses) {
                return $project->status ==  $statuses['Pending'] ||
                    ($project->completion_percentage > 0
                    && $project->completion_percentage < 100);
            });

        $upcoming_inspections = Inspection::where('status', $statuses['Pending'])
            ->whereDate('scheduled_date', '<=', Carbon::now()->addDays(7))
            ->whereDate('scheduled_date', '>=', Carbon::now())
            ->with('project')
            ->get();

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
            'count'             => User::where('is_client', true)->count(),
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

        //changes
//        $payment_reports = [
//            'type'              => 'payments',
//            'heading'           => 'Total Payments',
//            'card_icon'         => 'fa fa-dollar-sign',
//            'card_background'   => 'l-bg-cyan',
//            'count'             => '$'.number_format($projects->sum('payments_sum_amount')),
//            'url'               => null,
//        ];
//
//        $inspection_reports = [
//            'type'              => 'inspections',
//            'heading'           => 'Total Inspections',
//            'card_icon'         => null,
//            'card_background'   => 'l-bg-purple-dark',
//            'count'             => $projects->sum('inspections_count'),
//            'url'               => null,
//        ];



        $reports = [
            $project_reports,
            $client_reports,
            $task_reports,

            //changes
//            $payment_reports,
//            $inspection_reports
        ];


        return view('index', compact('reports', 'running_projects', 'upcoming_inspections'));
    }

    public function clientIndex(Request $request)
    {
//        todo: when client has no project.
        $request->validate([
            'project' => 'nullable|exists:projects,id',
            'client' => 'nullable|exists:users,id',
        ]);

        $statuses = config('app.STATUSES');

        if (auth()->user()->is_client) $all_projects = Project::where('client_id', auth()->id());
        elseif($request->client) $all_projects = Project::where('client_id', $request->client);
        else $all_projects = Project::query();
        $all_projects = $all_projects->latest()->get();

        $project = $request->project ? $all_projects->where('id', $request->project)->first() : $all_projects->first();
        if (!$project) return abort(404);

        $project = $project->load([
            'client',
            'tasks',
            'payments' => function ($paymentQuery) use ($statuses) {
                $paymentQuery->where('status', $statuses['Completed'])->with('tasks');
            },
            'inspections',
            'reports' => function($reportQuery) {
                $reportQuery->where('is_active', true)
                    ->with('task:id,name');
            },
            'elementSettings'
        ]);

        $elements = [];
        foreach ($project->elementSettings as $element_setting) {
            $elements[$element_setting->element_id - 1] = [
                'element_name'  => $element_setting->element_name,
                'is_enabled'    => (bool) $element_setting->is_enabled,
            ];
        }

        return view('client-index', compact('project', 'all_projects', 'elements'));
    }
}

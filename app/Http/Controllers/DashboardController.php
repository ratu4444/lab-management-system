<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index ()
    {
        if (auth()->user()->is_client) return redirect()->route('dashboard.client-index');

        $projects = Project::withCount('tasks', 'inspections')
            ->withSum('payments', 'amount')
            ->with('client')
            ->get();

        $running_projects = $projects->where('status', config('app.STATUSES.In Progress'));
        $upcoming_inspections = Inspection::where('status', config('app.STATUSES.Pending'))
            ->whereDate('scheduled_date', '<=', Carbon::now()->addDays(7))
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
            'heading'           => 'Total Clients',
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

        $payment_reports = [
            'type'              => 'payments',
            'heading'           => 'Total Payments',
            'card_icon'         => 'fa fa-dollar-sign',
            'card_background'   => 'l-bg-cyan',
            'count'             => $projects->sum('payments_sum_amount'),
            'url'               => null,
        ];

        $inspection_reports = [
            'type'              => 'inspections',
            'heading'           => 'Total Inspections',
            'card_icon'         => null,
            'card_background'   => 'l-bg-purple-dark',
            'count'             => $projects->sum('inspections_count'),
            'url'               => null,
        ];


        $reports = [
            $project_reports,
            $client_reports,
            $task_reports,
            $payment_reports,
            $inspection_reports
        ];

        return view('index', compact('reports', 'running_projects', 'upcoming_inspections'));
    }


}

<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index ()
    {
        if (auth()->user()->is_client) {
            return view('project.show');
        }

        $projects = Project::with('client')
            ->paginate(10, ['*'], 'project_page');

        $clients = User::where('is_client', true)
            ->withCount('projects')
            ->paginate(10, ['*'], 'client_page');

        $total_projects = [
            'type'              => 'projects',
            'heading'           => 'Total Projects',
            'card_icon'         => 'fa fa-list',
            'card_background'   => 'l-bg-green',
            'count'             => Project::count(),
            'url'               => route('project.index')
        ];

        $total_clients = [
            'type'              => 'clients',
            'heading'           => 'Total Clients',
            'card_icon'         => 'fa fa-users',
            'card_background'   => 'l-bg-orange',
            'count'             => User::where('is_client', true)->count(),
            'url'               => route('client.index')
        ];

        $total_tasks = [
            'type'              => 'tasks',
            'heading'           => 'Total Tasks',
            'card_icon'         => 'fa fa-clipboard-list',
            'card_background'   => 'l-bg-red',
            'count'             => Task::count(),
            'url'               => null,
        ];

        $total_payments = [
            'type'              => 'payments',
            'heading'           => 'Total Payments',
            'card_icon'         => 'fa fa-dollar-sign',
            'card_background'   => 'l-bg-cyan',
            'count'             => Payment::sum('amount'),
            'url'               => null,
        ];

        $total_inspections = [
            'type'              => 'inspections',
            'heading'           => 'Total Inspections',
            'card_icon'         => null,
            'card_background'   => 'l-bg-purple-dark',
            'count'             => Inspection::count(),
            'url'               => null,
        ];


        $reports = [
            $total_projects,
            $total_clients,
            $total_tasks,
            $total_payments,
            $total_inspections
        ];

        return view('index', compact('projects', 'clients', 'reports'));
    }


}

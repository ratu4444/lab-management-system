<?php

namespace App\Http\Controllers;

use App\Models\Project;
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

        return view('index', compact('projects', 'clients'));
    }


}

<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create($project_id)
    {
//        $clients = User::where('is_client', true)->get();
        $access_token = auth()->user()->createToken('accessToken')->plainTextToken;

        $project = Project::with('tasks')->findOrFail($project_id);
        return view('task.create', compact('project', 'access_token'));
    }
}

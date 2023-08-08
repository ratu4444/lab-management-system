<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function create($project_id)
    {
//        $clients = User::where('is_client', true)->get();
        $access_token = auth()->user()->createToken('accessToken')->plainTextToken;

        $project = Project::with('tasks')->findOrFail($project_id);
        $tasks = Task::pluck('name');
        return view('task.create', compact('tasks','project', 'access_token', 'project_id'));

    }

    public function store(Request $request , $project_id)
    {
        $request->validate([
            'estimated_completion_date' => 'required|date_format:Y-m-d',
            'total_budget'              => 'required',
//          'dependency'              => 'required',
        ]);



        $task_data = [
            'project_id'                =>  $project_id,
            'name'                      => $request->name,
            'estimated_start_date'      => $request->estimated_start_date,
            'estimated_completion_date' => $request->estimated_completion_date,
            'total_budget'              => $request->total_budget,
            'status'                    => $request->status,
            'comment'                   => $request->comment,
        ];
        try {

            $task = Task::create($task_data);
            return redirect()->route('store.create');
        } catch (\Exception $exception) {
            return redirect()->back();
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\TaskDependency;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function create($project_id)
    {
        $project = Project::with('tasks')->findOrFail($project_id);
        return view('task.create', compact('project', 'project_id'));
    }

    public function store(Request $request , $project_id)
    {
//        dd($request);
        $request->validate([
            'estimated_completion_date' => 'required|date_format:Y-m-d',
            'total_budget'              => 'required',
//          'dependency'              => 'required',
        ]);

        $task_data = [
            'project_id'                => $project_id,
            'name'                      => $request->name,
            'estimated_start_date'      => $request->estimated_start_date,
            'estimated_completion_date' => $request->estimated_completion_date,
            'total_budget'              => $request->total_budget,
            'status'                    => $request->status,
            'comment'                   => $request->comment,
        ];

        DB::beginTransaction();
        try {
            $task = Task::create($task_data);

            $task_dependencies_data = [];

            if ($request->dependencies ){
            foreach ($request->dependencies as $dependency) {
                $task_dependencies_data[] = [
                    'task_id'           => $task->id,
                    'dependent_task_id' => $dependency,
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                ];
            }}

            if (count($task_dependencies_data)) TaskDependency::insert($task_dependencies_data);
            DB::commit();

            return back();
        } catch (\Exception $exception) {
            DB::rollBack();

            dd($exception->getMessage());
            return redirect()->back();
        }
    }
}

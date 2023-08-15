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
        $request->validate([
            'name'                      => 'required',
            'estimated_start_date'      => 'required|date_format:Y-m-d',
            'estimated_completion_date' => 'required|date_format:Y-m-d',
            'total_budget'              => 'required',
        ]);

        $project = Project::findOrFail($project_id);

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
            if ($request->dependencies) {
                foreach ($request->dependencies as $dependency) {
                    $task_dependencies_data[] = [
                        'task_id'           => $task->id,
                        'dependent_task_id' => $dependency,
                        'created_at'        => Carbon::now(),
                        'updated_at'        => Carbon::now(),
                    ];
                }
            }

            if (count($task_dependencies_data)) TaskDependency::insert($task_dependencies_data);

            DB::commit();

            return back()
                ->with('success', 'Task created successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function edit($task_id)
    {
        $task = Task::with('dependentTasks')->findOrFail($task_id);

        $task->dependent_task_ids = $task->dependentTasks->pluck('id')->toArray();
        $project_tasks = Task::where('project_id', $task->project_id)->where('id','!=', $task_id)->get();

        return view('task.edit', compact('task', 'project_tasks'));
    }

    public function update(Request $request, $task_id)
    {
        $request->validate([
            'name'                          => 'required',
            'estimated_start_date'          => 'required|date_format:Y-m-d',
            'estimated_completion_date'     => 'required|date_format:Y-m-d',
            'total_budget'                  => 'required',
        ]);

        $task = Task::with('taskDependencies')->findOrFail($task_id);

        $task_data = [
            'name'                      => $request->name,
            'estimated_start_date'      => $request->estimated_start_date,
            'estimated_completion_date' => $request->estimated_completion_date,
            'total_budget'              => $request->total_budget,
            'status'                    => $request->status,
            'comment'                   => $request->comment,
        ];

        DB::beginTransaction();

        try {
            $task->update($task_data);

            $task->taskDependencies()->delete();

            $task_dependencies_data = [];
            if ($request->dependencies) {
                foreach ($request->dependencies as $dependency) {
                    $task_dependencies_data[] = [
                        'task_id'           => $task->id,
                        'dependent_task_id' => $dependency,
                        'created_at'        => Carbon::now(),
                        'updated_at'        => Carbon::now(),
                    ];
                }
            }
            if (count($task_dependencies_data)) TaskDependency::insert($task_dependencies_data);

            DB::commit();
            return redirect()
                ->route('task.create', $task->project_id)
                ->with('success', 'Task updated successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }
}

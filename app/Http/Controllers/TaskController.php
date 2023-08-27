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
    public function index($project_id)
    {
        $project = Project::with('tasks')->findOrFail($project_id);
        $tasks = $project->tasks()->paginate(10);

        return view('task.index', compact('project', 'tasks'));
    }

    public function store(Request $request , $project_id)
    {
        $request->validate([
            'name'                      => 'required',
            'estimated_start_date'      => 'required|date_format:Y-m-d',
            'estimated_completion_date' => 'required|date_format:Y-m-d|after_or_equal:estimated_start_date',
            'total_budget'              => 'required',
            'completion_percentage'     => 'nullable|between:0,100'
        ]);

        $project = Project::findOrFail($project_id);

        $statuses = config('app.STATUSES');
        switch ($request->completion_percentage) {
            case $statuses['Pending']:
                $completion_percentage = 0;
            break;
            case $statuses['Completed']:
                $completion_percentage = 100;
            break;
            default:
                $completion_percentage = $request->completion_percentage ?? 0;
        }

        $task_data = [
            'project_id'                => $project_id,
            'name'                      => $request->name,
            'estimated_start_date'      => $request->estimated_start_date,
            'estimated_completion_date' => $request->estimated_completion_date,
            'total_budget'              => $request->total_budget,
            'status'                    => $request->status,
            'completion_percentage'     => $completion_percentage,
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

    public function edit($project_id, $task_id)
    {
        $project = Project::with('tasks.dependentTasks')
            ->findOrFail($project_id);

        $task = $project->tasks->where('id', $task_id)->first();
        if (!$task) return abort(404);
        $task->dependent_task_ids = $task->dependentTasks->pluck('id')->toArray();

        return view('task.edit', compact('task', 'project'));
    }

    public function update(Request $request, $project_id, $task_id)
    {
        $request->validate([
            'name'                      => 'required',
            'estimated_start_date'      => 'required|date_format:Y-m-d',
            'estimated_completion_date' => 'required|date_format:Y-m-d|after_or_equal:estimated_start_date',
            'start_date'                => 'nullable|date_format:Y-m-d',
            'completion_date'           => 'nullable|date_format:Y-m-d|after_or_equal:start_date',
            'total_budget'              => 'required',
            'completion_percentage'     => 'nullable|between:0,100'
        ]);

        $task = Task::with('taskDependencies')->findOrFail($task_id);
        $statuses = config('app.STATUSES');
        switch ($request->completion_percentage) {
            case $statuses['Pending']:
                $completion_percentage = 0;
                break;
            case $statuses['Completed']:
                $completion_percentage = 100;
                break;
            default:
                $completion_percentage = $request->completion_percentage ?? 0;
        }

        $task_data = [
            'name'                      => $request->name,
            'estimated_start_date'      => $request->estimated_start_date,
            'estimated_completion_date' => $request->estimated_completion_date,
            'start_date'                => $request->start_date,
            'completion_date'           => $request->completion_date,
            'total_budget'              => $request->total_budget,
            'status'                    => $request->status,
            'completion_percentage'     => $completion_percentage,
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
                ->route('task.index', $project_id)
                ->with('success', 'Task updated successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }
}

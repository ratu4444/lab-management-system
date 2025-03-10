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
        $project = Project::with('tasks')->find($project_id);
        if (!$project) return back()->with('error', 'Project Not Found');

        $tasks = $project->tasks()->paginate(10);

        return view('task.index', compact('project', 'tasks'));
    }

    public function store(Request $request , $project_id)
    {
        $request->validate([
            'name'                      => 'required',
            'estimated_start_date'      => 'required|date_format:Y-m-d',
            'estimated_completion_date' => 'required|date_format:Y-m-d|after_or_equal:estimated_start_date',
        ]);

        $task_data = [
            'project_id'                => $project_id,
            'name'                      => $request->name,
            'estimated_start_date'      => $request->estimated_start_date,
            'estimated_completion_date' => $request->estimated_completion_date,
        ];

        try {
            Task::create($task_data);

            return back()
                ->with('success', 'Task created successfully');
        } catch (\Exception $exception) {
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function edit($project_id, $task_id)
    {
        $project = Project::with('tasks.dependentTasks')
            ->find($project_id);
        if (!$project) return back()->with('error', 'Project Not Found');

        $task = $project->tasks->where('id', $task_id)->first();
        if (!$task) return back()->with('error', 'Task Not Found');

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
            'completion_percentage'     => 'nullable|between:0,100'
        ]);

        $task = Task::with('taskDependencies')->find($task_id);
        if (!$task) return back()->with('error', 'Task Not Found');

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

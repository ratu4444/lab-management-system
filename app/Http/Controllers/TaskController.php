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
            'estimated_completion_date' => 'required|date_format:Y-m-d',
            'total_budget'              => 'required',
        ]);

        $project = Project::find($project_id);

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

            $project->total_budget += $request->total_budget;
            $project->save();

            DB::commit();

            return back();
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function edit($project_id)
    {
        $project = Project::where('id', $project_id)->first();
//        dd('ok');
//        $task = Task::where('project_id', $project_id)->first();
//        $tasks = Task::get();
//        $task = $tasks->where('project_id', $project_id)->first();


//        $task_dependencies = TaskDependency::where('task_id', 7)->get();
//        dd($task_dependencies->id);
//         foreach ($task_dependencies as $task_dependency){
//            $task_dependency_id[] =[
//                $task_dependency->id];
//        }
//         dd($task_dependency_id);
//        $dependent_task_name = $tasks->where('id',foreach($task_dependency_id as $task_dependencies_name){
//
//         dd($dependent_task_name);
//        foreach ($task_dependencies as $task_dependency){
//            $task_dependency;
//        }
//

        return view('task.edit', compact('task', 'task_dependency', 'dependent_task_name'));
    }

}

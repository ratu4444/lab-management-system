<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskDependency;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function create()
    {
        $clients = User::where('is_client', true)->get();

        return view('create-project.create-project', compact('clients'));
    }

    public function storeClient(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required',
        ]);

        $client_data = [
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'mobile'        => $request->mobile,
            'company_name'  => $request->company_name,
        ];

        try {
            $user = User::create($client_data);

            $data = $this->formatUser($user);
            return $this->apiResponse($data, 'User created successfully');
        } catch (\Exception $exception) {
            return $this->apiResponse([], $exception->getMessage(), 500);
        }
    }

    public function storeProject(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'client_id'                 => 'required|exists:users,id',
            'estimated_completion_date' => 'required|date_format:Y-m-d',
            'estimated_budget'          => 'required',
        ]);

        $project_data = [
            'client_id'                 => $request->client_id,
            'name'                      => $request->name,
            'estimated_completion_date' => $request->estimated_completion_date,
            'estimated_budget'          => $request->estimated_budget,
            'status'                    => $request->status,
            'comment'                   => $request->comment,
        ];

        try {
            $project = Project::create($project_data);

            $data = $this->formatProject($project);
            return $this->apiResponse($data, 'Project created successfully');
        } catch (\Exception $exception) {
            return $this->apiResponse([], $exception->getMessage(), 500);
        }
    }

    public function storeTask(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'project_id'                => 'required|exists:projects,id',
            'estimated_start_date'      => 'required|date_format:Y-m-d',
            'estimated_completion_date' => 'required|date_format:Y-m-d',
            'total_budget'              => 'required',
            'dependent_task_ids'        => 'array',
            'dependent_task_ids.*'      => 'exists:tasks,id'
        ]);

        $task_data = [
            'project_id'                => $request->project_id,
            'name'                      => $request->name,
            'estimated_start_date'      => $request->estimated_start_date,
            'estimated_completion_date' => $request->estimated_completion_date,
            'start_date'                => $request->start_date,
            'completion_date'           => $request->completion_date,
            'total_budget'              => $request->total_budget,
            'status'                    => $request->status,
            'comment'                   => $request->comment,
        ];

        DB::beginTransaction();
        try {
            $task = Task::create($task_data);

            $task_dependencies_data = [];
            foreach ($request->dependent_task_ids as $dependent_task_id) {
                $task_dependencies_data[] = [
                    'task_id'           => $task->id,
                    'dependent_task_id' => $dependent_task_id
                ];
            }
            if (count($task_dependencies_data)) TaskDependency::insert($task_dependencies_data);

            $task->project->update([
                'total_budget' => $task->project->total_budget + $task->total_budget
            ]);

            DB::commit();

            $data = $this->formatTask($task);
            return $this->apiResponse($data, 'Project created successfully');
        } catch (\Exception $exception) {
            DB::rollBack();

            return $this->apiResponse([], $exception->getMessage(), 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\InspectionDependency;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskDependency;
use App\Models\TaskPayment;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::with('client');

        $client_id = $request->client;
        if ($client_id) $projects->where('client_id', $request->client);

        $projects = $projects->paginate(10);

        $filter_data = [
            'client'  => $client_id,
        ];
        $projects->appends(array_filter($filter_data));

        return view('project.index', compact('projects', 'client_id'));
    }

    public function create(Request $request)
    {
        $clients = User::where('is_client', true);
//      $clients->with('projects');
        $client_id = $request->client;
        if ($client_id) $clients->where('id', $client_id);

        $clients = $clients->get();

        $access_token = auth()->user()->createToken('accessToken')->plainTextToken;

        return view('project.create', compact('clients', 'access_token', 'client_id'));
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
//            'estimated_start_date'      => 'required|exists:users,id',
            'name'                      => 'required',
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

            return redirect()->route('task.create', $project->id);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return redirect()->back();
        }
    }

    public function createPayment()
    {
//        $clients = User::where('is_client', true)->get();
//        $access_token = auth()->user()->createToken('accessToken')->plainTextToken;

        return view('project.create-payment');
    }



    public function createInspection()
    {
//        $clients = User::where('is_client', true)->get();
//        $access_token = auth()->user()->createToken('accessToken')->plainTextToken;

        return view('project.create-inspection');
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
            'is_client'     => true,
        ];

        try {
            $user = User::create($client_data);

            $data = $this->formatUser($user);
            return $this->apiResponse($data, 'User created successfully');
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

    public function storePayment(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'project_id'    => 'required|exists:projects,id',
            'amount'        => 'required|min:0',
            'date'          => 'required|date_format:Y-m-d',
            'task_ids'      => 'array',
            'task_ids.*'    => 'exists:tasks,id',
        ]);

        $project = Project::find($request->project_id);

        $payment_data = [
            'project_id'        => $request->project_id,
            'client_id'         => $project->client_id,
            'name'              => $request->name,
            'amount'            => $request->amount,
            'date'              => $request->date,
            'payment_method'    => $request->payment_method ?? 'Cash',
            'comment'           => $request->comment,
        ];

        DB::beginTransaction();
        try {
            $payment = Payment::create($payment_data);

            $payment_tasks_data = [];
            foreach ($request->task_ids as $task_id) {
                $payment_tasks_data[] = [
                    'payment_id'    => $payment->id,
                    'task_id'       => $task_id,
                ];
            }
            if (count($payment_tasks_data)) TaskPayment::insert($payment_tasks_data);

            DB::commit();

            $data = $this->formatPayment($payment);
            return $this->apiResponse($data, 'Payment created successfully');
        } catch (\Exception $exception) {
            DB::rollBack();

            return $this->apiResponse([], $exception->getMessage(), 500);
        }
    }

    public function storeInspection(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'project_id'            => 'required|exists:projects,id',
            'scheduled_date'        => 'required|date_format:Y-m-d',
            'dependent_task_ids'    => 'array',
            'dependent_task_ids.*'  => 'exists:tasks,id'
        ]);

        $inspection_data = [
            'project_id'        => $request->project_id,
            'name'              => $request->name,
            'status'            => $request->status,
            'scheduled_date'    => $request->scheduled_date,
            'date'              => $request->date,
            'comment'           => $request->comment,
        ];

        DB::beginTransaction();
        try {
            $inspection = Inspection::create($inspection_data);

            $inspection_dependencies_data = [];
            foreach ($request->dependent_task_ids as $dependent_task_id) {
                $inspection_dependencies_data[] = [
                    'inspection_id'     => $inspection->id,
                    'dependent_task_id' => $dependent_task_id
                ];
            }
            if (count($inspection_dependencies_data)) InspectionDependency::insert($inspection_dependencies_data);

            DB::commit();

            $data = $this->formatInspection($inspection);
            return $this->apiResponse($data, 'Inspection created successfully');
        } catch (\Exception $exception) {
            DB::rollBack();

            return $this->apiResponse([], $exception->getMessage(), 500);
        }
    }
}

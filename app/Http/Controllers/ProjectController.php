<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\Payment;
use App\Models\Project;
use App\Models\SettingsInspection;
use App\Models\SettingsPayment;
use App\Models\SettingsTask;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::with('client')
            ->latest();

        $all_clients = User::where('is_client', true)->select('id', 'name')->get();
        $client = $request->client ? $all_clients->where('id', $request->client)->first() : null;
        if ($client) $projects->where('client_id', $client->id);

        $projects = $projects->paginate(10);

        $filter_data = $request->all();
        $projects->appends(array_filter($filter_data));

        return view('project.index', compact('projects', 'all_clients', 'client'));
    }

    public function create(Request $request)
    {
        $clients = User::where('is_client', true);
        $client_id = $request->client;
        if ($client_id) $clients->where('id', $client_id);
        $clients = $clients->get();

        $access_token = auth()->user()->createToken('accessToken')->plainTextToken;

        return view('project.create', compact('clients', 'access_token', 'client_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id'                 => 'required|exists:users,id',
            'name'                      => 'required',
            'estimated_completion_date' => 'required|date_format:Y-m-d|after:today',
//              Changes
//            'estimated_budget'          => 'required',
        ]);

        $project_data = [
            'client_id'                 => $request->client_id,
            'name'                      => $request->name,
            'estimated_completion_date' => $request->estimated_completion_date,
            'estimated_budget'          => $request->estimated_budget,
//            'status'                    => $request->status,
            'comment'                   => $request->comment,
        ];

        try {
            $project = Project::create($project_data);

            return redirect()
                ->route('project.default-task', $project->id)
                ->with('success', 'Project created successfully');
        } catch (\Exception $exception) {
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function edit($project_id)
    {
        $project = Project::findOrFail($project_id);

        return view('project.edit', compact('project'));
    }

    public function update(Request $request, $project_id)
    {
        $request->validate([
            'name'                      => 'required',
            'estimated_completion_date' => 'required|date_format:Y-m-d',
//            'estimated_budget'          => 'required',
        ]);

        $project = Project::findOrFail($project_id);

        $project_data = [
            'name'                      => $request->name,
            'estimated_completion_date' => $request->estimated_completion_date,
//            'estimated_budget'          => $request->estimated_budget,
//            'status'                    => $request->status,
            'comment'                   => $request->comment,
        ];

        try {
            $project->update($project_data);

            return redirect()
                ->route('task.index', $project_id)
                ->with('success', 'Project updated successfully');
        } catch (\Exception $exception) {
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function clientUpdateStatus(Request $request, $project_id)
    {
        $request->validate([
            'status'    => 'required',
        ]);

        $project = auth()->user()
            ->projects()
            ->findOrFail($project_id);

        $project_data = [
            'status'    => $request->status,
        ];

        try {
            $project->update($project_data);

            return back()->with('success', 'Project updated successfully');
        } catch (\Exception $exception) {
            return redirect()
                ->back()
                ->with('error', $exception->getMessage())
                ->withInput();
        }
    }

    public function defaultTask($project_id)
    {
        $project = Project::withCount('tasks')->findOrFail($project_id);
        if ($project->tasks_count) return redirect()->route('task.index', $project->id);

        $default_tasks = SettingsTask::where('is_enabled', true)->get();

        return view('project.default-task', compact('default_tasks', 'project'));
    }

    public function defaultTaskStore(Request $request, $project_id)
    {
        $request->validate([
            'tasks'                                 => 'required|array',
            'tasks.*.name'                          => 'required',
            'tasks.*.estimated_start_date'          => 'required|date_format:Y-m-d',
            'tasks.*.estimated_completion_date'     => 'required|date_format:Y-m-d|after_or_equal:tasks.*.estimated_start_date|after:today',
//          Changes
//            'tasks.*.total_budget'                  => 'required',
        ]);

        $project = Project::findOrFail($project_id);

        $task_data = [];
        foreach ($request->tasks as $task) {
            if (!isset($task['checked']) || !$task['checked']) continue;

            $task_data[] = [
                'project_id'                => $project->id,
                'name'                      => $task['name'],
                'estimated_start_date'      => $task['estimated_start_date'],
                'estimated_completion_date' => $task['estimated_completion_date'],
                'status'                    => config('app.STATUSES.Pending'),
//                Changes
//                'total_budget'              => $task['total_budget'],
                'completion_percentage'     => 0,
                'created_at'                => Carbon::now(),
                'updated_at'                => Carbon::now(),
            ];
        }

        try {
            if (count($task_data)) Task::insert($task_data);

            return redirect()
                ->route('project.index', $project_id)
                ->with('success', 'Task added successfully');
        } catch (\Exception $exception) {
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }

//    public function defaultPayment($project_id)
//    {
//        $project = Project::withCount('payments')->findOrFail($project_id);
//        if ($project->payments_count) return redirect()->route('payment.index', $project->id);
//
//        $default_payments = SettingsPayment::where('is_enabled', true)->get();
//
//        return view('project.default-payment', compact('default_payments', 'project'));
//    }

//    public function defaultPaymentStore(Request $request, $project_id)
//    {
//        $request->validate([
//            'payments'                              => 'required|array',
//            'payments.*.name'                       => 'required',
//            'payments.*.date'                       => 'required|date_format:Y-m-d',
//            'payments.*.amount'                     => 'required|min:1',
//            'payments.*.payment_method'             => 'required',
//        ]);
//
//        $project = Project::findOrFail($project_id);
//
//        $payment_data = [];
//        foreach ($request->payments as $payment) {
//            if (!isset($payment['checked']) || !$payment['checked']) continue;
//
//            $payment_data[] = [
//                'project_id'        => $project->id,
//                'client_id'         => $project->client_id,
//                'name'              => $payment['name'],
//                'date'              => $payment['date'],
//                'amount'            => $payment['amount'],
//                'payment_method'    => $payment['payment_method'],
//                'created_at'        => Carbon::now(),
//                'updated_at'        => Carbon::now(),
//            ];
//        }
//
//        try {
//            if (count($payment_data)) Payment::insert($payment_data);
//
//            return redirect()
//                ->route('project.default-inspection', $project_id)
//                ->with('success', 'Payment added successfully');
//        } catch (\Exception $exception) {
//            return redirect()
//                ->back()
//                ->with('error', $exception->getMessage());
//        }
//    }

//    public function defaultInspection($project_id)
//    {
//        $project = Project::withCount('inspections')->findOrFail($project_id);
//        if ($project->inspections_count) return redirect()->route('inspection.index', $project->id);
//
//        $default_inspections = SettingsInspection::where('is_enabled', true)->get();
//
//        return view('project.default-inspection', compact('default_inspections', 'project'));
//    }

//    public function defaultInspectionStore(Request $request, $project_id)
//    {
//        $request->validate([
//            'inspections'                   => 'required|array',
//            'inspections.*.name'            => 'required',
//            'inspections.*.scheduled_date'  => 'required|date_format:Y-m-d',
//        ]);
//
//        $project = Project::findOrFail($project_id);
//
//        $inspection_data = [];
//        foreach ($request->inspections as $inspection) {
//            if (!isset($inspection['checked']) || !$inspection['checked']) continue;
//
//            $inspection_data[] = [
//                'project_id'        => $project->id,
//                'name'              => $inspection['name'],
//                'scheduled_date'    => $inspection['scheduled_date'],
//                'status'            => config('app.STATUSES.Pending'),
//                'created_at'        => Carbon::now(),
//                'updated_at'        => Carbon::now(),
//            ];
//        }
//
//        try {
//            if (count($inspection_data)) Inspection::insert($inspection_data);
//
//            return redirect()
//                ->route('task.index', $project_id)
//                ->with('success', 'Inspection added successfully');
//        } catch (\Exception $exception) {
//            return redirect()
//                ->back()
//                ->with('error', $exception->getMessage());
//        }
//    }
}

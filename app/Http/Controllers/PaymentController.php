<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Project;
use App\Models\TaskPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function create($project_id)
    {
        $project = Project::with('tasks')->findOrFail($project_id);

        return view('payment.create', compact(  'project'));
    }

    public function store(Request $request, $project_id)
    {
        $request->validate([
            'name'              => 'required|string',
            'amount'            => 'required',
            'date'              => 'required|date_format:Y-m-d',
            'payment_method'    => 'required'
        ]);

        $project = Project::findOrFail($project_id);
        $client_id = $project->client_id;

        $payment_data = [
            'project_id'                => $project_id,
            'client_id'                 => $client_id,
            'name'                      => $request->name,
            'amount'                    => $request->amount,
            'date'                      => $request->date,
            'payment_method'            => $request->payment_method,
            'comment'                   => $request->comment,
        ];

        DB::beginTransaction();
        try {
            $payment = Payment::create($payment_data);

            $payment_task_data = [];
            if ($request->tasks) {
                foreach ($request->tasks as $task) {
                    $payment_task_data [] = [
                        'payment_id'    => $payment->id,
                        'task_id'       => $task,
                        'created_at'    => Carbon::now(),
                        'updated_at'    => Carbon::now(),
                    ];
                }
            }

            if(count($payment_task_data)) TaskPayment::insert($payment_task_data);

            DB::commit();
            return redirect()
                ->back()
                ->with('success', 'Payment created successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function edit($project_id, $payment_id)
    {
        $project = Project::with('tasks', 'payments.tasks')
            ->findOrFail($project_id);

        $payment = $project->payments->where('id', $payment_id)->first();
        if (!$payment) return abort(404);
        $payment->dependent_task_ids = $payment->tasks->pluck('id')->toArray();

        return view('payment.edit', compact('payment', 'project'));
    }

    public function update(Request $request, $project_id, $payment_id)
    {
        $request->validate([
            'name'              => 'required|string',
            'amount'            => 'required',
            'date'              => 'required|date_format:Y-m-d',
            'payment_method'    => 'required'
        ]);

        $payment = Payment::with('taskPayments')->findOrFail($payment_id);

        $payment_data = [
            'name'              => $request->name,
            'amount'            => $request->amount,
            'date'              => $request->date,
            'payment_method'    => $request->payment_method,
            'comment'           => $request->comment,
        ];

        DB::beginTransaction();

        try {
            $payment->update($payment_data);

            $payment->taskPayments()->delete();

            $payment_dependencies_data = [];
            if ($request->tasks) {
                foreach ($request->tasks as $task) {
                    $payment_dependencies_data[] = [
                        'payment_id'    => $payment->id,
                        'task_id'       => $task,
                        'created_at'    => Carbon::now(),
                        'updated_at'    => Carbon::now(),
                    ];
                }
            }

            if (count($payment_dependencies_data)) TaskPayment::insert($payment_dependencies_data);

            DB::commit();
            return redirect()
                ->route('payment.create', $project_id)
                ->with('success', 'Payment updated successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }
}

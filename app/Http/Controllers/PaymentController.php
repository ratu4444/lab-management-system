<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskDependency;
use App\Models\TaskPayment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function create($project_id)
    {
        $project = Project::with('tasks', 'inspections')->where('id', $project_id)->firstOrFail();
        return view('payment.create', compact(  'project'));
    }

    public function store(Request $request, $project_id)
    {
        $request->validate([
            'amount' => 'required',
        ]);

        $project = Project::where('id', $project_id)->first();

        $client_id = $project->client_id;

        $payment_data = [
            'project_id'                =>  $project_id,
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

            if ($request->tasks){
            foreach ($request->tasks as $task) {
                $payment_task_data [] = [
                    'payment_id' => $payment->id,
                    'task_id' => $task,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }}

            if(count($payment_task_data)) TaskPayment::insert($payment_task_data);
            DB::commit();
            return redirect()->back();
        } catch (\Exception $exception) {
//            dd($exception->getMessage());
            DB::rollBack();
            return redirect()->back();
        }
    }


    public function edit($payment_id){

        $payment = Payment::with('dependentTasks')->findOrFail($payment_id);

        $payment->dependent_payment_ids = $payment->dependentTasks->pluck('id')->toArray();
        $payment_task = Task::where('project_id', $payment->project_id)->get();

        return view('payment.edit', compact('payment', 'payment_task'));


    }

    public function update(Request $request, $payment_id){
//        dd($request);

        $request->validate([
            'name' => 'required',
            'date' => 'required|date_format:Y-m-d',
            'amount' => 'required',
        ]);

        $payment = Payment::with('taskPayments')->findOrFail($payment_id);

        $payment_data = [
            'name'                      => $request->name,
            'amount'                    => $request->amount,
            'date'                      => $request->date,
            'payment_method'            => $request->payment_method,
            'comment'                   => $request->comment,

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
//            dd('ok');
            if (count($payment_dependencies_data)){
                $dependency = TaskPayment::insert($payment_dependencies_data);
            }
            DB::commit();
            return redirect()->route('payment.create', $payment->project_id);
        } catch (\Exception $exception) {
//            dd($exception->getLine());
            return redirect()->back();
        }
    }
}

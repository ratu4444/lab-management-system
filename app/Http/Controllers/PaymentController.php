<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskPayment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function create($project_id)
    {
        $project = Project::with('tasks', 'payments')->where('id', $project_id)->firstOrFail();
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
            $payment_dependency = [];
//
            $payment_dependency [] = [
                'payment_id'    => $payment->id,
                'task_id'       =>  $project->task->id,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
        ];

            if(count($payment_dependency)) TaskPayment::insert($payment_dependency);
            DB::commit();
            return redirect()->back();
        } catch (\Exception $exception) {
//            dd($exception->getMessage());
            DB::rollBack();
            return redirect()->back();
        }
    }
}

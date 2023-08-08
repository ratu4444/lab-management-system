<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create($project_id)
    {

//      dd($project_id);
        $access_token = auth()->user()->createToken('accessToken')->plainTextToken;

        $payments = Payment::where('project_id', $project_id)->get();
        $tasks = Task::pluck('name');
        return view('payment.create', compact(  'tasks','payments','access_token','project_id'));

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
        try {

            $payment = Payment::create($payment_data);
            return redirect()->back();
        } catch (\Exception $exception) {
//            dd($exception->getMessage());
            return redirect()->back();
        }
    }
}

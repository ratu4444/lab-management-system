<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create($project_id)
    {
 dd('ok');
//        $clients = User::where('is_client', true)->get();
        $access_token = auth()->user()->createToken('accessToken')->plainTextToken;

        $task = Task::with('payments')->findOrFail($project_id);
//        dd($task);
        return view('payment.create', compact('task', 'access_token'));

    }

    public function store(Request $request , $project_id)
    {
        $request->validate([
            'estimated_completion_date' => 'required|date_format:Y-m-d',
            'total_budget'          => 'required',
//            'dependency'                => 'required',
        ]);



        $task_data = [
            'project_id' =>  $project_id,
            'name'                      => $request->name,
            'estimated_start_date'      => $request->estimated_start_date,
            'estimated_completion_date' => $request->estimated_completion_date,
            'total_budget'              => $request->total_budget,
            'status'                    => $request->status,
            'comment'                   => $request->comment,
        ];
        try {

            $task = Task::create($task_data);
            return redirect()->route('store.create');
        } catch (\Exception $exception) {
            return redirect()->back();
        }
    }
}

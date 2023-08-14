<?php

namespace App\Http\Controllers;

use App\Models\SettingsTask;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function create(){
        return view('settings.create-task');
    }

    public function store(Request $request){

        $task_data = [
            'name'   => $request->name,
            'status' => $request->status,
            'budget' => $request->total_budget,
            'comment'=> $request->comment,
        ];

        $task_settings = SettingsTask::create($task_data);
        return redirect()->back();

    }
}

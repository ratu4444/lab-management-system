<?php

namespace App\Http\Controllers;

use App\Models\SettingsInspection;
use App\Models\SettingsPayment;
use App\Models\SettingsTask;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function taskCreate(){
        return view('settings.create-task');
    }

    public function taskStore(Request $request){

        $task_data = [
            'name'   => $request->name,
            'status' => $request->status,
            'budget' => $request->total_budget,
            'comment'=> $request->comment,
        ];

        $settings_task = SettingsTask::create($task_data);
        return redirect()->back();
    }

    public function paymentCreate(){
        return view('settings.create-payment');
    }

    public function paymentStore(Request $request){

        $payment_data = [
            'name'   => $request->name,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'comment'=> $request->comment,
        ];


        $settings_payment = SettingsPayment::create($payment_data);
        return redirect()->back();
    }

    public function inspectionCreate(){
        return view('settings.create-inspection');
    }

    public function inspectionStore(Request $request){

        $inspection_data = [
            'name'   => $request->name,
            'status' => $request->status,
            'comment'=> $request->comment,
        ];


        $settings_inspection = SettingsInspection::create($inspection_data);
        return redirect()->back();
    }

}

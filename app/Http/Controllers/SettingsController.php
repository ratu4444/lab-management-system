<?php

namespace App\Http\Controllers;

use App\Models\ElementSetting;
use App\Models\Project;
use App\Models\SettingsInspection;
use App\Models\SettingsPayment;
use App\Models\SettingsTask;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function taskStore(Request $request)
    {
        $task_data = [
            'name'   => $request->name,
            'status' => $request->status,
            'budget' => $request->total_budget,
            'comment'=> $request->comment,
        ];

        $settings_task = SettingsTask::create($task_data);
        return redirect()->back();
    }

    public function taskShow()
    {
        $task_show = SettingsTask::get();
        return view('settings.settings-task', compact('task_show'));
    }

    public function paymentStore(Request $request)
    {
        $payment_data = [
            'name'              => $request->name,
            'amount'            => $request->amount,
            'payment_method'    => $request->payment_method,
            'comment'           => $request->comment,
        ];

        $settings_payment = SettingsPayment::create($payment_data);
        return redirect()->back();
    }

    public function paymentShow()
    {
        $payment_show = SettingsPayment::get();
        return view('settings.settings-payment', compact('payment_show'));
    }

    public function inspectionStore(Request $request)
    {
        $inspection_data = [
            'name'   => $request->name,
            'status' => $request->status,
            'comment'=> $request->comment,
        ];

        $settings_inspection = SettingsInspection::create($inspection_data);
        return redirect()->back();
    }

    public function inspectionShow()
    {
        $inspection_show = SettingsInspection::get();
        return view('settings.settings-inspection', compact('inspection_show'));
    }

    public function elementShow(Request $request)
    {
//        dd($request->all());
        $all_projects = Project::get();
        $project = $request->project ? $all_projects->where('id', $request->project)->first()  : $all_projects->first();

        return view('settings.settings-element', compact('all_projects', 'project'));
    }

    public function elementStore(Request $request, $project_id)
    {
        $element_data = [];
        foreach ($request->elements as $index => $element) {
            $element_data[] = [
                'project_id'    => $project_id,
                'element_id'    => $index+1,
                'element_name'  => $element['title'],
                'is_enabled'    => $element['is_enabled'],
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ];
        }

        DB::beginTransaction();
        try {
            if (count($element_data)) {
                ElementSetting::where('project_id', $project_id)->delete();
                ElementSetting::insert($element_data);
            }

            DB::commit();
            return redirect()
                ->route('dashboard.client-index', ['project' => $project_id])
                ->with('success', 'Settings updated successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }


    }
}

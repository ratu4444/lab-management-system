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
    public function taskShow()
    {
        $settings_tasks = SettingsTask::get();
        return view('settings.settings-task', compact('settings_tasks'));
    }

    public function taskStore(Request $request)
    {
        $request->validate([
            'name'      => 'required|string',
            'status'    => 'required',
            'budget'    => 'required'
        ]);

        $task_data = [
            'name'          => $request->name,
            'budget'        => $request->total_budget,
            'is_enabled'    => $request->is_enabled,
        ];

        try {
            SettingsTask::create($task_data);

            return redirect()
                ->back()
                ->with('success', 'Default Task created successfully');
        } catch (\Exception $exception) {
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function taskEdit($default_task_id)
    {
        $settings_task = SettingsTask::findOrFail($default_task_id );
        return view('settings.settings-task-edit', compact('settings_task', 'default_task_id'));
    }

    public function taskUpdate(Request $request, $default_task_id){
//        return $default_task_id;

        $settings_task_update_data = [
            'name' =>$request->name,
            'budget' =>$request->total_budget,
            'is_enabled' =>$request->is_enabled,
        ];

        try {
            $settings_task = SettingsTask::findOrFail($default_task_id );
            $settings_task->update($settings_task_update_data);
            return redirect()->route('settings.task.show')
                ->with('success', 'Default Task created successfully');
        }
        catch (\Exception $exception){
            return back()
                ->with('error', $exception->getMessage());
        }

    }
    public function paymentShow()
    {
        $settings_payments = SettingsPayment::get();
        return view('settings.settings-payment', compact('settings_payments'));
    }

    public function paymentStore(Request $request)
    {
        $request->validate([
            'name'              => 'required|string',
            'amount'            => 'required',
            'payment_method'    => 'required'
        ]);

        $payment_data = [
            'name'              => $request->name,
            'amount'            => $request->amount,
            'payment_method'    => $request->payment_method,
            'is_enabled'        => $request->is_enabled,
        ];

        try {
            SettingsPayment::create($payment_data);

            return redirect()
                ->back()
                ->with('success', 'Default Payment created successfully');
        } catch (\Exception $exception) {
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function paymentEdit($default_task_id)
    {
        $settings_payment = SettingsPayment::findOrFail($default_task_id);
        return view('settings.settings-payment-edit', compact('settings_payment', 'default_task_id'));
    }

    public function paymentUpdate(Request $request, $default_task_id){

        $settings_payment_update_data = [
            'name' =>$request->name,
            'amount' =>$request->amount,
            'payment_method' =>$request->payment_method,
            'is_enabled' =>$request->is_enabled,
        ];

        try {
            $settings_payment = SettingsPayment::findOrFail($default_task_id );
            $settings_payment->update($settings_payment_update_data);
            return redirect()->route('settings.payment.show')
                ->with('success', 'Default Task created successfully');
        }
        catch (\Exception $exception){
            return back()
                ->with('error', $exception->getMessage());
        }

    }

    public function inspectionShow()
    {
        $settings_inspections = SettingsInspection::get();
        return view('settings.settings-inspection', compact('settings_inspections'));
    }

    public function inspectionStore(Request $request)
    {
        $request->validate([
            'name'              => 'required|string',
        ]);

        $inspection_data = [
            'name'          => $request->name,
            'is_enabled'    => $request->is_enabled,
        ];

        try {
            SettingsInspection::create($inspection_data);

            return redirect()
                ->back()
                ->with('success', 'Default Inspection created successfully');
        } catch (\Exception $exception) {
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function inspectionEdit($default_task_id)
    {
        $settings_inspection = SettingsInspection::findOrFail($default_task_id);
//        dd($settings_payment);
        return view('settings.settings-inspection-edit', compact('settings_inspection', 'default_task_id'));
    }

    public function inspectionUpdate(Request $request, $default_task_id){
//        return $default_task_id;

        $settings_inspection_update_data = [
            'name' =>$request->name,
            'is_enabled' =>$request->is_enabled,
        ];

        try {
            $settings_inspection = SettingsInspection::findOrFail($default_task_id );
            $settings_inspection->update($settings_inspection_update_data);
            return redirect()->route('settings.inspection.show')
                ->with('success', 'Default Task created successfully');
        }
        catch (\Exception $exception){
            return back()
                ->with('error', $exception->getMessage());
        }

    }

    public function elementShow(Request $request)
    {
        $all_projects = Project::latest()->get();
        $project = $request->project ? $all_projects->where('id', $request->project)->first()  : $all_projects->first();
        if (!$project) return abort(404);

        $element_settings = ElementSetting::where('project_id', $project->id)
            ->orderBy('element_id', 'asc')
            ->get();

        $elements = [];
        foreach ($element_settings as $element_setting) {
            $elements[$element_setting->element_id - 1] = [
                'element_name'  => $element_setting->element_name,
                'is_enabled'    => (bool) $element_setting->is_enabled,
            ];
        }

        return view('settings.settings-element', compact('all_projects', 'project', 'elements'));
    }

    public function elementStore(Request $request, $project_id)
    {
        $request->validate([
            'elements'                  => 'required|array',
            'elements.*.element_name'   => 'required',
            'elements.*.is_enabled'     => 'required',
        ]);

        $element_data = [];
        foreach ($request->elements as $index => $element) {
            $element_data[] = [
                'project_id'    => $project_id,
                'element_id'    => $index + 1,
                'element_name'  => $element['element_name'],
                'is_enabled'    => $element['is_enabled'],
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ];
        }

        DB::beginTransaction();
        try {
            if (count($element_data)) {
                ElementSetting::where('project_id', $project_id)->forceDelete();
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

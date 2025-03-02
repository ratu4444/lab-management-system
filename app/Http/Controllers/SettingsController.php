<?php

namespace App\Http\Controllers;

use App\Models\ElementSetting;
use App\Models\MailConfiguration;
use App\Models\OauthToken;
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
            'name' => 'required|string',
//            'total_budget'      => 'required'
        ]);

        $task_data = [
            'name' => $request->name,
//            'budget'        => $request->total_budget,
            'is_enabled' => $request->is_enabled,
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
        $settings_task = SettingsTask::find($default_task_id);
        if (!$settings_task) return back()->with('error', 'Default Task Not Found');

        return view('settings.settings-task-edit', compact('settings_task'));
    }

    public function taskUpdate(Request $request, $default_task_id)
    {
        $request->validate([
            'name' => 'required|string',
//            'total_budget'      => 'required'
        ]);

        $settings_task_update_data = [
            'name' => $request->name,
//            'budget'        => $request->total_budget,
            'is_enabled' => $request->is_enabled,
        ];

        $settings_task = SettingsTask::find($default_task_id);
        if (!$settings_task) return back()->with('error', 'Default Task Not Found');

        try {
            $settings_task->update($settings_task_update_data);

            return redirect()
                ->route('settings.task.show')
                ->with('success', 'Default Task Updated successfully');
        } catch (\Exception $exception) {
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }

    }
}

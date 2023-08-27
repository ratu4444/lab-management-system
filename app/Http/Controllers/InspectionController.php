<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\InspectionDependency;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InspectionController extends Controller
{
    public function index($project_id)
    {
        $project = Project::with('tasks', 'inspections')
            ->findOrFail($project_id);

        return view('inspection.index', compact( 'project'));
    }

    public function store(Request $request, $project_id)
    {
        $request->validate([
            'name'              => 'required|string',
            'scheduled_date'    => 'required|date_format:Y-m-d'
        ]);

        $project = Project::with('client')->findOrFail($project_id);

        $inspection_data = [
            'project_id'                => $project_id,
            'name'                      => $request->name,
            'status'                    => $request->status,
            'date'                      => $request->date,
            'scheduled_date'            => $request->scheduled_date,
            'comment'                   => $request->comment,
        ];

        DB::beginTransaction();
        try {
            $inspection = Inspection::create($inspection_data);

            $inspection_dependecies = [];
            if ($request->dependencies ) {
                foreach ($request->dependencies as $dependency){
                    $inspection_dependecies [] = [
                        'inspection_id'     => $inspection->id,
                        'dependent_task_id' => $dependency,
                        'created_at'        => Carbon::now(),
                        'updated_at'        => Carbon::now(),
                    ];
                }
            }
            if(count($inspection_dependecies)) InspectionDependency::insert($inspection_dependecies);

            $project_client_email = $project->client?->email;
            if ($request->status == config('app.STATUSES.Completed') && $project_client_email) {
                $recipients_emails = [$project_client_email];
                sendMailFromOutlook($recipients_emails);
            }

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Inspection created successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function edit($project_id, $inspection_id)
    {
        $project = Project::with('tasks', 'inspections.dependentTasks')
            ->findOrFail($project_id);

        $inspection = $project->inspections->where('id', $inspection_id)->first();
        if (!$inspection) return abort(404);
        $inspection->dependent_task_ids = $inspection->dependentTasks->pluck('id')->toArray();

        return view('inspection.edit', compact('inspection', 'project'));
    }

    public function update(Request $request, $project_id, $inspection_id)
    {
        $request->validate([
            'name'              => 'required',
            'scheduled_date'    => 'required|date_format:Y-m-d',
            'inspected_date'    => 'nullable|date_format:Y-m-d|after_or_equal:scheduled_date',
        ]);

        $inspection = Inspection::with('inspectionDependencies', 'project.client')->findOrFail($inspection_id);
        $project = $inspection->project;

        $inspection_data = [
            'name'              => $request->name,
            'status'            => $request->status,
            'date'              => $request->inspected_date,
            'scheduled_date'    => $request->scheduled_date,
            'comment'           => $request->comment,
        ];

        DB::beginTransaction();
        try {
            $inspection->update($inspection_data);

            $inspection->inspectionDependencies()->delete();

            $inspection_dependencies_data = [];
            if ($request->dependencies) {
                foreach ($request->dependencies as $dependency) {
                    $inspection_dependencies_data[] = [
                        'inspection_id'     => $inspection->id,
                        'dependent_task_id' => $dependency,
                        'created_at'        => Carbon::now(),
                        'updated_at'        => Carbon::now(),
                    ];
                }
            }

            if (count($inspection_dependencies_data)) InspectionDependency::insert($inspection_dependencies_data);

            $project_client_email = $project?->client?->email;
            if ($request->status == config('app.STATUSES.Completed') && $project_client_email) {
                $recipients_emails = [$project_client_email];
                sendMailFromOutlook($recipients_emails);
            }

            DB::commit();
            return redirect()
                ->route('inspection.index', $project_id)
                ->with('success', 'Inspection updated successfully');
        } catch (\Exception $exception) {
            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }
}

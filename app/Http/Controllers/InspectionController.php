<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\InspectionDependency;
use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InspectionController extends Controller
{
    public function create($project_id)
    {
        $project = Project::with('tasks', 'inspections')
            ->findOrFail($project_id);

        return view('inspection.create', compact( 'project'));
    }

    public function store(Request $request, $project_id)
    {
        $request->validate([
            'name'              => 'required|string',
            'scheduled_date'    => 'required|date_format:Y-m-d'
        ]);

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

    public function edit($inspection_id)
    {
        $inspection = Inspection::with('dependentTask')
            ->findOrFail($inspection_id);

        $inspection->dependent_inspection_ids = $inspection->dependentTask->pluck('id')->toArray();
        $project_tasks = Task::where('project_id', $inspection->project_id)->get();

        return view('inspection.edit', compact('inspection', 'project_tasks'));
    }

    public function update(Request $request, $inspection_id)
    {
        $request->validate([
            'name'              => 'required',
            'scheduled_date'    => 'required|date_format:Y-m-d',
        ]);

        $inspection = Inspection::with('inspectionDependencies')->findOrFail($inspection_id);

        $inspection_data = [
            'name'              => $request->name,
            'status'            => $request->status,
            'date'              => $request->date,
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

            DB::commit();
            return redirect()
                ->route('inspection.create', $inspection->project_id)
                ->with('success', 'Inspection updated successfully');;
        } catch (\Exception $exception) {
            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }
}

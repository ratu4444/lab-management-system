<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\InspectionDependency;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InspectionController extends Controller
{
    public function create($project_id)
    {
//      dd($project_id);

        $inspections = Inspection::where('project_id', $project_id)->get();


        $project = Project::with('tasks', 'inspections')->where('id', $project_id)->firstOrFail();
        return view('inspection.create', compact( 'project',));

    }

    public function store(Request $request, $project_id)
    {
//        dd($request->all());
//        $request->validate([
//            'amount' => 'required',
//        ]);

//        $project = Project::where('id', $project_id)->first();
//
//        $client_id = $project->client_id;



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
            if ($request->dependencies ){
            foreach ($request->dependencies as $dependency){

            $inspection_dependecies [] = [
                'inspection_id'     => $inspection->id,
                'dependent_task_id' => $dependency,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ];
            }}
//dd($inspection_dependecies);
            if(count($inspection_dependecies)) InspectionDependency::insert($inspection_dependecies);
            DB::commit();
//            dd('ok');
            return redirect()->back();
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function edit($inspection_id){


        $inspection = Inspection::with('dependentTask')->findOrFail($inspection_id);

        $inspection->dependent_inspection_ids = $inspection->dependentTask->pluck('id')->toArray();
        $inspection_tasks = Task::where('project_id', $inspection->project_id)->get();

        return view('inspection.edit', compact('inspection', 'inspection_tasks'));


    }

    public function update(Request $request, $inspection_id){

//        dd($request);
        $request->validate([
            'name' => 'required',
            'date' => 'required|date_format:Y-m-d',
        ]);

        $inspection = Inspection::with('inspectionDependencies')->findOrFail($inspection_id);
//        dd($inspection);

        $inspection_data = [
            'name'                      => $request->name,
            'status'                    => $request->status,
            'date'                      => $request->date,
            'scheduled_date'            => $request->scheduled_date,
            'comment'                   => $request->comment,
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
//            dd('ok');
            if (count($inspection_dependencies_data)){
                $inspection = InspectionDependency::insert($inspection_dependencies_data);
            }
            DB::commit();
            return redirect()->route('inspection.create', $inspection->project_id);
        } catch (\Exception $exception) {
//            dd($exception->getLine());
            return redirect()->back();
        }


    }
}

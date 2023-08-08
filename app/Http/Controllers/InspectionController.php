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
}

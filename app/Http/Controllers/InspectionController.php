<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    public function create($project_id)
    {
//      dd($project_id);
        $access_token = auth()->user()->createToken('accessToken')->plainTextToken;

        $inspections = Inspection::where('project_id', $project_id)->get();
        $tasks = Task::pluck('name');
        return view('inspection.create', compact( 'tasks','inspections', 'access_token','project_id'));

    }

    public function store(Request $request, $project_id)
    {
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
        try {

            $inspection = Inspection::create($inspection_data);
            return redirect()->back();
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return redirect()->back();
        }
    }
}

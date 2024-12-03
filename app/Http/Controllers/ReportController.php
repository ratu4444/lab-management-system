<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index($project_id)
    {
        $project = Project::with('reports')->findOrFail($project_id);
        $reports = $project->reports()->paginate(10);

        return view('report.index', compact('project', 'reports'));
    }

    public function store(Request $request, $project_id)
    {
        $request->validate([
            'name'  => 'required|string',
            'file'  => 'required|file',
        ]);

        $is_project_exist = Project::whereId($project_id)->exists();
        if (!$is_project_exist)
            return redirect()
                ->back()
                ->with('error', 'Project not found');

        $file_type = $request->file->getMimeType();
        $file_path = uploadFile($request->file);

        $report_data = [
            'project_id'    => $project_id,
            'name'          => $request->name,
            'file'          => $file_path,
            'file_type'     => $file_type,
            'description'   => $request->description
        ];

        try {
            Report::create($report_data);

            return redirect()
                ->back()
                ->with('success', 'Report created successfully');
        } catch (\Exception $exception) {
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function clientStore(Request $request, $project_id)
    {
        $request->validate([
            'task_id'   => 'required|exists:tasks,id',
            'name'      => 'required|string',
            'file'      => 'required|file',
        ]);

        $project = auth()->user()
            ->projects()
            ->findOrFail($project_id);

        $file_type = $request->file->getMimeType();
        $file_path = uploadFile($request->file);

        $report_data = [
            'task_id'       => $request->task_id,
            'name'          => $request->name,
            'file'          => $file_path,
            'file_type'     => $file_type,
            'description'   => $request->description,
            'created_by'    => auth()->id()
        ];

        DB::beginTransaction();
        try {
            $project->reports()
                ->create($report_data);

            $project->tasks()
                ->whereId($request->task_id)
                ->update([
                    'status'                => config('app.STATUSES')['Completed'],
                    'completion_percentage' => 100,
                    'completion_date'       => Carbon::now()
                ]);

            DB::commit();
            return redirect()
                ->back()
                ->with('success', 'Report created successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function edit($project_id, $report_id)
    {
        $report = Report::where('project_id', $project_id)->findOrFail($report_id);
        return view('report.edit', compact('report'));
    }

    public function update(Request $request, $project_id, $report_id)
    {
        $request->validate([
            'name'  => 'required',
            'file'  => 'nullable|file'
        ]);

        $report = Report::where('project_id', $project_id)->findOrFail($report_id);
        $report_data = [
            'name'  => $request->name,
        ];

        if ($request->file) {
            $report_data['file_type'] = $request->file->getMimeType();
            $report_data['file'] = uploadFile($request->file);
        }

        try {
            $report->update($report_data);

            return redirect()
                ->route('report.index', $project_id)
                ->with('success', 'Report updated successfully');
        } catch (\Exception $exception) {
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function toggleVisibility($project_id, $report_id)
    {
        $report = Report::where('project_id', $project_id)->findOrFail($report_id);
        try {
            $report->update([
                'is_active' => !$report->is_active,
            ]);

            return redirect()
                ->route('report.index', $project_id)
                ->with('success', 'Report updated successfully');
        } catch (\Exception $exception) {
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function destroy($project_id, $report_id)
    {
        $report = Report::where('project_id', $project_id)->findOrFail($report_id);
        try {
            $report->delete();

            return redirect()
                ->route('report.index', $project_id)
                ->with('success', 'Report deleted successfully');
        } catch (\Exception $exception) {
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }
}

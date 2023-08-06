<?php
namespace App\Traits;

trait ResponseFormattingTrait{
    function formatUser($user): array
    {
        $data = [
            'id'            => $user->id,
            'name'          => $user->name,
            'email'         => $user->email,
            'mobile'        => $user->mobile,
            'company_name'  => $user->company_name
        ];

        return $data;
    }

    function formatProject($project): array
    {
        $data = [
            'id'                        => $project->id,
            'client_id'                 => $project->client_id,
            'name'                      => $project->name,
            'estimated_completion_date' => $project->estimated_completion_date,
            'estimated_budget'          => $project->estimated_budget,
            'total_budget'              => $project->total_budget,
            'status'                    => $project->status,
            'comment'                   => $project->comment
        ];

        return $data;
    }

    function formatTask($task): array
    {
        $data = [
            'id'                        => $task->id,
            'project_id'                => $task->project_id,
            'name'                      => $task->name,
            'estimated_start_date'      => $task->estimated_start_date,
            'estimated_completion_date' => $task->estimated_completion_date,
            'start_date'                => $task->start_date,
            'completion_date'           => $task->completion_date,
            'status'                    => $task->status,
            'total_budget'              => $task->total_budget,
            'completion_percentage'     => $task->completion_percentage,
            'parent_id'                 => $task->parent_id,
            'comment'                   => $task->comment
        ];

        return $data;
    }

    function formatPayment($payment): array
    {
        $data = [
            'id'                => $payment->id,
            'project_id'        => $payment->project_id,
            'client_id'         => $payment->client_id,
            'name'              => $payment->name,
            'amount'            => $payment->amount,
            'date'              => $payment->date,
            'payment_method'    => $payment->payment_method,
            'comment'           => $payment->comment
        ];

        return $data;
    }

    function formatInspection($inspection): array
    {
        $data = [
            'id'                => $inspection->id,
            'project_id'        => $inspection->project_id,
            'name'              => $inspection->name,
            'status'            => $inspection->status,
            'scheduled_date'    => $inspection->scheduled_date,
            'date'              => $inspection->date,
            'comment'           => $inspection->comment
        ];

        return $data;
    }

    function apiResponse($data = [], $message = 'Operation Successful', $status = 200): \Illuminate\Http\JsonResponse
    {
        $response = [
            'success'   => $status >= 200 && $status < 300,
            'status'    => $status,
            'message'   => $message,
            'data'      => $data
        ];

        return response()->json($response, $status);
    }
}

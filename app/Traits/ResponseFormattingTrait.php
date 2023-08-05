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
        $data = [];

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

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

<?php

use App\Models\OauthToken;
use Illuminate\Support\Facades\Http;

if (!function_exists('sendMailFromOutlook')) {
    function sendMailFromOutlook(string $subject, string $message, array $recipients_emails, string $outlook_base_url = 'https://graph.microsoft.com/v1.0')
    {
        $app_name = OauthToken::APP_NAMES['OUTLOOK'];

        $oauth_token = OauthToken::where('app_name', $app_name)->first();
        if (!$oauth_token) return response()->json([
            'success'   => false,
            'status'    => 400,
            'message'   => 'No outlook account found',
            'data'      => []
        ], 400);

        $headers = [
            'Authorization' => 'Bearer '.$oauth_token->access_token,
            'Accept'        => "application/json"
        ];

        $recipients = [];
        foreach ($recipients_emails as $email) {
            $recipients[] = [
                'emailAddress' => [
                    'address'   => $email
                ]
            ];
        }

        $body = [
            'message' => [
                'subject'       => $subject,
                'body'          => [
                    'contentType'   => 'Text',
                    'content'       => $message,
                ],
                'toRecipients'  => $recipients,
            ]
        ];

        $api = "$outlook_base_url/me/sendMail";

        $response = Http::withHeaders($headers)->post($api, $body);
        return response()->json([
            'success'   => $response->successful(),
            'status'    => $response->status(),
            'message'   => $response->reason(),
            'data'      => $response->json()
        ], $response->status());
    }
}

if (!function_exists('getOutlookUserData')) {
    function getOutlookUserData(string $accesss_token, string $outlook_base_url = 'https://graph.microsoft.com/v1.0')
    {
        $api = "$outlook_base_url/me";
        $headers = [
            'Authorization' => "Bearer $accesss_token",
            'Accept'        => "application/json"
        ];

        $response = Http::withHeaders($headers)->get($api);

        return $response->successful() ? $response->json() : null;
    }
}

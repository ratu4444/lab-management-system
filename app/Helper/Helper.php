<?php

use App\Models\MailConfiguration;
use App\Models\OauthToken;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Aws\S3\S3Client;

//if (!function_exists('sendMailFromOutlook')) {
//    function sendMailFromOutlook(array $recipients_emails, string $outlook_base_url = 'https://graph.microsoft.com/v1.0')
//    {
//        $app_name = OauthToken::APP_NAMES['OUTLOOK'];
//
//        $mail_configuration = MailConfiguration::where('app_name', $app_name)
//            ->with('oauthToken')
//            ->first();
//        $oauth_token = $mail_configuration?->oauthToken ?? OauthToken::where('app_name', $app_name)->first();
//        $subject = $mail_configuration?->mail_subject ?? 'Project has just passed an inspection';
//        $message = $mail_configuration?->mail_body ?? 'We have great news. Your project has just passed an inspection. Be sure to check out your Dashboard for what is coming up next in the build process. As always feel free to reach out to us if you have any questions about what to expect.';
//
//        if (!$oauth_token) return response()->json([
//            'success'   => false,
//            'status'    => 400,
//            'message'   => 'No outlook account found',
//            'data'      => []
//        ], 400);
//
//        $headers = [
//            'Authorization' => 'Bearer '.$oauth_token->access_token,
//            'Accept'        => "application/json"
//        ];
//
//        $recipients = [];
//        foreach ($recipients_emails as $email) {
//            $recipients[] = [
//                'emailAddress' => [
//                    'address'   => $email
//                ]
//            ];
//        }
//
//        $body = [
//            'message' => [
//                'subject'       => $subject,
//                'body'          => [
//                    'contentType'   => 'Text',
//                    'content'       => $message,
//                ],
//                'toRecipients'  => $recipients,
//            ]
//        ];
//
//        $api = "$outlook_base_url/me/sendMail";
//
//        $response = Http::withHeaders($headers)->post($api, $body);
//        return response()->json([
//            'success'   => $response->successful(),
//            'status'    => $response->status(),
//            'message'   => $response->reason(),
//            'data'      => $response->json()
//        ], $response->status());
//    }
//}
//
//if (!function_exists('getOutlookUserData')) {
//    function getOutlookUserData(string $accesss_token, string $outlook_base_url = 'https://graph.microsoft.com/v1.0')
//    {
//        $api = "$outlook_base_url/me";
//        $headers = [
//            'Authorization' => "Bearer $accesss_token",
//            'Accept'        => "application/json"
//        ];
//
//        $response = Http::withHeaders($headers)->get($api);
//
//        return $response->successful() ? $response->json() : null;
//    }
//}

if (!function_exists('uploadFile')) {
    function uploadFile($file, $folder = null): string
    {
        $file_storage = strtolower(env('FILE_STORAGE'));
        $tmp_name = str_replace(' ', '_', $file->getClientOriginalName());
        $file_name = time().'_'.$tmp_name;

        $user_type = auth()->user()->type;

        $upload_folder = "storage/$user_type/" . trim($folder, '/') . '/';
        $upload_folder = str_replace('//', '/', $upload_folder);

        switch ($file_storage) {
            case 's3':
                $file->storeAs(env('S3_FOLDER').$upload_folder, $file_name, 's3');
                break;
            default:
                $file->move(public_path($upload_folder), $file_name);
        }

        return $upload_folder.$file_name;
    }
}

if (!function_exists('getFileUrl')) {
    function getFileUrl($file_path)
    {
        if (URL::isValidUrl($file_path)) return $file_path;

        $file_storage = strtolower(env('FILE_STORAGE'));
        switch ($file_storage) {
            case 's3':
                $alive_time = Carbon::now()->addMinutes(60)->toDateTimeString();
                $client = new S3Client([
                    'region'        => env('AWS_DEFAULT_REGION'),
                    'version'       => 'latest',
                    'credentials'   => [
                        'key'       => env('AWS_ACCESS_KEY_ID'),
                        'secret'    => env('AWS_SECRET_ACCESS_KEY')
                    ]
                ]);
                $bucket = config("filesystems.disks.s3.bucket");
                $command = $client->getCommand('GetObject', [
                    'Bucket'    => $bucket,
                    'Key'       => env('S3_FOLDER').$file_path
                ]);

                $request = $client->createPresignedRequest($command, $alive_time);
                $file_url = (string)$request->getUri();
                break;
            default:
                $file_url = url($file_path);
                break;
        }

        return $file_url;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\OauthToken;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OauthController extends Controller
{
    public function oauthAuthorize($app_name)
    {
        switch (strtolower($app_name)) {
            case OauthToken::APP_NAMES['OUTLOOK']:
                return $this->oauthAuthorizeOutlook();
            default :
                return "$app_name Oauth Not Supported yet";
        }
    }

    public function oauthAuthorizeOutlook()
    {
        $client_id = env('OUTLOOK_CLIENT_ID');
        $tenant_id = env('OUTLOOK_TENANT_ID');
        $redirect_uri = route('oauth.redirect', OauthToken::APP_NAMES['OUTLOOK']);
        $scope = 'offline_access https://graph.microsoft.com/.default';

        $params = [
            'client_id'     => $client_id,
            'response_type' => 'code',
            'redirect_uri'  => $redirect_uri,
            'response_mode' => 'query',
            'scope'         => $scope,
            'state'         => '12345'
        ];

        $authorize_url = "https://login.microsoftonline.com/$tenant_id/oauth2/v2.0/authorize";
        $authorize_url = sprintf("%s?%s", $authorize_url, http_build_query($params));

        return redirect()->to($authorize_url);
    }

    public function oauthRedirect(Request $request, $app_name)
    {
        switch (strtolower($app_name)) {
            case OauthToken::APP_NAMES['OUTLOOK']:
                return $this->oauthRedirectOutlook($request);
            default :
                return "$app_name Oauth Not Supported yet";
        }
    }

    public function oauthRedirectOutlook(Request $request)
    {
        $client_id = env('OUTLOOK_CLIENT_ID');
        $tenant_id = env('OUTLOOK_TENANT_ID');
        $client_secret_value = env('OUTLOOK_CLIENT_SECRET_VALUE');
        $redirect_uri = route('oauth.redirect', OauthToken::APP_NAMES['OUTLOOK']);
        $scope = 'offline_access https://graph.microsoft.com/.default';
        $code = $request->code;

        $body = [
            "client_id"     => $client_id,
            "client_secret" => $client_secret_value,
            "grant_type"    => "authorization_code",
            "redirect_uri"  => $redirect_uri,
            'scope'         => $scope,
            "code"          => $code,
        ];
        $token_url = "https://login.microsoftonline.com/$tenant_id/oauth2/v2.0/token";

        $response = Http::asForm()->post($token_url, $body);

        if ($response->successful()) {
            $response_data = $response->json();

            $oauth_token_data = [
                'app_name'          => OauthToken::APP_NAMES['OUTLOOK'],
                'token_type'        => $response_data['token_type'] ?? null,
                'access_token'      => $response_data['access_token'],
                'refresh_token'     => $response_data['refresh_token'] ?? null,
                'expiration_time'   => $response_data['expires_in'] ? Carbon::now()->addSeconds($response_data['expires_in']) : null,
                'response_data'     => json_encode($response_data),
            ];

            OauthToken::create($oauth_token_data);
        } else {
            $error_message = $response->json('error_description');
            dd('error : '.$error_message);
        }
    }
}

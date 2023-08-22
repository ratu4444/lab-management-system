<?php

namespace App\Http\Controllers;

use App\Models\OauthToken;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OauthController extends Controller
{
    protected string $outlook_base_url;
    public function __construct()
    {
        $this->outlook_base_url = 'https://graph.microsoft.com/v1.0';
    }

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
        $app_name = OauthToken::APP_NAMES['OUTLOOK'];

        $client_id = env('OUTLOOK_CLIENT_ID');
        $tenant_id = env('OUTLOOK_TENANT_ID');
        $client_secret_value = env('OUTLOOK_CLIENT_SECRET_VALUE');
        $redirect_uri = route('oauth.redirect', $app_name);
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
        if (!$response->successful()) return $response->json('error_description');

        $response_data = $response->json();
        $user_data = $this->getUserData($response_data['access_token']);

        $oauth_token_data = [
            'token_type'        => $response_data['token_type'] ?? null,
            'access_token'      => $response_data['access_token'],
            'refresh_token'     => $response_data['refresh_token'] ?? null,
            'expiration_time'   => $response_data['expires_in'] ? Carbon::now()->addSeconds($response_data['expires_in']) : null,
            'response_data'     => json_encode($response_data),
            'user_name'         => $user_data['displayName'] ?? null,
            'user_email'        => $user_data['mail'] ?? null,
            'user_data'         => json_encode($user_data),
        ];

        return $this->storeTokenAndReturnView($app_name, $oauth_token_data);
    }

    public function storeTokenAndReturnView(string $app_name, array $oauth_token_data)
    {
        try {
            $oauth_token = OauthToken::where('app_name', $app_name)->first();

            if ($oauth_token) $oauth_token->update($oauth_token_data);
            else {
                $oauth_token_data['app_name'] = $app_name;
                $oauth_token = OauthToken::create($oauth_token_data);
            }

            return 'successful';
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    private function getUserData($accesss_token)
    {
        $api = $this->outlook_base_url.'/me';
        $headers = [
            'Authorization' => "Bearer $accesss_token",
            'Accept'        => "application/json"
        ];

        $response = Http::withHeaders($headers)->get($api);

        return $response->successful() ? $response->json() : null;
    }
}

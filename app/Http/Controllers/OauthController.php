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
        $app_names = OauthToken::APP_NAMES;

        switch (strtolower($app_name)) {
            case $app_names['OUTLOOK']:
                return $this->oauthAuthorizeOutlook();
            default :
                return redirect()
                    ->route('dashboard.admin-index')
                    ->with('error', "$app_name Oauth Not Supported yet");
        }
    }

    public function oauthAuthorizeOutlook()
    {
        $app_name = OauthToken::APP_NAMES['OUTLOOK'];

        $client_id = env('OUTLOOK_CLIENT_ID');
        $tenant_id = env('OUTLOOK_TENANT_ID');
        $redirect_uri = route('oauth.redirect', $app_name);
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
        $app_names = OauthToken::APP_NAMES;
        switch (strtolower($app_name)) {
            case $app_names['OUTLOOK']:
                return $this->oauthRedirectOutlook($request);
            default :
                return redirect()
                    ->route('dashboard.admin-index')
                    ->with('error', "$app_name Oauth Not Supported yet");
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

        return $this->generateOutlookAccessToken($token_url, $body);
    }

    private function generateOutlookAccessToken(string $token_url, array $body = [], bool $return_view = true)
    {
        $app_name = OauthToken::APP_NAMES['OUTLOOK'];

        $response = Http::asForm()->post($token_url, $body);
        if (!$response->successful()) {
            $this->makeTokenExpired($app_name);

            if ($return_view) return redirect()
                ->route('settings.outlook-configuration')
                ->with('error', $response->json('error_description'));

            else return $this->apiResponse([], $response->json('error_description'), 400);
        }

        $response_data = $response->json();
        $user_data = getOutlookUserData($response_data['access_token']);

        $oauth_token_data = [
            'token_type'            => $response_data['token_type'] ?? null,
            'access_token'          => $response_data['access_token'],
            'refresh_token'         => $response_data['refresh_token'] ?? null,
            'expiration_time'       => $response_data['expires_in'] ? Carbon::now()->addSeconds($response_data['expires_in']) : null,
            'response_data'         => json_encode($response_data),
            'user_name'             => $user_data['displayName'] ?? null,
            'user_email'            => $user_data['mail'] ?? null,
            'user_data'             => json_encode($user_data),
            'is_expired'            => false,
            'last_refreshed_time'   => Carbon::now(),
        ];

        return $this->storeTokenAndReturn($app_name, $oauth_token_data, $return_view);
    }

    public function storeTokenAndReturn(string $app_name, array $oauth_token_data, bool $return_view = true)
    {
        try {
            $oauth_token = OauthToken::where('app_name', $app_name)->first();

            if ($oauth_token) $oauth_token->update($oauth_token_data);
            else {
                $oauth_token_data['app_name'] = $app_name;
                OauthToken::create($oauth_token_data);
            }

            if ($return_view) return redirect()
                ->route("settings.$app_name-configuration")
                ->with('success', 'Account successfully updated');

            else return $this->apiResponse([], 'Account successfully updated', 200);
        } catch (\Exception $exception) {
            if ($return_view) return redirect()
                ->route("settings.$app_name-configuration")
                ->with('error', $exception->getMessage());

            else return $this->apiResponse([], $exception->getMessage(), 500);
        }
    }

    private function makeTokenExpired(string $app_name)
    {
        $oauth_token = OauthToken::where('app_name', $app_name)->first();
        $oauth_token->update([
            'is_expired' => true,
        ]);
    }

    public function oauthRefresh($app_name)
    {
        $app_names = OauthToken::APP_NAMES;
        switch (strtolower($app_name)) {
            case $app_names['OUTLOOK']:
                return $this->oauthRefreshOutlook();
            default :
                return redirect()
                    ->route('dashboard.admin-index')
                    ->with('error', "$app_name Oauth Not Supported yet");
        }
    }

    public function oauthRefreshOutlook(bool $return_view = true)
    {
        $app_name = OauthToken::APP_NAMES['OUTLOOK'];

        $client_id = env('OUTLOOK_CLIENT_ID');
        $tenant_id = env('OUTLOOK_TENANT_ID');
        $client_secret_value = env('OUTLOOK_CLIENT_SECRET_VALUE');
        $redirect_uri = route('oauth.redirect', $app_name);
        $scope = 'offline_access https://graph.microsoft.com/.default';

        $oauth_token = OauthToken::where('app_name', $app_name)->first();
        $refresh_token = $oauth_token->refresh_token;

        $body = [
            "client_id"     => $client_id,
            "client_secret" => $client_secret_value,
            "grant_type"    => "refresh_token",
            "redirect_uri"  => $redirect_uri,
            'scope'         => $scope,
            "refresh_token" => $refresh_token,
        ];
        $token_url = "https://login.microsoftonline.com/$tenant_id/oauth2/v2.0/token";

        return $this->generateOutlookAccessToken($token_url, $body, $return_view);
    }
}

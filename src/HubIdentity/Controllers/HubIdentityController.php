<?php

namespace HubIdentity\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use GuzzleHttp\Client;

class HubIdentityController extends BaseController
{

    /**
     * Create a session and redirect to home
     *
     * @param Request $request
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function sessionCreate(Request $request)
    {
        $session = session();

        $inputs = $request->all();

        $userToken = $inputs['user_token'] ?? null;

        if(empty($userToken)) {
            throw new Exception('Invalid user token provided');
        }

        $url = config('hubidentity.url') . '/api/v1/current_user/' . $userToken;

        $client = new Client();

        $response = $client->request('GET', $url, [
            'headers' => [
                'x-api-key' => config('hubidentity.private_key')
            ]
        ]);

        $body = $response->getBody();

        $string_body = $body->getContents();

        $body_json = json_decode($string_body, true);

        if(empty($body_json['uid'])) {
            throw new Exception('Invalid HubIdentity response');
        }

        Auth::guard('hubidentity')->loginUsingId($body_json['uid']);

        $path = $session->pull('url.intended', '/');

        return response()->redirectTo($path);
    }

    /**
     *  Send user to HubIdentity login page
     *
     * @return RedirectResponse
     */
    public function login()
    {
        $redirectUrl = config('hubidentity.url') . '/browser/v1/providers?api_key='. config('hubidentity.public_key');

        return response()->redirectTo($redirectUrl);
    }

    /**
     * Destroy the session and redirect to home
     *
     * @return RedirectResponse
     */
    public function logout()
    {
        session()->invalidate();

        return response()->redirectTo('/');
    }
}

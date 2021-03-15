<?php

namespace HubIdentity\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class HubIdentityController extends BaseController
{

    /**
     * Create a session and redirect to home
     *
     * @param  Request $request
     *
     * @return Response
     */
    public function sessionCreate(Request $request)
    {
        $inputs = $request->all();

        $userToken = $inputs['user_token'];

        $url = env('HUBIDENTITY_URL') . '/api/v1/current_user/' . $userToken;

        $response = Http::withHeaders(
            [
                'x-api-key' => env('HUBIDENTITY_PRIVATE')
            ]
        )->get($url);

        $body_json = $response->json();

        Auth::guard('hubidentity')->loginUsingId($body_json['uid']);

        return response()->redirectTo('/');
    }

    /**
     * Destroy the session and redirect to home
     *
     * @param  Request $request
     *
     * @return Response
     */
    public function logout(Request $request)
    {
        session()->invalidate();

        return response()->redirectTo('/');
    }
}

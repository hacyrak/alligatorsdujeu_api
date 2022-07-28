<?php

namespace App\Http\Middleware;

use Auth0\SDK\Auth0;
use Auth0\SDK\Exception\InvalidTokenException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Auth0Middleware {

    /**
     * Run the request filter.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {

        $token = $request->bearerToken();

        if (!$token) {
            return response()
                ->json('No token provided', Response::HTTP_UNAUTHORIZED);
        }

        try {
            $this->validateToken($token);
        } catch (InvalidTokenException $exception) {
            return response()
                ->json($exception->getMessage());
        }

        return $next($request);
    }

    public function validateToken($token) {

        $auth0 = new Auth0(
            [
                'domain' => env('AUTH0_DOMAIN'),
                'strategy' => 'api',
                'audience' => [
                    env('AUTH0_AUD'),
                ],
            ]
        );
        $auth0->decode($token);
    }
}
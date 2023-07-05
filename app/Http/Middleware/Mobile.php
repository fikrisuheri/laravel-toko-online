<?php

namespace App\Http\Middleware;

use Closure;

class Mobile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**
         * check if the request has bearer token
         */
        if($request->bearerToken()){
            /**
             * get the bearer token from the request header
             */
            $token = $request->bearerToken();

            /**
             * check if the token is valid
             */
            if(\App\AuthToken::where('token', $token)->exists()){
                /**
                 * get the user from the token
                 */
                $user = \App\AuthToken::where('token', $token)->first()->user;

                /**
                 * set the authenticated user
                 */
                auth()->setUser($user);

                /**
                 * return the request
                 */
                return $next($request);
            }else{
                /**
                 * return error message if token is invalid
                 */
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        }else{
            /**
             * return error message if bearer token is not present
             */
            return response()->json(['error' => 'Bearer Token NOT FOUND'], 401);
        }
    }
}

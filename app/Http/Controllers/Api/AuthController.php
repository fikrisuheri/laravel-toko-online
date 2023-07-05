<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\AuthToken;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * create api endpoint for login
     */
    public function login(Request $request){
        /**
         * check login credentials
         */
        if(auth()->attempt(['email' => $request->email, 'password' => $request->password])){
            /**
             * get the authenticated user
             */
            $user = auth()->user();

            /**
             * generate token using base64 encryption
             * save token using model AuthToken
             */
            $token = base64_encode(Str::random(32));

            AuthToken::create([
                'token' => $token,
                'user_id' => $user->id
            ]);

            /**
             * return the authenticated user and token in json format
             */
            return response()->json(['user' => $user, 'access_token' => $token]);
        }else{
            /**
             * return error message if login credentials are incorrect
             */
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    /**
     * create api endpoint for logout
     */
    public function logout(Request $request){
        /**
         * get the authenticated user using brearer token in header
         */
        $token = $request->bearerToken();

        /**
         * delete token from database
         */
        AuthToken::where('token', $token)->delete();

        /**
         * return success message
         */
        return response()->json(['message' => 'Successfully logged out']);

    }
}
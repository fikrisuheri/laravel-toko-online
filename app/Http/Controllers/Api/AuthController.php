<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\AuthToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
             * generate token
             */
            $token = $this->generateToken($user);

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

    /**
     * create api endpoint for register based on RegisterController
     */
    public function register(Request $request){
        /**
         * create user using eloquent
         */
        $user = \App\User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'role' => 'customer',

            /**
             * hash the password
             */
            'password' => Hash::make($request['password']),
        ]);

        /**
         * generate token login for new user
         */
        $token = $this->generateToken($user);

        /**
         * return success message and token
         */
        return response()->json(['user' => $user, 'access_token' => $token]);
    }

    /**
     * create protected function to generate token
     */
    protected function generateToken($user){
        /**
         * generate token using base64 encryption
         */
        $token = base64_encode(Str::random(32));

        /**
         * save token using model AuthToken
         */
        AuthToken::create([
            'token' => $token,
            'user_id' => $user->id
        ]);

        /**
         * return token
         */
        return $token;
    }
}
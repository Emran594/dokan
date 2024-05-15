<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userRegistration(Request $request) {
        try {
            $userData = [
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ];

            User::create($userData);

            return response()->json([
                'status' => 'success',
                'message' => 'User registration successful'
            ]);
        } catch (\Exception $e) {
            // Log error or handle it according to your application's requirements
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function userLogin(Request $request){
        $count = User::where('email', $request->input('email'))
                 ->where('password', $request->input('password'))
                 ->count();

        if($count == 1){
            $token = JWTToken::createToken($request->input('email'));

            return response()->json([
                'status' => "Success",
                'message' => "User Login Successfully",
                'token' => $token
            ]);
        }else{
            return response()->json([
                'status' => "Failed",
                'message' => "Invalid Email Or Password"
            ]);
        }


    }
}

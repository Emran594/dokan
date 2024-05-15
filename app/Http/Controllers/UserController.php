<?php

namespace App\Http\Controllers;

use App\Models\User;
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
}

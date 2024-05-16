<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    function LoginPage():View{
        return view('pages.auth.login-page');
    }

    function RegistrationPage():View{
        return view('pages.auth.registration-page');
    }
    function SendOtpPage():View{
        return view('pages.auth.send-otp-page');
    }
    function VerifyOTPPage():View{
        return view('pages.auth.verify-otp-page');
    }

    function ResetPasswordPage():View{
        return view('pages.auth.reset-pass-page');
    }

    function ProfilePage():View{
        return view('pages.dashboard.profile-page');
    }
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

    public function sendOtp(Request $request){
        $email = $request->input('email');
        $otp = rand(1000,9999);
        $count = User::where('email',$email)->count();

        if($count == 1){
            Mail::to($email)->send(new OTPMail($otp));
            User::where('email',$email)->update(['otp' => $otp]);
            return response()->json([
                'status' => "Success",
                'message' => "4 Digit Otp Code Send on your Email"
            ]);

        }else{
            return response()->json([
                'status' => "Failed",
                'message' => "Invalid Email"
            ]);
        }
    }

    public function verifyOtp(Request $request){
        $email=$request->input('email');
        $otp=$request->input('otp');
        $count=User::where('email','=',$email)
            ->where('otp','=',$otp)->count();

        if($count==1){
            // Database OTP Update
            User::where('email','=',$email)->update(['otp'=>'0']);

            // Pass Reset Token Issue
            $token=JWTToken::CreateTokenForSetPassword($request->input('email'));
            return response()->json([
                'status' => 'success',
                'message' => 'OTP Verification Successful',
            ],200)->cookie('token',$token,60*24*30);

        }
        else{
            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorized'
            ],200);
        }
    }

    public function ResetPassword(Request $request){
        try{
            $email=$request->header('email');
            $password=$request->input('password');
            User::where('email','=',$email)->update(['password'=>$password]);
            return response()->json([
                'status' => 'success',
                'message' => 'Request Successful',
            ],200);

        }catch (Exception $exception){
            return response()->json([
                'status' => 'fail',
                'message' => 'Something Went Wrong',
            ],200);
        }
    }





}

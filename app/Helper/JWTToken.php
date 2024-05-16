<?php

namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken {

    public static function createToken($userEmail){
        $key = env('JWT_TOKEN');
        $payload = [
            'iss' => 'laravel-token',
            'iat' => time(),
            'exp' => time() + 60*60,
            'userEmail' => $userEmail
        ];

        return JWT::encode($payload, $key, 'HS256');
    }

    public static function verifyToken($token) {
        try {
            $key = env('JWT_TOKEN');
            $decoded = JWT::decode($token, new Key($key,'HS256'));
            return $decoded->userEmail;
        } catch (Exception $e) {
            return "Unauthorised";
        }
    }

    public static function CreateTokenForSetPassword($userEmail):string{
        $key =env('JWT_KEY');
        $payload=[
            'iss'=>'laravel-token',
            'iat'=>time(),
            'exp'=>time()+60*20,
            'userEmail'=>$userEmail,
            'userID'=>'0'
        ];
        return JWT::encode($payload,$key,'HS256');
    }

}

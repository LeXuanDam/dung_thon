<?php

namespace App\Helper;
use \Firebase\JWT\JWT;

class JsonWebToken
{
    const KEY = 'XV46XxCFRxNuB8LyAtmLDgi/xRnTAlMHjSACddwkyKe';
    public static function encode($token){
        $token->time = time() + 86400;
        return JWT::encode($token, self::KEY);
    }
    public static function decode($token){
        return JWT::decode($token, self::KEY , array('HS256'));
    }
    public static function user($key = null)
    {
        try{
            $token = static::decode(static::getToken());
            return $token;
        }
        catch (\Exception $e){
            return null;
        }
    }
    public static function getToken()
    {
        return request()->headers->get('Access-Token');
    }
    public static function issuePasswordResetToken($email)
    {
        $token = array(
            'email' => $email,
            'exp' => time() + 48 * 60 * 60
        );
        $token = JWT::encode($token, self::KEY);
        return $token;
    }
}

<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use \Firebase\JWT\JWT;

class JwtHelper {
    private static $secret_key = 'your_secret_key';
    private static $encrypt = ['HS256'];
    private static $aud = null;

    public static function generateToken($data, $secret_key) {
        $time = time();

        $token = array(
            'iat' => $time,
            'exp' => $time + (60*60), // Token expiration time
            'data' => $data
        );

        return JWT::encode($token, $secret_key, 'HS256');
    }

    public static function verifyToken($token) {
        if (empty($token)) {
            return false;
        }

        try {
            $decode = JWT::decode($token, self::$secret_key, self::$encrypt);
            return (array) $decode;
        } catch (\Exception $e) {
            return false;
        }
    }
}
?>

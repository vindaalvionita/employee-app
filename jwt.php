<?php
require 'vendor/autoload.php';
use \Firebase\JWT\JWT;

function generate_jwt($id) {
    $key = "vindaalvionita230501";
    $payload = [
        'iat' => time(),
        'exp' => time() + (60 * 60), // Token akan kadaluarsa dalam 1 jam
        'id' => $id
    ];
    return JWT::encode($payload, $key);
}

function validate_jwt($token) {
    $key = "vindaalvionita230501";
    try {
        return JWT::decode($token, $key, ['HS256']);
    } catch (Exception $e) {
        return null;
    }
}
?>

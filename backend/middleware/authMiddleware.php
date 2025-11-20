<?php
require_once __DIR__ . '/../rest/config.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware {

    public function verifyToken($token){
        if(!$token)
            Flight::halt(401, "Missing authentication header");

        $decoded_token = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));

        Flight::set('user', $decoded_token->user);
        Flight::set('role', $decoded_token->user->role);
        Flight::set('jwt_token', $token);

        return TRUE;
    }

    public function authorizeRole($requiredRole) {
        $role = Flight::get('role');
        if ($role !== $requiredRole) {
            Flight::halt(403, 'Access denied: insufficient privileges');
        }
    }

    public function authorizeRoles($roles) {
        $role = Flight::get('role');
        if (!in_array($role, $roles)) {
            Flight::halt(403, 'Forbidden: role not allowed');
        }
    }

    function authorizePermission($permission) {
        $user = Flight::get('user');
        if (!in_array($permission, $user->permissions)) {
            Flight::halt(403, 'Access denied: permission missing');
        }
    }    
}
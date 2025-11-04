<?php
require_once __DIR__ . '/../services/UserService.php';

$userService = new UserService();

// Users
Flight::route('GET /users', function() use ($userService) {
  Flight::json($userService->get_all_users());
});

Flight::route('GET /users/@id', function($id) use ($userService) {
  Flight::json($userService->get_user_by_id($id));
});

Flight::route('POST /users', function() use ($userService) {
  $data = Flight::request()->data->getData();
  Flight::json($userService->create_user($data));
});



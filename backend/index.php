<?php

require dirname(__DIR__) . '/vendor/autoload.php';

require_once __DIR__ . '/rest/services/authService.php';
require_once __DIR__ . '/middleware/authMiddleware.php';

Flight::map('auth_service', function() {
  return new AuthService();
});

Flight::map('auth', function() {
  $authMiddleware = new AuthMiddleware();
  $token = Flight::request()->getHeader("Authentication");
  return $authMiddleware->verifyToken($token);
});

Flight::map('auth_middleware', function() {
  return new AuthMiddleware();
});

foreach (glob(__DIR__ . '/rest/routes/*.php') as $routeFile) {
  require_once $routeFile;
}

Flight::route('/', function () {
  echo "Hello, FlightPHP!";
});

Flight::route('/index.php', function () {
  echo "Hello, FlightPHP!";
});

Flight::start();

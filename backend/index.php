<?php
require __DIR__ . '/vendor/autoload.php';

// Load routes
foreach (glob(__DIR__ . '/rest/routes/*.php') as $routeFile) {
  require_once $routeFile;
}

Flight::route('/', function () {
  echo "Hello, FlightPHP!";
});

Flight::start();

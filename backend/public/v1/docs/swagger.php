<?php
ini_set('display_errors', 0);
header('Content-Type: application/json');

require __DIR__ . '/../../../../vendor/autoload.php';

if($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '127.0.0.1'){
    define('BASE_URL', 'http://localhost/SkillSwap/backend');
} else {
    define('BASE_URL', 'https://lobster-app-czvm2.ondigitalocean.app/backend/');
}

$openapi = \OpenApi\Generator::scan([
    __DIR__ . '/../../../rest/routes'
]);

$openapi->info = new \OpenApi\Annotations\Info([
    'title' => 'API',
    'description' => 'SkillSwap API',
    'version' => '1.0',
    'contact' => new \OpenApi\Annotations\Contact([
        'email' => 'fatihtheg123@protonmail.com',
        'name' => 'Web Programming'
    ])
]);

$openapi->servers = [
    new \OpenApi\Annotations\Server([
        'url' => 'http://localhost/SkillSwap/backend',
        'description' => 'Local API server'
    ]),
    new \OpenApi\Annotations\Server([
        'url' => 'prodserver',
        'description' => 'Production API server'
    ])
];

echo $openapi->toJson();
?>

<?php
declare(strict_types=1);

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\PhpFileLoader;
use Symfony\Component\Routing\Router;

require '../include/common.inc';

$fileLocator = new FileLocator([__DIR__ . '/../config']);
$router = new Router(
    new PhpFileLoader($fileLocator),
    'routes.php'
);
preg_match('/^\/([\w-]+)\.php/', $_SERVER['REQUEST_URI'], $matches);
$pathParts = [
    $matches[1] ?? '',
    $_GET['action'] ?? null,
    $_GET['id'] ?? null,
];
$filteredParts = array_filter($pathParts, fn($part) => $part !== null);
$requestUri = '/' . implode('/', $filteredParts);
$routeMatch = $router->match($requestUri);

// Dispatch to controller
$class = $routeMatch['_controller'][0];
$method = $routeMatch['_controller'][1];
require sprintf('src/Controller/%s.php', $routeMatch['_controller'][0]); // src/Controller/index.php

$container = require __DIR__ . '/../config/services.php';
$container->get($class)->{$method}(); // IndexController::defaultAction

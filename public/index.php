<?php
declare(strict_types=1);

use Config\ViewGlobals;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\PhpFileLoader;
use Symfony\Component\Routing\Router;
use Twig\AppExtension;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require '../include/common.inc';

// Twig
$loader = new FilesystemLoader(__DIR__ . '/../templates');

// Transitional DI
$services = [];
$builder = new DI\ContainerBuilder();
$twig = new Environment($loader, [
    'cache' => __DIR__ . '/../var/cache/templates',
]);

$builder->addDefinitions([
    ViewGlobals::class => new ViewGlobals('http://localhost:8081'),
    Environment::class => $twig
]);
$container = $builder->build();

$fileLocator = new FileLocator([__DIR__ . '/../config']);
$router = new Router(
    new PhpFileLoader($fileLocator),
    'routes.php'
);
preg_match('/^\/([\w-]+)\.php/', $_SERVER['REQUEST_URI'], $matches);
$pathParts = [
    $matches[1],
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
$container->get($class)->{$method}(); // IndexController::defaultAction

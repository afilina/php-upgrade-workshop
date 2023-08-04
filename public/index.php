<?php
declare(strict_types=1);

use Config\ViewGlobals;

require '../include/common.inc';

// Transitional DI
$services = [];
$builder = new DI\ContainerBuilder();
$builder->addDefinitions([
    ViewGlobals::class => new ViewGlobals('http://localhost:8081'),
]);
$container = $builder->build();

// Transitional mini-router (url = /index.php)
preg_match('/\/([\w-]+)\.php/', $_GET['url'], $matches);
$controller = $matches[1];
$action = $_GET['action'] ?? 'default';

require sprintf('src/Controller/%s.php', $controller); // src/Controller/index.php
$class = sprintf('%sController', ucfirst($controller)); // IndexController
$method = sprintf('%sAction', $action);

$container->get($class)->{$method}(); // IndexController::defaultAction

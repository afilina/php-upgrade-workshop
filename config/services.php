<?php
declare(strict_types=1);

use Config\ViewGlobals;
use Twig\AppExtension;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/../templates');
$twig = new Environment($loader, [
    'cache' => __DIR__ . '/../var/cache/templates',
    'debug' => true,
]);
$twig->addExtension(new AppExtension());

$builder = new DI\ContainerBuilder();
$builder->addDefinitions([
    ViewGlobals::class => new ViewGlobals('http://localhost:8081'),
    Environment::class => $twig
]);
return $builder->build();

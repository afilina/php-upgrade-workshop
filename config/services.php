<?php
declare(strict_types=1);

use Config\ViewGlobals;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\DsnParser;
use Products\DoctrineProductRepository;
use Products\ProductRepository;
use Twig\TwigExtension;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$viewGlobals = new ViewGlobals('http://localhost:8081');

$loader = new FilesystemLoader(__DIR__ . '/../templates');
$twig = new Environment($loader, [
    'cache' => __DIR__ . '/../var/cache/templates',
    'debug' => true,
    'strict_variables' => true,
]);
$twig->addExtension(new TwigExtension());
$twig->addGlobal('global', $viewGlobals);

$dsnParser = new DsnParser();
$connectionParams = $dsnParser->parse('mysqli://root:root@db/app');
$doctrine = DriverManager::getConnection($connectionParams);

$builder = new DI\ContainerBuilder();
$builder->addDefinitions([
    ViewGlobals::class => $viewGlobals, // remove once everything uses Twig
    Environment::class => $twig,
    Connection::class => $doctrine,
    ProductRepository::class => DI\autowire(DoctrineProductRepository::class),
]);
return $builder->build();

<?php
declare(strict_types=1);

use Config\ViewGlobals;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\DsnParser;
use Products\DoctrineProductRepository;
use Products\ProductRepository;
use Twig\AppExtension;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/../templates');
$twig = new Environment($loader, [
    'cache' => __DIR__ . '/../var/cache/templates',
    'debug' => true,
]);
$twig->addExtension(new AppExtension());

$dsnParser = new DsnParser();
$connectionParams = $dsnParser->parse('mysqli://root:root@db/app');
$doctrine = DriverManager::getConnection($connectionParams);

$builder = new DI\ContainerBuilder();
$builder->addDefinitions([
    ViewGlobals::class => new ViewGlobals('http://localhost:8081'),
    Environment::class => $twig,
    Connection::class => $doctrine,
    ProductRepository::class => DI\autowire(DoctrineProductRepository::class),
]);
return $builder->build();

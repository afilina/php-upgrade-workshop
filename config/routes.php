<?php
declare(strict_types=1);

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->add('index', '/')
        ->controller([IndexController::class, 'defaultAction'])
    ;
    $routes->add('product_view', '/product/view/{id}')
        ->controller([ProductController::class, 'viewAction'])
    ;
    $routes->add('product_edit', '/product/edit/{id}')
        ->controller([ProductController::class, 'editAction'])
    ;
    $routes->add('export_products_csv', '/export/products_csv')
        ->controller([ExportController::class, 'products_csvAction'])
    ;
    $routes->add('export_products_pdf', '/export/products_pdf')
        ->controller([ExportController::class, 'products_pdfAction'])
    ;
};

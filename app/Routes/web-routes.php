<?php

declare(strict_types=1);

/**
 * This file contains the routes for the web application.
 */

use App\Controllers\DashboardController;
use App\Controllers\HomeController;
use App\Controllers\ShopController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


return static function (Slim\App $app): void {

    // ? Admin routes
    //* Base URI: localhost/book-shop/admin
    $app->group('/admin', function ($group) {
        $group->get('/dashboard', [DashboardController::class, 'index']);
        $group->get('/products', [DashboardController::class, 'products']);
    });

    //* NOTE: Route naming pattern: [controller_name].[method_name]
    $app->get('/', [HomeController::class, 'index'])
        ->setName('home.index');

    $app->get('/home', [HomeController::class, 'index'])
        ->setName('home.index');

    $app->get('/shops', [ShopController::class, 'getShops'])
        ->setName('shops.getShops');

    $app->get('/shops/search', [ShopController::class, 'searchShops'])
        ->setName('shops.searchShops');

    $app->get('/shops/{id}', [ShopController::class, 'getShop'])
        ->setName('shops.getShop');

    // A route to test runtime error handling and custom exceptions.
    $app->get('/error', function (Request $request, Response $response, $args) {
        throw new \Slim\Exception\HttpNotFoundException($request, "Something went wrong");
    });
};

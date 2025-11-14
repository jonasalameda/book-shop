<?php

declare(strict_types=1);

/**
 * This file contains the routes for the web application.
 */

use App\Controllers\CategoriesController;
use App\Controllers\DashboardController;
use App\Controllers\HomeController;
use App\Controllers\ShopController;
use App\Controllers\ProductsController;
use App\Controllers\UploadController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


return static function (Slim\App $app): void {

    // ? Admin routes
    //* Base URI: localhost/book-shop/admin
    $app->group('/admin', function ($group) {
        $group->get('/dashboard', [DashboardController::class, 'index'])
            ->setName('dashboard.index');
        $group->get('/products', [ProductsController::class, 'index'])
            ->setName('products.index');
        //* GET route for showing the product edit form
        $group->get('/products/edit/{product_id}', [ProductsController::class, 'edit']);
        $group->get('/products/create', [ProductsController::class, 'create']);
        //! Add Categories here
        $group->get('/categories', [CategoriesController::class, 'index'])
                    ->setName('categories.index');

        $group->get('/categories/edit/{category_id}', [CategoriesController::class, 'edit'])
                    ->setName('categories.index');
        //* handle save edited product info
        $group->post('/products/update/{product_id}', [ProductsController::class, 'update']);

        // File upload routes
        // $group->get('/products/create', [UploadController::class, 'index'])->setName('upload.index');
        $group->post('/products/upload', [ProductsController::class, 'add'])->setName('add.process');
    });

    //* NOTE: Route naming pattern: [controller_name].[method_name]
    $app->get('/', [HomeController::class, 'index'])
        ->setName('home.index');

    $app->get('/home', [HomeController::class, 'index'])
        ->setName('home.index');

    // A route to test runtime error handling and custom exceptions.
    $app->get('/error', function (Request $request, Response $response, $args) {
        throw new \Slim\Exception\HttpNotFoundException($request, "Something went wrong");
    });
};

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
use App\Controllers\AuthController;
use App\Controllers\TwoFactorController;
use App\Middleware\AuthMiddleware;
use App\Middleware\AdminAuthMiddleware;
use App\Middleware\TwoFactorMiddleware;
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
    })->add(AdminAuthMiddleware::class);

    //* NOTE: Route naming pattern: [controller_name].[method_name]
    $app->get('/', [HomeController::class, 'index'])
        ->setName('home.index');

    $app->get('/home', [HomeController::class, 'index'])
        ->setName('home.index');

    $app->get('/register', [AuthController::class, 'register'])->setName('auth.register');

    $app->post('/register', [AuthController::class, 'store']);

    $app->get('/login', [AuthController::class, 'login'])->setName('auth.login');

    $app->post('/login', [AuthController::class, 'authenticate']);

    $app->get('/logout', [AuthController::class, 'logout'])->setName('auth.logout');

    $app->get('/dashboard', [AuthController::class, 'dashboard'])
        ->setName('user.dashboard')
        ->add(TwoFactorMiddleware::class)  // Add this line
        ->add(AuthMiddleware::class);

    $app->get('/products', [ProductsController::class, 'userIndex']);

    $app->get('/api/products/search', [ProductsController::class, 'search'])
        ->setName('api.products.search');

    $app->get('/2fa/setup', [TwoFactorController::class, 'showSetup'])
        ->setName('2fa.setup')
        ->add(AuthMiddleware::class);

    $app->post('/2fa/verify-and-enable', [TwoFactorController::class, 'verifyAndEnable'])
        ->setName('2fa.enable')
        ->add(AuthMiddleware::class);

    // 2FA Verification during login
    $app->get('/2fa/verify', [TwoFactorController::class, 'showVerify'])
        ->setName('2fa.verify')
        ->add(AuthMiddleware::class);

    $app->post('/2fa/verify', [TwoFactorController::class, 'verify'])
        ->setName('2fa.verify.post')
        ->add(AuthMiddleware::class);

    // 2FA Disable (requires full auth including 2FA)

    $app->get('/2fa/disable', [TwoFactorController::class, 'showDisable'])
        ->setName('2fa.disable.show')
        ->add(TwoFactorMiddleware::class)
        ->add(AuthMiddleware::class);


    $app->post('/2fa/disable', [TwoFactorController::class, 'disable'])
        ->setName('2fa.disable')
        ->add(TwoFactorMiddleware::class)
        ->add(AuthMiddleware::class);

    // A route to test runtime error handling and custom exceptions.
    $app->get('/error', function (Request $request, Response $response, $args) {
        throw new \Slim\Exception\HttpNotFoundException($request, "Something went wrong");
    });
};

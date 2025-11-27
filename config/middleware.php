<?php

declare(strict_types=1);

use App\Middleware\ExceptionMiddleware;
use App\Middleware\LocaleMiddleware;
use App\Middleware\SessionMiddleware;
use Slim\App;

return function (App $app) {
    //TODO: Add your middleware here.

    $app->addBodyParsingMiddleware();
    $app->addRoutingMiddleware();
    //!NOTE: the error handling middleware MUST be added last.
    //!NOTE: You can add override the default error handler with your custom error handler.
    //* For more details, refer to Slim framework's documentation.
    // Add your middleware here.
    // Start the session at the application level.
    //$app->add(SessionStartMiddleware::class);
    $app->add(ExceptionMiddleware::class);
    // option 2
    $app->add(SessionMiddleware::class);
    // Detect and set the application locale
    $app->add(LocaleMiddleware::class);
};

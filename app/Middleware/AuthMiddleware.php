<?php

namespace App\Middleware;

use App\Helpers\FlashMessage;
use App\Helpers\SessionManager;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response as Psr7Response;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\Psr17\NyholmPsr17Factory;
use Slim\Routing\RouteContext;

class AuthMiddleware implements MiddlewareInterface
{
    /**
     * Process the request - check if user is authenticated.
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        // TODO: Check if user is authenticated using SessionManager::get('is_authenticated')
        //       Store the result in $isAuthenticated variable
        $isAuthenticated = SessionManager::get('is_authenticated');
        // TODO: If NOT authenticated:
        //       - Use FlashMessage::error() with message: "Please log in to access this page."
        //       - Get RouteParser: $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        //       - Generate login URL: $loginUrl = $routeParser->urlFor('auth.login');
        //       - Create redirect response:
        //         $response = new \Slim\Psr7\Response();
        //         return $response->withHeader('Location', $loginUrl)->withStatus(302);
        if (!$isAuthenticated) {
            FlashMessage::error('Please log in to access this page');
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $loginUrl = $routeParser->urlFor('auth.login');

            $factory = new Psr17Factory();
            return $factory->createResponse(302);
        }

        // If authenticated, continue to the next middleware/route handler
        // TODO: Return $handler->handle($request);

        return $handler->handle($request);
    }
}

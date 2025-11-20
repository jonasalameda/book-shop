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
use Slim\Routing\RouteContext;

class AdminAuthMiddleware implements MiddlewareInterface
{
    /**
     * Process the request - check if user is authenticated AND is an admin.
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        // TODO: Get authentication status using SessionManager::get('is_authenticated')
        $isAuthenticated = SessionManager::get('is_authenticated');
        // TODO: Get user role using SessionManager::get('user_role')
        $userRole = SessionManager::get('user_role');

        // TODO: If NOT authenticated:
        //       - Use FlashMessage::error() with message: "Please log in to access the admin panel."
        //       - Redirect to 'auth.login' (same pattern as AuthMiddleware)

        if (!$isAuthenticated) {
            // dd("OsdI");
            FlashMessage::error("Please log in to access the admin panel.");
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $loginUrl = $routeParser->urlFor('auth.login');
            // dd("OsdI");
            $factory = new Psr17Factory();
            $response =  $factory->createResponse(302);
            return $response->withHeader('Location', $loginUrl)->withStatus(302);
        }

        // TODO: If authenticated but role is NOT 'admin':
        //       - Use FlashMessage::error() with message: "Access denied. Admin privileges required."
        //       - Redirect to 'user.dashboard' route
        if ($isAuthenticated && $userRole !== 'admin') {
            FlashMessage::error("Access denied. Admin privileges required.");
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $loginUrl = $routeParser->urlFor('user.dashboard');

            $factory = new Psr17Factory();
            $response =  $factory->createResponse(302);
            return $response->withHeader('Location', $loginUrl)->withStatus(302);
        }

        // If authenticated AND admin, continue to admin route
        // TODO: Return $handler->handle($request);

        return $handler->handle($request);
    }
}

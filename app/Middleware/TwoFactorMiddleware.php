<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Domain\Models\TwoFactorAuth as ModelsTwoFactorAuth;
use App\Domain\Models\TwoFactorAuthModel;
use App\Helpers\SessionManager;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use RobThree\Auth\TwoFactorAuth;
use Slim\Routing\RouteContext;
use App\Domain\Models\TrustedDeviceModel;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseFactoryInterface;

/**
 * Middleware to check if user needs to verify 2FA.
 *
 * This middleware runs AFTER AuthMiddleware. It checks:
 * 1. Is the user authenticated?
 * 2. Does the user have 2FA enabled?
 * 3. Has the user already verified 2FA in this session?
 *
 * If 2FA is required but not verified, redirect to /2fa/verify
 */
class TwoFactorMiddleware implements MiddlewareInterface
{
    public function __construct(
        private TwoFactorAuthModel $twoFactorModel,
        private TrustedDeviceModel $trustedDeviceModel
    ) {}

    public function process(Request $request, RequestHandler $handler): ResponseInterface
    {
        // Check if user is authenticated
        if (!SessionManager::get('is_authenticated')) {
            // Not authenticated, let AuthMiddleware handle it
            return $handler->handle($request);
        }

        $userId = SessionManager::get('user_id');

        // TODO: Check if user has 2FA enabled
        // HINT: Use $this->twoFactorModel->isEnabled($userId)
        $has2FAEnabled = $this->twoFactorModel->isEnabled($userId); // Replace with your implementation

        // If 2FA is not enabled, proceed normally
        if (!$has2FAEnabled) {
            return $handler->handle($request);
        }

        // Check for trusted device cookie
        $cookies = $request->getCookieParams();
        $deviceToken = $cookies['trusted_device'] ?? null;

        if ($deviceToken) {
            if ($this->trustedDeviceModel->isValid($deviceToken, $userId)) {
                // Device is trusted - mark 2FA as verified
                SessionManager::set('two_factor_verified', true);
                $this->trustedDeviceModel->updateLastUsed($deviceToken);

                return $handler->handle($request);
            } else {
                // Token invalid/expired - delete cookie
                setcookie('trusted_device', '', time() - 3600, '/' . APP_ROOT_DIR_NAME);
            }
        }

        // Continue to redirect to 2FA verification...

        // TODO: Check if 2FA has already been verified in this session
        // HINT: Check SessionManager::get('two_factor_verified')
        $isVerified = SessionManager::get('two_factor_verified'); // Replace with: SessionManager::get('two_factor_verified')

        if ($isVerified) {
            // 2FA already verified, proceed
            return $handler->handle($request);
        }

        // 2FA required but not verified - redirect to verification page
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $verifyUrl = $routeParser->urlFor('2fa.verify');

        $factory = new Psr17Factory();
        $response =  $factory->createResponse(302);
        return $response->withHeader('Location', $verifyUrl)->withStatus(302);
    }
}

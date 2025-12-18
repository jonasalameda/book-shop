<?php

namespace App\Controllers;

use App\Domain\Models\AdminModel;
use App\Helpers\FlashMessage;
use App\Helpers\SessionManager;
use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AdminProfileController extends BaseController
{
    public function __construct(
        Container $container,
        private AdminModel $admin_model
    ) {
        parent::__construct($container);
    }

    /**
     * Show current admin profile
     */
    public function edit(Request $request, Response $response): Response
    {
        $adminId = SessionManager::get('user_id');

        if (!$adminId || SessionManager::get('user_role') !== 'admin') {
            FlashMessage::error('Unauthorized access.');
            return $this->redirect($request, $response, 'login');
        }

        $admin = $this->admin_model->getOneAdmin($adminId);

        if (!$admin) {
            FlashMessage::error('Admin account not found.');
            return $this->redirect($request, $response, 'dashboard.index');
        }

        $data = [
            'admin' => $admin
        ];

        return $this->render($response, 'admin/profile/profileEditView.php', $data);
    }

    /**
     * Update current admin profile
     */
    public function update(Request $request, Response $response): Response
    {
        $adminId = SessionManager::get('user_id');
        if (!$adminId || SessionManager::get('user_role') !== 'admin') {
            FlashMessage::error('Unauthorized access.');
            return $this->redirect($request, $response, 'login');
        }
        $data = $request->getParsedBody();
        $this->admin_model->updateAdmin($adminId, $data);
        SessionManager::set('user_name', $data['first_name'] . ' ' . $data['last_name']);
        SessionManager::set('user_email', $data['email']);
        FlashMessage::success('Profile updated successfully.');
        return $this->redirect($request, $response, 'dashboard.index');
    }
}

<?php

namespace App\Controllers;

use App\Domain\Models\CustomerModel;
use App\Helpers\FlashMessage;
use App\Helpers\SessionManager;
use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CustomersController extends BaseController
{

    public function __construct(Container $container, private CustomerModel $customer_model)
    {
        parent::__construct($container);
    }

    /**
     * Display customer page
     */
    public function index(Request $request, Response $response, array $args): Response
    {


        $data = ['title' => 'Customer Page'];
        $data['customers'] = $this->customer_model->getCustomers();
        return $this->render($response, 'admin/customers/customersIndexView.php', $data);
    }

    public function edit(Request $request, Response $response, array $args): Response
    {
        $userID = $args["id"];
        // dd($userID);
        $customer = $this->customer_model->getOneCustomer($userID);
        // dd($user); //Works
        $data = [
            'user' => $customer
        ];
        return $this->render($response, 'admin/customers/customersEditView.php', $data);
    }

    public function editCustomers(Request $request, Response $response, array $args): Response
    {
        $userID = $args["id"];
        $customer = $this->customer_model->getOneCustomer($userID);

        return $this->render($response, 'admin/customers/customersEditView.php', [
            'customer' => $customer
        ]);
    }


    public function editProfile(Request $request, Response $response, array $args): Response
    {

        $userID = $args["user_id"] ?? null;
        // dd($userID);
        $customer = $this->customer_model->getOneCustomer($userID);
        // dd($user); //Works
        $data = [
            'user' => $customer
        ];
        return $this->render($response, 'customer/editProfile.php', $data);
    }

    /**
     * update user
     */
    public function update(Request $request, Response $response, array $args): Response
    {
        $userInfo = $request->getParsedBody();
        // dd($userInfo); //is good
        $user_id = $userInfo["user_id"];

        $this->customer_model->updateCustomerProfile($user_id, $userInfo);

        $updatedUser = $this->customer_model->getOneCustomer($user_id);

        SessionManager::set('user_name', $updatedUser['first_name'] . ' ' . $updatedUser['last_name']);
        SessionManager::set('user_email', $updatedUser['email']);
        SessionManager::set('user_id', $updatedUser['id']);
        SessionManager::set('username', $updatedUser['username']);

        FlashMessage::success('Customer information updated successfully!');

        return $this->redirect($request, $response, 'user.dashboard');
    }

    public function updateCustomers(Request $request, Response $response, array $args): Response
    {
        $userID = $args["id"];
        $userInfo = $request->getParsedBody();

        $this->customer_model->updateCustomer($userID, $userInfo);

        FlashMessage::success('Customer updated successfully.');

        return $this->redirect($request, $response, 'customers.index');
    }

    public function delete(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];

        $this->customer_model->deleteCustomer($id);

        FlashMessage::success('Customer deleted successfully.');

        return $this->redirect($request, $response, 'customers.index');
    }
}

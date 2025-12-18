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
            'customer' => $customer
        ];
        return $this->render($response, 'admin/customers/customersEditView.php', $data);
    }

    /**
     * Delete user
     */
    public function update(Request $request, Response $response, array $args): Response
    {
        $userInfo = $request->getParsedBody();
        // dd($userInfo); //is good
        $user_id = $userInfo["id"];
        $this->customer_model->updateCustomer($user_id, $userInfo);
        FlashMessage::success('Customer information updated successfully!');
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

<?php

namespace App\Controllers;

use App\Helpers\SessionManager;
use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DashboardController extends BaseController
{
    public function __construct(Container $container)
    {
        parent::__construct($container);
    }

    //*step1 add route handler/request handler (controller) method aka a callback method
    public function index(Request $req, Response $res, array $args): Response {
        //! to process the request: we might need to interact with the model.
        //*change, pull data/records, etc.
        //* render view or redirect th $req to another view
        $data = [];
        SessionManager::set('user_id', 321);
        SessionManager::set('username', 'john');

        return $this->render($res, 'admin/dashboardView.php', $data);
    }

    public function products(Request $req, Response $res, array $args): Response {
        // return $this->redirect($req, $res, 'products.index');
        return $this->render($res, 'admin/products/productsIndexView.php');
    }
}

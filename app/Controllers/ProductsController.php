<?php

namespace App\Controllers;

use App\Domain\Models\ProductsModel;
use App\Helpers\SessionManager;
use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class ProductsController extends BaseController
{
    public function __construct(Container $container, private ProductsModel $products_model)
    {
        parent::__construct($container);
    }

    public function index(Request $request, Response $response, array $args): Response
    {
        //* 1) Fetch from the DB.
        $products = $this->products_model->getProducts();

        //* 2) Prepare the data to be passed to the view.
        //!NOTE: Must be a well-structured associative array.
        $data = [
            'title' => 'List of Products',
            'message' => 'Welcome to the home page',
            'products' => $products
        ];

        // $userId = SessionManager::get('user_id');
        // $username = SessionManager::get('username');

        // if (!$username) {
        //     return $response->withStatus(401);
        // }

        // $data["username"] = $username;
        // //* Render a view (OR we can redirect the request to another view)
        return $this->render($response, 'admin/products/productsIndexView.php', $data);
    }

    public function show(Request $request, Response $response, array $args): Response {
        return $response;
    }
    public function create(Request $request, Response $response, array $args): Response {
        return $response;
    }
    public function edit(Request $request, Response $response, array $args): Response {
        //* Step 1) Get the item id to be edited from the query string params section of the URI
        $filters = $request->getQueryParams();
        // dd("Editing the product: " . $product_id['id']);
        $product_id = $filters['id'];

        //* Step 2) Pull the existing item identified by the received ID from the database.
        $product = $this->products_model->getProductById($product_id);

        //* Step 3) Pass it to the view where the update/editing form filled with item info will be rendered
        dd($product);

        return $response;
    }
    public function update(Request $request, Response $response, array $args): Response {
        return $response;
    }
    public function delete(Request $request, Response $response, array $args): Response {
        return $response;
    }
}

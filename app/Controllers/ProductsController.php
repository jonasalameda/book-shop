<?php

namespace App\Controllers;

use App\Domain\Models\CategoriesModel;
use App\Domain\Models\ProductsModel;
use App\Helpers\SessionManager;
use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Helpers\FlashMessage;


class ProductsController extends BaseController
{
    public function __construct(Container $container, private ProductsModel $products_model, private CategoriesModel $categories_model)
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
        // dd("Editing the product: " . $product_id['id']);
        $product_id = $args['product_id'];
        // dd("Editing product: " . $product_id);

        //* Step 2.a) Pull the existing item identified by the received ID from the database.
        $product = $this->products_model->getProductById($product_id);

        //* Step 2.b) Fetch the list of categories from the DB
        $categories = $this->categories_model->getAll();
        // dd($product);

        //* Step 3) Pass it to the view where the update/editing form filled with item info will be rendered

        $data = [
            'page_title' => 'Edit Product Details',
            'product' => $product,
            'categories' => $categories
        ];

        return $this->render($response, 'admin/products/productsEditView.php', $data);
    }
    public function update(Request $request, Response $response, array $args): Response {
        //! Handle the submission of the edit form
        //? Save the edited product info.
        //* 1) Get the received form data from the request
        $product_info = $request->getParsedBody();
        // dd($product_info);
        //TODO: Add a flash message to be shown to the user in master list (products list)
        //* 2) Ask the model to save the product info
        FlashMessage::success('Update Successful');
        return $this->redirect($request, $response, 'products.index');
    }
    public function delete(Request $request, Response $response, array $args): Response {
        return $response;
    }
}

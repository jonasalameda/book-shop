<?php

namespace App\Controllers;

use App\Domain\Models\CategoriesModel;
use App\Domain\Models\ProductsModel;
use App\Helpers\FlashMessage;
use App\Helpers\SessionManager;
use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CategoriesController extends BaseController
{
    public function __construct(Container $container, private CategoriesModel $categories_model)
    {
        parent::__construct($container);
    }

    public function index(Request $request, Response $response, array $args): Response
        {
            //* 1) Fetch from the DB.
            $categories = $this->categories_model->getAll();

            //!NOTE: Must be a well-structured associative array.
            $data = [
                'title' => 'List of Categories',
                'message' => 'Welcome to the home page',
                'categories' => $categories
            ];

            // $userId = SessionManager::get('user_id');
            // $username = SessionManager::get('username');

            // if (!$username) {
            //     return $response->withStatus(401);
            // }

            // $data["username"] = $username;

            // //* Render a view (OR we can redirect the request to another view)
            return $this->render($response, 'admin/categories/categoriesIndexView.php', $data);
        }

    public function show(Request $request, Response $response, array $args): Response
    {
        return $response;
    }

    public function create(Request $request, Response $response, array $args): Response
    {
        $categories = $this->categories_model->getAll();

        $data = [
            'title' => 'Create Categories',
            'message' => 'Welcome to the home page',
            'categories' => $categories,
        ];

        return $this->render($response, 'admin/categories/categoriesCreateView.php', $data);
    }

    public function edit(Request $request, Response $response, array $args): Response
    {
        //* Step 1) Get the item id to be edited from the query string params section of the URI
        // dd("Editing the product: " . $product_id['id']);
        $category_id = $args['category_id'];
        // dd("Editing product: " . $product_id);

        //* Step 2.a) Pull the existing item identified by the received ID from the database.
        $category = $this->categories_model->getCategoryById($category_id);

        //* Step 2.b) Fetch the list of categories from the DB
        // dd($product);

        //* Step 3) Pass it to the view where the update/editing form filled with item info will be rendered

        $data = [
            'title' => 'Create Products',
            'categories' => $category,
        ];

        return $this->render($response, 'admin/categories/categoriesEditView.php', $data);
    }

    public function update(Request $request, Response $response, array $args): Response
    {
        $category_info = $request->getParsedBody();

        dd($category_info);

        FlashMessage::success("Successfully updated the following category: {$category_info['category_name']}");

        return $this->redirect($request, $response, 'categories.index');
    }

    public function delete(Request $request, Response $response, array $args): Response
    {
        return $response;
    }
}

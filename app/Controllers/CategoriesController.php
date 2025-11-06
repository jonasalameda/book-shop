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
        return $response;
    }

    public function edit(Request $request, Response $response, array $args): Response
    {
        $filters = $request->getQueryParams();
        $category_id = $args['category_id'];

        $category = $this->categories_model->getCategoryById($category_id);

        $categories = $this->categories_model->getAll();

        dd($category);

        $data = [
            "category",
        ];

        return $this->render($response, 'edit', $data);
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

<?php

namespace App\Controllers;

use App\Domain\Models\CategoriesModel;
use App\Domain\Models\ProductsModel;
use App\Helpers\SessionManager;
use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Helpers\FlashMessage;

use function DI\string;

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

    public function show(Request $request, Response $response, array $args): Response
    {
        return $response;
    }

    public function create(Request $request, Response $response, array $args): Response
    {
        // $products = $this->products_model->getProducts();
        $categories = $this->categories_model->getAll();

        $data = [
            'title' => 'Create Products',
            'message' => 'Welcome to the home page',
            'categories' => $categories,
        ];

        return $this->render($response, 'admin/products/productsCreateView.php', $data);
    }

    public function add(Request $request, Response $response, array $args): Response
    {
        $products = $this->products_model->getProducts();
        $productId = $this->products_model->createProduct($request->getParsedBody());
        $imageData = $this->upload($request, ['image/jpeg', 'image/png', 'image/gif'], 2 * 1024 * 1024, 'product_', "products")->getData();
        // ? DEFAULT: ['image/jpeg', 'image/png', 'image/gif']
        // ? DEFAULT: 2 * 1024 * 1024 // 2MB in bytes
        // ? DEFAULT: 'upload_'
        $this->products_model->createProductImage([
            "prod_id" => $productId,
            "file_path" => $imageData['filepath'],
            "is_primary" => true,
        ]);

        $data = [
            'title' => 'Create Products',
            'message' => 'Welcome to the home page',
            'products' => $products,
        ];

        return $this->redirect($request, $response, 'products.index', $data);
    }


    public function edit(Request $request, Response $response, array $args): Response
    {
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
    public function update(Request $request, Response $response, array $args): Response
    {
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
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $response;
    }

    public function search(Request $request, Response $response, array $args): Response
    {
        // TODO: Extract query parameters using $request->getQueryParams()
        // - Get 'q' parameter, trim it, default to empty string if not set
        // - Get 'category' parameter, convert to int if set, otherwise null
        $request->getQueryParams();
        $params = [
            'q' => trim($request['q'] ?? ''),
            'category' => (int) $request['category'] ?? null,
        ];

        // TODO: Validate search term length
        // - If longer than 100 characters, truncate it using substr()
        if (strlen($params['q']) > 100) {
            $params['q'] = substr($params['q'], 0, 100);
        }

        // TODO: Call $this->model->searchProducts() with search term and category ID
        $products = $this->products_model->searchProducts();

        // TODO: Create response data array with these keys:
        // - 'success' => true
        // - 'count' => count of products
        // - 'query' => the search term
        // - 'category_id' => the category ID
        // - 'products' => the products array
        $data = [
            'success' => true,
            'count' => array_count_values($products),
            'query' => $params['q'],
            'category_id' => $params['category'],
            'products' => $products,
        ];

        // TODO: Convert response data to JSON and write to response body
        // @see: https://www.slimframework.com/docs/v4/objects/response.html#returning-json
        // - Use json_encode()
        // - Use $response->getBody()->write()
        $json = json_encode($response);
        $response->getBody()->write($json);

        // TODO: Return response with proper headers
        // - Set Content-Type: application/json
        // - Set status code 200
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function details(Request $request, Response $response, array $args): Response
    {
        $productId = $args['id'];

        $product = $this->products_model->getProductById($productId);

        $data = [
            "product" => $product,
            "categories" => $this->categories_model->getCategoryById($productId),
            "images" => $this->products_model->getProductImage($productId)
        ];

        return $this->render($response, 'products/userProductDetailsView.php', $data);
    }

    public function userIndex(Request $request, Response $response, array $args): Response
    {
        // TODO: Get all products using $this->model->getAllProducts()
        $products = $this->products_model->getProducts();
        // TODO: Get all categories using $this->model->getAllCategories()
        $categories = $this->categories_model->getAll();
        // TODO: Render the view 'products/userProductIndexView.php'
        // - Pass products, categories, and page_title in the data array
        return $this->render($response, 'products/userProductIndexView.php', ['products' => $products, 'categories' => $categories]);
    }
}

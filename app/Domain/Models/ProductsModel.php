<?php

namespace App\Domain\Models;

use App\Helpers\Core\PDOService;

class ProductsModel extends BaseModel
{

    private $products_table = "products";
    public function __construct(PDOService $db_service)
    {
        parent::__construct($db_service);
    }

    /**
     * Fetches the list of products from the DB.
     * @return mixed
     */
    public function getProducts(): mixed
    {

        $sql = "SELECT * FROM {$this->products_table} ORDER BY id ASC";
        $products = $this->selectAll($sql);
        return $products;
    }

    public function getProductById(int $product_id): mixed
    {

        $sql = "SELECT * FROM {$this->products_table} WHERE id = :product_id";
        $product = $this->selectOne($sql, ["product_id" => $product_id]);
        return $product;
    }

    public function updateProduct(int $id, array $productData)
    {
        return $this->execute(
            'UPDATE users
         SET name = :name, description = :description, price = :price, stock_quantity = :stock_quantity, updated_at = :updated_at
         WHERE id = :id',
            [
                'id' => $id,
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'stock_quantity' => $productData['stock_quantity'],
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );
    }

    public function createProduct(array $productData)
    {
        $this->execute(
            'INSERT INTO `products` (category_id, name, description, price, stock_quantity, updated_at) VALUES (:category_id, :name, :description, :price, :stock_quantity, :updated_at)',
            [
                'category_id' => (int) $productData['category_id'],
                'name' => $productData['product_name'],
                'description' => $productData['description'],
                'price' => (float) $productData['price'],
                'stock_quantity' => (int) $productData['stock_quantity'],
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        return $this->lastInsertId();
    }

    public function createProductImage(array $data)
    {
        return $this->execute(
            'INSERT INTO `product_images` (product_id, file_path, is_primary) VALUES (:product_id, :file_path, :is_primary)',
            [
                'product_id' => $data['prod_id'],
                'file_path' => $data['file_path'],
                'is_primary' => $data['is_primary'] ?? false,
            ]
        );
    }

    public function searchProducts(string $searchTerm = '', ?int $categoryId = null): array
    {
        // TODO: Create base SQL query with LEFT JOINs
        // - Join products (p) with categories (c) on category_id
        // - Join with product_images (pi) where is_primary = 1
        // - Select: p.id, p.name, p.description, p.price, p.stock_quantity,
        //              c.name AS category_name, c.id AS category_id, pi.file_path AS image_path
        // - Start with WHERE 1=1 to make adding conditions easier
        $sql = "SELECT p.id, p.name, p.description, p.price, p.stock_quantity,
                 c.name AS category_name, c.id AS category_id, pi.file_path AS image_path FROM products p LEFT JOIN categories c ON p.category_id = c.id
                 LEFT JOIN product_images pi ON p.id = pi.product_id
                 WHERE p.name CONCAT('%', :search, '%') OR
                    p.description LIKE :search AND
                    c.id = :category_id
                GROUP BY p.id
                ORDER BY p.name ASC";

        // TODO: Initialize empty params array
        $params = [];
        // TODO: If searchTerm is not empty:
        // - Add condition: (p.name LIKE :search OR p.description LIKE :search)
        // - Add to params: 'search' => '%' . $searchTerm . '%'
        if (!empty($searchTerm)) {
            $params['search'] = $searchTerm;
        }

        // TODO: If categoryId is provided and > 0:
        // - Add condition: p.category_id = :category_id
        // - Add to params: 'category_id' => $categoryId
        if ($categoryId > 0) {
            $params['category_id'] = $categoryId;
        }

        // TODO: Add GROUP BY p.id and ORDER BY p.name ASC

        // TODO: Return results using $this->selectAll($sql, $params)
        return $this->selectAll($sql, $params);
    }

    public function getProductImage(int $productId)
    {
        return $this->selectAll("SELECT * FROM `product_images` WHERE product_id = ?", [$productId]);
    }
}

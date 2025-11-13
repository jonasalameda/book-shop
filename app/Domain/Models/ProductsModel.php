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

        $sql = "SELECT * FROM {$this->products_table}";
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
}

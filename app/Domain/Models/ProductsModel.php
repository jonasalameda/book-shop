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
    public function getProducts() : mixed {

        $sql = "SELECT * FROM {$this->products_table}";
        $products = $this->selectAll($sql);
        return $products;
    }

    public function getProductById(int $product_id) : mixed {

        $sql = "SELECT * FROM {$this->products_table} WHERE id = :product_id";
        $product = $this->selectOne($sql, ["product_id" => $product_id]);
        return $product;
    }

    public function updateProduct(int $id, array $userData) {
        return $this->execute(
        'UPDATE users
         SET name = :name, description = :description, price = :price, stock_quantity = :stock_quantity, updated_at = :updated_at
         WHERE id = :id',
        [
            'id' => $id,
            'name' => $userData['name'],
            'description' => $userData['description'],
            'price' => $userData['price'],
            'stock_quantity' => $userData['stock_quantity'],
            'updated_at' => date('Y-m-d H:i:s')
        ]
    );
    }
}

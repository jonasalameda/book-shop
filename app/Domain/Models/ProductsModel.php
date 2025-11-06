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
        $products = $this->selectOne($sql, ["product_id" => $product_id]);
        return $products;
    }
}

<?php

namespace App\Domain\Models;

use App\Helpers\Core\PDOService;

class CategoriesModel extends BaseModel
{
    private $categories_table = "categories";

    public function __construct(PDOService $db_service)
    {
        $this->pdo = $db_service->getPDO();
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM {$this->categories_table} ";
        return $this->selectAll($sql);
    }

    public function getCategoryById(int $product_id): mixed
    {

        $sql = "SELECT * FROM {$this->categories_table} WHERE id = :product_id";
        $products = $this->selectOne($sql, ["product_id" => $product_id]);
        return $products;
    }

    function updateCategory(array $product_info)
    {
        $sql = "UPDATE products SET name = ?, description = ? WHERE id = ?";

        return $this->execute(
            $sql,
            [
                $product_info['category_name'],
                $product_info['description'],
                $product_info['id']
            ]
        );
    }
}

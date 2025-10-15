<?php

namespace App\Domain\Models;
use \App\Helpers\Core\PDOService;
class ShopModel extends BaseModel
{
    public function __construct(PDOService $pdo_service) {
        parent::__construct($pdo_service);
    }

    // public method that reads and returns the list of shops.
    public function fetchShops() : mixed {
        $sql = "SELECT * FROM cafes";
        $cafes = $this->selectAll($sql);

        return $cafes;
    }

    public function fetchShop($id) : mixed {
        $cafe = $this->selectOne('SELECT * FROM cafes WHERE id = ?', [$id]);;

        return $cafe;
    }

    public function fetchReviews($shop_id) : mixed {
        $sql = "SELECT * FROM location_ratings WHERE location_id=?";

        $reviews = $this->selectOne($sql, [$shop_id]);

        return $reviews;
    }

        public function fetchDrinks($shop_id) : mixed {
        $sql = "SELECT * FROM location_drinks WHERE location_id=?";

        $drinks = $this->selectAll($sql, [$shop_id]);

        return $drinks;
    }

    // optional parameter should be last, while required parameters (such as searchKeyword) must be put first
    public function searchShops($searchKeyword, $filterType = "city") : mixed {
        if ($filterType == "city") {
            $query = "SELECT * FROM `cafes` WHERE `city` LIKE CONCAT('%', :city, '%');";
            $cafes = $this->selectAll($query, ["city" => $searchKeyword]);

            return $cafes;
        }

        $sql = "SELECT * FROM `cafes` WHERE `name` LIKE CONCAT('%', :name, '%');";
        $cafes = $this->selectAll($sql, ["name" => $searchKeyword]);

        // if (!$cafes) {
        //     throw new \InvalidArgumentException("No locations found.");
        // }
        return $cafes;
    }
}

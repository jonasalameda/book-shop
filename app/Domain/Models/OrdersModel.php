<?php

use App\Domain\Models\BaseModel;
use App\Helpers\Core\PDOService;

class OrdersModel extends BaseModel
{
    public function __construct(PDOService $pdo_service)
    {
        parent::__construct($pdo_service);
    }

    public function createOrder($orderData)
    {
        $this->execute(
            'INSERT INTO `orders` (user_id, total_amount, status) VALUES (user_id, total_amount, status)',
            [
                'user_id' => (int) $orderData['user_id'],
                'total_amount' => $orderData['product_total_amount'],
                'status' => $orderData['status'],
            ]
        );

        return $this->lastInsertId();
    }

    public function getOrders()
    {
        $query = "SELECT * FROM `orders`";
        $orders = $this->selectAll($query);
        return $orders;
    }

    public function getOneOrder(int $id)
    {
        $query = "SELECT * FROM `orders` WHERE id = :order_id";
        $order = $this->selectOne($query, ['order_id' => $id]);
        return $order;
    }

    //Update user information
    public function updateOrder(int $id, array $userInfo)
    {
        // dd($id);
        // dd($userInfo); Naming was changed
        $sql = "UPDATE users
                SET
                total_amount = :total_amount,
                status = :status
                WHERE id = :id";

        $updateUser = $this->execute($sql, [
            'id' => $id,
            'status' => $userInfo['status'],
            'total_amount'  => $userInfo['total_amount']
        ]);
        return $updateUser;
    }

    public function deleteOrder($id)
    {
        $query = "DELETE FROM orders WHERE id = :order_id AND role = 'customer'";

        $this->execute($query, ['order_id' => $id]);
    }
}

<?php

namespace App\Domain\Models;

use App\Helpers\Core\PDOService;

class CustomerModel extends BaseModel
{

    public function __construct(PDOService $pdo_service)
    {
        parent::__construct($pdo_service);
    }

    public function getCustomers()
    {
        $query = "SELECT * FROM users WHERE role = 'customer'";
        $customers = $this->selectAll($query);
        return $customers;
    }

    public function getOneCustomer($id)
    {
        $query = "SELECT * FROM users WHERE id = :customer_id";
        $customer = $this->selectOne($query, ['customer_id' => $id]);
        return $customer;
    }

    //Update user information
    public function updateCustomer(int $id, array $userInfo)
    {
        // dd($id);
        // dd($userInfo); Naming was changed
        $sql = "UPDATE users SET first_name = :first_name,
                last_name = :last_name,
                username = :username,
                email = :email,
                role = :role,
                updated_at = NOW() WHERE id = :id";

        $updateUser = $this->execute($sql, [
            'id'         => $id,
            'first_name' => $userInfo['first_name'],
            'last_name'  => $userInfo['last_name'],
            'username'   => $userInfo['username'],
            'email'      => $userInfo['email'],
            'role'       => $userInfo['role']
        ]);
        return $updateUser;
    }

    public function deleteCustomer($id)
    {
        $query = "DELETE FROM users WHERE id = :customer_id AND role = 'customer'";

        $this->execute($query, ['customer_id' => $id]);
    }
}

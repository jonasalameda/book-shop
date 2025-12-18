<?php

namespace App\Domain\Models;

use App\Helpers\Core\PDOService;

class AdminModel extends BaseModel
{

    public function __construct(PDOService $pdo_service)
    {
        parent::__construct($pdo_service);
    }

    public function getAdmins()
    {
        $query = "SELECT * FROM users WHERE role = 'admin'";
        $admins = $this->selectAll($query);
        return $admins;
    }

    public function getOneAdmin($id)
    {
        $query = "SELECT * FROM users WHERE id = :admin_id AND role = 'admin'";
        $admin = $this->selectOne($query, ['admin_id' => $id]);
        return $admin;
    }

    //Update admin information
    public function updateAdmin(int $id, array $userInfo)
    {
        // dd($id);
        // dd($userInfo);
        $sql = "UPDATE users SET first_name = :first_name,
            last_name  = :last_name,
            username   = :username,
            email      = :email,
            updated_at = NOW() WHERE id = :id AND role = 'admin'";

        $updateUser = $this->execute($sql, [
            'id'         => $id,
            'first_name'=> $userInfo['first_name'],
            'last_name' => $userInfo['last_name'],
            'username'  => $userInfo['username'],
            'email'     => $userInfo['email'],
        ]);
        return $updateUser;
    }
}

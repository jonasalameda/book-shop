<?php

use App\Helpers\FlashMessage;
use App\Helpers\ViewHelper;

ViewHelper::AdminHeader($data['title']);
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

    <br>
    <h2>List of Customers</h2>

    <div>
        <?= FlashMessage::render() ?>
    </div>

    <hr>

    <div class="table-responsive small">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($data['customers'] as $customer): ?>
                    <tr>
                        <td><?= $customer['id'] ?></td>
                        <td><?= $customer['first_name'] ?></td>
                        <td><?= $customer['last_name'] ?></td>
                        <td><?= $customer['username'] ?></td>
                        <td><?= $customer['email'] ?></td>
                        <td><?= ucfirst($customer['role']) ?></td>
                        <td>
                            <a href="customer/edit/<?= $customer['id'] ?>" class="btn btn-success btn-sm">
                                Edit
                            </a>
                            <a href="customer/delete/<?= $customer['id'] ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Are you sure you want to delete this user?');">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</main>

<?php
ViewHelper::loadJsScripts();
ViewHelper::AdminFooter();
?>

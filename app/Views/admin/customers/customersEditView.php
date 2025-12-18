<?php

use App\Helpers\ViewHelper;

$page_title = 'Edit Customer';

ViewHelper::AdminHeader($page_title);

$customer = $data['customer'];
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

    <h2>Edit Customer:</h2>

    <form class="row g-3" method="POST" action="<?= APP_ADMIN_URL ?>/customer/update/<?= $customer['id'] ?>">

        <input type="hidden" name="id" value="<?= $customer['id'] ?>">

        <div class="col-md-6">
            <label class="form-label">First Name</label>
            <input
                required
                type="text"
                name="first_name"
                value="<?= $customer['first_name'] ?>"
                class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">Last Name</label>
            <input
                required
                type="text"
                name="last_name"
                value="<?= $customer['last_name'] ?>"
                class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">Username</label>
            <input
                required
                type="text"
                name="username"
                value="<?= $customer['username'] ?>"
                class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">Email</label>
            <input
                required
                type="email"
                name="email"
                value="<?= $customer['email'] ?>"
                class="form-control">
        </div>

        <div class="col-md-4">
            <label class="form-label">Role</label>
            <select name="role" class="form-select">
                <option value="customer" <?= $customer['role'] === 'customer' ? 'selected' : '' ?>>
                    Customer
                </option>
                <option value="admin" <?= $customer['role'] === 'admin' ? 'selected' : '' ?>>
                    Admin
                </option>
            </select>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-success">Save</button>
            <a class="btn btn-danger" href="<?= APP_ADMIN_URL ?>/customers">Cancel</a>
        </div>

    </form>

</main>

<?php
ViewHelper::loadJsScripts();
ViewHelper::AdminFooter();
?>

<?php

use App\Helpers\ViewHelper;

$page_title = 'My Profile';
ViewHelper::AdminHeader($page_title);

$admin = $data['admin'];
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

    <h2>My Profile</h2>

    <form class="row g-3" method="POST" action="<?= APP_ADMIN_URL ?>/update/{id}">

        <div class="col-md-6">
            <label class="form-label">First Name</label>
            <input required type="text" name="first_name"
                   value="<?= $admin['first_name'] ?>" class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">Last Name</label>
            <input required type="text" name="last_name"
                   value="<?= $admin['last_name'] ?>" class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">Username</label>
            <input required type="text" name="username"
                   value="<?= $admin['username'] ?>" class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">Email</label>
            <input required type="email" name="email"
                   value="<?= $admin['email'] ?>" class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">New Password</label>
            <input type="password" name="password" class="form-control"
                   placeholder="Leave blank to keep current password">
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-success">Save Changes</button>
        </div>

    </form>

</main>

<?php
ViewHelper::loadJsScripts();
ViewHelper::AdminFooter();
?>

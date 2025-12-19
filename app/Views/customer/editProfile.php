<?php

use App\Helpers\ViewHelper;

$page_title = 'Edit User Details';
$user = $data['user'];

ViewHelper::loadHeader($page_title);
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

    <h2 class="mt-4 mb-4">Edit User Details</h2>

    <form class="row g-4" method="POST" action="<?= APP_BASE_URL ?>/customer/update/<?= $user['id'] ?>">
        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">

        <div class="col-md-6">
            <label for="inputUser_fName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="inputUser_fName" name="user_fname" value="<?= $user['first_name'] ?>" required>
        </div>

        <div class="col-md-6">
            <label for="inputUser_lName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="inputUser_lName" name="user_lname" value="<?= $user['last_name'] ?>" required>
        </div>

        <div class="col-md-6">
            <label for="inputUser_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="inputUser_email" name="user_email" value="<?= $user['email'] ?>" required>
        </div>

        <div class="col-md-6">
            <label for="inputUser_username" class="form-label">Username</label>
            <input type="text" class="form-control" id="inputUser_username" name="user_username" value="<?= $user['username'] ?>" required>
        </div>

        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-success">Update Changes</button>
            <a href="<?= APP_BASE_URL ?>/dashboard" class="btn btn-danger ms-2">Cancel</a>
        </div>

    </form>

</main>

<?php
ViewHelper::loadJsScripts();
ViewHelper::loadFooter();
?>

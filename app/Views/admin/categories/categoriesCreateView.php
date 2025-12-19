<?php
//! Needs to be modified and corrected still. Right now it uses 'products'
//TODO: change view to match category creation

use App\Helpers\ViewHelper;

$page_title = 'Create Category';

//load an admin-specific header.
ViewHelper::adminHeader($page_title);

// dd($product)
$options = ViewHelper::renderSelectOptions($categories, "", 'id', 'name');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h2>Create Category:</h2>
    <form class="row g-3" method="POST" action="<?= APP_ADMIN_URL ?>/categories/upload" enctype="multipart/form-data">
        <input type="hidden" name="prod_id">

        <div class="col-md-6">
            <label for="inputName" class="form-label">Name</label>
            <input type="text" name="product_name" class="form-control" id="inputName">
        </div>

        <div class="col-md-6">
            <label for="inputDescription" class="form-label">Description</label>
            <input type="text" name="description" class="form-control" id="inputDescription">
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-success">Save</button>
            <a class="btn btn-danger" href="<?= APP_ADMIN_URL ?>/products"> Cancel</a>
        </div>
    </form>

    <?php

    ViewHelper::loadJsScripts();
    ///// We need to load an admin-specific footer.
    ViewHelper::adminFooter();
    ?>
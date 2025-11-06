<?php

use App\Helpers\ViewHelper;
//TODO: set the page title dynamically based on the view being rendered in the controller.
$page_title = 'Products list';

//TODO: We need to load an admin-specific header.
ViewHelper::adminHeader($page_title);
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">
                    Share
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary">
                    Export
                </button>
            </div>
            <button
                type="button"
                class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
                <svg class="bi" aria-hidden="true">
                    <use xlink:href="#calendar3"></use>
                </svg>
                This week
            </button>
        </div>
    </div>
    <div class="table-responsive small">
<!--TODO: render the list of products/categories using an HTML table -->

<h1>Welcome to The Book shop Directory</h1>
<br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock Quantity</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($products as $key => $product) {

                ?>
                <tr>
                    <td><?= $product["id"] ?></td>
                    <td> <?= htmlspecialchars($product["name"]) ?> </td>
                    <td> <?= htmlspecialchars($product["description"]) ?> </td>
                    <td> <?= htmlspecialchars($product["price"]) ?> </td>
                    <td> <?= htmlspecialchars($product["stock_quantity"]) ?> </td>
                    <td> <?= htmlspecialchars($product["created_at"]) ?> </td>
                    <td> <?= htmlspecialchars($product["updated_at"]) ?> </td>
                    <td>
                        <a href="products/edit?id=<?= $product['id'] ?>" class="btn btn-success">Edit</a>
                    </td>
                </tr>
            <?php }
            ?>
        </tbody>
    </table>


    </div>
</main>

<?php

ViewHelper::loadJsScripts();
//TODO: We need to load an admin-specific footer.
ViewHelper::adminFooter();
?>

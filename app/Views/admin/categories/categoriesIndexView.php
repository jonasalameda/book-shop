<?php

use App\Helpers\ViewHelper;
//TODO: set the page title dynamically based on the view being rendered in the controller.
$page_title = 'Categories List';

//TODO: We need to load an admin-specific header.
ViewHelper::adminHeader($page_title);
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>
    <div class="table-responsive small">
        <!--TODO: render the list of products/categories using an HTML table -->

        <h1>Welcome to The Book Shop Directory</h1>
        <br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Created at</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($categories as $key => $category) {
                ?>
                    <tr>
                        <td> <?= $category["id"] ?> </td>
                        <td> <?= htmlspecialchars($category["name"]) ?> </td>
                        <td> <?= htmlspecialchars($category["description"]) ?> </td>
                        <td> <?= htmlspecialchars($category["created_at"]) ?> </td>
                        <td>
                            <a href="categories/edit/<?= $category['id'] ?>" class="btn btn-success">Edit</a>
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

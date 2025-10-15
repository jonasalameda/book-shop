<?php

use App\Helpers\ViewHelper;

use function DI\get;

//TODO: set the page title dynamically based on the view being rendered in the controller.
$page_title = "List of Shops";
ViewHelper::loadHeader($page_title);
?>

<h1><a href="/mvc-cafes/shops" class="text-dark"><?= "List of Shops" ?></a></h1>
<form action="/mvc-cafes/shops/search" method="get">
    <input type="search" name="prefix" id="prefix">
    <select name="searchOption" id="option">
        <option value="name">Search by name</option>
        <option value="city">Search by city</option>
    </select>
</form>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th class="col">Name</th>
            <th class="col">Description</th>
            <th class="col">City</th>
            <th class="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($data['cafes'] as $key => $cafe) { ?>
            <tr>
                <td> <?= $cafe["name"]; ?></td>
                <td><?= $cafe["description"]; ?></td>
                <td><?= $cafe["city"]; ?></td>
                <td><a href="/mvc-cafes/shops/<?= $cafe['id'] ?>" class="btn btn-dark">View</a></td>
                <td><button class="btn btn-danger">Delete</button></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php

ViewHelper::loadJsScripts();
ViewHelper::loadFooter();
?>

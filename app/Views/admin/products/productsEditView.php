<?php

use App\Helpers\ViewHelper;
//TODO: set the page title dynamically based on the view being rendered in the controller.
$page_title = 'Edit Product Details';

//TODO: We need to load an admin-specific header.
ViewHelper::adminHeader($page_title);
$product = $data["product"];
$categories = $data["categories"];
// dd($product)

$options = ViewHelper::renderSelectOptions($categories, $product["category_id"], 'id', 'name');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h2>Edit Product:</h2>
<form class="row g-3" method="POST" action="<?= APP_ADMIN_URL ?>/products/update/ <?= $product["id"]?>">
    <input type="hidden" name="product_id" value="<?= $product["id"] ?>">
  <div class="col-md-6">
    <label for="inputName" class="form-label">Name</label>
    <input type="text" value="<?= $product["name"] ?>" name="product_name" class="form-control" id="inputName">
  </div>
  <div class="col-md-6">
    <label for="inputDescription" class="form-label">Description</label>
    <input type="text" value="<?= $product["description"] ?>" name="description" class="form-control" id="inputDescription">
  </div>
  <div class="col-12">
    <label for="inputPrice" class="form-label">Price</label>
    <input type="text" value="<?= $product["price"] ?>" class="form-control" name="price" id="inputPrice" placeholder="19.99">
  </div>
  <div class="col-md-4">
    <label for="inputCategory" class="form-label">Category:</label>
    <select id="inputCategory" name="category" class="form-select">
      <?= $options ?>
<!--TODO: We need to populate the list of options: we should list the product categories -->

    </select>
  </div>
  <div class="col-md-2">
    <label for="inputQuantity" class="form-label">Quantity:</label>
    <input type="text" value="<?= $product["stock_quantity"] ?>" name="quantity" class="form-control" id="inputQuantity">
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-success">Save</button>
    <a class="btn btn-danger" href="<?= APP_ADMIN_URL ?>/products"> Cancel</a>
  </div>
</form>

<?php

ViewHelper::loadJsScripts();
//TODO: We need to load an admin-specific footer.
ViewHelper::adminFooter();
?>

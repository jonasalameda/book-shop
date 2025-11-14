<?php

use App\Helpers\ViewHelper;
//TODO: set the page title dynamically based on the view being rendered in the controller.
$page_title = 'Edit Categories Details';

//TODO: We need to load an admin-specific header.
ViewHelper::adminHeader($page_title);
$categories = $data["categories"];
// dd($product)

?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h2>Edit Category:</h2>
<form class="row g-3" method="POST" action="<?= APP_ADMIN_URL ?>/categories/update/<?= $categories["id"]?>">
    <input type="hidden" name="category_id" value="<?= $categories["id"] ?>">
  <div class="col-md-6">
    <label for="inputName" class="form-label">Category Name</label>
    <input type="text" value="<?= $categories["name"] ?>" name="category_name" class="form-control" id="inputName">
  </div>
  <div class="col-md-6">
    <label for="inputDescription" class="form-label">Category Description</label>
    <input type="text" value="<?= $categories["description"] ?>" name="description" class="form-control" id="inputDescription">
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

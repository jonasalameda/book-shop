<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link rel="stylesheet" href="<?= APP_ASSETS_DIR_URL ?>/css/details.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php

use App\Helpers\ViewHelper;

$page_title = 'Books';
ViewHelper::loadHeader($page_title);
$product = $data['product'];
$categories = $data['categories'];
$images = $data['images'];
?>

<!-- Search Container -->

<div class="book-details" style="height: 50em;">
    <div class="book-image">


        <div id="bookImageCarousel" class="carousel slide carousel-fade">
            <div class="carousel-inner">
                <?php foreach ($images as $image): ?>
                    <div class="carousel-item <?= $image['is_primary'] == 1 ? 'active' : '' ?>">
                        <img height="400" width="100%" src="<?= APP_UPLOADS_DIR_URL . $image['file_path'] ?>" class="d-block">
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#bookImageCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#bookImageCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="book-description">
        <div class="card text-center">
            <div class="card-body">
                <h1><?= $product['name'] ?></h1>
                <h3>$<?= $product['price'] ?></h3>
                <h4>Left in Stock: <?= $product['stock_quantity'] ?></h4>
                <p>
                    <?= $product['description'] ?>
                </p>
            </div>
        </div>
    </div>
    <div class="book-actions">
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <button class="btn btn-primary" type="submit">
                        Add to cart
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Pass base URL to JavaScript -->
<script>
    // Make APP_BASE_URL available to JavaScript
    window.APP_BASE_URL = '<?= APP_BASE_URL ?>';
</script>

<!-- Load JavaScript for live search -->


<?php
ViewHelper::loadJsScripts();
ViewHelper::loadFooter();

?>
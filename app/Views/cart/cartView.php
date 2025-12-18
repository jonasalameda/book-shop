<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Authentication System</title>
    <link rel="stylesheet" href="<?= APP_ASSETS_DIR_URL ?>/css/cart.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php

use App\Helpers\ViewHelper;

$page_title = 'Cart';
ViewHelper::loadHeader($page_title);
?>

<div id="user-cart" class="container-fluid">
    <h1>My Cart</h1>
    <div id="cart-items">
    </div>
    <div id="total-price">
        <p>Total Price: <span id="total-amount"></span></p>
        <button id="checkout-button" class="btn btn-success p-3">Checkout</button>
    </div>
</div>

<?php
ViewHelper::loadFooter();
?>
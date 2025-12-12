<?php
use App\Helpers\ViewHelper;


ViewHelper::loadHeader($data['title']);
?>

    <div class="container mt-5">
        <h1>Welcome, <?= htmlspecialchars($_SESSION['user_name'] ?? 'Guest') ?>!</h1>

        <div class="mb-4">
            <?= App\Helpers\FlashMessage::render() ?>
        </div>

    <div class="container mt-5">
        <h1>User Dashboard</h1>

        <div class="mb-4">
            <?= App\Helpers\FlashMessage::render() ?>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">My Profile</h5>
                        <p class="card-text">
                            <strong>Name:</strong> <?= htmlspecialchars($_SESSION['user_name'] ?? 'N/A') ?><br>
                            <strong>Email:</strong> <?= htmlspecialchars($_SESSION['user_email'] ?? 'N/A') ?><br>
                            <strong>Role:</strong> <?= htmlspecialchars($_SESSION['user_role'] ?? 'N/A') ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Quick Actions</h5>
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-primary">Browse Products</a>
                            <a href="#" class="btn btn-secondary">My Orders</a>
                            <a href="#" class="btn btn-info">Update Profile</a>
                            <a class="btn btn-danger btn-sm" href="logout">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>

<?php

ViewHelper::loadJsScripts();
ViewHelper::loadFooter();
?>

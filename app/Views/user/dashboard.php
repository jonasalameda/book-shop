<?php

use App\Helpers\ViewHelper;


ViewHelper::loadHeader($data['title']);
?>

<div class="container mt-5">
    <h1><?= trans('dashboard.welcome') ?> <?= htmlspecialchars($_SESSION['user_name'] ?? 'Guest') ?>!</h1>

    <div class="mb-4">
        <?= App\Helpers\FlashMessage::render() ?>
    </div>

    <div class="container mt-5">
        <h1><?= trans('dashboard.title') ?></h1>

        <div class="mb-4">
            <?= App\Helpers\FlashMessage::render() ?>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= trans('dashboard.profile') ?></h5>
                        <p class="card-text">
                            <strong><?= trans('dashboard.name') ?></strong> <?= htmlspecialchars($_SESSION['user_name'] ?? 'N/A') ?><br>
                            <strong><?= trans('dashboard.email') ?></strong> <?= htmlspecialchars($_SESSION['user_email'] ?? 'N/A') ?><br>
                            <strong><?= trans('dashboard.role') ?></strong> <?= htmlspecialchars($_SESSION['user_role'] ?? 'N/A') ?>/client
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= trans('dashboard.actions') ?></h5>
                        <div class="d-grid gap-2">
                            <a href="<?= APP_BASE_URL ?>/products" class="btn btn-primary"><?= trans('dashboard.products_btn') ?></a>
                            <a href="#" class="btn btn-secondary"><?= trans('dashboard.orders_btn') ?></a>
                            <a href="#" class="btn btn-info"><?= trans('dashboard.update_btn') ?></a>
                            <a class="btn btn-danger btn-sm" href="logout"><?= trans('dashboard.logout_btn') ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <?php

    ViewHelper::loadJsScripts();
    ViewHelper::loadFooter();
    ?>
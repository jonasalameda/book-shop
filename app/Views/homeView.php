<?php

use App\Helpers\ViewHelper;
//TODO: set the page title dynamically based on the view being rendered in the controller.
$page_title = trans('home.title');
ViewHelper::loadHeader($page_title);
?>

<div class="container-fluid text-center introduction">
    <div class="row mt-3">
        <div class="col">
            <h1><?= trans('home.welcome') ?></h1>
        </div>
    </div>

    <div class="row mt-6">
        <div class="col">
            <h2><i><?= trans('home.subtitle') ?></i></h2>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <button class="btn-start"><?= trans('home.start_button') ?></button>
        </div>
    </div>
</div>

<div class="container-fluid text-start featured">

</div>

<?php

ViewHelper::loadJsScripts();
ViewHelper::loadFooter();
?>

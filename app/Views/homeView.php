<?php

use App\Helpers\ViewHelper;
//TODO: set the page title dynamically based on the view being rendered in the controller.
$page_title = 'Home';
ViewHelper::loadHeader($page_title);
?>

<div class="container-fluid text-center introduction">
    <div class="row mt-3">
        <div class="col">
            <h1>Shop of Ruina</h1>
        </div>
    </div>

    <div class="row mt-6">
        <div class="col">
            <h2><i>"May you find your book in this place"</i></h2>
        </div>
    </div>
</div>

<div class="container-fluid text-start featured">
    
</div>

<?php

ViewHelper::loadJsScripts();
ViewHelper::loadFooter();
?>

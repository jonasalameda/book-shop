<?php

use App\Helpers\ViewHelper;

$page_title = '404 - Page Not Found';
ViewHelper::loadHeader($page_title);
?>

<div style="text-align: center; padding: 50px 20px;">
    <h1 style="font-size: 72px; margin: 0; color: #e74c3c;">404</h1>
    <h2 style="margin: 20px 0;">Page Not Found</h2>
    <p style="font-size: 18px; color: #dcdcdcff; margin: 20px 0;">
        Sorry, the page you are looking for does not exist.
    </p>
    <a href="<?= APP_BASE_URL ?>" style="display: inline-block; margin-top: 30px; padding: 12px 30px; background-color: #3498db; color: white; text-decoration: none; border-radius: 5px; font-size: 16px;">
        Go Back Home
    </a>
    <div class="row justify-content-center text-center mt-3">
        <div class="tenor-gif-embed" data-postid="14228003647965206973" data-share-method="host" data-aspect-ratio="1" data-width="20%"><a href="https://tenor.com/view/limbus-company-limbus-don-quixote-don-yapping-gif-14228003647965206973">Limbus Company Don Quixote GIF</a>from <a href="https://tenor.com/search/limbus+company-gifs">Limbus Company GIFs</a></div>
        <script type="text/javascript" async src="https://tenor.com/embed.js"></script>
    </div>

</div>

<?php
ViewHelper::loadJsScripts();
ViewHelper::loadFooter();
?>
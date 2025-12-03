<?php

use App\Helpers\ViewHelper;

use function DI\string;

$page_title = '404 - Page Not Found';
ViewHelper::loadHeader($page_title);
?>

<?php

function randomGIF()
{
    $gifs = [
        "https://tenor.com/view/don-quixote-meme-limbus-company-project-moon-yapping-gif-9568944924184521933",
        "https://tenor.com/view/don-quixote-don-limbus-company-limbus-dokibird-gif-4370949539332628256",
        "https://tenor.com/view/go-my-scarab-lobotomy-corporation-library-of-ruina-punishing-bird-apocalypse-bird-gif-6864640319894577960",
        "https://tenor.com/view/roland-lolang-library-of-ruina-lor-gif-3404051265727826411",
        "https://tenor.com/view/limbus-company-don-quixote-gif-6513598745099926539",
        "https://tenor.com/view/don-quixote-limbus-limbus-company-don-sancho-gif-11002003181537778115",
        "https://tenor.com/view/dante-limbus-company-ltg-gif-1576163327419096720",
        "https://tenor.com/view/limbus-limbus-company-don-quixote-gif-27606974",
        "https://tenor.com/view/limbus-company-gif-501081621266469291",
        "https://tenor.com/view/library-of-ruina-gif-26249605"
    ];

    $gif = $gifs[random_int(0, sizeof($gifs))];

    $linkExploded = explode("-", $gif);

    return $linkExploded[sizeof($linkExploded) - 1];
}
?>

<div style="text-align: center; padding: 50px 20px;">
    <h1 style="font-size: 72px; margin: 0; color: #e74c3c;">404</h1>
    <h2 style="margin: 20px 0;">Page Not Found</h2>
    <p style="font-size: 18px; color: #dcdcdcff; margin: 20px 0;">
        You may not find your book in this place.
    </p>

    <a href="<?= APP_BASE_URL ?>" style="display: inline-block; margin-top: 30px; padding: 12px 30px; background-color: #3498db; color: white; text-decoration: none; border-radius: 5px; font-size: 16px;">
        Back to home
    </a>

    <div class="row justify-content-center text-center mt-3">
        <div class="tenor-gif-embed" data-postid="<?= randomGIF() ?>" data-share-method="host" data-aspect-ratio="1" data-width="20%"></div>
        <script type="text/javascript" async src="https://tenor.com/embed.js"></script>
    </div>
</div>

<?php
ViewHelper::loadJsScripts();
ViewHelper::loadFooter();
?>
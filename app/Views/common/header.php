<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <link rel="stylesheet" href="/book-shop/public/assets/css/index.css">
    <link rel="stylesheet" href="/book-shop/public/assets/css/footer.css">
    <!-- TODO: include your CSS files here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="/book-shop/public/assets/css/navbar.css">
</head>

<body>
    <nav class="navbar navbar-main" data-bs-theme="dark">
        <div class="container-fluid text-center">
            <a class="navbar-brand" href="/book-shop/">
                <img src="/book-shop/public/assets/imgs/tail.png" alt="Logo" class="d-inline-block align-text-top" width="35" height="35">
            </a>
            <a class="nav-link" href="<?= APP_BASE_URL ?>/products"><?= trans('nav.catalog'); ?></a>
            <a class="nav-link" href="<?= APP_BASE_URL ?>/dashboard"><?= trans('nav.dashboard'); ?></a>
            <a class="nav-link" href="/book-shop/contact"><?= trans('nav.contact_us'); ?></a>
            <?php

            use App\Helpers\SessionManager;


            if (!SessionManager::get('user_id')): ?>
                <a class="nav-link sign-in" href="<?= APP_BASE_URL ?>/register"><?= trans('nav.sign_in'); ?></a>
            <?php endif; ?>
            <div class="language-switcher">
                <?php
                // Get current locale from global translator
                global $translator;
                $currentLocale = $translator->getLocale();
                $availableLocales = $translator->getAvailableLocales();
                ?>

                <?php foreach ($availableLocales as $locale): ?>
                    <?php if ($locale !== $currentLocale): ?>
                        <a href="?lang=<?= hs($locale) ?>" class="lang-link">
                            <?= $locale === 'en' ? 'English' : 'Français' ?>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>

                <span class="current-lang">
                    <?= $currentLocale === 'en' ? '🇬🇧 English' : '🇫🇷 Français' ?>
                </span>
            </div>
        </div>
    </nav>
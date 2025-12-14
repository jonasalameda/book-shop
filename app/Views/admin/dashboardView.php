<?php

use App\Helpers\FlashMessage;
use App\Helpers\ViewHelper;

ViewHelper::adminHeader('Admin Dashboard') ?>

<div class="container" style="max-width: 800px; margin: 50px auto;">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>
    <div><?= FlashMessage::render(); ?></div>

    <div class="welcome-section">
        <h2>Welcome, <?= htmlspecialchars($user['first_name'] ?? 'User') ?>!</h2>
        <p>Email: <?= htmlspecialchars($user['email'] ?? '') ?></p>
    </div>

    <hr>

    <div class="security-section">
        <h3>Security Settings</h3>

        <div class="security-card">
            <h4>Two-Factor Authentication (2FA)</h4>
            <?php if ($has2FA): ?>
                <p class="status status-enabled">✓ 2FA is <strong>enabled</strong></p>
                <p>Your account is protected with two-factor authentication.</p>

                <form method="POST" action="<?= '/' . APP_ROOT_DIR_NAME . '/2fa/disable' ?>">
                    <button type="submit" class="btn btn-danger">Disable 2FA</button>
                </form>
            <?php else: ?>
                <p class="status status-disabled">⚠ 2FA is <strong>disabled</strong></p>
                <p>Enable 2FA to add an extra layer of security to your account.</p>

                <a href="<?= '/' . APP_ROOT_DIR_NAME . '/2fa/setup' ?>" class="btn btn-primary">Enable 2FA</a>
            <?php endif; ?>
        </div>
    </div>

    <hr>

    <div class="actions">
        <form method="POST" action="<?= '/' . APP_ROOT_DIR_NAME . '/logout' ?>">
            <button type="submit" class="btn btn-secondary">Logout</button>
        </form>
    </div>
</div>

<?php ViewHelper::adminFooter() ?>

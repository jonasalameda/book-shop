<?php

use App\Helpers\FlashMessage;
use App\Helpers\TranslationHelper;
use App\Helpers\ViewHelper;

ViewHelper::loadHeader($data['title']);
?>

<div class="container py-5">

    <h1 class="text-center mb-5"><?= hs(trans('contact.contact-us')); ?></h1>

    <div class="row g-5 align-items-center">

        <div class="col-lg-6 d-flex justify-content-center">
            <img
                src="<?= APP_BASE_URL ?>/public/assets/imgs/ContactUs.jpg"
                class="img-fluid rounded shadow"
                style="height: 650px; width: 600; object-fit: cover;"
            />
        </div>

        <div class="col-lg-6">

            <div class="mb-4">
                <h2 class="fw-bold"><?= hs(trans('contact.message-us')); ?></h2>
                <p class="mt-3" style="color: white;">
                    <?= hs(trans('contact.send-message')); ?>
                </p>
            </div>

            <form action="contact" method="post" class="p-4 border rounded shadow-sm bg-light">

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="color: black;">To: info@ruinalibrary.com</label>
                </div>

                <div class="mb-4">
                    <textarea
                        name="message-box"
                        class="form-control"
                        id="contact-message"
                        rows="8"
                        placeholder="<?= hs(trans('contact.text-box')); ?>"
                        required
                    ></textarea>
                </div>

                <button type="submit" class="btn btn-success px-4">
                    <?= hs(trans('contact.send')); ?>
                </button>

            </form>

        </div>

    </div>

    <div class="mt-4">
        <?= FlashMessage::render() ?>
    </div>

</div>

<?php
ViewHelper::loadJsScripts();
ViewHelper::loadFooter();
?>

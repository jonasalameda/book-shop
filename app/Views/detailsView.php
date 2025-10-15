<?php
use App\Helpers\ViewHelper;

use function DI\get;

$page_title = $data['page_title'];
ViewHelper::loadHeader($page_title);
?>

<div class="container-fluid text-start">
    <div class="row">
        <div class="col text-center">
            <h1><?= $data["cafe"]["name"]?></h1>
            <h4>Ratings: <?= $data["average_rating"] ?> (<?= $data["total_ratings"] ?>)</h4>
            <p><?= $data["cafe"]["address"]?>,<?= $data["cafe"]["city"] ?>, <?= $data["cafe"]["state"]?>, <?= $data["cafe"]["zip_code"]?> </p>
            <p><?= $data["cafe"]["email"]?></p>
            <p><?= $data["cafe"]["website"]?></p>
            <p><?= $data["cafe"]["instagram_handle"]?></p>
            <p><?= $data["cafe"]["phone"]?></p>
            <p>Operating hours: <?= $data["cafe"]["opening_time"]?> to <?= $data["cafe"]["closing_time"]?></p>
            <p>Specialties: <?= $data["cafe"]["specialty"]?></p>
        </div>
        <div class="col" >
            <h1>Menu</h1>
            <?php foreach ($data['drinks'] as $key => $drink): ?>
                <div class="card w-25 p-3">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?= $drink['drink_name'] ?></h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary text-center"><?= $drink['price'] ?></h6>
                        <p class="card-text text-center"><?= $drink['category']; ?><?php echo $drink['is_signature'] == 1 ? ' (This drink is a signature product of this establishment)' : ''; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

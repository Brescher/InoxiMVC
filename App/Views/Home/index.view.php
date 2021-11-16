<?php /** @var Array $data */ ?>
<div class="container">
    <div class="row">
        <div class="d-flex justify-content-start flex-wrap">
            <?php foreach ($data['entrys'] as $entry) { ?>
                <div class="card" style="width: 18rem; margin: 5px">
                    <img src="<?= \App\Config\Configuration::UPLOAD_DIR . $entry->getImage() ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $entry->getTitle() ?></h5>
                        <p class="card-text"><?= $entry->getText() ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php /** @var Array $data */ ?>
<div class="container">
    <div class="row">
        <div class="d-flex justify-content-start flex-wrap">
            <?php foreach ($data['entrys'] as $entry) { ?>
                <div class="card" style="width: 18rem; margin: 5px">
                    <img src="<?= \App\Config\Configuration::LOAD_DIR . $entry->getImage() ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $entry->getTitle() ?></h5>
                        <p class="card-text"><?= $entry->getText() ?></p>
                        <a href="?c=home&a=update&entryid=<?= $entry->getId() ?>" class="btn btn-primary">
                            <i class="bi bi-arrow-up-square-fill"></i>
                        </a>
                        <a href="?c=home&a=deleteEntry&entryid=<?= $entry->getId() ?>" class="btn btn-primary">
                            <i class="bi bi-x-circle-fill"></i>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>



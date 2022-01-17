<?php
session_start();
?>
<div class="row">
    <div class="col">
        <form method="post" enctype="multipart/form-data" action="?c=forum&a=upload" onsubmit=" return validate(this)">
            <div>
                <label for="text">Text:</label>
                <textarea name="text" id="text" required></textarea>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Obrázok</label>
                    <input name="file" class="form-control" id="formFile" type="file" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Odoslať</button>
                </div>
            </div>
        </form>
        <p id="error_para" ></p>
    </div>
</div>

<?php /** @var Array $data */ ?>
<div class="container">
    <div class="row">
        <div class="d-flex justify-content-start flex-wrap">
            <?php foreach (array_reverse($data['posts'])  as $post) { ?>
                <div class="card" style="width: 18rem; margin: 5px">
                    <img src="<?= \App\Config\Configuration::LOAD_DIR . $post->getImage() ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $post->getUsername() ?></h5>
                        <p class="card-text"><?= $post->getText() ?></p>
                        <a href="?c=forum&a=updatePost&postid=<?= $post->getId() ?>" class="btn btn-primary">
                            <i class="bi bi-arrow-up-square-fill"></i>
                        </a>
                        <a href="?c=forum&a=deletePost&postid=<?= $post->getId() ?>" class="btn btn-primary">
                            <i class="bi bi-x-circle-fill"></i>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
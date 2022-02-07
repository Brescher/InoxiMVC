<?php
session_set_cookie_params(0);
session_start();
?>

<?php
if(isset($_SESSION['username'])) {
    $type = $_SESSION["usertype"];
    $adminName = "admin";
    if (!strcmp($type, $adminName)) { ?>
        <div class="row">
            <div class="col">
                <form method="post" enctype="multipart/form-data" action="?c=product&a=upload" class="form-entry" onsubmit=" return validate(this)">
                    <div>
                        <input type="text" name="name" id="name" class="textfield" placeholder="Názov produktu..." required><br>
                        <input type="text" name="material" id="material" class="textfield" placeholder="Materiál..." required><br>
                        <textarea name="description" id="description" class="textfield" placeholder="Popis..." multiple required></textarea>
                        <div class="mb-3">
                            <input name="file" class="form-control" id="formFile" type="file" placeholder="Obrázok..." required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn-form no-reg">Odoslať</button>
                        </div>
                    </div>
                    <p id="error_para" ></p>
                </form>
            </div>
        </div>
    <?php }
}
?>

<?php /** @var Array $data */ ?>
<div class="container-fluid" id="uPostsAll">
    <?php foreach (array_reverse($data['products']) as $product) { ?>
        <div class='main-container'>
            <div class='left-container'>
                <img src="<?= \App\Config\Configuration::LOAD_DIR . $product->getImage() ?>" class='img-thumbnail img-fluid rounded imgForum' alt='...' >
            </div>
            <div class='right-container'>
                <p><?= $product->getName() ?></p><br>
                <p>Materiál: <?= $product->getMaterial() ?></p><br>
                <p><?= $product->getDescription() ?></p><br>
                <div class="button-container">
                    <?php
                    if(isset($_SESSION['username'])) {
                        $type = $_SESSION["usertype"];
                        $adminName = "admin";
                        if (!strcmp($type, $adminName)) {
                            $productid = $product->getId();
                            echo "<a href='?c=product&a=updateProduct&productid=$productid' class='btn btn-update' title='update'>";
                            echo "    <i class='bi bi-arrow-up-square-fill update-button'></i>";
                            echo "</a>";
                            echo "<a href='?c=product&a=deleteProduct&productid=$productid' class='btn btn-delete' title='delete'>";
                            echo "    <i class='bi bi-x-circle-fill delete-button'></i>";
                            echo "</a>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>


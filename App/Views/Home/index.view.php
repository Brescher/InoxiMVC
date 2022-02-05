<?php
session_set_cookie_params(0);
session_start();
?>

<?php
if(isset($_SESSION['username'])) {
    $name = $_SESSION['username'];
    $adminName = "becho";
    if (!strcmp($name, $adminName)) { ?>
        <div class="row">
            <div class="col">
                <form method="post" enctype="multipart/form-data" action="?c=home&a=upload" class="form-entry" onsubmit=" return validate(this)">
                    <div>
                        <input type="text" name="title" id="title" class="textfield" placeholder="Titulok..." required><br>
                        <textarea name="text" id="text" class="textfield" placeholder="Text..." required></textarea>
                        <div class="mb-3">
                            <input  name="file[]" class="form-control" id="formFile" type="file" placeholder="Obrázok..." required>
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
    <?php foreach (array_reverse($data['entrys'])  as $entry) { ?>
        <div class='main-container'>
            <div class='left-container'>
                <img src="<?= \App\Config\Configuration::LOAD_DIR . $entry->getImage() ?>"  class='img-thumbnail img-fluid rounded imgForum'  alt='...' >
            </div>
            <div class='right-container'>
                <h5>
                    <?= $entry->getTitle() ?>
                    <div class="button-container">
                        <?php
                        if(isset($_SESSION['username'])) {
                            $name = $_SESSION['username'];
                            $adminName = "becho";
                            if (!strcmp($name, $adminName)) {
                                $postid = $entry->getId();
                                echo "<a href='?c=home&a=update&entryid=$postid' class='btn btn-primary'>";
                                echo "    <i class='bi bi-arrow-up-square-fill update-button'></i>";
                                echo "</a>";
                                echo "<a href='?c=home&a=deleteEntry&entryid=$postid' class='btn btn-primary'>";
                                echo "    <i class='bi bi-x-circle-fill delete-button'></i>";
                                echo "</a>";
                            }
                        }
                        ?>
                    </div>
                </h5>
                <p><?= $entry->getText() ?></p>
            </div>
        </div>
    <?php } ?>
</div>



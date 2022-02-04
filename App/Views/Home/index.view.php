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
                <form method="post" enctype="multipart/form-data" action="?c=home&a=upload" onsubmit=" return validate(this)">
                    <div>
                        <input type="text" name="title" id="title" class="textfield" required><br>
                        <textarea name="text" id="text" class="textfield" required></textarea>
                        <div class="mb-3">
                            <input name="file" class="form-control" id="formFile" type="file" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Odoslať</button>
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
<div class="container">
    <div class="row">
        <div class="d-flex justify-content-start flex-wrap">
            <?php foreach (array_reverse($data['entrys'])  as $entry) { ?>
                <div class="card" style="width: 18rem; margin: 5px">
                    <img src="<?= \App\Config\Configuration::LOAD_DIR . $entry->getImage() ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $entry->getTitle() ?></h5>
                        <p class="card-text"><?= $entry->getText() ?></p>
                        <?php
                        if(isset($_SESSION['username'])) {
                            $name = $_SESSION['username'];
                            $adminName = "becho";
                            if (!strcmp($name, $adminName)) {
                                $postid = $entry->getId();
                                echo "<a href='??c=home&a=update&entryid=$postid' class='btn btn-primary'>";
                                echo "    <i class='bi bi-arrow-up-square-fill'></i>";
                                echo "</a>";
                                echo "<a href='c=home&a=deleteEntry&entryid$postid' class='btn btn-primary'>";
                                echo "    <i class='bi bi-x-circle-fill'></i>";
                                echo "</a>";
                            }
                        }
                        ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>



<?php
session_set_cookie_params(0);
session_start();
?>
<?php
if(isset($_SESSION['userid'])){
    $user = $_SESSION['username'];
    $profile = $_GET['0'];
    if(strcmp($user,$profile) === 0){?>
    <div class="row">
        <div class="col">
            <form method="post" enctype="multipart/form-data" action="?c=forum&a=upload" onsubmit=" return validate(this)">
                <div>
                    <textarea name="text" id="text" class="textfield" required></textarea>
                    <div class="mb-3">
                        <input name="file" class="form-control" id="formFile" type="file" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Odoslať</button>
                    </div>
                </div>
                <p class="error_para" ></p>
            </form>
        </div>
    </div>
<?php    }
}
?>

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
                        <?php
                        if(isset($_SESSION['username'])) {
                            $name = $_SESSION['username'];
                            $postName = $post->getUsername();
                            if (!strcmp($name, $postName)) {
                                $postid = $post->getId();
                                echo "<a href='?c=forum&a=updatePost&postid=$postid' class='btn btn-primary forum'>";
                                echo "    <i class='bi bi-arrow-up-square-fill'></i>";
                                echo "</a>";
                                echo "<a href='?c=forum&a=deletePost&postid=$postid' class='btn btn-primary forum'>";
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
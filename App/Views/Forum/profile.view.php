<?php
session_set_cookie_params(0);
session_start();
?>
<?php
if(isset($_SESSION['userid'])){
    $user = $_SESSION['username'];
    $profile = $_GET['0'];
    if(strcmp($user,$profile) === 0){?>
        <a href='?c=login&a=deleteUser&userid=<?= $_SESSION['userid']?>' >
            <button type='button'>Vymazať účet.</button>
        </a>
        <div class="row">
            <div class="col">
                <form method="post" enctype="multipart/form-data" action="?c=forum&a=upload" class="form-entry" onsubmit=" return validate(this)">
                    <div>
                        <textarea name="text" id="text" class="textfield" placeholder="Text..." required></textarea>
                        <div class="mb-3">
                            <input name="file" class="form-control" id="formFile" type="file" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn-form no-reg">Odoslať</button>
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
<div class="container-fluid" id="uPostsAll">
    <?php foreach (array_reverse($data['posts'])  as $post) { ?>
    <div class='main-container'>
        <div class='left-container'>
            <img src="<?= \App\Config\Configuration::LOAD_DIR . $post->getImage() ?>"  class='img-thumbnail img-fluid rounded imgForum'  alt='...' >
        </div>
        <div class='right-container'>
            <h5><a href='?c=forum&a=profile&0='><?= $post->getUsername() ?></a>
                <div class="button-container">
                <?php
                if(isset($_SESSION['username'])) {
                    $name = $_SESSION['username'];
                    $postName = $post->getUsername();
                    if (!strcmp($name, $postName)) {
                        $postid = $post->getId();
                        echo "<a href='?c=forum&a=updatePost&postid=$postid' class='btn btn-update forum' title='update'>";
                        echo "    <i class='bi bi-arrow-up-square-fill'></i>";
                        echo "</a>";
                        echo "<a href='?c=forum&a=deletePost&postid=$postid' class='btn btn-delete forum' title='delete'>";
                        echo "    <i class='bi bi-x-circle-fill'></i>";
                        echo "</a>";
                    }
                }
                ?>
                </div>
            </h5>
            <p><?= $post->getText() ?></p>
        </div>
    </div>
    <?php } ?>
</div>
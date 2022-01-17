<div class="row">
    <div class="col">
        <form method="post" enctype="multipart/form-data" action="?c=forum&a=update&postid=<?php echo $postID = $_GET['postid']; ?>" onsubmit=" return validate(this)">
            <div>
                <?php
                $postID = $_GET['postid'];
                $post = \App\Models\Upost::getOne($postID);
                ?>
                <label for="text">Text:</label>
                <textarea name="text" id="text" required><?php  echo $post->getText()?></textarea>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Obrázok</label>
                    <input name="file" class="form-control" id="formFile" type="file">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary"">Odoslať</button>
                </div>
            </div>
        </form>
        <p id="error_para" ></p>
    </div>
</div>

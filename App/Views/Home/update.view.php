<?php
session_set_cookie_params(0);
session_start();
?>
<div class="row">
    <div class="col">
        <form method="post" enctype="multipart/form-data" action="?c=home&a=updateEntry&entryid=<?php echo $entryID = $_GET['entryid']; ?>" onsubmit=" return validate(this)">
            <div>
                <?php
                $entryID = $_GET['entryid'];
                $entry = \App\Models\Entry::getOne($entryID);
                ?>
                <input type="text" name="title" id="title" class="textfield" value="<?php  echo $entry->getTitle()?>" required><br>
                <textarea name="text" id="text" class="textfield" required><?php  echo $entry->getText()?></textarea>
                <div class="mb-3">
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

<?php
session_set_cookie_params(0);
session_start();
?>
<?php
    if(isset($_SESSION['userid'])){ ?>
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
<?php    }
?>


<div class="container">
    <div class="row">
        <div class="col">
            <div>
                <button id="btn-load-forum">Load</button>
            </div>
        </div>
    </div>
</div>

<?php /** @var Array $data */ ?>
<div class="container">
    <div class="row">
        <div id="uPostsAll" class="d-flex justify-content-start flex-wrap">

        </div>
    </div>
</div>
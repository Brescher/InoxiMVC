<?php
session_set_cookie_params(0);
session_start();
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
<div class="container-fluid" id="uPostsAll">

</div>
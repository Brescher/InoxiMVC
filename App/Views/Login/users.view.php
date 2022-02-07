<?php
session_set_cookie_params(0);
session_start();
?>


<?php
if(isset($_SESSION['username'])) {
$type = $_SESSION["usertype"];
$adminName = "admin";
if (!strcmp($type, $adminName)) { ?>

    <?php /** @var Array $data */ ?>
        <div class="container-fluid" id="uUsersAll">

        </div>
<?php }
}
?>



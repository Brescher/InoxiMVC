<?php
session_set_cookie_params(0);
session_start();
?>


<?php /** @var Array $data */ ?>
<div class="container-fluid" id="uPostsAll">
    <?php foreach (($data['users']) as $user) { ?>
        <div class='main-container' style="text-align: center">
            <div class="left-container">
                <p style="text-align: center"> <?= $user->getUsername() ?> <?= $user->getEmail() ?> <?= $user->getUserType() ?></p>
            </div>
            <div class="right-container">
                <div class="button-container">
                            <?php
                            if(isset($_SESSION['username'])) {
                                $type = $_SESSION["usertype"];
                                $adminName = "admin";
                                if (!strcmp($type, $adminName)) {
                                    $userid = $user->getId();
                                    echo "<a href='?c=login&a=addAdmin&userid=$userid' >";
                                    echo "     <button type='button'>Pridať admina</button> ";
                                    echo "</a>";
                                    echo "<a href='?c=login&a=removeAdmin&userid=$userid' >";
                                    echo "    <button type='button'>Odobrať admina</button> ";
                                    echo "</a>";
                                    echo "<a href='?c=login&a=deleteUser&userid=$userid' >";
                                    echo "    <button type='button'>Vymazať používateľa</button> ";
                                    echo "</a>";
                                }
                            }
                            ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

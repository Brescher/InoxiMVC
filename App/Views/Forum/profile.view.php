<p><?php
    session_set_cookie_params(0);
    session_start();

    if(isset($_SESSION['userid'])){
        echo $_SESSION['username'];
    } else {
        echo "no nic no";
    }?></p>

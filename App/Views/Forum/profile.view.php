<p><?php


    if(isset($_SESSION['userid'])){
        echo $_SESSION['username'];
    } else {
        echo "no nic no";
    }?></p>

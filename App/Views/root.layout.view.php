<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <title>InoxiPonia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="InoxiMVC/public/css.css">
    <script src="InoxiMVC/public/validation.js""></script>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-end sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">InoxiPonia </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="?c=home">Domov</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?c=home&a=contact">Kontakt</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?c=home&a=entry">Pridanie fotky</a>
                </li>

                <?php

                    if(isset($_SESSION["userid"])){
                        echo "<li class='nav-item'>";
                        echo "    <a class='nav-link' href='?c=login&a=register'>Profil</a>";
                        echo "</li>";
                        echo "<li class='nav-item'>";
                        echo "    <a class='nav-link' href='?c=login&a=logout'>Odhlásenie</a>";
                        echo "</li>";
                    } else {
                        echo "<li class='nav-item'>";
                        echo "    <a class='nav-link' href='?c=login&a=register&0='>Registrácia</a>";
                        echo "</li>";
                        echo "<li class='nav-item'>";
                        echo "    <a class='nav-link' href='?c=login&a=login'>Prihlásenie</a>";
                        echo "</li>";
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row mt-2">
        <div class="col">
                <?= $contentHTML ?>
        </div>
    </div>
</div>
</body>
</html>


<div class="row login-page">
    <div class="col form">
        <form method="post" action="?c=login&a=loginUser" class="login-form">
            <input type="text" name="username" id="username" placeholder="Používateľské meno/email..." required><br>
            <input type="password" name="password" id="password" placeholder="Heslo..." required><br>
            <button type="submit" name="login">Prihlásiť</button>
            <p class="message">Ešte nie ste registrovaný? <a href="?c=login&a=register&0=">Vytvoriť účet</a></p>
            <p id="error_para" class="errmsg"><?php echo ($_GET["0"])?></p>
        </form>

    </div>
</div>


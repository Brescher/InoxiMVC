<div class="row login-page">
    <div class="col form">
        <form method="post" action="?c=login&a=registerUser" class="register-form">
            <input type="text" name="email" id="email" placeholder="Email..." required><br>
            <input type="text" name="username" id="username" placeholder="Používateľské meno..." required><br>
            <input type="password" name="password" id="password" placeholder="Heslo..." required><br>
            <input type="password" name="passwordrepeat" id="passwordrepeat" placeholder="Zopakuj heslo..." required><br>
            <button type="submit" name="register" id="register" class="btn-form">Registrovať</button>
            <p class="message">Už máte účet? <a href="#">Prihláste sa.</a></p>
            <p id="error_para" class="errmsg" ><?php echo ($_GET["0"])?></p>
        </form>
    </div>
</div>
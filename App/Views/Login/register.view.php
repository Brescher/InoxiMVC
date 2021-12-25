<div class="row">
    <div class="col">
        <form method="post" action="?c=login&a=registerUser">
            <div>
                <input type="text" name="email" id="email" placeholder="Email..." ><br>
                <input type="text" name="username" id="username" placeholder="Používateľské meno..." required><br>
                <input type="password" name="password" id="password" placeholder="Heslo..." required><br>
                <input type="password" name="passwordrepeat" id="passwordrepeat" placeholder="Zopakuj heslo..." required><br>
                <div class="mb-3">
                    <button type="submit" name="register" class="btn btn-primary">Registrovať</button>
                </div>
            </div>
        </form>
        <p id="error_para" ><?php echo ($_GET["0"])?></p>
    </div>
</div>

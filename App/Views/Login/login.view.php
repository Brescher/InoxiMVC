<div class="row">
    <div class="col">
        <form method="post" action="?c=login&a=loginUser"">
            <div>
                <input type="text" name="username" id="username" placeholder="Používateľské meno/email..." required><br>
                <input type="password" name="password" id="password" placeholder="Heslo..." required><br>
                <div class="mb-3">
                    <button type="submit" name="login" class="btn btn-primary">Prihlásiť</button>
                </div>
            </div>
        </form>
        <p id="error_para" ><?php echo ($_GET["0"])?></p>
    </div>
</div>
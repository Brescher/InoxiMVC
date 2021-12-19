<div class="row">
    <div class="col">
        <form method="post" enctype="multipart/form-data" action="?c=home&a=upload" onsubmit=" return validate(this)">
            <div>
                <input type="text" name="username" id="username" placeholder="Používateľské meno/email..." required><br>
                <input type="password" name="password" id="password" placeholder="Heslo..." required><br>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Prihlásiť</button>
                </div>
            </div>
        </form>
        <p id="error_para" ></p>
    </div>
</div>
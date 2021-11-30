<div class="row">
    <div class="col">
        <form method="post" enctype="multipart/form-data" action="?c=home&a=upload" onsubmit=" return validate(this)">
            <div>
                <label for="name">Nazov:</label>
                <input type="text" name="title" id="title" required><br>
                <label for="text">Text:</label>
                <textarea name="text" id="text" required></textarea>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Obrázok</label>
                    <input name="file" class="form-control" id="formFile" type="file" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Odoslať</button>
                </div>
            </div>
        </form>
        <p id="error_para" ></p>
    </div>
</div>
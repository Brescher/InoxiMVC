<div class="row">
    <div class="col">
        <form method="post" enctype="multipart/form-data" action="?c=home&a=upload">
            <div>
                <label for="name">Nazov:</label>
                <input type="text" name="title" id="title"><br>
                <label for="text">Text:</label>
                <textarea name="text" id="text"></textarea>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Obrázok</label>
                    <input name="file" class="form-control" id="formFile" type="file">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Odoslať</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    function validate(form)
    {
        var validExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];

        var arrInputs = form.getElementsByTagName("input");
        for (var i = 0; i < arrInputs.length; i++) {
            var input = arrInputs[i];
            if (input.type == "file") {
                var fileName = input.value;
                if (fileName.length > 0) {
                    var isValid = false;
                    for (var j = 0; j < validExtensions.length; j++) {
                        var currentExtension = validExtensions[j];
                        var fileExtension = fileName.substr(fileName.length - currentExtension.length, currentExtension.length).toLowerCase();
                        if (fileExtension == currentExtension.toLowerCase()) {
                            isValid = true;
                            break;
                        }
                    }
                    if (!isValid) {
                        alert("Pardon, " + fileName + " je zlý typ súboru, dovolené prípony sú: " + validExtensions.join(", "));
                        return false;
                    }
                }
            }
        }

        return true;
    }
</script>

<div class="row">
    <div class="col">
        <form method="post" enctype="multipart/form-data" action="?c=home&a=updateEntry&entryid=<?php echo $entryID = $_GET['entryid'] ?>" onsubmit=" return validate(this)">
            <div>
                <?php
                $entryID = $_GET['entryid'];
                $entry = \App\Models\Entry::getOne($entryID);
                ?>
                <label for="name">Nazov:</label>
                <input type="text" name="title" id="title" value="<?php  echo $entry->getTitle()?>" required><br>
                <label for="text">Text:</label>
                <textarea name="text" id="text" required><?php  echo $entry->getText()?></textarea>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Obrázok</label>
                    <input name="file" class="form-control" id="formFile" type="file">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary"">Odoslať</button>
                </div>
            </div>
        </form>
        <p id="error_para" ></p>
    </div>
</div>

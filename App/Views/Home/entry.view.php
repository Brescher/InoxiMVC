<script type="text/javascript">
    function validate()
    {
        var error="";
        var title = document.getElementById( "title" );
        if( title.value == "" )
        {
            error = " Treba zadať nadpis! ";
            document.getElementById( "error_para" ).innerHTML = error;
            return false;
        }

        var text = document.getElementById( "text" );
        if( text.value == "" )
        {
            error = " Treba zadať text! ";
            document.getElementById( "error_para" ).innerHTML = error;
            return false;
        }

        var fileName = document.getElementById( "formFile" );
        if( fileName.value == "" )
        {
            error = " Treba zadať nejaký obrázok! ";
            document.getElementById( "error_para" ).innerHTML = error;
            return false;
        }

        else
        {
            return true;
        }
    }

</script>

<div class="row">
    <div class="col">
        <form method="post" enctype="multipart/form-data" action="?c=home&a=upload" onsubmit="return validate();">
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

    <p id="error_para" ></p>

    </div>
</div>
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

    if(document.getElementById("title") != null){
        let title = document.getElementById("title").value;

        if(title.length > 100){
            alert("Pardon, maximálna dĺžka nadpisu je 100 znakov.");
            return false;
        } else if (title.length < 10){
            alert("Pardon, minimálna dĺžka nadpisu je 10 znakov.");
            return false;
        }
    }

    if(document.getElementById("text") != null){
        let text = document.getElementById("text").value;

        if(text.length > 600){
            alert("Pardon, maximálna dĺžka textu je 600 znakov.");
            return false;
        } else if (text.length < 100){
            alert("Pardon, minimálna dĺžka textu je 100 znakov.");
            return false;
        }
    }

    if(document.getElementById("name") != null){
        let text = document.getElementById("name").value;

        if(text.length > 150){
            alert("Pardon, maximálna dĺžka názvu je 150 znakov.");
            return false;
        } else if (text.length < 50){
            alert("Pardon, minimálna dĺžka názvu je 50 znakov.");
            return false;
        }
    }

    if(document.getElementById("material") != null){
        let text = document.getElementById("material").value;

        if(text.length > 200){
            alert("Pardon, maximálna dĺžka popisu materiálu je 200 znakov.");
            return false;
        } else if (text.length < 10){
            alert("Pardon, minimálna dĺžka popisu materiálu je 10 znakov.");
            return false;
        }
    }

    if(document.getElementById("description") != null){
        let text = document.getElementById("description").value;

        if(text.length > 300){
            alert("Pardon, maximálna dĺžka popisu produktu je 300 znakov.");
            return false;
        } else if (text.length < 50){
            alert("Pardon, minimálna dĺžka popisu produktu je 50 znakov.");
            return false;
        }
    }

    return true;
}
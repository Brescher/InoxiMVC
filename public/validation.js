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
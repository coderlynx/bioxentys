$(document).ready(function(){
    $("#formAltaNovedad").submit(function(e){
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "controllerNovedad.php",
            mimeType:"multipart/form-data",
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                alert(data);
                console.log("Éxito");
                reset(); 
            },
            error: function(xhr, textStatus, error){
                console.log(xhr.statusText);
                console.log(textStatus);
                console.log(error);
            }
        });
        e.preventDefault();
    });
});

function reset() {
    document.getElementById("formAltaNovedad").reset();
    $("#titulo").focus();
}


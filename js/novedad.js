var Novedades = {
init: function() {
    var _this = this;
    _this.cargarNovedades();
    
    $("#novedad1").submit(function(e){
       
        var formData = new FormData(this);
        
        _this.realizarPeticon(formData);
        
        e.preventDefault();
        return false;
    });
    
    $("#novedad2").submit(function(e){
       
        var formData = new FormData(this);
        
        _this.realizarPeticon(formData);
        
        e.preventDefault();
        return false;
    });
    
    
    $(".cancelar").click(function(){

        $(this).parent().find("#titulo").val('');
        $(this).parent().find("#descripcion").val('');
        $(this).parent().find("#vinculo").val('');
        $(this).parent().find("#fecha").val('');
        
    });


    
    $("#logout").click(function(){
        
         $.ajax({
            type: "DELETE",
            url: "controllerAutenticacion.php",
            success: function(data){
                alert(data);
                window.location.href = "login.html";
            }
            })
        });

},
realizarPeticon:function(formData) {
     $.ajax({
            type: "POST",
            url: "controllerNovedad.php",
            mimeType:"multipart/form-data",
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                if(data == "ok") {
                    alert("Novedad carga exitosamente");
                    location.reload();
                } else {
                    alert(data);
                }
                //window.location.replace("index.html");
                //cargarNovedades(); 
            },
            error: function(xhr, textStatus, error){
                console.log(xhr.statusText);
                console.log(textStatus);
                console.log(error);
            }
        });
},
cargarNovedades: function() {
    var _this = this;
    var ruta = 'controllerNovedad.php';
    if ($("#novedades").length == 1) 
        ruta = 'panel/controllerNovedad.php';
    
    
    $.ajax({
        async:false,    
        cache:false,   
        type: "GET",
        url: ruta,
        success:  function(novedades){  
            var rta = JSON.parse(novedades);
           // var items = [];
            //for (i=0; i < rta.length; i++) {
                _this.dibujarNovedadesEnPantalla($("#novedad1"), rta[0]);
                _this.dibujarNovedadesEnPantalla($("#novedad2"), rta[1]);
            //}
        },
        error:function(xhr, textStatus, error){
            console.log(xhr.statusText);
            console.log(textStatus);
            console.log(error);
        }
    });
},
dibujarNovedadesEnPantalla: function(contenedor, novedad) {
    var _this = this;
    //si es llamado desde el index
    if ($("#novedades").length == 1) {
        contenedor.find("#id").html(novedad.id);
        contenedor.find("#titulo").html(novedad.titulo);
        contenedor.find("#descripcion").html(novedad.descripcion);
        contenedor.find("#vinculo").attr("href",novedad.vinculo);
        contenedor.find("#foto").attr("src",novedad.rutaFoto);
        contenedor.find("#fecha").html(novedad.fecha);
        
    } else { //si es desde el panel de carga
        contenedor.find("#id").val(novedad.id);
        contenedor.find("#titulo").val(novedad.titulo);
        contenedor.find("#descripcion").val(novedad.descripcion);
        contenedor.find("#vinculo").val(novedad.vinculo);
        contenedor.find("#prev").attr("src",novedad.rutaFoto);

        var dateAr = novedad.fecha.split('/');
        var newDate = dateAr[2] + '-' + dateAr[1] + '-' + dateAr[0];

        contenedor.find("#fecha").val(newDate);
    }
    
    /*var _this = this;
    contenedor.css("display","flex");
    var article_item = $("<article>");
    article_item.attr("id", novedad.id);
    article_item.addClass("novedad");

    var p = $("<p>");
    p.html("Título: " + novedad.titulo);
    article_item.append(p);
    
    var p = $("<p>");
    p.html("Fecha: " + novedad.fecha);
    article_item.append(p);
    
    var p = $("<p>");
    p.html("Descripción: " + novedad.descripcion);
    article_item.append(p);
    
    var img = $("<img src='" + novedad.rutaFoto + "'>");
    article_item.append(img);
    
    var a = $("<p><a href='" + novedad.vinculo + "' target='_blank'>Leer más</a></p>");
    article_item.append(a);
    
    contenedor.append(article_item);
    return article_item;*/
    
},
reset: function() {
    document.getElementById("formAltaNovedad").reset();
    $("#titulo").focus();
    window.location.href = "index.html";
}
}

$(document).ready(function(){
    cargarNovedades();
    
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
                window.location.replace("index.html");
                cargarNovedades(); 
            },
            error: function(xhr, textStatus, error){
                console.log(xhr.statusText);
                console.log(textStatus);
                console.log(error);
            }
        });
        e.preventDefault();
    });
    
    $("#login").click(function(){
        var usuario = {};
        usuario.nombre = $("#nombre").val();
        usuario.password = $("#password").val();
        
        var jsonUsuario = JSON.stringify(usuario);
    
         $.post('controllerAutenticacion.php', {usuario:jsonUsuario }, function(respuestaJson) {
               alert(respuestaJson);
               
            }).error(function(e){
                    console.log('Error al ejecutar la petición por:' + e);
                }
            );
    });
    
    $("#logout").click(function(){
        
         $.ajax({
            type: "DELETE",
            url: "controllerAutenticacion.php",
            success: function(data){
                alert(data);
            }
            })
        });

                      
    $("#cargar").click(function(){
        
         $.get('controllerAutenticacion.php', function(respuestaJson) {
             if(respuestaJson) {
                  alert(respuestaJson);
             } else {
                 window.location.href = "cargarNovedad.php";
             }
              
               
            }).error(function(e){
                    console.log('Error al ejecutar la petición por:' + e);
                }
            );
    });
    
    
});
function cargarNovedades() {
    var _this = this;
    $.ajax({
        async:false,    
        cache:false,   
        type: "GET",
        url: "controllerNovedad.php",
        success:  function(novedades){  
            var rta = JSON.parse(novedades);
            var items = [];
            for (i=0; i < rta.length; i++) {
                _this.dibujarNovedadesEnPantalla($("#novedades"), rta[i]);
            }
        },
        error:function(xhr, textStatus, error){
            console.log(xhr.statusText);
            console.log(textStatus);
            console.log(error);
        }
    });
}
function dibujarNovedadesEnPantalla(contenedor, novedad) {
    var _this = this;
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
    return article_item;		 
}
function reset() {
    document.getElementById("formAltaNovedad").reset();
    $("#titulo").focus();
    window.location.href = "index.html";
}


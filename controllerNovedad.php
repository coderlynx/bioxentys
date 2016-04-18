<?php 
require "novedad.php";
require "archivo.php";

// Tratamiento archivo
$archivo = new Archivo();
$archivo->nombreInput = key($_FILES);
$archivo->nombre = $_FILES[$archivo->nombreInput]['name'];
$archivo->tipo = $_FILES[$archivo->nombreInput]['type'];
$archivo->tamano = $_FILES[$archivo->nombreInput]['size'];
$archivo->directorio = "images\\";
$archivo->ruta = "$archivo->directorio"."$archivo->nombre";

if($archivo->validar()) {
    $cargaArchivoExitosa = $archivo->mover();
}

// Cargo novedad
if($cargaArchivoExitosa) {
    $novedad = new Novedad($_POST['titulo'], $_POST['fecha'], $_POST['descripcion'], $archivo->ruta, $_POST['vinculo']);
    Novedad::insert($novedad);
}
?>

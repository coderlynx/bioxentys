<?php 
require "novedad.php";
require "archivo.php";
session_start();

/* Trae todas las novedades */
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$novedades = Novedad::getAll();
	echo json_encode($novedades);
    exit;
}


/* Inserta novedades */
// Tratamiento archivo
$archivo = new Archivo();
$archivo->nombreInput = key($_FILES);
$archivo->nombre = $_FILES[$archivo->nombreInput]['name'];
$archivo->tipo = $_FILES[$archivo->nombreInput]['type'];
$archivo->tamano = $_FILES[$archivo->nombreInput]['size'];
$archivo->directorio = "images\\";
$archivo->ruta = "$archivo->directorio"."$archivo->nombre";

if($archivo->validar()) {
    //$cargaArchivoExitosa = $archivo->mover();
    $ruta_resize = $archivo->resize(150,150);
}

// Cargo novedad
if($ruta_resize) {
    $novedad = new Novedad(null, $_POST['titulo'], $_POST['fecha'], $_POST['descripcion'], $ruta_resize, $_POST['vinculo']);
    $nov = Novedad::insert($novedad);
    
    if($nov) echo 'Novedad cargada exitosamente';
}
?>

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

//si no hay foto cargada
if($_FILES['foto']['name'] == null && $_FILES['foto']['size'] == 0) 
    die('Debe cargar una imagen');

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
if(isset($ruta_resize)) {
    $novedad = new Novedad($_POST['id'], $_POST['titulo'], $_POST['fecha'], $_POST['descripcion'], $ruta_resize, $_POST['vinculo']);
    $nov = Novedad::insert($novedad);
    
    if($nov) echo 'ok';
}
?>

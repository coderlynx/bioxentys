<?php
require_once 'Usuario.php';
session_start();

//EXTRAER el metodo de la peticion (GET,POST,PUT,DELETE)
$metodo = strtolower($_SERVER['REQUEST_METHOD']);

// Filtrar método
switch ($metodo) {
    case 'get':
        if(!isset($_SESSION["nombre"])) {
            die("Debes loguearte");
        }
 
        break;
    case 'post':
        /*Valido Usuario */
        $usr = json_decode($_POST['usuario']);

        $rto = Usuario::login($usr->nombre, $usr->password);

        if ($rto === 0) die("El nombre y/o el password no son correctos.");

        echo 'Bienvenido: ' . $rto;

           
        break;
    case 'put':
    case 'delete':
        session_destroy();
        die("Sesion cerrada");

        break;
    default:
        echo 'Metodo no reconocible';

}
	



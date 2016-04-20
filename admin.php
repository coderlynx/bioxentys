<?php
session_start();

if(!isset($_SESSION["nombre"]))	{
    header("Location: login.html");  //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión) 
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bioxentys ADMIN</title>
    
    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,600,900' rel='stylesheet' type='text/css'>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- Animate CSS-->
    <link rel="stylesheet" href="../css/animate.css">

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Style -->
    <link href="../css/style.css" rel="stylesheet">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="js/lte-ie7.js"></script>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    
    <main>
        <div class="container admin">
           <p id="logout" style="cursor:pointer; text-align:right;">Cerrar Sesion </p> 
            <img src="../images/logo-panel.png" alt="BIOXENTYS">
            <h2 class="form-signin-heading">ALTA <span class="negrita">NOVEDADES</span></h2>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group new1">
                        <form id="novedad1" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="id" name="id" val="" />
                            <label for="titulo">Título</label>
                            <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Ingresar título" required autofocus>

                            <label for="descripcion">Descripción:</label>
                            <textarea class="form-control" name="descripcion" rows="5" id="descripcion" required></textarea>

                            <label for="vinculo">Vínculo a nota:</label>
                            <input type="text" id="vinculo" name="vinculo" class="form-control" placeholder="Ingresar vinculo" required>

                            <label for="fecha">Fecha:</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                            
                            <label for="foto">Subir imagen</label>
                            <input type="file" style="margin-bottom: 20px;" name="foto" id="foto1" required>
                            
                            <div>
                                <label for="thumb">Previsualización</label>
                                <img alt="thumb" id="prev" />
                            </div>
                            <button class="btn btn-success actualizar"  type="submit">ACTUALIZAR</button>
                            <input class="btn btn-success cancelar" type="button" value="CANCELAR"/>
<!--                            <button class="btn btn-danger" class="cancelar" >Cancelar</button>-->
 
                        </form>
                         
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group new1">
                        <form id="novedad2" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="id" name="id" val="" />
                            <label for="titulo">Título</label>
                            <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Ingresar título" required autofocus>

                            <label for="descripcion">Descripción:</label>
                            <textarea class="form-control" name="descripcion" rows="5" id="descripcion" required></textarea>

                            <label for="vinculo">Vínculo a nota:</label>
                            <input type="text" id="vinculo" name="vinculo" class="form-control" placeholder="Ingresar vinculo" required>

                            <label for="fecha">Fecha:</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                            
                            <label for="foto">Subir imagen</label>
                            <input type="file" style="margin-bottom: 20px;" name="foto" id="foto2" required>
                            
                            <div>
                                <label for="thumb">Previsualización</label>
                                <img alt="thumb" id="prev" />
                            </div>

                            <button class="btn btn-success actualizar" type="submit">ACTUALIZAR</button>
                            <input class="btn btn-success cancelar" type="button" value="CANCELAR"/>
<!--                            <button class="btn btn-danger cancelar">Cancelar</button>-->
                        </form>
                        
                    </div>
                </div>
            </div>
    </main>


<!-- =========================
     SCRIPTS 
============================== -->


    <script src="js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.nicescroll.js"></script>
    <script src="../js/wow.js"></script>
    <script src="../js/script.js"></script>
    <script src="js/novedad.js"></script>
     <script>
        
    $(document).ready(function(){
        
      Novedades.init();
        
    });
    </script>


</body>

</html>
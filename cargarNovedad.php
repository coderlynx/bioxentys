<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cargar Novedad</title>
</head>
<body>
  <form method="post" action="controllerNovedad.php" enctype="multipart/form-data">
    <fieldset>
      <legend>Ingreso de Novedad</legend>
      <label for="titulo">Título: </label>
      <br>
      <input type="text" id="titulo" name="titulo" size="100" maxlength="100" autofocus required>
      <br><br>
      <label for="fecha">Fecha: </label>
      <br>
      <input type="date" id="fecha" name="fecha" required>
      <br><br>
      <label for="descripcion">Descripción: </label>
      <br>
      <textarea id="descripcion" name="descripcion" cols="100" rows="10" placeholder="Ingrese descripción..." required></textarea>
      <br><br>
      <label for="vinculo">Link: </label>
      <br>
      <input type="url" id="vinculo" name="vinculo" size="100" maxlength="100" placeholder="http://www.novedad.com" required>
      <br><br>
      <label for="foto">Foto: </label>
      <br>
      <input type="file" name="foto" required>
      <!--<input type="hidden" name="MAX_FILE_SIZE" value="100000">-->
      <br><br>
      <input type="reset" value="Borrar Datos">
      <input type="submit" value="Cargar Novedad">
    </fieldset>
  </form>
</body>
</html>

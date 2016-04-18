<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Cargar Novedad</title>
  <script src="js/jquery.min.js"></script>
  <script src="js/novedad.js"></script>
</head>
<body>
  <form id="formAltaNovedad" method="post" enctype="multipart/form-data">
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
      <br><br>
      <input type="reset" value="Borrar Datos">
      <input type="submit" value="Cargar Novedad">
    </fieldset>
  </form>
</body>
</html>

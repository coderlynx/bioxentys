<?php 
class archivo {
  private $nombreInput;
  private $nombre;
  private $tipo;
  private $size;
  private $directorio;
  private $ruta;
  
  const MAX_SIZE = 100000;
  
  public function __get($property) {
    if (property_exists($this, $property)) {
        return $this->$property;
    }
  }

  public function __set($property, $value) {
    if (property_exists($this, $property)) {
        $this->$property = $value;
    }
  }

  public function validar() {
    if(!(strpos($this->tipo, "gif") || strpos($this->tipo, "jpeg")) || strpos($this->tipo, "jpg") || 
         strpos($this->tipo, "png")) {
      echo "La extensión del archivo no es correcta.<br>
            Se permiten archivos .gif o .jpeg o .png o jpg.<br>";
      return false;
    }
    if($this->size > self::MAX_SIZE) {
      echo "El tamaño del archivos no es correcto.<br>
            Se permiten archivos de 100 Kb máximo.<br>";
      return false;
    }
    return true;
  }

  public function mover() {
    if (move_uploaded_file($_FILES[$this->nombreInput]["tmp_name"], "$this->directorio/$this->nombre")){
      echo "El archivo ha sido cargado correctamente.";
      return true;
    }else{
      echo "El archivo no se ha podido guardar correctamente.";
      return false;
    }
  }
    
  public function resize($width, $height) {
      /* Get original image x y*/
      list($w, $h) = getimagesize($_FILES[$this->nombreInput]['tmp_name']);
      /* calculate new image size with ratio */
      $ratio = max($width/$w, $height/$h);
      $h = ceil($height / $ratio);
      $x = ($w - $width / $ratio) / 2;
      $w = ceil($width / $ratio);
      /* new file name */
      $path = 'images/'.$width.'x'.$height.'_'.$_FILES[$this->nombreInput]['name'];
      /* read binary data from image file */
      $imgString = file_get_contents($_FILES[$this->nombreInput]['tmp_name']);
      /* create image from string */
      $image = imagecreatefromstring($imgString);
      $tmp = imagecreatetruecolor($width, $height);
      imagecopyresampled($tmp, $image,
        0, 0,
        $x, 0,
        $width, $height,
        $w, $h);
      /* Save image */
      switch ($_FILES[$this->nombreInput]['type']) {
        case 'image/jpeg':
          imagejpeg($tmp, $path, 100);
          break;
        case 'image/png':
          imagepng($tmp, $path, 0);
          break;
        case 'image/gif':
          imagegif($tmp, $path);
          break;
        default:
          exit;
          break;
      }
      return $path;
      /* cleanup memory */
      imagedestroy($image);
      imagedestroy($tmp);
    }
}
?>
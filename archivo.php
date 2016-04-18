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
    if(!(strpos($this->tipo, "gif") || strpos($this->tipo, "jpeg"))) {
      echo "La extensión del archivo no es correcta.<br>
            Se permiten archivos .gif o .jpeg.<br>";
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
      echo "El archivo ha sido cargado correctamente.<br>";
      return true;
    }else{
      echo "El archivo no se ha podido guardar correctamente.<br>";
      return false;
    }
  }
}
?>
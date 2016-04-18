<?php 
require "DBConnection.php";

class Novedad implements JsonSerializable {
    private $id;
    private $titulo;
    private $fecha;
    private $descripcion;
    private $rutaFoto;
    private $vinculo;

    public function __construct($id = null, $titulo, $fecha, $descripcion, $rutaFoto, $vinculo) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->rutaFoto = $rutaFoto;
        $this->vinculo = $vinculo;
        $this->fecha = $fecha;
    }
    
    private function normalizeDate($date) {
        if(!empty($date)){ 
            $var = explode('/',str_replace('-','/',$date));
            return "$var[2]/$var[1]/$var[0]"; 
        }
    }
    
    public  function jsonSerialize() {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'fecha' => $this->fecha,
            'descripcion' => $this->descripcion,
            'rutaFoto' => $this->rutaFoto,
            'vinculo' => $this->vinculo
        ];	
	}
    
    public static function getAll(){
		try {
		    $query = "SELECT * FROM novedades";
		    $stmt = DBConnection::getStatement($query);
		   
		    if(!$stmt->execute()) {
                throw new Exception("Error al traer las novedades.");
			}
		  
			$novedades = array();
			
			while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
                $fechaNormalizada = self::normalizeDate($row['fecha']);
                $novedad = new Novedad($row['id'], $row['titulo'], $fechaNormalizada, $row['descripcion'], $row['rutaFoto'], $row['vinculo']);
              
                $novedades[] = $novedad;
			}
		    return $novedades;
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
		}
    }
    
    public static function insert($novedad){
    $db = DBConnection::getConnection();

    if($novedad->id) /*Modifica*/ {
        try	{
            $db->beginTransaction();

            $query = "UPDATE novedades SET titulo = :titulo, descripcion = :descripcion, fecha = :fecha, rutaFoto = :rutaFoto, vinculo = :vinculo WHERE id = :id";

            $stmt = DBConnection::getStatement($query);

            $stmt = Novedad::bindearDatos($stmt, $novedad);
            $stmt->bindParam(':id', $novedad->id, PDO::PARAM_INT);


            if(!$stmt->execute()) {
              throw new Exception("Error en el editado de la novedad.");
            }
            $db->commit();
            return $novedad;

        } catch(PDOException $e){
              echo 'Error: ' . $e->getMessage();
              $db->rollBack();
        }
    } else { 
        try	{
            $db->beginTransaction();

            $query = "INSERT INTO novedades (titulo, descripcion, fecha, rutaFoto, vinculo)
            VALUES(:titulo, :descripcion, :fecha, :rutaFoto, :vinculo)";

            $stmt = DBConnection::getStatement($query);
            $stmt = Novedad::bindearDatos($stmt, $novedad);

            if(!$stmt->execute()) {
              throw new Exception("Error en el insertado de la novedad.");
            }
            $novedad->id = $db->lastInsertId();
            $db->commit();
            return $novedad;

        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            $db->rollBack();
        }
    }
    }

    private static function bindearDatos($stmt, $novedad) {
    $stmt->bindParam(':titulo', $novedad->titulo, PDO::PARAM_STR);
    $stmt->bindParam(':descripcion', $novedad->descripcion, PDO::PARAM_STR);
    $stmt->bindParam(':fecha', $novedad->fecha, PDO::PARAM_STR);
    $stmt->bindParam(':rutaFoto', $novedad->rutaFoto, PDO::PARAM_STR);
    $stmt->bindParam(':vinculo', $novedad->vinculo, PDO::PARAM_STR);

    return $stmt;
    }
}
?>

<?php
require "DBConnection.php";

class Usuario implements JsonSerializable
{
	private $nombre;
    private $password;
    public static $MENSAJE;

 
    public function __construct($nombre, $password)
    {
		$this->nombre = $nombre;
        $this->password = $password;
    }
    
   
	
	public function jsonSerialize() 
	{
		$json = array();
		
		//foreach($this as $key=>)
		return [
			'nombre' => $this->nombre
		];
		
	}
    
    /**
	 * Retorna si existe el usuario el nombre o un 0 si no lo encuentra.
	 *
	 * @return $_SESSION el nombre de usuario en la session.
	 */
	public static function login($nombre, $password)
	{
		
		try {
			
			$query = "SELECT * from usuarios WHERE nombre = :nombre";
			$stmt = DBConnection::getStatement($query);

			$stmt->bindValue(':nombre',$nombre);
			//$stmt->bindValue(':password',$password_encriptado, PDO::PARAM_STR);
			
			$stmt->execute();
 
			//si existe el usuario
			if($stmt->rowCount() == 1)
			{
				 $row  = $stmt->fetch();
				 
				 //$password_encriptado = password_hash($password, PASSWORD_DEFAULT);                

				if (password_verify($password, $row['clave'])) {
					 
					$_SESSION['nombre'] = $row['nombre'];	
				 
					return $_SESSION['nombre'];
				} else {
					return 0;
				}
				 
			}
			
			return 0;
			
		}catch(PDOException $e){
			
			print "Error!: " . $e->getMessage();
			
		}		
		
	}
    
	/*GETTER Y SETTER */
	public function __get($propiedad)
	{
		return $this->$propiedad;
	}

}
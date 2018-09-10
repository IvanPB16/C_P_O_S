<?php  
   
require_once "conexion.php";

class ModeloSubCategorias{

	static public function MdlMostrarSubCategoria($table,$item,$valor){

		if ($item != null) {
			$statement = Conexion::Conectar()->prepare("SELECT * FROM $table WHERE :id = id");
			$statement ->bindParam(":id",$valor,PDO::PARAM_STR);
			$statement->execute();
			return $statement->fecht();			
		}else{
			$statement = Conexion::Conectar()->prepare("SELECT * FROM $table");
			$statement->execute();
			return $statement -> fetchAll();
		}

		$statement -> close();
		$statement = null;
	}
}


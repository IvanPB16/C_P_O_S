<?php  
    
require_once "conexion.php";

class ModeloCategorias {

	static public function MdlAgregarCategoria($tabla,$dato){

		$statement = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre) VALUES (:categoria)");

		$statement -> bindParam(":categoria",$dato,PDO::PARAM_STR);

		if($statement->execute()){
			return "ok";
		}else{
			return "error";
		}
		$statement -> close();
		$statement = null;

	}
 
 
	static public function MdlMostrarCategoria($tabla,$item,$valor){
		if ($item != null) {
				$statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item" );
				$statement -> bindParam(":".$item,$valor,PDO::PARAM_STR);
				$statement -> execute();
				return $statement -> fetch();
		}else{
				$statement = Conexion::conectar()->prepare("SELECT * FROM $tabla");
				$statement -> execute();
				return $statement -> fetchAll();
		}
		$statement -> close();
		$statement = null;
	}

	static public function MdlEditarCategoria($tabla,$dato){

		$statement = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre where id = :id");

		$statement -> bindParam(":nombre",$dato["nombre"],PDO::PARAM_STR);
		$statement -> bindParam(":id",$dato["id"],PDO::PARAM_INT);

		if($statement->execute()){
			return "ok";
		}else{
			return "error";
		}
		$statement -> close();
		$statement = null;


	}

	static public function MdlBorrarCategoria($tabla,$dato){

		$statement = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$statement -> bindParam(":id",$dato,PDO::PARAM_INT);
		
		if ($statement->execute()){
			return "ok";
		}else{
			return "error";
		}

		$statement->close();
		$statement=null;

	}

}
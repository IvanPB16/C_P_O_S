<?php  
    
require_once "conexion.php";

class ModeloSubCategorias{

	static public function mdlAgregarSub($table,$data){

		$statement = Conexion::conectar()->prepare("INSERT INTO $table (id_categoria,nombre) VALUES (:id_categoria,:nombre)");

		$statement -> bindParam(":id_categoria",$data["cat"],PDO::PARAM_INT);
		$statement -> bindParam(":nombre",$data["subCat"],PDO::PARAM_STR);

		if ($statement -> execute()) {
			return "ok";
		}else{
			return "error";
		}

		$statement -> close();
		$statement = null;
	}

	static public function mdlMostrarSubCategoria($tabla,$item,$valor){		
			$statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_categoria = :id");
			$statement -> bindParam(":id",$valor,PDO::PARAM_INT);
			$statement->execute();
			return $statement -> fetchAll();
		$statement -> close();
		$statement = null;
	}

	static public function mdlMostrarSub($tabla,$item,$valor){
			// SELECT * FROM `subcategoria` WHERE id_categoria = 3
			$statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$statement ->bindParam(":".$item,$valor,PDO::PARAM_INT);
			$statement->execute();
			return $statement -> fetchAll();
			$statement -> close();
			$statement = null;
	}

	static public function mdlMostrarSubDos($tabla,$item,$valor){
		// SELECT * FROM `subcategoria` WHERE id = 30
		$statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		$statement ->bindParam(":".$item,$valor,PDO::PARAM_INT);
		$statement -> execute();
		return $statement -> fetch();
		
		$statement -> close();
		$statement = null;
	}

	static public function mdlEditarSub($tabla,$dato){
		$statement = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre  WHERE id = :id");
		$statement -> bindParam(":id",$dato["id"],PDO::PARAM_INT);
		$statement -> bindParam(":nombre",$dato["nombre"],PDO::PARAM_STR);
		if($statement->execute()){
			return "ok";
		}else{
			return "error";
		}
		$statement -> close();
		$statement = null;
	}


	static public function mdlBorrarSub($tabla,$dato){
		$statement = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$statement->bindParam(":id",$dato,PDO::PARAM_INT);

		if ($statement->execute()){
			return "ok";
		}else{
			return "error";
		}

		$statement->close();
		$statement=null;
	}

}
 

<?php  
    
require_once "conexion.php";

class ModeloSubCategorias{

	static public function mdlAgregarSub($table,$data){

		$statement = Conexion::Conectar()->prepare("INSERT INTO $table (id_categoria,nombre) VALUES (:id_categoria,:nombre)");

		$statement -> bindParam(":id_categoria",$data["cat"],PDO::PARAM_INT);
		$statement -> bindParam(":nombre",$data["subCat"],PDO::PARAM_STR);

		if ($statement -> execute()) {
			return "ok";
		}else{
			return "error";
		}
	}


	static public function mdlMostrarSubCategoria($table,$item,$valor){

		if ($item != null) {
			$statement = Conexion::Conectar()->prepare("SELECT id_categoria,nombre FROM $table WHERE $item = :$item");
			$statement ->bindParam(":".$item,$valor,PDO::PARAM_STR);
			$statement->execute();
			return $statement->fecht();			
		}else{
			$statement = Conexion::Conectar()->prepare("SELECT * FROM $table WHERE id_categoria = :id");
			$statement ->bindParam(":id",$valor,PDO::PARAM_INT);
			$statement->execute();
			return $statement -> fetchAll();
		}

		$statement -> close();
		$statement = null;
	}
}
 

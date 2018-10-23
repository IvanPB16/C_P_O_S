<?php 
require_once "conexion.php";

class ModeloCliente{

	static public function mdlAgregarCliente($tabla,$data){

		$statement = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_cliente, numero_cliente,rfc, email, telefono) VALUES (:nombre,:numero,:rfc,:email,:telefono)");

		$statement -> bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
		$statement -> bindParam(":numero",$data["numero"],PDO::PARAM_INT);
		$statement -> bindParam(":rfc",$data["rfc"],PDO::PARAM_STR);
		$statement -> bindParam(":email",$data["correo"],PDO::PARAM_STR);
		$statement -> bindParam(":telefono",$data["telefono"],PDO::PARAM_STR);

		if($statement -> execute()){
			return "ok";
		}else{
			return "error";
		}

		$statement -> close();
		$statement = null;

	}

	static public function mdlMostrarCliente($tabla,$item,$valor){

		if ($item != null) {
			$statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$statement -> bindParam(":".$item,$valor,PDO::PARAM_STR);
			$statement -> execute();
			return $statement -> fetch();
		}else{
			$statement = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
			$statement -> execute();
			return $statement -> fetchAll();
		}
		$statement -> close();
		$statement = null;
	}

	static public function mdlEditarCliente($tabla,$data){

		$statement = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_cliente = :nombre, numero_cliente = :numero, rfc = :rfc, email = :correo, telefono = :telefono WHERE id = :id");

		$statement -> bindParam(":id",$data["id"],PDO::PARAM_INT);
		$statement -> bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
		$statement -> bindParam(":numero",$data["numero"],PDO::PARAM_INT);
		$statement -> bindParam(":rfc",$data["rfc"],PDO::PARAM_STR);
		$statement -> bindParam(":correo",$data["correo"],PDO::PARAM_STR);
		$statement -> bindParam(":telefono",$data["telefono"],PDO::PARAM_STR);

		if ($statement -> execute()) {
			return "ok";
		}else{
			return "error";
		}

		$statement -> close();
		$statement = null;
	}

	static public function mdlEliminarCliente($tabla,$data){

		$statement = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$statement ->bindParam(":id",$data,PDO::PARAM_INT);

		if ($statement -> execute()) {
				return "ok";
		}else{
			return "error";
		}

		$statement -> close();
		$statement = null;
	}

}


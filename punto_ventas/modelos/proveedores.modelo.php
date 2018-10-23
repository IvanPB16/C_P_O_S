<?php 
require_once "conexion.php";

class ModeloProveedor{

	static public function mdlAgregarProveedor($tabla,$data){

		$statement = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_proveedor,producto,telefono,correo)VALUES(:nombre,:producto,:telefono,:correo)");

		$statement -> bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
		$statement -> bindParam(":producto",$data["producto"],PDO::PARAM_STR);
		$statement -> bindParam(":telefono",$data["telefono"],PDO::PARAM_STR);
		$statement -> bindParam(":correo",$data["correo"],PDO::PARAM_STR);

		if ($statement -> execute()) {
			return "ok";
		}else{
			return "error";
		}

		$statement -> close();
		$statement = null;
	}

	static public function mdlMostrarProveedor($tabla,$item,$valor){

		if ($item != null) {
			$statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
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


	static public function mdlEditarProveedor($tabla,$data){

		$statement = Conexion::conectar()->prepare("UPDATE  $tabla SET nombre_proveedor = :nombre, producto = :producto ,telefono = :telefono, correo = :correo WHERE id = :id");

		$statement -> bindParam(":id",$data["id"],PDO::PARAM_STR);
		$statement -> bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
		$statement -> bindParam(":producto",$data["producto"],PDO::PARAM_STR);
		$statement -> bindParam(":telefono",$data["telefono"],PDO::PARAM_STR);
		$statement -> bindParam(":correo",$data["correo"],PDO::PARAM_STR);

		if ($statement -> execute()) {
			return "ok";
		}else{
			return "error";
		}

		$statement -> close();
		$statement = null;

	}

	static public function mdlEliminarProveedor($tabla,$data){

		$statement = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$statement -> bindParam(":id",$data,PDO::PARAM_INT);

		if ($statement -> execute()) {
			return "ok";
		}else{
			return "error";
		}
		$statement -> close();
		$statement = null;
	}
}

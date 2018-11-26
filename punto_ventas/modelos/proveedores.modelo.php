<?php 
require_once "conexion.php";

class ModeloProveedor{

	static public function mdlAgregarProveedor($tabla,$data){

		$statement = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_proveedor,producto,descripcion,telefono,correo)VALUES(:nombre,:producto,:descripcion,:telefono,:correo)");

		$statement -> bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
		$statement -> bindParam(":producto",$data["producto"],PDO::PARAM_STR);
		$statement -> bindParam(":descripcion",$data["descripcion"],PDO::PARAM_STR);
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

		$statement = Conexion::conectar()->prepare("UPDATE  $tabla SET nombre_proveedor = :nombre, producto = :producto, descripcion = :descripcion ,telefono = :telefono, correo = :correo WHERE id = :id");

		$statement -> bindParam(":id",$data["id"],PDO::PARAM_STR);
		$statement -> bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
		$statement -> bindParam(":producto",$data["producto"],PDO::PARAM_STR);
		$statement -> bindParam(":descripcion",$data["descripcion"],PDO::PARAM_STR);
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

	static public function mdlCrearOrden($tabla,$datos){
		$statement = Conexion::conectar()->prepare("INSERT INTO $tabla(id_proveedor,productos,total)VALUES(:id_proveedor,:productos,:total)");
		$statement -> bindParam(":id_proveedor",$datos["idProveedor"],PDO::PARAM_INT);
		$statement -> bindParam(":productos",$datos["lista"]);
		$statement -> bindParam(":total",$datos["Total"]);
		if ($statement -> execute()) {
			return "ok";
		}else{
			return "error";
		}

		$statement -> close();
		$statement = null;
	}

	static public function mdlMostrarOrden($tabla,$item,$valor){

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

	static public function mdlEditarOrden($tabla,$datos){

		$statement = Conexion::conectar()->prepare("UPDATE $tabla SET id_proveedor = :id_proveedor,productos =:productos, total = :total WHERE id = :id");
		$statement -> bindParam(":id",$datos["idOrden"],PDO::PARAM_INT);
		$statement -> bindParam(":id_proveedor",$datos["idProveedor"],PDO::PARAM_INT);
		$statement -> bindParam(":productos",$datos["lista"],PDO::PARAM_STR);
		$statement -> bindParam(":total",$datos["Total"],PDO::PARAM_STR);
		if ($statement -> execute()) {
			return "ok";
		}else{
			return "error";
		}

		$statement -> close();
		$statement = null;
	}

	static public function mdlEliminarOrde($tabla,$dato){

		$statement = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$statement -> bindParam(":id",$dato,PDO::PARAM_INT);

		if($statement -> execute()){
			return "ok";
		}else{
			return "error";
		}
		$statement ->close();
		$statement = null;

	}
}

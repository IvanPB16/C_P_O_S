
<?php 
require_once "conexion.php";

class ModeloPromocion{

	static public function mdlCrearPromocion($tabla,$dato){

		$statement = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_promocion,precio_promocion,productos,fecha_inicio,fecha_fin) VALUES (:nombre_promocion,:precio_promocion,:productos,:fecha_inicio,:fecha_fin)");

		$statement -> bindParam(":nombre_promocion",$dato["nombre"],PDO::PARAM_STR);
		$statement -> bindParam(":precio_promocion",$dato["precioPromo"],PDO::PARAM_STR);
		$statement -> bindParam(":productos",$dato["productos"],PDO::PARAM_STR);
		$statement -> bindParam(":fecha_inicio",$dato["fechaInicio"],PDO::PARAM_STR);
		$statement -> bindParam(":fecha_fin",$dato["fechaFinal"],PDO::PARAM_STR);
		if ($statement ->execute()) {
			return "ok";
		}else{
			return "false";
		}

		$statement -> close();
		$statement=null;

		
	}

	static public function mdlMostrarPromocion($tabla,$item,$valor){

		if($item != null){
			$statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$statement -> bindParam(":".$item,$valor,PDO::PARAM_STR);
			$statement -> execute();
			return $statement ->fetch();
		}else{
		$statement = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$statement -> execute();
		return $statement -> fetchAll();
		}

		$statement -> close();
		$statement = null;

	}

	static public function mdlEditarPromocion($tabla,$dato){

		$statement = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_promocion = :nombre_promocion,
			precio_promocion = :precio_promocion,
			productos = :productos,
			fecha_inicio = :fecha_inicio,
			fecha_fin = :fecha_fin WHERE nombre_promocion = :nombre_promocion");
		$statement -> bindParam(":nombre_promocion",$dato["nombre"],PDO::PARAM_STR);
		$statement -> bindParam(":precio_promocion",$dato["precioPromo"],PDO::PARAM_STR);
		$statement -> bindParam(":productos",$dato["productos"],PDO::PARAM_STR);
		$statement -> bindParam(":fecha_inicio",$dato["fechaInicio"],PDO::PARAM_STR);
		$statement -> bindParam(":fecha_fin",$dato["fechaFinal"],PDO::PARAM_STR);

		if ($statement -> execute()) {
			return "ok";
		}else{
			return "error";
		}

	}

	static public function mdlEliminarPromo($tabla,$dato){
		$statement = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_promocion = :id");

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


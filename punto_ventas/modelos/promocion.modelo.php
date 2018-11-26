
<?php 
require_once "conexion.php";

class ModeloPromocion{

	static public function mdlCrearPromocion($tabla,$dato){

		$statement = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_promocion,codigo,precio_promocion,fecha_inicio,fecha_fin,id_producto) VALUES (:nombre_promocion,:codigo,:precio_promocion,:fecha_inicio,:fecha_fin,:id_producto)");

		$statement -> bindParam(":nombre_promocion",$dato["nombre"],PDO::PARAM_STR);
		$statement -> bindParam(":codigo",$dato["codigo"],PDO::PARAM_INT);
		$statement -> bindParam(":precio_promocion",$dato["precioPromo"],PDO::PARAM_STR);
		$statement -> bindParam(":fecha_inicio",$dato["fechaInicio"],PDO::PARAM_STR);
		$statement -> bindParam(":fecha_fin",$dato["fechaFinal"],PDO::PARAM_STR);
		$statement -> bindParam(":id_producto",$dato["idproducto"],PDO::PARAM_STR);

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
			$statement = Conexion::conectar()->prepare("SELECT * FROM $tabla GROUP BY codigo");
			$statement -> execute();
			return $statement -> fetchAll();
			}

		$statement -> close();
		$statement = null;

	}

	static public function mdlMostrarPromocion2($tabla,$item,$valor){
		$statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		$statement -> bindParam(":".$item,$valor,PDO::PARAM_STR);
		$statement -> execute();

		return $statement ->fetchAll();
		$statement -> close();
		$statement = null;

	}

	static public function mdlEditarPromocion($tabla,$dato){

		$statement = Conexion::conectar()->prepare("UPDATE $tabla SET codigo = :codigo, nombre_promocion = :nombre_promocion,
			precio_promocion = :precio_promocion, id_producto = :id_producto,fecha_inicio = :fecha_inicio,fecha_fin = :fecha_fin WHERE nombre_promocion = :nombre_promocion");

		$statement -> bindParam(":nombre_promocion",$dato["nombre"],PDO::PARAM_STR);
		$statement -> bindParam(":codigo",$dato["codigo"],PDO::PARAM_INT);
		$statement -> bindParam(":precio_promocion",$dato["precioPromo"],PDO::PARAM_STR);
		$statement -> bindParam(":fecha_inicio",$dato["fechaInicio"],PDO::PARAM_STR);
		$statement -> bindParam(":fecha_fin",$dato["fechaFinal"],PDO::PARAM_STR);
		$statement -> bindParam(":id_producto",$dato["idproducto"],PDO::PARAM_STR);

		if ($statement ->execute()) {
			return "ok";
		}else{
			return "false";
		}

		$statement -> close();
		$statement=null;


	}

	static public function mdlEliminarPromo($tabla,$dato){
		$statement = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE codigo = :codigo");

		$statement -> bindParam(":codigo",$dato,PDO::PARAM_INT);

		if($statement -> execute()){
			return "ok";
		}else{
			return "error";
		}
		$statement ->close();
		$statement = null;

	}

}


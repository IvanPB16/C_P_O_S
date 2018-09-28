<?php
require_once "conexion.php";
 
Class ModeloVentas{

	public static function mdlMostrarVentas($tabla,$item,$valor){

		if($item != null){
			$statement = Conexion::Conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY fecha DESC");
			$statement = bindParam(":".$item,$valor,PDO::PARAM_STR);
			$statement -> execute();
			return $statement ->fetch();
		}else{
			$statement = Conexion::Conectar()->prepare("SELECT * FROM $tabla  ORDER BY fecha DESC");
			$statement -> execute();
			return $statement ->fetchAll();
		}

		$statement -> close();
		$statement = null;
	}
}





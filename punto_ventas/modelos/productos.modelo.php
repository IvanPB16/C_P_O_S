<?php 
  
require_once "conexion.php";
 
class ModeloProducto{

	static public function mdlMostrarProducto($tabla,$item,$valor){
		if ($item != null) {
			$statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");
			$statement -> bindParam(":".$item,$valor,PDO::PARAM_STR);
			$statement ->execute();
			return $statement -> fetch();
		}else{
			$statement = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$statement ->execute();
			return $statement -> fetchAll();
		}
			$statement -> close();
			$statement = null;	
	}

	static public function mdlCrearProducto($tabla,$data){

		$statement = Conexion::conectar()-> prepare("INSERT INTO $tabla(id_categoria,codigo,descripcion,imagen,stock,precio_compra,precio_venta) VALUES (:id_categoria,:codigo,:descripcion,:imagen,:stock,:precio_compra,:precio_venta)");

		$statement -> bindParam(":id_categoria",$data["id_categoria"],PDO::PARAM_INT);
		$statement -> bindParam(":codigo",$data["codigo"],PDO::PARAM_STR);
		$statement -> bindParam(":descripcion",$data["descripcion"],PDO::PARAM_STR);
		$statement -> bindParam(":imagen",$data["imagen"],PDO::PARAM_STR);
		$statement -> bindParam(":stock",$data["stock"],PDO::PARAM_STR);
		$statement -> bindParam(":precio_compra",$data["precio_compra"],PDO::PARAM_STR);
		$statement -> bindParam(":precio_venta",$data["precio_venta"],PDO::PARAM_STR);

		if ($statement->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$statement->close();
		$statement=null;

	}

	static public function mdlEditarProducto($tabla,$data){

		$statement = Conexion::conectar()-> prepare("UPDATE $tabla SET id_categoria = :id_categoria,descripcion = :descripcion,imagen = :imagen,stock = :stock,precio_compra = :precio_compra,precio_venta = :precio_venta WHERE codigo = :codigo");

		$statement->bindParam(":id_categoria",$data["id_categoria"],PDO::PARAM_INT);
		$statement->bindParam(":codigo",$data["codigo"],PDO::PARAM_STR);
		$statement->bindParam(":descripcion",$data["descripcion"],PDO::PARAM_STR);
		$statement->bindParam(":imagen",$data["imagen"],PDO::PARAM_STR);
		$statement->bindParam(":stock",$data["stock"],PDO::PARAM_STR);
		$statement->bindParam(":precio_compra",$data["precio_compra"],PDO::PARAM_STR);
		$statement->bindParam(":precio_venta",$data["precio_venta"],PDO::PARAM_STR);

		if ($statement->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$statement->close();
		$statement=null;

	}
 
	static public function mdlEliminarProducto($tabla,$data){

		$statement = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$statement -> bindParam(":id",$data,PDO::PARAM_INT);

		if($statement -> execute()){
			return "ok";
		}else{
			return "error";
		}

		$statement -> close();
		$statement=null;
	}
} 
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

		$statement = Conexion::conectar()-> prepare("INSERT INTO $tabla(nuevaclave,id_categoria,id_subcategoria,codigo,descripcion,imagen,stock,precio_compra,precio_venta) VALUES (:nuevaclave,:id_categoria,:id_subcategoria,:codigo,:descripcion,:imagen,:stock,:precio_compra,:precio_venta)");

		$statement -> bindParam(":nuevaclave",$data["nuevaClave"],PDO::PARAM_INT);
		$statement -> bindParam(":id_categoria",$data["id_categoria"],PDO::PARAM_INT);
		$statement -> bindParam(":id_subcategoria",$data["id_subcategoria"],PDO::PARAM_INT);
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

		$statement = Conexion::conectar()-> prepare("UPDATE $tabla SET nuevaclave = :nuevaclave,id_categoria = :id_categoria,id_subcategoria = :id_subcategoria,descripcion = :descripcion,imagen = :imagen,stock = :stock,precio_compra = :precio_compra,precio_venta = :precio_venta WHERE codigo = :codigo");

		$statement -> bindParam(":nuevaclave",$data["nuevaClave"],PDO::PARAM_INT);
		$statement -> bindParam(":id_categoria",$data["id_categoria"],PDO::PARAM_INT);
		$statement -> bindParam(":id_subcategoria",$data["id_subcategoria"],PDO::PARAM_INT);
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

	static public function MdlActualizarProducto($tabla,$item1,$valor1,$valor){

		$statement = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$statement -> bindParam(":".$item1,$valor1, PDO::PARAM_STR);
		$statement -> bindParam(":id",$valor, PDO::PARAM_STR);

		if ($statement->execute()) {
			return "ok";
		}else{
			return "error";
		}

		$statement->close();
		$statement = null; 
	}

	static public function mdlAddCantidadProducto($tabla,$dato){

		$statement = Conexion::conectar()->prepare("UPDATE $tabla SET stock = :stock WHERE codigo = :codigo");
		
		$statement->bindParam(":codigo",$dato["codigo"],PDO::PARAM_STR);
		$statement->bindParam(":stock",$dato["stockFinal"],PDO::PARAM_STR);

		if ($statement->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$statement->close();
		$statement=null;
	}

} 
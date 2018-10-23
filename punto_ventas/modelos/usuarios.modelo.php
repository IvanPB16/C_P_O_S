<?php
   
require_once "conexion.php";
 
class ModeloUsuarios{

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/
 
	static public function MdlMostrarUsuarios($tabla,$item,$valor){


		if($item != null){
			$statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$statement -> bindParam(":".$item,$valor, PDO::PARAM_STR);
			$statement -> execute();
			return $statement -> fetch();
		}else{
			$statement = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$statement -> execute();
			return $statement -> fetchAll();
		}
		
		$statement->close();
		$statement = null;

	}

	static public function MdlCrearUsuario($tabla,$datos){

		$statement = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre,usuario,password,perfil,foto) VALUES (:nombre,:usuario, :password,:perfil,:foto)");

		$statement->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$statement->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$statement->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$statement->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$statement->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);

		if ($statement->execute()) {
			return "ok";
		}else{
			return "error";
		}

		$statement->close();
		$statement = null; 

	}

	#editar usuario

	static public function MdlEditarUsuarios($tabla,$datos){
		$statement = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, password = :password, perfil = :perfil, foto = :foto WHERE usuario = :usuario");

		$statement->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$statement->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$statement->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$statement->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$statement->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

		if ($statement->execute()) {
			return "ok";
		}else{
			return "error";
		}

		$statement->close();
		$statement = null; 
	}


	#actualizar  usuario

	static public function MdlActualizarUsuario($tabla,$item1,$valor1,$item2,$valor2){

		$statement = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$statement -> bindParam(":".$item1,$valor1, PDO::PARAM_STR);
		$statement -> bindParam(":".$item2,$valor2, PDO::PARAM_STR);

		if ($statement->execute()) {
			return "ok";
		}else{
			return "error";
		}

		$statement->close();
		$statement = null; 
	}


	#borrar usuario
	static public function MdlBorrarUsuarios($tabla,$dato){

		$statement = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id"); 
		$statement -> bindParam(":id",$dato,PDO::PARAM_INT);


			if ($statement->execute()) {
				return "ok";
			}else{
				return "error";
			}

			$statement->close();
			$statement = null; 
	}
} 
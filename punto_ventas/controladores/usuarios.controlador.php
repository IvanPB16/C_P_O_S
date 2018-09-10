<?php
 
class ControladorUsuarios{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/
	static public function ctrIngresoUsuario(){
 
		if(isset($_POST["usuario"])){
			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuario"]) && 
				preg_match('/^[a-zA-Z0-9]+$/',$_POST["password"])){

				$encriptar = crypt($_POST["password"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				
				$tabla = "usuarios";
				$item = "usuario"; 
				$valor = $_POST["usuario"];

				$respuesta =  ModeloUsuarios::MdlMostrarUsuarios($tabla,$item,$valor);
				if($respuesta["usuario"] == $_POST["usuario"] && $respuesta["password"] == $encriptar){

					if ($respuesta["estado"] == 1) {

						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["id"] = $respuesta["id"];
						$_SESSION["nombre"] = $respuesta["nombre"];
						$_SESSION["usuario"] = $respuesta["usuario"];
						$_SESSION["foto"] = $respuesta["foto"];
						$_SESSION["perfil"] = $respuesta["perfil"];

						date_default_timezone_set('America/Mexico_City');

						$fecha = date('Y-m-d');
						$hora = date('H:i:s');

						$fechaActual = $fecha.' '.$hora;

						$item1 = "ultimo_login";
						$valor1 = $fechaActual;

						$item2 = "id";
						$valor2 = $respuesta["id"];

						$ultimoLogin = ModeloUsuarios::MdlActualizarUsuario($tabla,$item1,$valor1,$item2,$valor2);

						if ($ultimoLogin == "ok") {
							echo '<script>
								window.location = "inicio";
							</script>';
						}

						echo '<script>
								window.location = "inicio";
							</script>';
					}else{
						echo '<br><div class="alert alert-danger">El usuario no está activado</div>';
					}

				}else{
					echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';	
				}
			}
		}
	}
	/*=============================================
	Crear USUARIO
	=============================================*/
	static public function ctrCrearUsuario(){


		if(isset($_POST["nuevoUsuario"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])){

			   	$ruta = "";

			   	if (isset($_FILES["nuevaFoto"]["tmp_name"])) {

			   		list($ancho,$alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

			   		$nuevoAncho = 500;
			   		$nuevoAlto = 500;

			   		#directorio
			   		$directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];
			   		#asignanlos permisos 
			   		mkdir($directorio,0755);

			   		#configuracion para imagen jpg
			   		if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

			   			#para obtener un número aleaotorio
			   			$aleatorio = mt_rand(100,999);
			   			#ruta en donde se genera la imagen
			   			$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";
			   			
			   			#crea la imagen jpg
			   			$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
			   			#cuando se corte la imagen mantenga las propiedades
			   			$destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);

			   			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

			   			imagejpeg($destino,$ruta);
			   			
			   		}
			   		
			   	}
			   	if (isset($_FILES["nuevaFoto"]["tmp_name"])) {

			   		list($ancho,$alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

			   		$nuevoAncho = 500;
			   		$nuevoAlto = 500;

			   		#directorio
			   		$directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];
			   		#asignanlos permisos 
			   		mkdir($directorio,0755);

			   		#configuracion para imagen png
			   		if($_FILES["nuevaFoto"]["type"] == "image/png"){

			   			#para obtener un número aleaotorio
			   			$aleatorio = mt_rand(100,999);
			   			#ruta en donde se genera la imagen
			   			$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";
			   			
			   			#crea la imagen png
			   			$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);
			   			#cuando se corte la imagen mantenga las propiedades
			   			$destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);

			   			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

			   			imagepng($destino,$ruta);
			   			
			   		}
			   		
			   	}

			 	$tabla = "usuarios";
			 	
			 	$encriptar = crypt($_POST["nuevoPassword"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			   $dato = array("nombre" => $_POST["nuevoNombre"],
			   				"usuario" => $_POST["nuevoUsuario"],
			   				"password" =>$encriptar,
			   				"perfil" =>  $_POST["nuevoPerfil"],
			   				"ruta" =>  $ruta
			   				);

			   $respuesta =  ModeloUsuarios::MdlIngresarUsuario($tabla,$dato);

			   if ($respuesta == "ok") {
			   	echo 	'<script>
							swal({
							type: "success",
							title: "¡El usuario se guardo correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then((result)=>{
								if(result.value){
								window.location = "usuarios";
								}
							});
						</script>';
			   }
			}else{
				echo '<script>

					swal({

						type: "error",
						title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){
						
							window.location = "usuarios";

						}

					});
			 
				</script>';
			}
		}

	}
	/*=============================================
	Mostrar USUARIO
	=============================================*/

	static public function ctrMostrarUsuario($item,$valor){
		$tabla = "usuarios";
		$respuesta =  ModeloUsuarios::MdlMostrarUsuarios($tabla,$item,$valor);
		return $respuesta;
	}
	
	/*=============================================
	Editar USUARIO
	=============================================*/
	static public function ctrEditarUsuario(){
		if (isset($_POST["editarUsuario"])) {

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){

				$ruta = $_POST["fotoActual"];

				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

			   		list($ancho,$alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

			   		$nuevoAncho = 500;
			   		$nuevoAlto = 500;

			   		#directorio
			   		$directorio = "vistas/img/usuarios/".$_POST["editarUsuario"];

			   		//si el usuario tiene una foto solo remplaza, si no crea el directorio
			   		if(!empty($_POST["fotoActual"])){

						unlink($_POST["fotoActual"]);

					}else{

						mkdir($directorio, 0755);

					}	
			   		

			   		#configuracion para imagen jpg
			   		if($_FILES["editarFoto"]["type"] == "image/jpeg"){

			   			#para obtener un número aleaotorio
			   			$aleatorio = mt_rand(100,999);
			   			#ruta en donde se genera la imagen
			   			$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";
			   			
			   			#crea la imagen jpg
			   			$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);
			   			#cuando se corte la imagen mantenga las propiedades
			   			$destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);

			   			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

			   			imagejpeg($destino,$ruta);
			   			
			   		}
			   		if($_FILES["editarFoto"]["type"] == "image/png"){

			   			#para obtener un número aleaotorio
			   			$aleatorio = mt_rand(100,999);
			   			#ruta en donde se genera la imagen
			   			$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".png";
			   			
			   			#crea la imagen png
			   			$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);
			   			#cuando se corte la imagen mantenga las propiedades
			   			$destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);

			   			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

			   			imagepng($destino,$ruta);
			   			
			   		}
			   		
			   	}

			   	$tabla = "usuarios";

			   	if ($_POST["editarPassword"] != "") {

			   		if (preg_match('/^[a-zA-Z0-9]+$/',$_POST["editarPassword"])) {

			   			$encriptar = crypt($_POST["editarPassword"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			   		}else{
			   			echo '<script>

								swal({
									type: "error",
									title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
									}).then((result)=>{
										if(result.value){						
											window.location = "usuarios";
										}
									}); 		 
							</script>';
			   		}

			   	}else{
			   		$encriptar = $_POST["passwordActual"];
			   	}

			   	$datos = array("nombre"=>$_POST["editarNombre"],
			   				   "usuario"=>$_POST["editarUsuario"],
			   				   "password"=>$encriptar,
			   				   "perfil"=>$_POST["editarPerfil"],
			   				   "foto" => $ruta
			   				);
			   	$respuesta =  ModeloUsuarios::MdlEditarUsuarios($tabla,$datos);

			   	if ($respuesta == "ok") {
			   	echo 	'<script>
							swal({
							type: "success",
							title: "¡El usuario se actualizo correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then((result)=>{
								if(result.value){
								window.location = "usuarios";
								}
							});
						</script>';
			   } 

			}else{
				
			   	echo 	'<script>
							swal({
							type: "error",
							title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then((result)=>{
								if(result.value){
								window.location = "usuarios";
								}
							});
						</script>';
			   
			} 
		}
	} 

	/*=============================================
	borrar USUARIO
	=============================================*/

	static public function ctrBorrarUsuario(){
		if (isset($_GET["idUsuario"])) {
			$tabla = "usuarios";
			$dato = $_GET["idUsuario"];

			if ($_GET["fotoUsuario"] != "") {
				unlink($_GET["fotoUsuario"]);
				rmdir('vistas/img/usuarios/'.$_GET["usuario"]);
			}

			$respuesta =ModeloUsuarios::MdlBorrarUsuarios($tabla,$dato);

			   if ($respuesta == "ok") {
				   	echo 	'<script>
								swal({
								type: "success",
								title: "¡El usuario ha sido borrado correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
								}).then((result)=>{
									if(result.value){
									window.location = "usuarios";
									}
								});
							</script>';
			   }

		}
	}
}
	


 
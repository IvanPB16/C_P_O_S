<?php  
 class ControladorProducto{
 	
 	static public function ctrMostrarProducto($item,$valor){

 		$tabla ="producto";

 		$respuesta = ModeloProducto::mdlMostrarProducto($tabla,$item,$valor);

 		return $respuesta; 		
 	}

 	static public function ctrCrearProducto(){
 		
 		if(isset($_POST["nuevaDescripcion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoStock"]) &&	
			   preg_match('/^[0-9]+$/', $_POST["nuevoPrecioCompra"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoPrecioVenta"])){

				$ruta = "vistas/img/productos/default/anonymous.png";

				if (isset($_FILES["nuevaImagen"]["tmp_name"])) {
					list($ancho,$alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					$directorio = "vistas/img/productos/".$_POST["nuevaCodigo"];

					mkdir($directorio,0755);
				
					if ($_FILES["nuevaImagen"]["type"] == "image/jpeg") {

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["nuevaCodigo"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				   			imagejpeg($destino,$ruta);
					}
				
					if ($_FILES["nuevaImagen"]["type"] == "image/png") {
						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["nuevaCodigo"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				   			imagepng($destino,$ruta);
					}
				}


				$tabla = "producto";

				$data = array("id_categoria" => $_POST["nuevaCategoria"],
					"codigo"=> $_POST["nuevoCodigo"],
					"descripcion"=> $_POST["nuevaDescripcion"],
					"stock"=> $_POST["nuevoStock"],
					"precio_compra"=> $_POST["nuevoPrecioCompra"],
					"precio_venta"=> $_POST["nuevoPrecioVenta"],
					"imagen" => $ruta); 
 				$respuesta = ModeloProducto::mdlCrearProducto($tabla,$data);
 				
 				if ($respuesta == "ok") {
						echo '<script>
								swal({
								type: "success",
								title: "¡El producto se agrego correctamente se agrego correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
								}).then((result)=>{
									if(result.value){
									window.location = "productos";
									}
								})
							</script>';	
						}
				}else{
				echo '<script>
					swal({
						type: "error",
						title: "¡La descripción no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result)=>{
						if(result.value){
							window.location = "productos";
						}
					})
				</script>';
			
			}	
			
 		}
	
 	}



 }  
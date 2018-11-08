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
			   preg_match('/^[0-9]+$/', $_POST["nuevoClavePro"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoStock"]) &&	
			   preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioCompra"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioVenta"])){

				$ruta = "vistas/img/productos/default/anonymous.png";

				if (isset($_FILES["nuevaImagen"]["tmp_name"])) {
					list($ancho,$alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					$directorio = "vistas/img/productos/".$_POST["nuevoCodigo"];

					mkdir($directorio,0755);
				
					if ($_FILES["nuevaImagen"]["type"] == "image/jpeg") {

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["nuevoCodigo"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				   			imagejpeg($destino,$ruta);
					}
				
					if ($_FILES["nuevaImagen"]["type"] == "image/png") {
						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["nuevoCodigo"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				   			imagepng($destino,$ruta);
					}
				}


				$tabla = "producto";

				$data = array("nuevaClave"=>$_POST["nuevoClavePro"],
					"id_categoria" => $_POST["nuevaCategoria"],
					"id_subcategoria" => $_POST["nuevaSubCategoria"],
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
								title: "¡El producto se agrego correctamente!",
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

 	static public function ctrEditarProducto(){
 		
 		if(isset($_POST["editarDescripcion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarClavePro"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarStock"]) &&	
			   preg_match('/^[0-9.]+$/', $_POST["editarPrecioCompra"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editarPrecioVenta"])){

				$ruta = $_POST["imagenActual"];

				if (isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])) {

			   		list($ancho,$alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);

			   		$nuevoAncho = 500;
			   		$nuevoAlto = 500;

			   		$directorio = "vistas/img/productos/".$_POST["editarCodigo"];

			   		if(!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "vistas/img/productos/default/anonymous.png"){

			   			unlink($_POST["imagenActual"]);

			   		}else{
			   			mkdir($directorio, 0755);
			   		}

			   		/*tipo imagen jpg*/

			   		if ($_FILES["editarImagen"]["type"] == "image/jpeg"){
			   			
			   			$aleatorio = mt_rand(100,999);

			   			$ruta = "vistas/img/productos/".$_POST["editarCodigo"]."/".$aleatorio.".jpg";

			   			$origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);

			   			$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

			   			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
			   			imagejpeg($destino,$ruta);

			   		}

			   		if ($_FILES["editarImagen"]["type"] == "image/png"){
			   			
			   			$aleatorio = mt_rand(100,999);

			   			$ruta = "vistas/img/productos/".$_POST["editarCodigo"]."/".$aleatorio.".png";

			   			$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);

			   			$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

			   			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
			   			imagepng($destino,$ruta);

			   		}

			   	}


				$tabla = "producto";

				$data = array("nuevaClave"=>$_POST["editarClavePro"],
					"id_categoria" => $_POST["editarCategoria"],
					"id_subcategoria" => $_POST["editarSubCategoria"],
					"codigo"=> $_POST["editarCodigo"],
					"descripcion"=> $_POST["editarDescripcion"],
					"stock"=> $_POST["editarStock"],
					"precio_compra"=> $_POST["editarPrecioCompra"],
					"precio_venta"=> $_POST["editarPrecioVenta"],
					"imagen" => $ruta); 
				var_dump($data);
 				$respuesta = ModeloProducto::mdlEditarProducto($tabla,$data);
 				
 				if ($respuesta == "ok") {
						echo '<script>
								swal({
								type: "success",
								title: "¡El producto se actualizo correctamente!",
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

 	static public function ctrEliminarProducto(){
 		
 		if (isset($_GET["idProducto"])) {
 			$tabla = "producto";
 			$data = $_GET["idProducto"];

 			if ($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/productos/default/anonymous.png") {
 				unlink($_GET["imagen"]);
 				rmdir('vistas/img/productos/'.$_GET["codigo"]);
 			}

 			$enviar = ModeloProducto::mdlEliminarProducto($tabla,$data);

 			if ($enviar == "ok") {
				echo '<script>
					swal({
					type: "success",
					title: "¡El producto se elimino correctamente!",
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

	static public function ctrAddCantidadProducto(){
		if (isset($_POST["stockFN"])) {
			if (preg_match('/^[0-9]+$/', $_POST["stockFN"])){
				$tabla = "producto";

				$dato = array("codigo" => $_POST["numeroAyuda"],"stockFinal" => $_POST["stockFN"]);

				$respuesta = ModeloProducto::mdlAddCantidadProducto($tabla,$dato);

				if ($respuesta == "ok") {
					echo '<script>
								swal({
								type: "success",
								title: "¡El cantidad se agrego correctamente!",
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
								type: "success",
								title: "¡Error al intentar agregar datos nuevos!",
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
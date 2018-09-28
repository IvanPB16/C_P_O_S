<?php 
  
class ControladorCategorias{
	
	static public function ctrAgregarCategoria(){
		if (isset($_POST["nuevaCategoria"])){

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoria"])) {

				$tabla = "categoria";

				$dato = $_POST["nuevaCategoria"];

				$respuesta = ModeloCategorias::MdlAgregarCategoria($tabla,$dato);
					if ($respuesta == "ok") {
						echo 	'<script>
									$.when(swal({
				                        type: "success",
				                        title: "¡Categoría agregada!",
				                        showConfirmButton: true,
				                        confirmButtonText: "Cerrar",
				                        closeOnConfirm: true
				                        }).then((result)=>{
				                            if(result.value){
				                                window.location = location.origin+"/categorias";
				                            }
				                       })).done(function(){
				                           $(".swal2-container").on("click",function () {
				                            window.location = location.origin+"/categorias";
				                           });
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
							window.location = "categorias";
						}
					});
				</script>';
			
			}			
		}
	}

	static public function ctrMostrarCategorias($item,$valor){
		
		$tabla = "categoria";

		$respuesta = ModeloCategorias::MdlMostrarCategoria($tabla,$item,$valor);

		return $respuesta;

	}
 
	static public function ctrEditarCategoria(){
		if (isset($_POST["editarCategoria"])){
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarCategoria"])) {

				$tabla = "categoria";
				$dato = array("nombre"=>$_POST["editarCategoria"],"id"=>$_POST["idCategoria"]);

				$respuesta = ModeloCategorias::MdlEditarCategoria($tabla,$dato);

					if ($respuesta == "ok") {
						echo 	'<script>
									swal({
									type: "success",
									title: "¡La categoría se modificó correctamente!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
									}).then((result)=>{
										if(result.value){
										window.location = "categorias";
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
							window.location = "categorias";
						}
					});
				</script>';

			}


		}
	}

	static public function ctrBorrarCategoria(){
		if (isset($_GET["idCategoria"])) {
			$tabla = "categoria";
			$dato = $_GET["idCategoria"];

			$respuesta = ModeloCategorias::MdlBorrarCategoria($tabla,$dato);
 
			if ($respuesta == "ok") {
				echo 	'<script>
								swal({
								type: "success",
								title: "¡La categoria ha sido borrado correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
								}).then((result)=>{
									if(result.value){
									window.location = "categorias";
									}
								});
							</script>';
			}
		}


	}
} 
<?php 
 
class ControladorSubCategorias{

	static public function ctrSubAgregarCategoria(){
		if(isset($_POST["nuevaSubCategoria"])){
			if(preg_match('/^[a-zA-Z ]+$/', $_POST["nuevaSubCategoria"])){
				
				$table = "subcategoria";

				$data = array("cat"=>$_POST["nuevoAgregarSubCategoria"],
					"subCat" => $_POST["nuevaSubCategoria"]
							);

				$enviar = ModeloSubCategorias::mdlAgregarSub($table,$data);

				if ($enviar == "ok") {
					echo '<script>
							swal({
								type:"success",
								title:"¡Subcategoria agregada correctamente!",
								showConfirmButton: true,
								confirmButtonText:"Cerrar",
								closeOnConfirm: false
								}).then((res)=>{
									if(res.value){
										window.location = "subcategorias";
									}
								});
						 </script>';
				}

			}else{

				echo '<script>
							swal({
								type:"warning",
								title:"¡Información invalidad en algún campo!",
								showConfirmButton: true,
								confirmButtonText:"Cerrar",
								closeOnConfirm: false
								}).then((res)=>{
									if(res.value){
										window.location = "subcategorias";
									}
								});
						 </script>';

			}
		}

	}

	static public function ctrMostrarSubCategorias($item,$valor){
		$tabla = "subcategoria";

		$respuesta = ModeloSubCategorias::mdlMostrarSubCategoria($tabla,$item,$valor);

		return $respuesta;
	}
	static public function ctrEditarMostrar($item,$valor){
	$tabla = "subcategoria";
	$respuesta = ModeloSubCategorias::mdlEditarMostrar($tabla,$item,$valor);

	return $respuesta;
	}
	
	static public function ctrBorrarSub(){
		if (isset($_GET["idSub"])) {
			$tabla = "subcategoria";
			$dato = $_GET["idSub"];


			$respuesta = ModeloSubCategorias::mdlBorrarSub($tabla,$dato);
			if ($respuesta == "ok") {
				echo 	'<script>
								swal({
								type: "success",
								title: "¡La subcategoria ha sido borrado correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
								}).then((result)=>{
									if(result.value){
									window.location = "subcategorias";
									}
								});
							</script>';
			}
			
		}
	}

} 
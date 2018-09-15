<?php 
 
class ControladorSubCategorias{

	static public function ctrSubAgregarCategoria(){
		if(isset($_POST["nuevaSubCategoria"])){
			if(preg_match('/^[a-zA-Z ]+$/', $_POST["nuevaSubCategoria"])){
				
				$table = "subcategoria";

				$data = array("cat"=>$_POST["nuevoAgregarCategoria"],
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
		$table = "subcategoria";

		$res = ModeloSubCategorias::mdlMostrarSubCategoria($table,$item,$valor);

		return $res;
	}


} 
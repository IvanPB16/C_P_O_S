<?php

class ControladorProveedor{

	static public function ctrAgregarProveedor(){
		if (isset($_POST["nuevoProveedor"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoProveedor"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoArticulo"]) &&
				preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) &&
				preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"])) {

				$tabla = "proveedor";

				$data = array("nombre"=>$_POST["nuevoProveedor"],
							  "producto"=>$_POST["nuevoArticulo"],
							  "telefono"=>$_POST["nuevoTelefono"],
							  "correo"=>$_POST["nuevoEmail"]
							   );

				$enviar = ModeloProveedor::mdlAgregarProveedor($tabla,$data);
				if ($enviar == "ok") {
					echo '<script>
							swal({
								type:"success",
								title:"Proveedor agregado correctamente!",
								showConfirmButton: true,
								confirmButtonText:"Cerrar",
								closeOnConfirm: false
								}).then((res)=>{
									if(res.value){
										window.location = "proveedores";
									}
								});
					 		</script>';
				}
			}else{
				echo '<script>
							swal({
								type:"warning",
								title:"¡La información en algún campo es incorrecta!",
								showConfirmButton: true,
								confirmButtonText:"Cerrar",
								closeOnConfirm: false
								}).then((res)=>{
									if(res.value){
										window.location = "proveedores";
									}
								});
					 		</script>';
			}
		}
	}

	static public function ctrMostrarProveedor($item,$valor){

		$tabla = "proveedor";

		$enviar = ModeloProveedor::mdlMostrarProveedor($tabla,$item,$valor);

		return $enviar;

	}

	static public function ctrEditarProveedor(){
		if (isset($_POST["editarProveedor"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarProveedor"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarArticulo"]) &&
				preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) &&
				preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"])) {

				$tabla = "proveedor";

				$data = array("id"=>$_POST["IdProv"],
							  "nombre"=>$_POST["editarProveedor"],
							  "producto"=>$_POST["editarArticulo"],
							  "telefono"=>$_POST["editarTelefono"],
							  "correo"=>$_POST["editarEmail"]
							   );


				$res = ModeloProveedor::mdlEditarProveedor($tabla,$data);

				if ($res == "ok") {
					echo '<script>
							swal({
								type:"success",
								title:"Proveedor editado correctamente!",
								showConfirmButton: true,
								confirmButtonText:"Cerrar",
								closeOnConfirm: false
								}).then((res)=>{
									if(res.value){
										window.location = "proveedores";
									}
								});
					 		</script>';
				}
			}else{
				echo '<script>
							swal({
								type:"warning",
								title:"¡La información en algún campo es incorrecta!",
								showConfirmButton: true,
								confirmButtonText:"Cerrar",
								closeOnConfirm: false
								}).then((res)=>{
									if(res.value){
										window.location = "proveedores";
									}
								});
					 		</script>';
			}
		}
	}

	static public function ctrEliminarProveedor(){

		if (isset($_GET["idProveedor"])) {
			
			$tabla = "proveedor";
			$data = $_GET["idProveedor"];

			$enviar = ModeloProveedor::mdlEliminarProveedor($tabla,$data);

			if ($enviar == "ok") {
				echo '<script>
						swal({
							type:"success",
							title:"Proveedor eliminado correctamente!",
							showConfirmButton: true,
							confirmButtonText:"Cerrar",
							closeOnConfirm: false
							}).then((res)=>{
								if(res.value){
									window.location = "proveedores";
								}
							});
					 </script>';
			}

		}
	}

}

